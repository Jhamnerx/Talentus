<?php

namespace App\Livewire\Admin\Facturacion\Nota;


use Carbon\Carbon;
use App\Models\Series;
use App\Models\Ventas;
use Livewire\Component;
use App\Models\plantilla;
use App\Models\NotaCredito;
use App\Models\TipoComprobantes;
use Illuminate\Support\Collection;
use App\Http\Requests\NotaDeCreditoRequest;
use App\Http\Controllers\Admin\UtilesController;
use App\Http\Controllers\Admin\Facturacion\Api\ApiFacturacion;
use App\Models\NotaDebito;

class Emitir extends Component
{
    //PROPIEDADES DE NOTA
    public $tipo_comprobante_id, $serie, $correlativo, $serie_correlativo,
        $fecha_emision;
    public $sustento_id;
    public $divisa, $tipo_cambio, $op_gravadas, $op_exoneradas, $op_inafectas, $op_gratuitas, $descuento = 0.00,
        $sub_total, $icbper, $igv, $total, $cliente_id, $sustento_texto;


    //PROPIEDAD PARA ASIGNAR EL MINIMO DEL CORRELATIVO
    public $min_correlativo;


    //PROPIEDADES PARA INVOICE SELECCIONADO
    public $invoice_id;
    public $invoice_id_new;
    public Ventas $invoice;

    public $serie_ref, $correlativo_ref, $serie_correlativo_ref, $invoice_divisa = "PEN", $invoice_fecha_emision, $invoice_fecha_vencimiento, $invoice_metodo_pago_id = "009", $invoice_comentario;
    public $invoice_tipo_descuento = "cantidad", $invoice_descuento_factor, $invoice_forma_pago = "CONTADO";
    public $invoice_cliente_id, $invoice_cliente_razon_social, $invoice_cliente_direccion;

    public $invoice_sub_total = 0.00, $invoice_op_gravadas = 0.00, $invoice_op_exoneradas = 0.00, $invoice_op_inafectas = 0.00,
        $invoice_op_gratuitas = 0.00, $invoice_descuento = 0.00, $invoice_igv = 0.00, $invoice_icbper = 0.00,  $invoice_total;

    public $simbolo = "S/. ";
    public $cliente;

    //PROPIEDADES UTILES
    public $comprobante_slug;
    public $tipo_comprobante_ref = '01';
    public $titulo_select_new = 'Factura';
    public $invoice_descuento_monto = 0.00;

    public plantilla $plantilla;

    public Collection $items;


    public function mount()
    {
        $this->tipo_comprobante_id = TipoComprobantes::where('slug', $this->comprobante_slug)->first()->codigo;
        $this->setSerieMount();

        //ESTABLACER FECHAS DEFAULT
        $this->fecha_emision = Carbon::now()->format('Y-m-d');
        $this->invoice_fecha_emision = Carbon::now()->format('Y-m-d');
        $this->invoice_fecha_vencimiento = Carbon::now()->format('Y-m-d');
        $this->items = collect();

        //$this->detalle_cuotas = collect();
        //  CONSULTAR TIPO CAMBIO
        $util = new UtilesController;
        // $this->tipo_cambio = $util->tipoCambio();
        $this->plantilla = plantilla::first();


        //
    }
    public function render()
    {

        return view('livewire.admin.facturacion.nota.emitir');
    }

    public function setSerieMount()
    {
        $serie = Series::where('tipo_comprobante_id', $this->tipo_comprobante_id)->first();
        $this->serie = $serie->serie;
        $this->correlativo = $serie->correlativo + 1;
        $this->min_correlativo = $serie->correlativo + 1;
        $this->serie_correlativo = $this->serie . "-" . $this->correlativo;
    }

    public function verIframe()
    {
        $this->dispatch('ver-iframe-pdf', serie_correlativo: $this->serie_correlativo_ref);
    }

    public function updatedInvoiceId($value)
    {
        $this->resetItems();
    }


    public function updatedTipoComprobanteRef($value)
    {
        $this->checkSerie();

        if ($value == '01') {

            $this->validate(
                [
                    'serie' => 'starts_with:F',
                ],
                [
                    'serie.starts_with' => 'Al seleccionar factura la serie debe iniciar con "F"'
                ]
            );
        } else {

            $this->validate(
                [
                    'serie' => 'starts_with:B',
                ],
                [
                    'serie.starts_with' => 'Al seleccionar boleta la serie debe iniciar con "B"'
                ]
            );
        }
    }

    public function updated($attr)
    {
        $request = new NotaDeCreditoRequest();
        $this->validateOnly($attr, $request->rules($this->tipo_comprobante_ref), $request->messages());
    }

