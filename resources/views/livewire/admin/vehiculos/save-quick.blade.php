<div>
    <div x-data="{ modalOpen: @entangle('modalOpen') }">
        <div class="fixed inset-0 bg-slate-900 bg-opacity-30 z-50 transition-opacity" x-show="modalOpen"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-100"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true" x-cloak>
        </div>
        <div id="basic-modal"
            class="fixed inset-0 z-50 overflow-hidden flex items-center my-4 justify-center transform px-4 sm:px-6"
            role="dialog" aria-modal="true" x-show="modalOpen" x-transition:enter="transition ease-in-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in-out duration-200"
            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4"
            x-cloak>

            <div class="bg-white rounded shadow-lg overflow-auto w-full md:w-3/4 lg:w-6/12 xl:w-6/12 2xl:w-6/12 max-h-full"
                @keydown.escape.window="modalOpen = false">
                <div class="px-5 py-3 border-b border-slate-200">
                    <div class="flex justify-between items-center">
                        <div class="font-semibold text-slate-800">CREAR VEHICULO</div>
                        <button class="text-slate-400 hover:text-slate-500" @click="modalOpen = false">
                            <div class="sr-only">Close</div>
                            <svg class="w-4 h-4 fill-current">
                                <path
                                    d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="px-8 py-5 bg-white sm:p-6">

                    <div class="grid grid-cols-12 gap-6">

                        <div class="col-span-6 sm:col-span-6">

                            <label class="block text-sm font-medium mb-1" for="placa">Placa: <span
                                    class="text-rose-500">*</span></label>
                            <div class="relative">
                                <input wire:model="placa" placeholder="ABC-780" name="placa" id="placa"
                                    class="form-input w-full pl-9 valid:border-emerald-300
                                                            required:border-rose-300 invalid:border-rose-300 peer"
                                    type="text" required />
                                <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 fill-current text-slate-800 shrink-0 ml-3 mr-2"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
                                        <g stroke-linecap="square" stroke-miterlimit="10" fill="none"
                                            stroke="currentColor" stroke-linejoin="miter" class="nc-icon-wrapper">
                                            <line data-cap="butt" x1="32" y1="29" x2="41"
                                                y2="19" stroke-linecap="butt">
                                            </line>
                                            <path data-cap="butt"
                                                d="M57,29,52.829,8.98A5,5,0,0,0,47.934,5H16.066a5,5,0,0,0-4.895,3.98L7,29"
                                                stroke-linecap="butt"></path>
                                            <polyline points="16 54 16 58 6 58 6 54"></polyline>
                                            <path
                                                d="M62,49H2V36.066a4.99,4.99,0,0,1,1.465-3.532L7,29H57l3.535,3.535A5,5,0,0,1,62,36.071Z">
                                            </path>
                                            <circle cx="11" cy="40" r="3"></circle>
                                            <polyline points="58 54 58 58 48 58 48 54"></polyline>
                                            <circle cx="53" cy="40" r="3"></circle>
                                            <line x1="25" y1="40" x2="39" y2="40"></line>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                            @error('placa')
                                <p class="mt-2 peer-invalid:visible text-pink-600 text-sm">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">

                            <label class="block text-sm font-medium mb-1" for="marca">Marca:</label>
                            <div class="relative">
                                <input wire:model="marca" placeholder="TOYOTA" name="marca" id="marca"
                                    class="form-input w-full pl-9" type="text" />
                                <div class="absolute inset-0 right-auto flex items-center pointer-events-none">

                                    <svg class="w-4 h-4 fill-current text-slate-400 shrink-0 ml-3 mr-2"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <g fill="none" class="nc-icon-wrapper">
                                            <path
                                                d="M10.08 10.86c.05-.33.16-.62.3-.87.14-.25.34-.46.59-.62.24-.15.54-.22.91-.23.23.01.44.05.63.13.2.09.38.21.52.36s.25.33.34.53c.09.2.13.42.14.64h1.79c-.02-.47-.11-.9-.28-1.29-.17-.39-.4-.73-.7-1.01-.3-.28-.66-.5-1.08-.66-.42-.16-.88-.23-1.39-.23-.65 0-1.22.11-1.7.34-.48.23-.88.53-1.2.92-.32.39-.56.84-.71 1.36-.15.52-.24 1.06-.24 1.64v.27c0 .58.08 1.12.23 1.64.15.52.39.97.71 1.35.32.38.72.69 1.2.91.48.22 1.05.34 1.7.34.47 0 .91-.08 1.32-.23.41-.15.77-.36 1.08-.63.31-.27.56-.58.74-.94.18-.36.29-.74.3-1.15h-1.79c-.01.21-.06.4-.15.58-.09.18-.21.33-.36.46s-.32.23-.52.3c-.19.07-.39.09-.6.1-.36-.01-.66-.08-.89-.23a1.75 1.75 0 0 1-.59-.62c-.14-.25-.25-.55-.3-.88a6.74 6.74 0 0 1-.08-1v-.27c0-.35.03-.68.08-1.01zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"
                                                fill="currentColor"></path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 sm:col-span-6">

                            <label class="block text-sm font-medium mb-1" for="modelo">Modelo:</label>
                            <div class="relative">
                                <input wire:model="modelo" placeholder="HILUX" name="modelo" id="modelo"
                                    class="form-input w-full pl-9" type="text" />
                                <div class="absolute inset-0 right-auto flex items-center pointer-events-none">

                                    <svg class="w-4 h-4 fill-current text-slate-400 shrink-0 ml-3 mr-2"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <g fill="none" class="nc-icon-wrapper">
                                            <path
                                                d="M20 18v-1c1.1 0 1.99-.9 1.99-2L22 5c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2v1H0v2h24v-2h-4zM4 5h16v10H4V5z"
                                                fill="currentColor"></path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 sm:col-span-6">

                            <label class="block text-sm font-medium mb-1" for="tipo">Tipo:</label>
                            <div class="relative">
                                <input wire:model="tipo" id="tipo" name="tipo" placeholder="PICK UP"
                                    class="form-input w-full pl-9" type="text" />
                                <div class="absolute inset-0 right-auto flex items-center pointer-events-none">

                                    <svg class="w-4 h-4 fill-current text-slate-400 shrink-0 ml-3 mr-2"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <g fill="none" class="nc-icon-wrapper">
                                            <path
                                                d="M4 16c0 .88.39 1.67 1 2.22V20c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h8v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1.78c.61-.55 1-1.34 1-2.22V6c0-3.5-3.58-4-8-4s-8 .5-8 4v10zm3.5 1c-.83 0-1.5-.67-1.5-1.5S6.67 14 7.5 14s1.5.67 1.5 1.5S8.33 17 7.5 17zm9 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm1.5-6H6V6h12v5z"
                                                fill="currentColor"></path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 sm:col-span-6">

                            <label class="block text-sm font-medium mb-1" for="year">Año:</label>
                            <div class="relative">
                                <input wire:model="year" id="year" name="year" placeholder="2019"
                                    class="form-input w-full pl-9" type="text" />
                                <div class="absolute inset-0 right-auto flex items-center pointer-events-none">

                                    <svg class="w-4 h-4 fill-current  shrink-0 ml-3 mr-2"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                                        <g class="nc-icon-wrapper">
                                            <path d="M2,41a5,5,0,0,0,5,5H41a5,5,0,0,0,5-5V16H2Z" fill="#e3e3e3">
                                            </path>
                                            <path d="M41,6H7a5,5,0,0,0-5,5v5H46V11A5,5,0,0,0,41,6Z" fill="#ff7163">
                                            </path>
                                            <path
                                                d="M23.239,38.894H12.359V36.6c2.891-2.922,5.36-5.363,6.175-6.414,1.382-1.784,1.136-3.3.484-3.88-1.287-1.142-3.435-.085-4.913,1.139l-1.788-2.119a7.62,7.62,0,0,1,5.557-2.225c2.88,0,4.928,1.662,4.928,4.216a6.047,6.047,0,0,1-1.549,3.949c-.826,1.032-4.8,4.855-4.8,4.855h6.781Z"
                                                fill="#aeaeae"></path>
                                            <path
                                                d="M24.7,32.155q0-4.62,1.954-6.877A7.319,7.319,0,0,1,32.5,23.021a10.653,10.653,0,0,1,2.087.16V25.81a8.524,8.524,0,0,0-1.874-.213c-1.8,0-3.517.431-4.364,2.023a6.926,6.926,0,0,0-.628,2.842,4.211,4.211,0,0,1,3.513-1.809c2.937,0,4.449,2.015,4.449,4.929,0,3.271-1.916,5.4-5.3,5.4C26.6,38.979,24.7,36.12,24.7,32.155Zm5.621,4.194c1.545,0,2.182-1.16,2.182-2.725,0-1.461-.651-2.448-2.118-2.448a2.318,2.318,0,0,0-2.417,2.161C27.965,34.856,28.82,36.349,30.318,36.349Z"
                                                fill="#aeaeae"></path>
                                            <path
                                                d="M11.5,12A1.5,1.5,0,0,1,10,10.5v-7a1.5,1.5,0,0,1,3,0v7A1.5,1.5,0,0,1,11.5,12Z"
                                                fill="#363636"></path>
                                            <path
                                                d="M36.5,12A1.5,1.5,0,0,1,35,10.5v-7a1.5,1.5,0,0,1,3,0v7A1.5,1.5,0,0,1,36.5,12Z"
                                                fill="#363636"></path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 sm:col-span-6">

                            <label class="block text-sm font-medium mb-1" for="color">Color:</label>
                            <div class="relative">
                                <input wire:model="color" id="color" name="color"
                                    placeholder="BLANCO ROJO AZUL" class="form-input w-full pl-9" type="text" />
                                <div class="absolute inset-0 right-auto flex items-center pointer-events-none">

                                    <svg class="w-4 h-4 fill-current  shrink-0 ml-3 mr-2"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                                        <g class="nc-icon-wrapper">
                                            <rect x="3" y="3" width="17" height="17"
                                                rx="3" fill="#6cc4f5"></rect>
                                            <path
                                                d="M46.138,9.419,38.581,1.862a2.945,2.945,0,0,0-4.162,0L26.862,9.419a2.943,2.943,0,0,0,0,4.162l7.557,7.557a2.948,2.948,0,0,0,4.162,0l7.557-7.557a2.943,2.943,0,0,0,0-4.162Z"
                                                fill="#c456eb"></path>
                                            <rect x="28" y="28" width="17" height="17"
                                                rx="3" fill="#6cc4f5"></rect>
                                            <rect x="3" y="28" width="17" height="17"
                                                rx="3" fill="#6cc4f5"></rect>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 sm:col-span-6">

                            <label class="block text-sm font-medium mb-1" for="motor">Motor:</label>
                            <div class="relative">
                                <input wire:model="motor" id="motor" name="motor" placeholder="1GDG066086"
                                    class="form-input w-full pl-9" type="text" />
                                <div class="absolute inset-0 right-auto flex items-center pointer-events-none">

                                    <svg class="w-4 h-4 fill-current shrink-0 ml-3 mr-2"
                                        xmlns="
                                        http://www.w3.org/2000/svg"
                                        viewBox="0 0 48 48">
                                        <g class="nc-icon-wrapper">
                                            <path
                                                d="M43.989,35.373,30.167,23.437,23,30.389l12.373,13.6q.1.115.213.225a6.1,6.1,0,0,0,8.627,0h0c.073-.073.144-.148.213-.224A6.1,6.1,0,0,0,43.989,35.373Z"
                                                fill="#ff7163"></path>
                                            <path
                                                d="M8.414,14H11l8.847,8.847L23,20l-9-9V8.414a1,1,0,0,0-.293-.707L8,2,2,8l5.707,5.707A1,1,0,0,0,8.414,14Z"
                                                fill="#949494"></path>
                                            <path
                                                d="M35.629,24.383A11.321,11.321,0,0,0,45.977,14.034a12.35,12.35,0,0,0-.485-4.291L39.48,15.754,32.251,8.525l6.011-6.012a12.342,12.342,0,0,0-4.29-.477,11.321,11.321,0,0,0-10.35,10.348,12.345,12.345,0,0,0,.479,4.295L3.046,35.688a3.171,3.171,0,0,0-.226,4.478c.036.04.072.078.11.115l4.793,4.794a3.17,3.17,0,0,0,4.483-.008c.037-.036.072-.074.107-.112L31.333,23.9A12.353,12.353,0,0,0,35.629,24.383Z"
                                                fill="#c8c8c8"></path>
                                            <path
                                                d="M39,40a1,1,0,0,1-.707-.293l-7-7a1,1,0,0,1,1.414-1.414l7,7A1,1,0,0,1,39,40Z"
                                                fill="#f74b3b"></path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 sm:col-span-6">

                            <label class="block text-sm font-medium mb-1" for="serie">Serie:</label>
                            <div class="relative">
                                <input wire:model="serie" id="serie" name="serie"
                                    placeholder="8AJHA8CD9K2629775" class="form-input w-full pl-9" type="text" />
                                <div class="absolute inset-0 right-auto flex items-center pointer-events-none">

                                    <svg class="w-4 h-4 fill-current text-slate-400 shrink-0 ml-3 mr-2"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                                        <g class="nc-icon-wrapper">
                                            <path
                                                d="M38,23a1,1,0,0,1-.707-.293l-6-6a1,1,0,0,1,0-1.414l8-8a1,1,0,0,1,1.414,0l6,6a1,1,0,0,1,0,1.414l-2,2a1,1,0,0,1-1.414,0L41,14.414,38.414,17l2.293,2.293a1,1,0,0,1,0,1.414l-2,2A1,1,0,0,1,38,23Z"
                                                fill="#eba40a"></path>
                                            <path
                                                d="M44.061,3.939a1.5,1.5,0,0,0-2.122,0L17.923,27.956a10.027,10.027,0,1,0,2.121,2.121L44.061,6.061A1.5,1.5,0,0,0,44.061,3.939ZM12,43a7,7,0,1,1,4.914-11.978c.011.012.014.027.025.039s.027.014.039.025A6.995,6.995,0,0,1,12,43Z"
                                                fill="#ffd764"></path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-12 sm:col-span-12 selectCliente" wire:ignore>

                            <label class="block text-sm font-medium mb-1" for="clientes_id">Cliente: <span
                                    class="text-rose-500">*</span></label>


                            <select wire:model="clientes_id" name="clientes_id" id="clientes_id"
                                class="clientes_id w-full" required></select>

                        </div>
                        <div class="col-span-12">

                            @error('clientes_id')
                                <p class="mt-2 peer-invalid:visible text-pink-600 text-sm">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        @if ($flotas)
                            <div class="col-span-12 sm:col-span-12">
                                <label class="block text-sm font-medium mb-1" for="clientes_id">Flotas:</label>
                                <div class="m-3 flex gap-2">
                                    @foreach ($flotas as $flota)
                                        <label class="flex items-center">
                                            <span class="text-sm mr-2 uppercase">{{ $flota->nombre }} </span>

                                            <input type="checkbox" value="{{ $flota->id }}"
                                                wire:model="flotas_selected" class="form-checkbox">
                                        </label>
                                    @endforeach
                                </div>

                                @error('flotas')
                                    <p class="mt-2 peer-invalid:visible text-pink-600 text-sm">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        @endif

                    </div>

                </div>
                <!-- Modal footer -->
                <div class="px-5 py-4 border-t border-slate-200">
                    <div class="flex flex-wrap justify-end space-x-2">
                        <button class="btn-sm border-slate-200 hover:border-slate-300 text-slate-600"
                            wire:click.prevent="closeModal">Cerrar</button>
                        <button wire:click.prevent="GuardarVehiculo()"
                            class="btn-sm bg-indigo-500 hover:bg-indigo-600 text-white">Guardar</button>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>

