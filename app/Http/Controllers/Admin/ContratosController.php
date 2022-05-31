<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContratosRequest;
use App\Models\Contratos;
use App\Models\Vehiculos;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

use function GuzzleHttp\Promise\all;

class ContratosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.ventas.contratos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehiculos = Vehiculos::all();
        return view('admin.ventas.contratos.create', compact('vehiculos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContratosRequest $request)
    {
        // dd($request->all());
        $contrato = Contratos::create([
            'empresa_id' => $request->empresa_id,
            'clientes_id' => $request->clientes_id,
            'fecha' => $request->fecha,
            'ciudades_id' => $request->ciudades_id,
            'fondo' => $request->fondo ? $request->fondo : '0',
            'sello' => $request->sello ? $request->sello : '0',
        ]);

        $contrato->unique_hash = Hashids::connection(Contratos::class)->encode($contrato->id);
        $contrato->save();

        Contratos::createItems($contrato, $request->items);

        return redirect()->route('admin.ventas.contratos.index')->with('store', 'El Contrato se creo con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contratos  $contratos
     * @return \Illuminate\Http\Response
     */
    public function show(Contratos $contratos)
    {
        return view('admin.ventas.contratos.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contratos  $contratos
     * @return \Illuminate\Http\Response
     */
    public function edit(Contratos $contrato)
    {
        return view('admin.ventas.contratos.edit', compact('contrato'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contratos  $contratos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contratos $contrato)
    {

        $contrato->update($request->all());
        $contrato->vehiculos()->detach();
        $resul = $contrato->vehiculos()->attach($request->items);
        //dd($request->items);
        return redirect()->route('admin.ventas.contratos.index')->with('update', 'El Contrato se actualizo con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contratos  $contratos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contratos $contratos)
    {
        //
    }
}