    public function checkSerie()
    {
        return substr($this->serie, 0, 1);
    }

    public function selectInvoice()
    {
        $this->invoice = Ventas::find($this->invoice_id);
        $this->serie_correlativo_ref = $this->invoice->serie_correlativo;
        $this->serie_ref = $this->invoice->serie;
        $this->correlativo_ref = $this->invoice->correlativo;

        //TOTALES
        $this->divisa = $this->invoice->divisa;
        $this->tipo_cambio = $this->invoice->tipo_cambio;
        $this->op_gravadas = $this->invoice->op_gravadas;
        $this->op_exoneradas = $this->invoice->op_exoneradas;
        $this->op_inafectas = $this->invoice->op_inafectas;
        $this->op_gratuitas = $this->invoice->op_gratuitas;
        $this->descuento = $this->invoice->descuento;
        $this->icbper = $this->invoice->icbper;
        $this->igv = $this->invoice->igv;
        $this->sub_total = $this->invoice->sub_total;
        $this->total = $this->invoice->total;

        $this->cliente_id = $this->invoice->cliente_id;

        $this->setDataInvoice();
        $this->setDataItemsInvoice();

        //  CALCULAR TOTALES AL AÑADIR ITEMS
        $this->reCalTotal();
    }
    public function selectTypeInvoice()
    {
        $this->resetItems();
        $this->reCalTotal();
        $this->reset('invoice_id', 'invoice_divisa', 'invoice_fecha_emision', 'invoice_fecha_vencimiento', 'invoice_forma_pago');
        $this->invoice_fecha_emision = Carbon::now()->format('Y-m-d');
        $this->invoice_fecha_vencimiento = Carbon::now()->format('Y-m-d');

        if ($this->tipo_comprobante_ref == '01') {
            $this->titulo_select_new = 'Factura';
        } else {

            $this->titulo_select_new = 'Boleta';
        }
    }

    public function setDataInvoice()
    {

        $this->divisa = $this->invoice->divisa;
        $this->invoice_divisa = $this->invoice->divisa;
        $this->invoice_fecha_emision = $this->invoice->fecha_emision;
        $this->invoice_fecha_vencimiento = $this->invoice->fecha_vencimiento;
        $this->invoice_forma_pago = $this->invoice->forma_pago;
    }

    public function setDataItemsInvoice()
    {

        foreach ($this->invoice->ventaDetalles  as $selected) {

            $this->items->push([
                'producto_id' => $selected->producto_id,
                'codigo' => $selected->codigo,
                'cantidad' => $selected->cantidad,
                'unit' => $selected->unit,
                'unit_name' => $selected->unit_name,
                'descripcion' => $selected->descripcion,
                'valor_unitario' => $selected->valor_unitario,
                'precio_unitario' => $selected->precio_unitario,
                'igv' => $selected->igv,
                'porcentaje_igv' => $selected->porcentaje_igv,
                'icbper' => $selected->icbper,
                'total_icbper' => $selected->total_icbper,
                'sub_total' => $selected->valor_unitario * $selected->cantidad,
                'total' => $selected->total,
                'codigo_afectacion' => $selected->codigo_afectacion,
                'afecto_icbper' => $selected->afecto_icbper,
            ]);
        }
    }

    //METODO GLOBAL PARA HACER CALCULOS
    public function reCalTotal()
    {
        $this->invoice_descuento =  $this->calcularDescuento();
        $this->invoice_sub_total =   $this->calcularSubTotal();
        $this->invoice_op_gravadas = $this->calcularOperacionesGravadas($this->invoice_descuento);
        $this->invoice_op_exoneradas = $this->calcularOperacionesExoneradas();
        $this->invoice_op_inafectas = $this->calcularOperacionesInafectas();
        $this->invoice_icbper = $this->calcularIcbper();

        $this->invoice_igv =  $this->calcularIgv();
        $this->invoice_total =  $this->calcularTotal();
    }
    public function calcularDescuento()
    {
        // cantidad - porcentaje

        $descuento = 0.00;
        if ($this->invoice_tipo_descuento == "cantidad") {

            if ($this->invoice_total) {
                $rules = $this->validate([
                    'invoice_descuento_monto' => [
                        'min:0',
                    ],
                ]);
            }

            $descuento = $this->invoice_descuento_monto;
            if ($this->invoice_sub_total) {

                $this->invoice_descuento_factor = round($this->invoice_descuento_monto / $this->invoice_sub_total, 4);
            }
        } else {
            if ($this->invoice_total) {
                $rules = $this->validate([
                    'invoice_descuento_monto' => [
                        'min:0',

                    ],
                ]);
            }
            //calculcart el porncetaje del descuento del subtotal
            $descuento = ($this->invoice_op_gravadas * $this->invoice_descuento_monto) / 100;
        }

        return round($descuento, 2);
    }
    //CALCULAR EL SUB TOTAL DE LOS ITEMS
    public function calcularSubTotal()
    {
        $sub_total = $this->items->map(function ($item, $key) {

            $sub_total = 0;
            $sub_total =  $sub_total + $item["sub_total"];
            return round($sub_total, 4);
        });

        return $sub_total->sum();
    }
    //CALCULAR TOTALES DE LOS TIPOS DE AFECTACIONES

