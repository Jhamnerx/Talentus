@extends('layouts.admin')
@section('ruta', 'ventas-facturas')


@section('contenido')


    <!-- Code block starts -->

    <div
        class="my-4 container px-10 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between pb-4 border-b border-gray-300">
        <!-- Add customer button -->
        <a href="{{ route('admin.ventas.facturas.index') }}">
            <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back w-5 h-5"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" />
                </svg>
                <span class="hidden xs:block ml-2">Atras</span>
            </button>
        </a>
        <div>
            <h4 class="text-2xl font-bold leading-tight text-gray-800 dark:text-gray-100">EDITAR FACTURA</h4>
            <ul aria-label="current Status"
                class="flex flex-col md:flex-row items-start md:items-center text-gray-600 dark:text-gray-400 text-sm mt-3">
                <li class="flex items-center mr-4">
                    <div class="mr-1">
                        <img class="dark:hidden"
                            src="https://tuk-cdn.s3.amazonaws.com/can-uploader/simple_with_sub_text_and_border-svg1.svg"
                            alt="Active">
                        <img class="dark:block hidden"
                            src="https://tuk-cdn.s3.amazonaws.com/can-uploader/simple_with_sub_text_and_border-svg1dark.svg"
                            alt="Active">
                    </div>
                    <span>Active</span>
                </li>

            </ul>
        </div>
    </div>
    <!-- Code block ends -->

    <div class="p-6 shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-2 bg-gray-50 sm:p-6">

            {!! Form::model($factura, [
                'route' => ['admin.ventas.facturas.update', $factura],
                'method' => 'put',
                'class' => 'formularioFactura',
            ]) !!}
            <div class="grid grid-cols-12 gap-2">


                <div class="col-span-12 grid grid-cols-12 md:col-span-6 border-dashed lg:border-r-2 pr-4 gap-2">
                    {{-- CLIENTE --}}
                    <div class="col-span-12 mb-5">


                        <label
                            class="flex text-sm not-italic items-center font-medium text-gray-800 whitespace-nowrap justify-between">
                            <div>Cliente <span class="text-sm text-red-500"> * </span></div>
                        </label>

                        {{-- <select name="clientes_id" id="" class="form-select w-full clientes_id pl-3" required> --}}
                        {!! Form::select(
                            'clientes_id',
                            [$factura->clientes_id => $factura->clientes->razon_social],
                            $factura->clientes_id,
                            [
                                'class' => 'w-full clientes_id pl-3
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                pl-3',
                                'required',
                            ],
                        ) !!}
                        </select>
                        @error('clientes_id')
                            <p class="mt-2 peer-invalid:visible text-pink-600 text-sm">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- NUMERO --}}

                    {{-- NUMERO --}}
                    <div class="col-span-12 mb-5">
                        <label
                            class="flex text-sm not-italic items-center font-medium text-gray-800 whitespace-nowrap justify-between">
                            <div>Número Factura <span class="text-sm text-red-500"> * </span></div>
                        </label>
                        <div class="relative">

                            {!! Form::text('numero', null, [
                                'placeholder' => '0012',
                                'class' => 'form-input w-2/4
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                valid:border-emerald-300
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                required:border-rose-300 invalid:border-rose-300 peer',
                                'id' => 'numero',
                            ]) !!}

                        </div>
                        @error('numero')
                            <p class="mt-2 peer-invalid:visible text-pink-600 text-sm">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    {{-- FECHA Factura --}}
                    <div class="col-span-6 gap-2">
                        <label
                            class="flex text-sm not-italic items-center font-medium text-gray-800 whitespace-nowrap justify-between">
                            <div>Fecha de Emisión: <span class="text-sm text-red-500"> * </span></div>

                        </label>
                        <div class="relative">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            {!! Form::text('fecha_emision', null, [
                                'placeholder' => 'Selecciona la fecha',
                                'class' => 'form-input
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        valid:border-emerald-300
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        required:border-rose-300 invalid:border-rose-300 peer fechaFactura font-base pl-8 py-2
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        outline-none
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        focus:ring-primary-400 focus:outline-none focus:border-primary-400 block sm:text-sm
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        border-gray-200 rounded-md
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        text-black input w-full',
                            ]) !!}

                        </div>
                        @error('fecha_emision')
                            <p class="mt-2 peer-invalid:visible text-pink-600 text-sm">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <!-- ... -->
                    {{-- FECHA CADUCIDAD --}}
                    <div class="col-span-6 gap-2">
                        <label
                            class="flex text-sm not-italic items-center font-medium text-gray-800 whitespace-nowrap justify-between">
                            <div>Fecha de vencimiento: <span class="text-sm text-red-500" style="display: none;"> *
                                </span>
                            </div>
                            <!---->
                            <!---->
                        </label>
                        <div class="relative">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>

                            {!! Form::text('fecha_vencimiento', null, [
                                'placeholder' => 'Selecciona la fecha',
                                'class' => 'form-input valid:border-emerald-300
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        required:border-rose-300 invalid:border-rose-300 peer fechaFactura font-base pl-8 py-2
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        outline-none
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        focus:ring-primary-400 focus:outline-none focus:border-primary-400 block sm:text-sm
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        border-gray-200 rounded-md
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        text-black input w-full',
                            ]) !!}
                        </div>
                        @error('fecha_vencimiento')
                            <p class="mt-2 peer-invalid:visible text-pink-600 text-sm">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>

                <div class="col-span-12 grid grid-cols-12 md:col-span-6 border-red-600 lg:pl-6">
                    {{-- moneda --}}
                    <div class="col-span-6">

                        <label class="text-gray-800 block text-sm font-medium mb-1" for="moneda">Moneda
                            <span class="text-rose-500">*</span> </label>

                        {!! Form::select('divisa', ['PEN' => 'PEN', 'USD' => 'USD'], null, [
                            'class' => 'form-select w-full divisa',
                            '@change' => 'cambiarDivisa($event.target.value)',
                            'id' => 'moneda',
                        ]) !!}

                        @error('divisa')
                            <p class="mt-2 peer-invalid:visible text-pink-600 text-sm">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>
                    <div class="col-span-12 mt-2">
                        <label
                            class="flex text-sm not-italic items-center font-medium text-gray-800 whitespace-nowrap justify-between">
                            <div>
                                Tipo de Pago:
                            </div>

                        </label>
                        <div class="flex flex-wrap items-center -m-3">

                            <div class="m-3">
                                <!-- Start -->
                                <label class="flex items-center">
                                    {!! Form::radio('tipo_pago', 'CONTADO', true, ['class' => 'form-radio']) !!}



                                    <span class="text-sm ml-2">CONTADO</span>
                                </label>
                                <!-- End -->
                            </div>
                            <div class="m-3">
                                <!-- Start -->
                                <label class="flex items-center">
                                    {!! Form::radio('tipo_pago', 'CREDITO', true, ['class' => 'form-radio']) !!}

                                    <span class="text-sm ml-2">CREDITO</span>
                                </label>
                                <!-- End -->
                            </div>

                        </div>


                        @error('tipo_pago')
                            <p class="mt-2 peer-invalid:visible text-pink-600 text-sm">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>
                    <div class="col-span-12">
                        <label
                            class="flex text-sm not-italic items-center font-medium text-gray-800 whitespace-nowrap justify-between">
                            <div>Nota
                            </div>
                            <!---->
                        </label>
                        <textarea class="form-input w-full px-4 py-3" name="nota" id="" cols="30" rows="5"
                            placeholder="Ingresar nota (opcional)"></textarea>
                    </div>
                    <!-- ... -->

                </div>





                <div class="col-span-12 mt-10 pt-4 bg-white shadow-lg rounded-lg px-3">

                    <div class="grid grid-cols-2 gap-2 mt-4 pt-4 pb-4 bg-white px-3 mb-2">
                        <div class="col-span-2 sm:col-span-1">
                            <div class="flex">
                                <button id="productos-button"
                                    class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-500 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600"
                                    type="button">
                                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                                        <path
                                            d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                                    </svg>
                                </button>
                                <label for="productos" class="sr-only">Añadir Artículo</label>
                                <select id="productos"
                                    class="bg-gray-50 productoSelect border border-gray-300 text-gray-900 text-sm rounded-r-lg border-l-gray-100 dark:border-l-gray-700 border-l-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Añadir Artículo</option>
                                </select>
                            </div>
                        </div>
                        <!-- ... -->
                        <div class="col-span-2 sm:col-span-1">
                            -
                        </div>
                    </div>
                    {{-- LISTA DE PRODUCTOS --}}

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <!-- Table header -->
                            <thead
                                class="text-xs font-semibold uppercase text-white bg-slate-800  border-t border-b border-slate-200">
                                <tr>
                                    <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                        <div class="font-semibold text-left">Artículo o Servicio</div>
                                    </th>
                                    <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                        <div class="font-semibold text-left">Cantidad</div>
                                    </th>


                                    <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                        <div class="font-semibold text-left">Precio</div>
                                    </th>

                                    <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                        <div class="font-semibold text-left">Importe</div>
                                    </th>
                                    <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                        <div class="font-semibold text-left">Acciones</div>
                                    </th>

                                </tr>
                            </thead>
                            <!-- Table body -->
                            <tbody class="text-sm divide-y divide-slate-200 listaItems">
                                <!-- Row -->
                                <tr class="main bg-slate-50">
                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                        <textarea rows="4" class="form-input descripcion" placeholder="Descripción"></textarea>
                                        <p class="mt-2 hidden text-pink-600 text-sm errorDescripcion">
                                            Rellena todos los campos
                                        </p>
                                    </td>
                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">

                                        <input type="number" min="0" value="1" step="1"
                                            class="form-input qyt" placeholder="Cantidad">
                                        <input type="hidden" class="divise">
                                    </td>

                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                        <input type="number" min="0" step="0.01" class="form-input importe"
                                            placeholder="Importe">
                                    </td>

                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">

                                    </td>
                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap w-px">
                                        <div class="space-x-1">

                                            <button type="button" onclick="add_item_to_table(); return false;"
                                                class="text-white btn bg-cyan-500 hover:text-slate-500 ">
                                                <span class="sr-only">Añadir</span>


                                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24">
                                                    <g fill="none" class="nc-icon-wrapper">
                                                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"
                                                            fill="currentColor">
                                                        </path>
                                                    </g>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <p class="mt-2 hidden text-pink-600 text-sm vacio">
                                        Debes añadir al menos 1 item
                                    </p>
                                </tr>
                                @if (!empty($factura->detalles))
                                    @foreach ($factura->detalles as $detalle)
                                        <tr id="fila{{ $loop->index }}">
                                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                                <textarea required name="items[{{ $loop->index }}][producto]" class="form-input" rows="4">{{ $detalle->producto }}</textarea>

                                            </td>
                                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                                <input required type="number"
                                                    name="items[{{ $loop->index }}][cantidad]" min="0"
                                                    value="{{ $detalle->cantidad }}" class="form-input cantidad"
                                                    placeholder="Cantidad" value="2">
                                            </td>
                                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                                <input required type="number" min="0" data-quantity=""
                                                    step="0.01" name="items[{{ $loop->index }}][precio]"
                                                    value="{{ $detalle->precio }}" class="form-input precio">
                                            </td>
                                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                                <input type="number" value="{{ $detalle->importe }}"
                                                    name="items[{{ $loop->index }}][importe]"
                                                    class="form-input importe subtotal" readonly>
                                            </td>
                                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap w-px">
                                                <div class="space-x-1">
                                                    <button type="button"
                                                        @click.prevent="eliminarDetalle({{ $loop->index }})"
                                                        class="text-rose-500 hover:text-rose-600 rounded-full">
                                                        <span class="sr-only">Delete</span>
                                                        <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                                                            <path d="M13 15h2v6h-2zM17 15h2v6h-2z" />
                                                            <path
                                                                d="M20 9c0-.6-.4-1-1-1h-6c-.6 0-1 .4-1 1v2H8v2h1v10c0 .6.4 1 1 1h12c.6 0 1-.4 1-1V13h1v-2h-4V9zm-6 1h4v1h-4v-1zm7 3v9H11v-9h10z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                @endif



                            </tbody>
                            <tfoot>
                                @error('items')
                                    <p class="mt-2 peer-invalid:visible text-pink-600 text-sm">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </tfoot>
                        </table>
                    </div>


                    <div class="flex">
                        {{-- DIV PARA SUB Y TOTALES --}}
                        <div class="py-2 ml-auto mt-5 w-full sm:w-2/4 lg:w-1/4 mr-2">
                            <div class="flex justify-between mb-3">
                                <div class="text-gray-900 text-right flex-1 font-medium text-sm">Total neto</div>
                                <div class="text-right w-40">
                                    <div class="text-gray-800 text-sm total"> S/. {{ $factura->subtotal }}</div>
                                    <input type="hidden" value="{{ $factura->subtotal }}" class="subTotalFactura"
                                        name="subtotal">
                                </div>
                            </div>
                            <div class="flex justify-between mb-4">
                                <div class="text-gray-900 text-right flex-1 font-medium text-sm">IGV(18%)</div>
                                <div class="text-right w-40">
                                    <div class="text-gray-800 text-sm igv"></div>
                                    <input type="hidden" value="{{ $factura->impuesto }}" class="impuestoFactura"
                                        name="impuesto">
                                </div>
                            </div>

                            <div class="py-2 border-t border-b">
                                <div class="flex justify-between">
                                    <div class="text-gray-900 text-right flex-1 font-medium text-sm">Monto Total</div>
                                    <div class="text-right w-40">
                                        <div class="text-xl text-gray-800 font-bold totalFactura">
                                            {{ $factura->total }}</div>
                                        <input type="hidden" value="{{ $factura->total }}" class="totalFactura"
                                            name="total">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>





                </div>
            </div>
            <div class="px-4 py-3 text-right sm:px-6">
                {!! Form::submit('GUARDAR', [
                    'class' => 'btn bg-emerald-500 hover:bg-emerald-600 focus:outline-none
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            focus:ring-2 focus:ring-offset-2
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            focus:ring-emerald-600 text-white',
                ]) !!}

            </div>
            {!! Form::close() !!}


        </div>






    </div>