@once
    @push('scripts')
        <script>
            $('#placa').caseEnforcer('uppercase');
        </script>

        <script>
            $('.clientes_id').select2({
                placeholder: 'Selecciona cliente',
                language: "es",
                width: '100%',
                ajax: {
                    url: '{{ route('search.clientes') }}',
                    dataType: 'json',
                    delay: 250,
                    cache: true,
                    data: function(params) {

                        var query = {
                            term: params.term,
                        }
                        return query;
                    },
                    processResults: function(data, params) {

                        var suggestions = $.map(data.suggestions, function(obj) {

                            obj.id = obj.id || obj.value;
                            obj.text = obj.data;
                            return obj;

                        });
                        return {
                            results: suggestions,
                        };
                    },


                },
                minimumInputLength: 1,
                templateResult: formatCliente,
            });


            $('.clientes_id').on('change', function() {

                @this.set('clientes_id', this.value)
            })

            function formatCliente(cliente) {

                if (cliente.loading) {
                    return cliente.text;
                }

                var $container = $(

                    "<div class='select2-result-clientes clearfix'>" +
                    "<div class='select2-result-clientes__meta'>" +
                    "<div class='select2-result-clientes__title'></div>" +
                    "<div class='select2-result-clientes__description'></div>" +
                    "</div>" +
                    "</div>"
                );

                $container.find(".select2-result-clientes__title").text(cliente.text);
                $container.find(".select2-result-clientes__description").text(cliente.numero_documento);

                return $container;
            }
        </script>
    @endpush
@endonce