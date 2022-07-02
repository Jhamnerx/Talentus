<div>
    {!! Form::open(['route' => 'admin.asign.lineas.store', 'autocomplete' => 'off']) !!}

    <div class="bg-white sm:p-6 shadow-md rounded-md">
        <div class="grid grid-cols-12 gap-2 mb-1 relative ml-4">

            <div class="col-span-12 sm:col-span-12 mb-4 mx-3">

                {!! Form::label('sim_card', '1. Ingrese código de nuevo chip:', ['class' => 'block text-sm font-medium
                mb-1'])
                !!}
                {{-- <input name="sim" id="autocomplete-ajax-sim" type="text" class="form-input w-full sm:w-1/2"
                    placeholder="Escribe el sim card"> --}}
                {!! Form::text('sim_card', $value, ['placeholder' => 'Escribe el sim card','id' =>
                'autocomplete-ajax-sim',
                'class' => 'form-input w-full sm:w-1/2', 'maxlength' => '19']) !!}



                {{-- <input type="text" name="sim_card" id="sim_card"> --}}
                {!! Form::hidden('sim_card_id', null, ['id' => 'sim_card_id']) !!}

                @error('sim_card_id')

                <p class="mt-2 peer-invalid:visible text-pink-600 text-sm">
                    {{$message}}
                </p>

                @enderror
            </div>

            <div class="col-span-12 sm:col-span-12 mb-4 mx-3">
                {!! Form::label('numero', '2. Ingrese una línea:', ['class' => 'block text-sm font-medium
                mb-1'])
                !!}

                <input name="numero" id="autocomplete-ajax-linea" type="text" class="form-input w-full sm:w-1/2"
                    placeholder="Ingresar Linea" maxlength="9">




                {!! Form::hidden('lineas_id', null, ['id' => 'linea_id']) !!}
                @error('lineas_id')

                <p class="mt-2 peer-invalid:visible text-pink-600 text-sm">
                    {{$message}}
                </p>

                @enderror
            </div>
            <div class="col-span-12 sm:col-span-12 mb-4 mx-3">
                {!! Form::label('motivo', '3. Motivo de cambio', ['class' => 'block text-sm font-medium mb-1'])
                !!}
                <input name="motivo" type="text" class="form-input w-full sm:w-1/2 " placeholder="Escribe el motivo">



                @error('motivo')

                <p class="mt-2 peer-invalid:visible text-pink-600 text-sm">
                    {{$message}}
                </p>

                @enderror
            </div>


        </div>
        <div class="px-4 py-3 text-right sm:px-6 mb-1 border-t-2 border-t-slate-400">

            {!! Form::submit('Asignar', ['class' => 'btn bg-emerald-500 hover:bg-emerald-600 focus:outline-none
            focus:ring-2 focus:ring-offset-2
            focus:ring-emerald-600 text-white']) !!}

        </div>
    </div>



    {!! Form::close() !!}

</div>
@section('js')
<script>



</script>
<script>
    $('#autocomplete-ajax-sim').devbridgeAutocomplete({
            // serviceUrl: '/autosuggest/service/url',
            lookup: function (query, done) {

                // Do Ajax call or lookup locally, when done,
                // call the callback and pass your results:
                $.ajax({
                    url: "{{route('search.sim_card')}}",
                    dataType: 'json',
                    data: {
                        term: query
                    },
                    success: function(data){

                        done(data);
                        //console.log(data);
                    }
                })

            },
            // serviceUrl: "{{route('search.lineas')}}",
            // type: 'GET',
            // dataType: 'json',

            minChars: 2,
            autoSelectFirst: false,
            deferRequestBy: 5,
            onSelect: function(suggestion) {

                $('#sim_card_id').val(suggestion.data);

            },
            onHint: function (hint) {
               $('#sim_card_id').val(hint);
                //console.log(hint);


            },
            onSearchComplete: function (query, suggestions) {

            },
            onInvalidateSelection: function() {
                $('#selction-ajax').html('You selected: none');
            },

        });
    $('#autocomplete-ajax-linea').devbridgeAutocomplete({
            // serviceUrl: '/autosuggest/service/url',
            lookup: function (query, done) {

                // Do Ajax call or lookup locally, when done,
                // call the callback and pass your results:
                $.ajax({
                    url: "{{route('search.lineas')}}",
                    dataType: 'json',
                    data: {
                        term: query
                    },
                    success: function(data){

                        done(data);
                        //console.log(data);
                    }
                })

            },
            // serviceUrl: "{{route('search.lineas')}}",
            // type: 'GET',
            // dataType: 'json',

            minChars: 2,
            autoSelectFirst: false,
            deferRequestBy: 5,
            onSelect: function(suggestion) {

                $('#linea_id').val(suggestion.data);
               // console.log(suggestion);

            },
            onHint: function (hint) {
               $('#linea_id').val(hint);
                //console.log(hint);


            },
            onSearchComplete: function (query, suggestions) {

            },
            onInvalidateSelection: function() {
                $('#selction-ajax').html('You selected: none');
            },

        });

</script>
@stop