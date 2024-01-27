<div>
    <div
        class="my-4 container px-10 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between pb-4 border-b border-gray-300">
        <a href="{{ route('admin.ventas.presupuestos.index') }}">
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
            <h4 class="text-2xl font-bold leading-tight text-gray-800 dark:text-gray-100">CREAR PRESUPUESTO</h4>
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

            <div class="grid grid-cols-12 gap-2">

                <div class="col-span-12 grid grid-cols-12 md:col-span-6 border-dashed lg:border-r-2 pr-4 gap-2">

                    {{-- CLIENTE --}}
                    <div class="col-span-12 mb-2">

                        <x-form.select label="Selecciona un cliente:" wire:model.live="clientes_id"
                            placeholder="Selecciona un cliente" option-description="numero_documento" :async-data="route('api.clientes.index')"
                            option-label="razon_social" option-value="id" hide-empty-message>

                            <x-slot name="afterOptions" class="p-2 flex justify-center"
                                x-show="displayOptions.length === 0">
                                <x-form.button wire:click.prevent="OpenModalCliente(`${search}`)" x-on:click="close"
                                    primary flat full>
                                    <span x-html="`Crear cliente <b>${search}</b>`"></span>
                                </x-form.button>
                            </x-slot>

                        </x-form.select>

                    </div>

                    {{-- SERIE --}}
                    <div class="col-span-12 md:col-span-6 xl:col-span-4">

                        <x-form.select id="serie" name="serie" label="Serie:" wire:model.live="serie"
                            placeholder="Selecciona una serie" :async-data="[
                                'api' => route('api.series.index'),
                                'params' => ['tipo_comprobante' => '00'],
                            ]" option-label="serie"
                            option-value="serie" hide-empty-message />
                    </div>

                    {{-- CORRELATIVO --}}
                    <div class="col-span-12 md:col-span-6 xl:col-span-4">

                        <x-form.inputs.number readonly id="correlativo" name="correlativo" wire:model.live="correlativo"
                            label="Correlativo:" />

                    </div>

                    {{-- FECHA PRESUPUESTO --}}

                    <div class="col-span-6 gap-2">

                        <x-form.datetime-picker label="Fecha de Emision:" id="fecha" name="fecha"
                            wire:model.live="fecha" :min="now()->subDays(1)" :max="now()" without-time
                            parse-format="YYYY-MM-DD" display-format="DD-MM-YYYY" :clearable="false" />

                    </div>

                    {{-- FECHA CADUCIDAD --}}
                    <div class="col-span-6 gap-2">
                        <x-form.datetime-picker label="Fecha de Emision:" id="fecha_caducidad" name="fecha_caducidad"
                            wire:model.live="fecha_caducidad" :min="now()->subDays(1)" :max="now()->addDays(15)" without-time
                            parse-format="YYYY-MM-DD" display-format="DD-MM-YYYY" :clearable="false" />

                    </div>
                </div>

                <div class="col-span-12 grid grid-cols-12 md:col-span-6 border-red-600 lg:pl-6 gap-2">
                    {{-- moneda --}}
                    <div class="col-span-12 md:col-span-6 mb-2">

                        <x-form.select label="Moneda:" id="divisa" name="divisa" :options="[['name' => 'SOLES', 'id' => 'PEN'], ['name' => 'DOLARES', 'id' => 'USD']]"
                            option-label="name" option-value="id" wire:model.live="divisa" :clearable="false"
                            icon='currency-dollar' />

                    </div>

                    <div class="col-span-12">
                        <x-form.textarea label="Comentario:" id="nota" name="nota" wire:model.live="nota"
                            placeholder="Ingresar nota opcional" />
                    </div>
                </div>

                <div class="col-span-12 mt-10 pt-4 bg-white shadow-lg rounded-lg px-3">
                    <div class="grid grid-cols-2 gap-2 mt-4 pt-4 pb-4 bg-white px-3 mb-2">
                        <div class="col-span-2 sm:col-span-1">
                            <div class="flex btnAddProducto">
                                <button id="productos-button"
                                    class="flex-shrink-0 cursor-default z-10 hidden md:inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-500 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600"
                                    type="button">
                                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                                        <path
                                            d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                                    </svg>
                                </button>
                                <label for="productos" class="sr-only">Añadir Artículo</label>
                                <select id="productos" wire:model.live="productoSelected"
                                    class="bg-gray-50 productoSelect border border-gray-300 text-gray-900 text-sm rounded-r-lg border-l-gray-100 dark:border-l-gray-700 border-l-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Añadir Artículo</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-span-2 sm:col-span-1">
                            <div class="m-2 w-full mt-1">
                                <label for="features">Mostrar Hoja Caracteristicas:</label>
                                <!-- Start -->
                                <div class="flex items-center">
                                    <div class="form-switch">
                                        <input wire:model.live="features" type="checkbox" id="features-1"
                                            class="sr-only features" />
                                        <label class="bg-slate-400" for="features-1">
                                            <span class="bg-white shadow-sm" aria-hidden="true"></span>
                                            <span class="sr-only">features switch</span>
                                        </label>
                                    </div>

                                </div>

                            </div>
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
                                        <div class="font-semibold text-left">Descripción</div>
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
                                        <textarea wire:model.live="selected.producto" rows="5" class="form-input descripcion" placeholder="Producto"></textarea>
                                        @if ($errors->has('selected.producto'))
                                            <p class="mt-2  text-pink-600 text-sm">
                                                {{ $errors->first('selected.producto') }}
                                            </p>
                                        @endif
                                    </td>
                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                        <textarea wire:model.live="selected.descripcion" rows="5" class="form-input descripcion"
                                            placeholder="Descripción"></textarea>
                                        @if ($errors->has('selected.descripcion'))
                                            <p class="mt-2  text-pink-600 text-sm">
                                                {{ $errors->first('selected.descripcion') }}
                                            </p>
                                        @endif
                                    </td>
                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">

                                        <input wire:model.live="selected.cantidad" type="number" min="1"
                                            value="1" step="1" class="form-input qyt"
                                            placeholder="Cantidad">
                                        @if ($errors->has('selected.cantidad'))
                                            <p class="mt-2  text-pink-600 text-sm">
                                                {{ $errors->first('selected.cantidad') }}
                                            </p>
                                        @endif
                                    </td>

                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                        <input wire:model.live="selected.precio" type="number" min="0"
                                            step="0.1" class="form-input importe" placeholder="Importe">
                                        @if ($errors->has('selected.precio'))
                                            <p class="mt-2  text-pink-600 text-sm">
                                                {{ $errors->first('selected.precio') }}
                                            </p>
                                        @endif
                                    </td>

                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">

                                    </td>
                                    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap w-px">
                                        <div class="space-x-1">

                                            <button type="button" wire:click="addProducto"
                                                class="text-white btn bg-cyan-500 hover:text-slate-500 ">
                                                <span class="sr-only">Añadir</span>


                                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24">
                                                    <g fill="none" class="nc-icon-wrapper">
                                                        <path
                                                            d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"
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

                                {{-- fila para añadir --}}
                                @if ($items->count() > 0)
                                    @foreach ($items->all() as $clave => $item)
                                        <tr wire:key="item-{{ $clave }}-{{ $item['producto_id'] }}">
                                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                                <textarea required wire:model.live="items.{{ $clave }}.producto" class="form-textarea" rows="4">

                                                </textarea>
                                                @if ($errors->has('items.' . $clave . '.cantidad'))
                                                    <p class="mt-2  text-pink-600 text-sm">
                                                        {{ $errors->first('items.' . $clave . '.cantidad') }}
                                                    </p>
                                                @endif
                                            </td>
                                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                                <textarea required wire:model.live="items.{{ $clave }}.descripcion" class="form-textarea" rows="4">
                                                </textarea>

                                            </td>
                                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                                <input required type="number" x-mask="99999"
                                                    wire:model.live="items.{{ $clave }}.cantidad"
                                                    min="1" step="1" class="form-input cantidad"
                                                    placeholder="Cantidad" value="2">
                                                @if ($errors->has('items.' . $clave . '.cantidad'))
                                                    <p class="mt-2  text-pink-600 text-sm">
                                                        {{ $errors->first('items.' . $clave . '.cantidad') }}
                                                    </p>
                                                @endif
                                            </td>
                                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                                <input required type="number" required min="1" step="0.1"
                                                    wire:model.live="items.{{ $clave }}.precio"
                                                    class="form-input precio">
                                                @if ($errors->has('items.' . $clave . '.cantidad'))
                                                    <p class="mt-2  text-pink-600 text-sm">
                                                        {{ $errors->first('items.' . $clave . '.cantidad') }}
                                                    </p>
                                                @endif
                                            </td>
                                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                                <input type="text"
                                                    wire:model.live="items.{{ $clave }}.total"
                                                    class="form-input importe subtotal" readonly>
                                            </td>
                                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap w-px">
                                                <div class="space-x-1">
                                                    <button type="button"
                                                        wire:click.prevent="eliminarProducto('{{ $clave }}')"
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
                        <div
                            class="py-2 ml-auto mt-5 w-full sm:w-2/4 lg:w-1/4 mr-2 {{ $ConvertirSoles ? '' : 'hidden' }}">
                            <div class="flex justify-between mb-3">
                                <div class="text-gray-900 text-right flex-1 font-medium text-sm">Sub Total</div>
                                <div class="text-right w-40">
                                    <div class="text-gray-800 text-sm"> S/.
                                        <span>{{ number_format($sub_total_soles, 2) }}</span>
                                    </div>

                                </div>
                            </div>
                            <div class="flex justify-between mb-4">
                                <div class="text-gray-900 text-right flex-1 font-medium text-sm">IGV(18%) Soles</div>
                                <div class="text-right w-40">
                                    <div class="text-gray-800 text-sm">S/.
                                        <span>{{ number_format($impuesto_soles, 2) }}</span>
                                    </div>

                                </div>
                            </div>

                            <div class="py-2 border-t border-b">
                                <div class="flex justify-between">
                                    <div class="text-gray-900 text-right flex-1 font-medium text-sm">Monto Total Soles
                                    </div>
                                    <div class="text-right w-40">
                                        <div class="text-xl text-gray-800 font-bold">
                                            S/. <span>{{ number_format($total_soles, 2) }}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- DIV PARA SUB Y TOTALES --}}
                        <div class="py-2 ml-auto mt-5 w-full sm:w-2/4 lg:w-1/4 mr-2">
                            <div class="flex justify-between mb-3">
                                <div class="text-gray-900 text-right flex-1 font-medium text-sm">Sub Total</div>
                                <div class="text-right w-40">
                                    <div class="text-gray-800 text-sm">{{ $simbolo }}
                                        <span>{{ number_format($sub_total, 2) }}</span>
                                    </div>

                                </div>
                            </div>
                            <div class="flex justify-between mb-4">
                                <div class="text-gray-900 text-right flex-1 font-medium text-sm">IGV(18%)</div>
                                <div class="text-right w-40">
                                    <div class="text-gray-800 text-sm">{{ $simbolo }}
                                        <span>{{ number_format($impuesto, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="py-2 border-t border-b">
                                <div class="flex justify-between">
                                    <div class="text-gray-900 text-right flex-1 font-medium text-sm">Monto Total
                                    </div>
                                    <div class="text-right w-40">
                                        <div class="text-xl text-gray-800 font-bold">
                                            {{ $simbolo }}<span>{{ number_format($total, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-4 py-3 text-right sm:px-6">
                <button class="btn bg-emerald-500 hover:cursor-pointer hover:bg-emerald-600 text-white"
                    wire:click.prevent="save">Guardar</button>
            </div>

        </div>

    </div>
</div>

@push('modals')
    @livewire('admin.clientes.save')
@endpush

@section('js')
@endsection