    public function calcularOperacionesGravadas($descuento)
    {


        $op_gravadas = $this->items->map(function ($item, $key) {

            if ($item['codigo_afectacion'] == '10') {
                $op_gravadas = 0.00;
                $op_gravadas = $op_gravadas + $item['sub_total'];
                return round($op_gravadas, 2);
            }
        })->sum();


        return $descuento > 0 ? $op_gravadas - $descuento : $op_gravadas;
    }


    public function calcularOperacionesExoneradas()
    {
        $op_exoneradas = $this->items->map(function ($item, $key) {

            if ($item['codigo_afectacion'] == '20') {
                $op_exoneradas = 0.00;
                $op_exoneradas = $op_exoneradas + $item['sub_total'];
                return round($op_exoneradas, 2);
            }
        })->sum();

        return round($op_exoneradas, 2);
    }

    public function calcularOperacionesInafectas()
    {

        $op_inafectas = $this->items->map(function ($item, $key) {

            if ($item['codigo_afectacion'] == '30') {
                $op_inafectas = 0.00;
                $op_inafectas = $op_inafectas + $item['sub_total'];
                return round($op_inafectas, 2);
            }
        })->sum();

        return round($op_inafectas, 2);
    }
    public function calcularIcbper()
    {

        $icbper = $this->items->map(function ($item, $key) {

            if ($item['afecto_icbper']) {
                $icbper = 0.00;
                $icbper = $item["icbper"];
                return round($icbper * $item["cantidad"], 4);
            }
        })->sum();

        return round(
            $icbper,
            2
        );
    }

    //CALCULAR IGV DESDE EL SUB TOTAL - FALTA POR TRAER EL PROCENTAJE DEL IUMPUESTO DE LA DB
    public function calcularIgv()
    {

        $igv = floatval($this->invoice_op_gravadas) *  $this->plantilla->igv;

        return round($igv, 4);
    }

    //CALCUJLAR TOTAL DE ACUERDO AL TIPO DE DESCUENTO Y SI HAY
    public function calcularTotal()
    {


        $total = ($this->invoice_op_gravadas + $this->invoice_op_exoneradas + $this->invoice_op_inafectas + $this->invoice_icbper) + $this->invoice_igv;

        return round($total, 4);
    }



    public function resetItems()
    {

        $this->items = collect();
    }


    public function save()
    {

        if ($this->tipo_comprobante_id == '07') {

            $request = new NotaDeCreditoRequest();
            $datos = $this->validate($request->rules($this->tipo_comprobante_ref), $request->messages());

            $nota = NotaCredito::create($datos);

            //ACTUALIZAR CORRELATIVO DE SERIE UTILIZADA
            $nota->getSerie->increment('correlativo');

            $api = new ApiFacturacion();
            $respuesta = $api->emitirNota($nota, $this->tipo_comprobante_id);

            if ($respuesta['fe_codigo_error']) {

                session()->flash('nota-registrada', $respuesta["fe_mensaje_error"] . ': Intenta enviar en un rato');
                $this->redirectRoute('admin.nota.credito.index');
            } else {

                session()->flash('nota-registrada', $respuesta['fe_mensaje_sunat']);
                $this->redirectRoute('admin.nota.credito.index');
            }
        }

        if ($this->tipo_comprobante_id == '08') {

            $request = new NotaDeCreditoRequest();
            $datos = $this->validate($request->rules($this->tipo_comprobante_ref), $request->messages());

            $nota = NotaDebito::create($datos);

            //ACTUALIZAR CORRELATIVO DE SERIE UTILIZADA
            $nota->getSerie->increment('correlativo');

            $api = new ApiFacturacion();
            $respuesta = $api->emitirNota($nota, $this->tipo_comprobante_id);

            if ($respuesta['fe_codigo_error']) {

                session()->flash('nota-registrada', $respuesta["fe_mensaje_error"] . ': Intenta enviar en un rato');
                $this->redirectRoute('admin.nota.debito.index');
            } else {

                session()->flash('nota-registrada', $respuesta['fe_mensaje_sunat']);
                $this->redirectRoute('admin.nota.debito.index');
            }
        }
    }
}