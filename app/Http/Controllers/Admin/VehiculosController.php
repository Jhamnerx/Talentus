<?php

namespace App\Http\Controllers\Admin;

use App\Exports\VehiculosExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehiculosRequest;
use App\Models\Vehiculos;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class VehiculosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.vehiculos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vehiculos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehiculosRequest $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehiculos  $vehiculos
     * @return \Illuminate\Http\Response
     */
    public function show(Vehiculos $vehiculos)
    {
        return view('admin.vehiculos.show', compact('vehiculos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehiculos  $vehiculos
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehiculos $vehiculo)
    {
        return view('admin.vehiculos.edit', compact('vehiculo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehiculos  $vehiculos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehiculos $vehiculo)
    {
        //dd($vehiculo->id);
        $requestVehiculo = new VehiculosRequest();
        $request->validate($requestVehiculo->rules($request->dispositivos_id, $request->numero, $vehiculo), $requestVehiculo->messages());


        $vehiculo->update($request->all());
        return redirect()->route('admin.vehiculos.index')->with('update', 'El vehiculo se actualizo con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehiculos  $vehiculos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehiculos $vehiculos)
    {
        //
    }

    public function exportExcel()
    {
        return Excel::download(new VehiculosExport, 'vehiculos.xls');

    }
}