@stop
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"
        integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>




    <script>
        var tipoCambio = parseFloat($(".tipoCambio").text());

        $("#money").maskMoney();
        // FUNCION PARA CAMBIAR DATOS Y DIVISA
        function cambiarDivisa(e) {

            calculate_totales(e)


        };


        // INICIALIZAR LOS INPUTS DE FECHA Y DATOS NECESARIPS
        $(document).ready(function() {
            cont = {{ count($factura->detalles) }};
            calculate_total('{{ $factura->divisa }}');
            detalles = {{ count($factura->detalles) }};
            flatpickr('.fechaEmision', {
                mode: 'single',
                defaultDate: "today",
                minDate: "today",
                disableMobile: "true",
                dateFormat: "Y-m-d",
                prevArrow: '<svg class="fill-current" width="7" height="11" viewBox="0 0 7 11"><path d="M5.4 10.8l1.4-1.4-4-4 4-4L5.4 0 0 5.4z" /></svg>',
                nextArrow: '<svg class="fill-current" width="7" height="11" viewBox="0 0 7 11"><path d="M1.4 10.8L0 9.4l4-4-4-4L1.4 0l5.4 5.4z" /></svg>',
            });
            flatpickr('.fechaVencimiento', {
                mode: 'single',
                defaultDate: new Date().fp_incr(1),
                minDate: "today",
                disableMobile: "true",
                dateFormat: "Y-m-d",
                prevArrow: '<svg class="fill-current" width="7" height="11" viewBox="0 0 7 11"><path d="M5.4 10.8l1.4-1.4-4-4 4-4L5.4 0 0 5.4z" /></svg>',
                nextArrow: '<svg class="fill-current" width="7" height="11" viewBox="0 0 7 11"><path d="M1.4 10.8L0 9.4l4-4-4-4L1.4 0l5.4 5.4z" /></svg>',
            });
        })


        $('.clientes_id').select2({
            placeholder: 'Buscar Cliente',
            language: "es",
            minimumInputLength: 2,
            width: '100%',
            ajax: {
                url: '{{ route('search.clientes') }}',
                dataType: 'json',
                delay: 250,
                cache: true,
                data: function(params) {

                    var query = {
                        term: params.term,
                        //type: 'public'
                    }

                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },
                processResults: function(data, params) {

                    // console.log(data.suggestions);
                    var suggestions = $.map(data.suggestions, function(obj) {

                        obj.id = obj.id || obj.data; // replace pk with your identifier
                        obj.text = obj.value; // replace pk with your identifier

                        return obj;

                    });
                    //console.log(data);
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {

                        results: suggestions,

                    };

                },


            }
        });

        $('.productoSelect').select2({
            placeholder: 'Añadir Artículo',
            language: "es",
            width: '100%',
            ajax: {
                url: '{{ route('search.productos') }}',
                dataType: 'json',
                delay: 250,
                cache: true,
                data: function(params) {

                    var query = {
                        term: params.term,
                        //type: 'public'
                    }

                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },
                processResults: function(data, params) {

                    // console.log(data.suggestions);
                    var suggestions = $.map(data.suggestions, function(obj) {

                        obj.id = obj.id || obj.data; // replace pk with your identifier
                        obj.text = obj.value; // replace pk with your identifier

                        return obj;

                    });
                    //console.log(data);
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {

                        results: suggestions,

                    };

                },


            }
        });

        // funcion para colocar los datos del producto seleccionado
        // a los inputs
        $('.productoSelect').on('select2:select', function(e) {

            var data = e.params.data;
            enviarDatosProductos(data);
            $('.errorDescripcion').addClass('hidden');
            $('.errorPrecio').addClass('hidden');

        });

        // colocar los datos
        function enviarDatosProductos(data) {
            //console.log(data);
            $('.descripcion').val(data.text);
            $('.divise').val(data.divisa);
            $('.importe').val(data.precio);
            // $('.cantidad').val(cantidad.precio);

            let divisa = $(".divisa option:selected").text();

            calculate_total(divisa)
        }

        function add_item_to_table() {

            let divisa = $(".divisa option:selected").text();
            var descripcion = $('.descripcion').val();
            var cantidad = $('.qyt').val();
            var precio = $('.importe').val();
            var divisaProducto = $('.divise').val();

            var fila = '<tr id="fila' + cont + '">' +
                '<td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">' +
                '<textarea required name="items[' + cont + '][producto]" class="form-input" rows="5">' + descripcion +
                '</textarea>' +
                '</td>' +
                '<td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">' +
                '<input required type="number" name="items[' + cont + '][cantidad]" min="0" value="' + cantidad +
                '" class="form-input cantidad" placeholder="Cantidad" >' +
                '</td>' +
                '<td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">' +
                '<input required type="number" min="0" data-quantity="" step="0.01" name="items[' + cont +
                '][precio]" value="' + precio + '" class="form-input precio">' +
                '</td>' +
                '<td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">' +
                '<input type="number" value="00.00" name="items[' + cont +
                '][importe]" class="form-input importe subtotal" readonly>' +
                '</td>' +
                '<td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap w-px">' +
                '<div class="space-x-1">' +
                '<button type="button" @click.prevent="eliminarDetalle(' + cont +
                ')"  class="text-rose-500 hover:text-rose-600 rounded-full">' +
                '<span class="sr-only">Delete</span>' +
                '<svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">' +
                '<path d="M13 15h2v6h-2zM17 15h2v6h-2z" />' +
                '<path d="M20 9c0-.6-.4-1-1-1h-6c-.6 0-1 .4-1 1v2H8v2h1v10c0 .6.4 1 1 1h12c.6 0 1-.4 1-1V13h1v-2h-4V9zm-6 1h4v1h-4v-1zm7 3v9H11v-9h10z" />' +
                '</svg>' +
                '</button>' +
                '</div>' +
                '</td>' +
                '</tr>';



            if (descripcion && precio) {
                //console.log('enviar tabla');
                cont++;
                detalles = detalles + 1;
                $('.errorDescripcion').addClass('hidden');
                $('.errorPrecio').addClass('hidden');
                $('.listaItems').append(fila);

                $('.descripcion').val("");
                $('.qyt').val(1);
                $('.importe').val(0);
                addAlert();
                calculate_total(divisa)

            } else {
                $('.errorDescripcion').removeClass('hidden');
                $('.errorPrecio').removeClass('hidden');
            }







        }


        function calculate_total(divisa = "PEN") {

            var cant = $(".cantidad");
            var prec = $(".precio");
            var sub = $(".subtotal");


            //console.log(cant);
            for (var i = 0; i < cant.length; i++) {

                var inpC = cant[i];
                var inpP = prec[i];
                var inpS = sub[i];

                inpS.value = (inpC.value * inpP.value).toFixed(2);

                $(".subtotal")[i].innerHTML = parseFloat(inpS.value);
                // console.log(parseFloat(inpS.value));
            }
            calculate_totales(divisa);
        }

        function getDivisa() {

            // return $(".divisa option:selected").text();
            return parseFloat($(".tipoCambio").text());

        }


        function calculate_totales(divisa = "PEN") {

            var subTotal = $(".subtotal");
            //console.log(divisa);
            // var divisa = $(".divisa option:selected").text();

            /**
             * MOSTRAS SIMBOLO SEGUN DIVISA
             */


            var total = 0;

            for (var i = 0; i < subTotal.length; i++) {

                // console.log(total);
                total += parseFloat($(".subtotal")[i].value);



            }

            // var divisa = cambiarDivisa();
            var simbolo = "S/."
            if (divisa === "PEN") {
                simbolo = "S/.";

                $(".ConvertirSoles").hide();

                igvTotal = calcularIgv(total);

                totalFactura = total + igvTotal;

                $(".total").html(simbolo + " " + numeral(total).format('0,0.00'));



                $('.igv').html(simbolo + " " + numeral(igvTotal).format('0,0.00'))
                $('.totalFactura').html(simbolo + " " + numeral(totalFactura).format('0,0.00'));


                // ENVIAR DATOS DE TOTAL A INPUTS
                $(".subTotalFactura").val(numeral(total).format('0.00'));
                $(".impuestoFactura").val(numeral(igvTotal).format('0.00'));
                $(".totalFactura").val(numeral(totalFactura).format('0.00'));

            } else {

                simbolo = "$";

                igvTotal = calcularIgv(total);

                totalFactura = total + igvTotal;

                $(".total").html(simbolo + " " + numeral(total).format('0,0.00'));



                $('.igv').html(simbolo + " " + numeral(igvTotal).format('0,0.00'))
                $('.totalFactura').html(simbolo + " " + numeral(totalFactura).format('0,0.00'));


                // ENVIAR DATOS DE TOTAL A INPUTS
                $(".subTotalFactura").val(numeral(total).format('0.00'));
                $(".impuestoFactura").val(numeral(igvTotal).format('0.00'));
                $(".totalFactura").val(numeral(totalFactura).format('0.00'));
            }




            // evaluarGuardarVenta();
        }


        function calcularIgv(monto) {

            igv = (parseFloat(monto) * 18) / 100;

            return igv;
        }

        $(document).on("change", ".listaItems .cantidad", function() {
            let divisa = $(".divisa option:selected").text();
            calculate_total(divisa);

        })
        $(document).on("change", ".listaItems .precio", function() {
            let divisa = $(".divisa option:selected").text();
            calculate_total(divisa);

        })


        function eliminarDetalle(indice) {
            detalles = detalles - 1;
            let divisa = $(".divisa option:selected").text();
            $("#fila" + indice).remove();
            calculate_total(divisa);
        }



        function addAlert() {
            iziToast.success({
                position: 'topRight',
                title: 'AGREGADO',
                message: 'Se añadio un producto al Factura',
            });
        }

        function evaluarGuardarFactura() {

            //console.log(detalles);
            if (detalles > 0) {
                $(".guardarFactura").addClass('disabled');
            } else {
                $(".guardarFactura").removeClass('disabled');
                cont = 0;
            }
        }
    </script>


    <script>
        $('.formularioFactura').submit(function(e) {
            e.preventDefault();

            $(".vacio").addClass('hidden');

            if (detalles > 0) {
                this.submit();

            } else {
                $(".vacio").removeClass('hidden');
            }
        })
    </script>


@endsection
