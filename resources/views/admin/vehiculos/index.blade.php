@extends('layouts.admin')
@section('ruta', 'vehiculos-vehiculos')
@section('contenido')

    <!-- Table -->
    @livewire('admin.vehiculos.vehiculos-index')
    @livewire('admin.vehiculos.save-vehiculo')
    @livewire('admin.vehiculos.edit-vehiculo')


    @livewire('admin.vehiculos.delete')
    @livewire('admin.vehiculos.import')
    @livewire('admin.vehiculos.suspend')
    @livewire('admin.vehiculos.mantenimiento.save', ['update' => session('updated-numero')])
    @livewire('admin.vehiculos.save-quick')


@stop

@section('js')
    <script>
        Livewire.on('updated-numero', (event) => {

            Swal.fire({
                icon: 'success',
                title: 'VEHICULO ACTUALIZADO',
                text: 'La Actualización cambio el numero, deseas registrar una programación de mantenimiento?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, Registrar!',
                cancelButtonText: 'Cerrar!'
            }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.dispatch('create-mantenimiento', {
                        placa: event.placa
                    })
                } else if (result.isDenied) {

                }
            })

        });
    </script>
@stop
