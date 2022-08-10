@extends('layouts.admin')

@section('contenido')
    <!-- Code block starts -->
    <div
        class="my-6 lg:my-12 container px-6 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between pb-4 border-b border-gray-300">
        <!-- Add customer button -->
        <a href="{{ route('admin.almacen.dispositivos.index') }}">
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
            <h4 class="text-2xl font-bold leading-tight text-gray-800 dark:text-gray-100">AÑADIR DISPOSITIVO</h4>
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
                    <span>Activo</span>
                </li>

            </ul>
        </div>
    </div>
    <!-- Code block ends -->

    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1 ml-4">
                <div class="px-6 sm:px-2">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Formulario para añadir un dispositivo
                    </h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Rellena los campos obligatorios
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">

                {!! Form::open(['route' => 'admin.almacen.dispositivos.store']) !!}
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-12 gap-6">

                            <div class="col-span-6 sm:col-span-6">
                                {!! Form::hidden('empresa_id', session('empresa')) !!}


                                {!! Html::decode(
                                    Form::label('imei', 'Imei <span class="text-rose-500">*</span>', ['class' => 'block text-sm font-medium mb-1']),
                                ) !!}

                                {!! Form::text('imei', null, [
                                    'placeholder' => 'Escribe un imei...',
                                    'class' => 'form-input
                                                                                                                                                                                                                            w-full md:w-full valid:border-emerald-300 required:border-rose-300 invalid:border-rose-300
                                                                                                                                                                                                                            peer',
                                ]) !!}
                                @error('imei')
                                    <p class="mt-2 peer-invalid:visible text-pink-600 text-sm">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-6">


                                {!! Form::label('modelo_id', 'Modelo:', ['class' => 'block text-sm font-medium mb-1']) !!}
                                {!! Form::select('modelo_id', $modelos, null, ['class' => 'form-select w-full']) !!}

                            </div>

                            @error('modelo_id')
                                <p class="mt-2 peer-invalid:visible text-pink-600 text-sm">
                                    {{ $message }}
                                </p>
                            @enderror

                            <div class="col-span-12 mt-2">
                                <label
                                    class="flex text-sm not-italic items-center font-medium text-gray-800 whitespace-nowrap justify-between">
                                    <div>
                                        De cliente?:
                                    </div>

                                </label>
                                <div class="flex flex-wrap items-center -m-3">

                                    <div class="m-3">
                                        <!-- Start -->
                                        <label class="flex items-center">
                                            <input type="radio" name="of_client" value="1" class="form-radio" />
                                            <span class="text-sm ml-2">SI</span>
                                        </label>
                                        <!-- End -->
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        {!! Form::submit('GUARDAR', [
                            'class' => 'btn bg-emerald-600 hover:bg-emerald-600 focus:outline-none
                                                                                                                                                                    focus:ring-2 focus:ring-offset-2
                                                                                                                                                                    focus:ring-emerald-600 text-white',
                        ]) !!}

                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
