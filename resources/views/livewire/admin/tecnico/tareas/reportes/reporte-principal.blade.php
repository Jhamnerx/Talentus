<div>
    <div x-data="{ openModalReporte: @entangle('openModalReporte').live }">
        <!-- Modal backdrop -->
        <div class="fixed inset-0 bg-slate-900 bg-opacity-30 z-50 transition-opacity" x-show="openModalReporte"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-100"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true" x-cloak>
        </div>
        <!-- Modal dialog -->
        <div id="basic-modal"
            class="fixed inset-0 z-50 overflow-hidden flex items-center my-4 justify-center transform px-4 sm:px-6"
            role="dialog" aria-modal="true" x-show="openModalReporte"
            x-transition:enter="transition ease-in-out duration-200" x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in-out duration-200"
            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4"
            x-cloak>

            <div class="bg-white rounded shadow-lg overflow-auto w-full md:w-3/4 lg:w-6/12 xl:w-6/12 2xl:w-1/3 max-h-full"
                @keydown.escape.window="openModalReporte = false">
                <!-- Modal header -->
                <div class="px-5 py-3 border-b border-slate-200">
                    <div class="flex justify-between items-center">
                        <div class="font-semibold text-slate-800">REPORTE DE TAREAS</div>
                        <button class="text-slate-400 hover:text-slate-500" @click="openModalReporte = false">
                            <div class="sr-only">Close</div>
                            <svg class="w-4 h-4 fill-current">
                                <path
                                    d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <form autocomplete="off" autocapitalize="true">


                    <div class="px-8 py-5 bg-white sm:p-6">

                        <div class="grid grid-cols-12 gap-6">
                            <div class="col-span-12 md:col-span-6 gap-2">
                                <label
                                    class="flex text-sm not-italic items-center font-medium text-gray-800 whitespace-nowrap justify-between">
                                    <div>Fecha de Inicial: <span class="text-sm text-red-500"> * </span></div>

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
                                    <input maxlength="10" wire:model.live='fecha_inicial' type="text"
                                        class="form-input valid:border-emerald-300
                                    required:border-rose-300 invalid:border-rose-300 peer fechaInicio  font-base pl-8 py-2 outline-none focus:ring-primary-400 focus:outline-none focus:border-primary-400 block sm:text-sm border-gray-200 rounded-md text-black input w-full"
                                        placeholder="Selecciona la fecha">
                                </div>
                                @error('fecha_inicial')
                                    <p class="mt-2 peer-invalid:visible text-pink-600 text-sm">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="col-span-12 md:col-span-6 gap-2">
                                <label
                                    class="flex text-sm not-italic items-center font-medium text-gray-800 whitespace-nowrap justify-between">
                                    <div>Fecha de Fin: <span class="text-sm text-red-500"> * </span></div>

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
                                    <input maxlength="10" wire:model.live="fecha_final" type="text"
                                        class="form-input valid:border-emerald-300
                                    required:border-rose-300 invalid:border-rose-300 peer fechaFin  font-base pl-8 py-2 outline-none focus:ring-primary-400 focus:outline-none focus:border-primary-400 block sm:text-sm border-gray-200 rounded-md text-black input w-full"
                                        placeholder="Selecciona la fecha">
                                </div>
                                @error('fecha_final')
                                    <p class="mt-2 peer-invalid:visible text-pink-600 text-sm">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="col-span-12 md:col-span-6 gap-2">
                                <label
                                    class="flex text-sm not-italic items-center font-medium text-gray-800 whitespace-nowrap justify-between">
                                    <div>Estado: <span class="text-sm text-red-500"> * </span></div>

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
                                    <select wire:model.live="estado" class="form-select w-full pl-9" id="">
                                        <option value="PENDIENT">PENDIENTE</option>
                                        <option value="UNREAD">SIN LEER</option>
                                        <option value="COMPLETE" selected>COMPLETADAS</option>
                                        <option value="CANCELED">CANCELADAS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-12">
                                <label class="block text-sm font-medium mb-1" for="plataforma">Selecciona El Tecnico:
                                    <span class="text-rose-500">*</span></label>
                                <div class="flex flex-wrap items-center">

                                    @foreach ($tecnicos as $tecnico)
                                        <div class="m-3">
                                            <label class="flex items-center">
                                                <input type="radio" name="radio-buttons" class="form-radio"
                                                    wire:model.live="tecnico_id" value="{{ $tecnico->id }}" />
                                                <span class="text-sm ml-2">{{ $tecnico->name }}</span>
                                            </label>
                                        </div>
                                    @endforeach

                                </div>
                                @error('tecnico_id')
                                    <p class="mt-2 peer-invalid:visible text-pink-600 text-sm">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="col-span-12">

                                <div class="flex flex-wrap items-center -m-1.5">
                                    <div class="flex flex-wrap -space-x-px gap-3">
                                        <button wire:click.prevent="exportToExcel"
                                            class="btn bg-slate-50 border-slate-200 hover:bg-slate-50 text-indigo-500 rounded-none first:rounded-l last:rounded-r">Excel</button>
                                        <button wire:click.prevent="exportToPdf"
                                            class="btn bg-white border-slate-200 hover:bg-slate-50 text-slate-600 rounded-none first:rounded-l last:rounded-r">PDF</button>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </form>
                <!-- Modal footer -->
                <div class="px-5 py-4 border-t border-slate-200">
                    <div class="flex flex-wrap justify-end space-x-2">
                        <button class="btn-sm border-slate-200 hover:border-slate-300 text-slate-600"
                            wire:click="closeModal">Cerrar</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End -->

</div>
