<!DOCTYPE html>
<html>

<head>
    @if ($acta->vehiculos && $acta->ciudades)
        <title>ACTA {{ $acta->vehiculos->placa }}
            {{ $acta->ciudades->prefijo . '-' . $acta->year . '-' . $acta->numero }}
        </title>
    @else
        <title>Faltan datos en esta acta, por favor corrigelas</title>
    @endif



    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    {{ header('Content-type:application/pdf') }}


    <style type="text/css">
        /* -- Base -- */
        body {

            font-family: "Arial, Helvetica, sans-serif";
            background-repeat: no-repeat;
            background-size: 100%;

        }

        html {
            margin: 0px;
            padding: 0px;

        }

        .acta {
            display: flex;
            flex-wrap: wrap;
            overflow: hidden;
            padding: 2rem;
            // margin: 0rem 4rem;

        }




        .certifica {
            margin-top: -1rem;
            margin-bottom: 1rem;
            text-justify: auto;
            margin-left: 5rem;
            font-size: 16px;
            color: #000;
            line-height: 1.7;
            // position: relative;

        }

        .descripcion {
            margin-top: 2rem;
            margin-bottom: 1rem;
            text-justify: auto;
            margin-left: 5rem;
            font-size: 14.5px;
            color: #000;
            text-align: center;
        }

        .tabla {
            padding: 0rem 7.2rem;
            text-align: left;
        }

        .footer {
            font-size: 16px;
            color: #000;
            width: 100%;

        }

        .footer .sello {
            margin-top: 3rem;
            width: 50%;
            text-align: center;
        }

        .fecha {
            text-align: right;
            margin-top: -2rem;
            padding-right: 4rem;
        }

        .sello img {
            width: 150px;
        }



        .header {
            display: flex;
            flex-wrap: wrap;
            overflow: hidden;
            margin-left: 5rem;
            margin-top: 2rem;

        }

        .numero {
            width: 100%;
            overflow: hidden;
            color: rgb(238, 34, 34);
            font-style:  !important;
            font-weight: bold;
            font-size: 24px;
            font-family: "DejaVu Sans";
            margin-left: 30rem;
            margin-top: -1.4rem;

        }



        .titulo {


            display: grid;
            grid-template-columns: 30% 70% 1fr;
            grid-template-rows: 1fr;
            gap: 0px 7em;
            height: 160px;

        }


        .qr {
            padding-left: 37rem;
            position: relative;
            top: -42px;
        }



        .title {

            font-weight: bold;
            font-size: 22px;
            text-align: center;
            justify-content: center;
            width: 50%;
            padding-left: 12.5rem;
            position: relative;

        }

        .title span {
            position: relative;
            top: 50px;
        }

        .hash {
            padding-left: 31rem;
            padding-top: 6rem;
            font-size: 12px;
        }
    </style>

</head>

@if ($acta->fondo)

    <body background="data:image/jpeg;base64, {{ base64_encode(file_get_contents('images/' . $fondo)) }}">
    @else

        <body>
@endif


<div class="acta">

    <div class="header">



        <div class="numero">
            {{ $acta->codigo }}
        </div>

    </div>
    <div class="titulo">
        <div class=" title">
            <span>ACTA DE INSTALACIÓN DE EQUIPO GPS</span>
        </div>
        <div class="qr">
            <img
                src="data:image/jpeg;base64, {{ base64_encode(
                    QrCode::format('png')->size(120)->gradient(10, 88, 147, 5, 44, 82, 'vertical')
                    ->style('square')->eye('circle')->encoding('UTF-8')->generate(
                            ' VEHICULO: ' .
                                $acta->vehiculos->placa .
                                " \n ACTA VALIDA HASTA: " .
                                $acta->fin_cobertura .
                                "
                                                \nCONSULTAR VALIDEZ EN: " .
                                route('consulta.actas', $acta->codigo),
                        ),
                ) }}">

        </div>

    </div>


    <div class="certifica">
        <div>
            <span>
                <b>{{ $plantilla->razon_social }}</b>, con RUC {{ $plantilla->ruc }}, Certifica que nuestro cliente:
                <b>{{ $acta->vehiculos->flotas ? strtoupper($acta->vehiculos->flotas->clientes->razon_social) : 'no existe' }}</b>
                con DNI/RUC: {{ $acta->vehiculos->flotas->clientes->numero_documento }}, ha adquirido un equipo
                GPS,
                para la unidad que se detalla a continuación:
                Así mismo a la fecha se encuentra transmitiendo a nuestra Plataforma de Monitoreo Satelital en
                tiempo real.
            </span>
        </div>
    </div>

    <div class="descripcion">
        <table class="tabla">
            <tr>
                <td height="20">Fecha de Instalación</td>
                <td height="20">:{{ $acta->created_at->format('d-m-Y') }}</td>
            </tr>


            <tr>
                <td height="20">Modelo GPS</td>
                <td height="20">:{{ $acta->vehiculos->dispositivos->modelo->modelo }}</td>
            </tr>

            <tr>
                <td height="20">Imei</td>
                <td height="20">:{{ $acta->vehiculos->dispositivos->imei }}</td>
            </tr>

            <tr>
                <td height="20">Certificado de Homologación</td>
                <td height="20">: {{ $acta->vehiculos->dispositivos->modelo->certificado }} </td>
            </tr>

            <tr>
                <td height="20">Placa</td>
                <td height="20">:{{ $acta->vehiculos->placa }}</td>
            </tr>
            <tr>
                <td height="20">Marca</td>
                <td height="20">:{{ $acta->vehiculos->marca }}</td>
            </tr>
            <tr>
                <td height="20">Modelo</td>
                <td height="30">:{{ $acta->vehiculos->modelo }}</td>

            </tr>
            <tr>
                <td height="20">Tipo</td>
                <td height="20">:{{ $acta->vehiculos->tipo }}</td>

            </tr>
            <tr>
                <td height="20">A&ntilde;o</td>
                <td height="20">:{{ $acta->vehiculos->year }}</td>
            </tr>
            <tr>
                <td height="20">Color</td>
                <td height="20">:{{ $acta->vehiculos->color }}</td>
            </tr>
            <tr>
                <td height="20">Motor</td>
                <td height="20">:{{ $acta->vehiculos->motor }}</td>
            </tr>
            <tr>
                <td height="20">Serie</td>
                <td height="20">:{{ $acta->vehiculos->serie }}</td>
            </tr>
            <tr>
                <td height="20">Inicio Cobertura</td>
                <td height="20">:<b>{{ $acta->inicio_cobertura->format('d-m-Y') }}</b></td>

            </tr>
            <tr>
                <td height="20">Fin de cobertura</td>
                <td height="20">:<b>{{ $acta->fin_cobertura->format('d-m-Y') }}</b></td>
            </tr>
        </table>

    </div>

    <div class="footer">
        <div class="sello">
            @if ($acta->sello)
                <img src="data:image/jpeg;base64, {{ base64_encode(file_get_contents('images/' . $sello)) }}"
                    alt="">
            @endif

        </div>
        <div class="fecha">
            <p>{{ $acta->fecha }}</p>
        </div>
    </div>

    <div class="hash">
        {{ $acta->unique_hash }}
    </div>

</div>



</body>

</html>
