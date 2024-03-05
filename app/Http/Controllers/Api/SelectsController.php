<?php

namespace App\Http\Controllers\Api;

use App\Models\Unit;
use App\Models\Lineas;
use App\Models\Series;
use App\Models\Ventas;
use App\Models\SimCard;
use App\Models\Clientes;
use App\Models\Categoria;
use App\Models\Productos;
use App\Models\Sustentos;
use App\Models\Vehiculos;
use App\Models\Dispositivos;
use Illuminate\Http\Request;
use App\Models\TipoDocumento;
use App\Models\TipoAfectacion;
use App\Models\TipoComprobantes;
use App\Models\ModelosDispositivo;
use App\Http\Controllers\Controller;
use App\Models\Ciudades;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Database\Eloquent\Builder;

class SelectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function categorias(Request $request): Collection
    {

        return Categoria::query()
            ->select('id', 'nombre')
            ->orderBy('nombre')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('nombre', 'like', "%{$request->search}%")
            )
            ->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('id', $request->input('selected', [])),
                fn (Builder $query) => $query->limit(30)
            )
            ->active(1)
            ->get();
    }

    public function ciudades(Request $request): Collection
    {

        return Ciudades::query()
            ->select('id', 'nombre')
            ->orderBy('nombre')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('nombre', 'like', "%{$request->search}%")
            )
            ->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('id', $request->input('selected', [])),
                fn (Builder $query) => $query->limit(30)
            )
            ->active(1)
            ->get();
    }
    public function tipoAfectacion(Request $request): Collection
    {
        return TipoAfectacion::query()
            ->select('codigo', 'descripcion')
            ->orderBy('descripcion')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('descripcion', 'like', "%{$request->search}%")
            )
            ->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('codigo', $request->input('selected', [])),
            )
            ->get();
    }


    public function unit(Request $request): Collection
    {
        return Unit::query()
            ->select('codigo', 'name')
            ->orderBy('name')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('name', 'like', "%{$request->search}%")
                    ->orwhere('codigo', 'like', "%{$request->search}%")
            )
            ->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('codigo', $request->input('selected', [])),
                fn (Builder $query) => $query->limit(15)
            )
            ->get();
    }

    public function clientes(Request $request): Collection
    {


        return Clientes::query()
            ->select('id', 'razon_social', 'numero_documento', 'tipo_documento_id')
            ->orderBy('id')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('razon_social', 'like', "%{$request->search}%")
                    ->orWhere('numero_documento', 'like', "%{$request->search}%")
            )->when(
                $request->tipo_comprobante == "01" ? true : false,
                fn (Builder $query) => $query
                    ->tipoDoc(6)

            )->when(
                $request->tipo_comprobante == "03" ? true : false,
                fn (Builder $query) => $query
                    ->tipoDoc(1)

            )
            ->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('id', $request->input('selected', [])),
                fn (Builder $query) => $query->limit(50)
            )
            ->active(1)
            ->get();
    }

    public function invoices(Request $request): Collection
    {

        return Ventas::query()
            ->select('id', 'serie_correlativo', 'fecha_emision', 'divisa', 'total', 'cliente_id')
            ->where('fe_estado', 1)
            ->orderBy('serie_correlativo')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('serie_correlativo', 'like', "%{$request->search}%")
            )->when(
                $request->tipo_comprobante_ref,
                fn (Builder $query) => $query
                    ->where('tipo_comprobante_id', $request->tipo_comprobante_ref)

            )
            ->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('id', $request->input('selected', [])),
                fn (Builder $query) => $query->limit(50)
            )
            ->when(
                $request->exists('code_sunat'),
                fn (Builder $query) => $query->where('code_sunat', $request->input('code_sunat'))
            )
            ->get()
            ->map(function (Ventas $invoice) {

                if ($invoice->tipo_comprobante_id == '01') {
                    $invoice->imagen = Storage::url('facturacion/images/factura.png');
                } else {
                    $invoice->imagen = Storage::url('facturacion/images/boleta.png');
                }

                $invoice->option_description = $invoice->cliente->razon_social . ' | ' . $invoice->fecha_emision->format('d-m-Y') . " | " . $invoice->divisa . " " . $invoice->total;
                return $invoice;
            });
    }

    public function series(Request $request): Collection
    {

        return Series::query()
            ->select('id', 'serie', 'correlativo', 'tipo_comprobante_id')
            ->orderBy('id')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('serie', 'like', "%{$request->search}%")

            )
            ->where('tipo_comprobante_id', $request->tipo_comprobante)
            ->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('serie', $request->input('selected', [])),
                fn (Builder $query) => $query->limit(20)
            )
            ->get();
    }

    public function productos(Request $request): Collection
    {

        return Productos::query()
            ->select('id', 'codigo', 'serie', 'descripcion', 'valor_unitario', 'unit_code', 'stock')
            ->orderBy('id')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('serie', 'like', "%{$request->search}%")
                    ->orwhere('descripcion', 'like', "%{$request->search}%")
                    ->orwhere('codigo', 'like', "%{$request->search}%")

            )
            ->where('stock', '>', 0)
            ->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('id', $request->input('selected', [])),
                fn (Builder $query) => $query->limit(20)
            )->active(1)
            ->get()->map(function (Productos $producto) {

                $producto->imagen = $producto->image ? Storage::url($producto->image->url) : Storage::url('productos/default.jpg');
                $producto->option_description = $producto->codigo . " - Stock: " . $producto->stock . " " . $producto->unit->descripcion . " - Precio: $" . $producto->valor_unitario;

                return $producto;
            });
    }

    public function documentos(Request $request): Collection
    {

        return TipoDocumento::query()
            ->select('codigo', 'descripcion')
            ->orderBy('codigo')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('descripcion', 'like', "%{$request->search}%")

            )
            ->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('codigo', $request->input('selected', []))

            )
            ->get();
    }
    public function comprobantes(Request $request): Collection
    {

        return TipoComprobantes::query()
            ->select('codigo', 'descripcion')
            ->orderBy('codigo')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('descripcion', 'like', "%{$request->search}%")

            )
            ->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('codigo', $request->input('selected', []))

            )
            ->get();
    }
    public function sim(Request $request): Collection
    {
        return SimCard::query()
            ->select('id', 'sim_card')
            ->orderBy('id')
            ->withoutGlobalScopes()
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('sim_card', 'like', "%{$request->search}%")

            )
            ->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('id', $request->input('selected', [])),
                fn (Builder $query) => $query->limit(20)
            )
            ->get();
    }
    public function lineas(Request $request): Collection
    {
        return Lineas::query()
            ->with(['vehiculo' => function ($query) {
                $query->select('numero', 'id', 'placa');
            }])
            ->select('id', 'numero', 'operador')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('numero', 'like', "%{$request->search}%")

            )
            ->withoutGlobalScopes()
            ->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('numero', $request->input('selected', [])),
                fn (Builder $query) => $query->limit(60)

            )
            ->get()->map(function (Lineas $linea) {


                if ($linea->vehiculo) {

                    $linea->option_description = $linea->operador . " - " . "<b>" . $linea->vehiculo->placa . "</b>";
                } else {

                    $linea->option_description = $linea->operador . " - " . 'LIBRE';
                }
                //

                return $linea;
            });
    }
    public function dispositivos(Request $request): Collection
    {
        return Dispositivos::query()

            ->with(['modelo' => function ($query) {
                $query->select('modelo', 'id');
            }])
            ->select('id', 'imei', 'modelo_id')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('imei', 'like', "%{$request->search}%")

            )
            ->withoutGlobalScopes()
            ->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('imei', $request->input('selected', [])),
                fn (Builder $query) => $query->limit(50)

            )
            ->get()->map(function (Dispositivos $dispositivo) {


                if ($dispositivo->vehiculos) {

                    if ($dispositivo->modelo) {

                        $dispositivo->option_description = $dispositivo->modelo->modelo . " - " . "<b>" . $dispositivo->vehiculos->placa . "</b>";
                    } else {

                        $dispositivo->option_description = '';
                    }
                } else {
                    if ($dispositivo->modelo) {
                        $dispositivo->option_description = $dispositivo->modelo->modelo . " - " . 'LIBRE';
                    } else {

                        $dispositivo->option_description = '';
                    }
                }
                //

                return $dispositivo;
            });
    }
    public function vehiculos(Request $request): Collection
    {
        return Vehiculos::query()
            ->with(['cliente' => function ($query) {
                $query->select('razon_social', 'numero_documento', 'id');
            }])
            ->select('id', 'placa', 'clientes_id')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('placa', 'like', "%{$request->search}%")

            )
            ->withoutGlobalScopes()
            ->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('id', $request->input('selected', [])),
                fn (Builder $query) => $query->limit(20)

            )
            ->get()->map(function (Vehiculos $vehiculo) {

                if ($vehiculo->cliente) {

                    $vehiculo->option_description = $vehiculo->cliente->razon_social . " | " . $vehiculo->cliente->numero_documento;
                } else {

                    $vehiculo->option_description = "";
                }


                //

                return $vehiculo;
            });
    }
    public function modelosDispositivos(Request $request): Collection
    {
        $modelos = ModelosDispositivo::query()
            ->select('id', 'modelo', 'marca')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('modelo', 'like', "%{$request->search}%")

            )
            ->withoutGlobalScopes();
        if ($request->input('modelo')) {

            $modelos->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('modelo', $request->input('selected', [])),

            );
        } else {
            $modelos->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('id', $request->input('selected', [])),

            );
        }

        return $modelos->get();
    }
    public function sustentos(Request $request): Collection
    {

        return Sustentos::query()
            ->select('id', 'codigo', 'descripcion', 'tipo')
            ->orderBy('id')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('serie', 'like', "%{$request->search}%")

            )
            ->where('tipo', $request->tipo_comprobante == "07" ? "C" : "D")
            ->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('serie', $request->input('selected', [])),
                fn (Builder $query) => $query->limit(20)
            )
            ->get();
    }
}
