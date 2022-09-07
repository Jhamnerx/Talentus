@extends('layouts.admin')
@section('ruta', 'vehiculos-reportes')
@section('contenido')

    <!-- Table -->


    @livewire('admin.vehiculos.reportes.index')

@stop

@push('modals')
    @livewire('admin.vehiculos.reportes.show-contactos')
    @livewire('admin.vehiculos.reportes.save')
    @livewire('admin.vehiculos.reportes.edit')
    @livewire('admin.vehiculos.reportes.delete')
    @livewire('admin.vehiculos.reportes.show-detalle')
    @livewire('admin.vehiculos.reportes.recordatorio')
@endpush



@section('js')

    <script>
        window.addEventListener('reporte-edit', event => {
            iziToast.success({
                position: 'topRight',
                title: 'ACTUALIZADO',
                message: 'El Reporte de ' + event.detail.vehiculo + ' Fue Actualizado',
            });

        })
    </script>


    <script>
        window.addEventListener('detalle-reporte', event => {
            iziToast.success({
                position: 'topRight',
                title: 'DETALLE AGREGADO',
                message: 'Se añadio un detalle al reporte',
            });

        })
    </script>

    <script>
        window.addEventListener('reporte-delete', event => {
            iziToast.error({
                position: 'topRight',
                title: 'ELIMINADO',
                message: 'El Reporte de ' + event.detail.vehiculo + ' Fue Eliminado',
            });

        })
    </script>
    <script>
        window.addEventListener('reporte-save', event => {
            $(document).ready(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Guardado',
                    text: 'El Reporte de ' + event.detail.vehiculo + ' Fue Creado',
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"

                })
            });
        })
    </script>

    <script>
        window.addEventListener('recordatorio-save', event => {
            $(document).ready(function() {
                iziToast.success({
                    position: 'topRight',
                    title: 'RECORDATORIO CREADO',
                    message: 'Se creo un recordatorio para el Vehiculo ' + event.detail.vehiculo,
                });
            });
        })
    </script>

    <script>
        // A basic demo function to handle "select all" functionality
        document.addEventListener('alpine:init', () => {
            Alpine.data('handleSelect', () => ({
                selectall: false,
                selectAction() {
                    countEl = document.querySelector('.table-items-action');
                    if (!countEl) return;
                    checkboxes = document.querySelectorAll('input.table-item:checked');
                    document.querySelector('.table-items-count').innerHTML = checkboxes.length;
                    if (checkboxes.length > 0) {
                        countEl.classList.remove('hidden');
                    } else {
                        countEl.classList.add('hidden');
                    }
                },
                toggleAll() {
                    this.selectall = !this.selectall;
                    checkboxes = document.querySelectorAll('input.table-item');
                    [...checkboxes].map((el) => {
                        el.checked = this.selectall;
                    });
                    this.selectAction();
                },
                uncheckParent() {
                    this.selectall = false;
                    document.getElementById('parent-checkbox').checked = false;
                    this.selectAction();
                }
            }))
        })
    </script>
@stop
