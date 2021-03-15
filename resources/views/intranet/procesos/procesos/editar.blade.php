<?php
function mes_espanol($fecha_ing)
{
$monthNumero = date('m', strtotime($fecha_ing));
switch ($monthNumero) {
case '1':
$monthNameSpanish = 'Enero';
break;
case '2':
$monthNameSpanish = 'Febrero';
break;
case '3':
$monthNameSpanish = 'Marzo';
break;
case '4':
$monthNameSpanish = 'Abril';
break;
case '5':
$monthNameSpanish = 'Mayo';
break;
case '6':
$monthNameSpanish = 'Junio';
break;
case '7':
$monthNameSpanish = 'Julio';
break;
case '8':
$monthNameSpanish = 'Agosto';
break;
case '9':
$monthNameSpanish = 'Septiembre';
break;
case '10':
$monthNameSpanish = 'Octubre';
break;
case '11':
$monthNameSpanish = 'Noviembre';
break;
default:
$monthNameSpanish = 'Diciembre';
}
echo $monthNameSpanish;
}
//---------------------------------------------
function icono_extension($extension)
{
switch ($extension) {
case 'pdf':
$icono_archivo = 'far fa-file-pdf text-danger';
break;
case 'xls':
$icono_archivo = 'far fa-file-excel text-success';
break;
case 'xlsx':
$icono_archivo = 'far fa-file-excel text-success';
break;
case 'jpg':
$icono_archivo = 'fas fa-file-image text-info';
break;
case 'jpeg':
$icono_archivo = 'fas fa-file-image text-info';
break;
case 'png':
$icono_archivo = 'fas fa-file-image text-info';
break;
case 'gif':
$icono_archivo = 'fas fa-file-image text-info';
break;
case 'doc':
$icono_archivo = 'far fa-file-word text-primary';
break;
case 'docx':
$icono_archivo = 'far fa-file-word text-primary';
break;
case 'txt':
$icono_archivo = 'far fa-file-alt text-primary';
break;
case 'mp3':
$icono_archivo = 'far fa-file-audio text-warning';
break;
case 'mp4':
$icono_archivo = 'fas fa-photo-video text-warning';
break;
case 'mkv':
$icono_archivo = 'fas fa-photo-video text-warning';
break;
case 'zip':
$icono_archivo = 'far fa-file-archive text-red';
break;
case 'rar':
$icono_archivo = 'far fa-file-archive text-red';
break;
default:
$icono_archivo = 'far fa-file text-black';
}
echo $icono_archivo;
}
?>
@extends("theme.back.plantilla")
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('estilosHojas')
    <!-- Pagina CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin/crear_proceso.css') }}">
@endsection
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('tituloHoja')
    Editar proceso:{{ $proceso->codigo_unico_proceso }}
@endsection
<!-- ************************************************************* -->
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('cuerpo_pagina')
    <div class="card" style="border-top: 8px solid rgb(38, 160, 241);">
        @include('includes.error-form')
        @include('includes.mensaje')
        <div class="card-header">
            <br>
            <div class="row row d-flex justify-content-around">
                <div class="col-12">
                    <div class="row d-flex justify-content-around">
                        <div class="col-12 col-md-6 col-lg-6 text-center" style="white-space:nowrap;">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <h6>Proceso N° <strong
                                            id="codigo_unico_proceso">{{ $proceso->codigo_unico_proceso }}</strong></h6>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6 text-center"><button
                                        class="btn btn-primary bg-primary btn-xs ml-2" data-toggle="modal"
                                        data-target="#cambio_cod_proceso"><i class="fas fa-pen-square"></i> Camb Cod.
                                        Pro.</button></div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 text-center">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <h6>Tipo de proceso: <strong
                                            id="tipo_de_proceso">{{ $proceso->tipos_proceso->tipo_proceso }}</strong></h6>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6 text-center"><button
                                        class="btn btn-primary bg-primary btn-xs ml-2" data-toggle="modal"
                                        data-target="#cambio_tipo_proceso"><i class="fas fa-pen-square"></i> Camb Tipo
                                        Pro.</button></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <h6><strong>Clientes:</strong></h6>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-around">
                        <div class="col-11 table-responsive">
                            <table class="table tabla-data" id="tabla_clientes_proceso">
                                <thead>
                                    <tr>
                                        <th scope="col">Papel del cliente</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Identificaci&oacute;n</th>
                                        <th scope="col">Correo</th>
                                        <th scope="col">Tel&eacute;fono</th>
                                        <th scope="col">Persona de Contacto</th>
                                        <th scope="col">Cargo Contacto</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $contador = 0; ?>
                                    @foreach ($proceso->empresas as $empresa)
                                        <?php $contador++; ?>
                                        <tr>
                                            @if ($contador == 1)
                                        <tr id="clientes_primer_registro">
                                        @else
                                        <tr>
                                    @endif{{ $empresa->papel }}</td>
                                    <td>{{ $empresa->nombre }}</td>
                                    <td>{{ $empresa->identificacion }}</td>
                                    <td>{{ $empresa->email }}</td>
                                    <td>{{ $empresa->telefono }}</td>
                                    <td>{{ $empresa->contacto }}</td>
                                    <td>{{ $empresa->cargo }}</td>>
                                    @if ($contador == 1)
                                        <td><button type="button" style="font-size: 9pt;" class="btn-accion-tabla text-info"
                                                title="Cambiar este registro" data-toggle="modal"
                                                data-target="#modal_cambiar_cliente"><i
                                                    class="fas fa-exchange-alt"></i></button></td>
                                    @else
                                        <td>
                                            <form
                                                action="{{ route('eliminar_cliente_proceso', ['id_cliente' => $cliente_pro->id, 'id_proceso' => $proceso->id]) }}"
                                                class="d-inline form-eliminar" method="POST">
                                                @csrf @method("delete")
                                                <button type="submit"
                                                    class="btn-accion-tabla eliminar tooltipsC text-danger"
                                                    title="Eliminar este registro" id_registro="{{ $cliente_pro->id }}">
                                                    <i class="fas fa-user-slash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-3 mb-5">
                        <div class="col-12 pl-2">
                            <button class="btn btn-success bg-success btn-xs ml-2 pl-2 pr-2" data-toggle="modal"
                                data-target="#modal_adicionar_cliente"><i class="fas fa-pen-square"></i> Adicionar
                                cliente</button>
                        </div>
                    </div>
                    <hr style="border-top: 2px solid black;">
                    <div class="row d-flex justify-content-around">
                        <div class="col-12 col-md-11 col-lg-11">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <h6>Juzgado: <strong
                                                    id="juzgado_proceso">{{ $proceso->juzgados->despacho }}</strong></h6>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6 text-right"><button
                                                class="btn btn-primary bg-primary btn-xs ml-2" data-toggle="modal"
                                                data-target="#cambio_juzgado_proceso"><i class="fas fa-pen-square"></i> Camb
                                                Juzgado</button></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">
                                                    Jurisdicci&oacute;n</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">
                                                    Departamento</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Distrito
                                                </th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Circuito
                                                </th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">
                                                    Municipio</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Juez
                                                </th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Correo
                                                    Electronico</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">
                                                    Tel&eacute;fono</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">
                                                    Direcci&oacute;n</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="row_tabla_juzgado">
                                                <td style="white-space:nowrap;" class="text-center">
                                                    {{ $proceso->juzgados->jurisdiccion_juzgados->jurisdiccion }}</td>
                                                <td style="white-space:nowrap;" class="text-center">
                                                    {{ $proceso->juzgados->municipios->circuitos->distritos->departamentos->departamento }}
                                                </td>
                                                <td style="white-space:nowrap;" class="text-center">
                                                    {{ $proceso->juzgados->municipios->circuitos->distritos->distrito }}
                                                </td>
                                                <td style="white-space:nowrap;" class="text-center">
                                                    {{ $proceso->juzgados->municipios->circuitos->circuito }}</td>
                                                <td style="white-space:nowrap;" class="text-center">
                                                    {{ $proceso->juzgados->municipios->municipio }}</td>
                                                <td style="white-space:nowrap;" class="text-center">
                                                    {{ $proceso->juzgados->juez }}</td>
                                                <td style="white-space:nowrap;" class="text-center">
                                                    {{ $proceso->juzgados->email }}</td>
                                                <td style="white-space:nowrap;" class="text-center">
                                                    {{ $proceso->juzgados->telefono }}</td>
                                                <td style="white-space:nowrap;" class="text-center">
                                                    {{ $proceso->juzgados->direccion }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr style="border-top: 1px solid rgb(34, 65, 90);">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <h6>Estado Notificacion: <strong
                                                    id="estado_notificacion_juridica">{{ $proceso->estado_notifi }}</strong>
                                            </h6>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6 text-center"><button
                                                class="btn btn-primary bg-primary btn-xs ml-2" data-toggle="modal"
                                                data-target="#cambio_est_not_proceso"><i class="fas fa-pen-square"></i>
                                                Editar Est. Notif</button></div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                            <table class="table table-striped table-bordered table-hover table-sm">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="text-center" style="vertical-align: middle;">
                                                            Fecha Notificaci&oacute;n</th>
                                                        <th scope="col" class="text-center" style="vertical-align: middle;">
                                                            A&ntilde;o</th>
                                                        <th scope="col" class="text-center" style="vertical-align: middle;">
                                                            Mes</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr id="datos_estado_notificacion_juridica">
                                                        @if ($proceso->estado_notifi == 'Notificado')
                                                            <td style="white-space:nowrap;" class="text-center">
                                                                {{ $proceso->fecha_notifi }}</td>
                                                            <td style="white-space:nowrap;" class="text-center">
                                                                {{ date('Y', strtotime($proceso->fecha_notifi)) }}</td>
                                                            <td style="white-space:nowrap;" class="text-center"><?php mes_espanol($proceso->fecha_notifi); ?></td>
                                                        @else
                                                            <td style="white-space:nowrap;" class="text-center">
                                                                {{ '---' }}</td>
                                                            <td style="white-space:nowrap;" class="text-center">
                                                                {{ '---' }}</td>
                                                            <td style="white-space:nowrap;" class="text-center">
                                                                {{ '---' }}</td>
                                                        @endif
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <h6>Conocimiento Jur&iacute;dico: <strong id="estado_conocimiento_juridico">
                                                    @if ($proceso->fecha_conoci_juridi != null)
                                                        {{ 'Si' }}@else{{ 'No' }}@endif
                                                </strong></h6>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6 text-center"><button
                                                class="btn btn-primary bg-primary btn-xs ml-2" data-toggle="modal"
                                                data-target="#cambio_con_jur_proceso"><i class="fas fa-pen-square"></i>
                                                Editar Con. Jur&iacute;dico</button></div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                            <table class="table table-striped table-bordered table-hover table-sm">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="text-center" style="vertical-align: middle;">
                                                            Fec. Con. Jur&iacute;dico</th>
                                                        <th scope="col" class="text-center" style="vertical-align: middle;">
                                                            A&ntilde;o</th>
                                                        <th scope="col" class="text-center" style="vertical-align: middle;">
                                                            Mes</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr id="datos_estado_conocimiento_juridico">
                                                        @if ($proceso->fecha_conoci_juridi != null)
                                                            <td style="white-space:nowrap;" class="text-center">
                                                                {{ $proceso->fecha_conoci_juridi }}</td>
                                                            <td style="white-space:nowrap;" class="text-center">
                                                                {{ date('Y', strtotime($proceso->fecha_conoci_juridi)) }}
                                                            </td>
                                                            <td style="white-space:nowrap;" class="text-center"><?php mes_espanol($proceso->fecha_conoci_juridi);
                                                                ?></td>
                                                        @else
                                                            <td style="white-space:nowrap;" class="text-center">
                                                                {{ '---' }}</td>
                                                            <td style="white-space:nowrap;" class="text-center">
                                                                {{ '---' }}</td>
                                                            <td style="white-space:nowrap;" class="text-center">
                                                                {{ '---' }}</td>
                                                        @endif
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr style="border-top: 2px solid black;">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <h6><strong>Demandados:</strong></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-sm tabla-data"
                                        id="tabla_demandados_proceso">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Nombres
                                                </th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">
                                                    Identificaci&oacute;n</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Correo
                                                    Electronico</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">
                                                    Tel&eacute;fono</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">
                                                    Direcci&oacute;n</th>
                                                <th scope="col" style="white-space:nowrap;vertical-align: middle;"
                                                    class="text-center">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($proceso->demandados as $item)
                                                <tr>
                                                    <td style="white-space:nowrap;">{{ $item->nombres }}</td>
                                                    <td style="white-space:nowrap;" class="text-center">
                                                        {{ $item->tipos_docu->abreb_id . ' ' . $item->identificacion }}
                                                    </td>
                                                    @if ($item->email != null)
                                                        <td style="white-space:nowrap;" class="text-center">
                                                            {{ $item->email }}</td>
                                                    @else
                                                        <td style="white-space:nowrap;" class="text-center">
                                                            {{ '---' }}</td>
                                                    @endif
                                                    @if ($item->telefono != null)
                                                        <td style="white-space:nowrap;" class="text-center">
                                                            {{ $item->telefono }}</td>
                                                    @else
                                                        <td style="white-space:nowrap;" class="text-center">
                                                            {{ '---' }}</td>
                                                    @endif
                                                    @if ($item->direccion != null)
                                                        <td style="white-space:nowrap;" class="text-center">
                                                            {{ $item->direccion }}</td>
                                                    @else
                                                        <td style="white-space:nowrap;" class="text-center">
                                                            {{ '---' }}</td>
                                                    @endif
                                                    <td style="white-space:nowrap;" class="text-center">
                                                        <form
                                                            action="{{ route('eliminar_demandado_proceso', ['id_demandado' => $item->id]) }}"
                                                            class="d-inline form-eliminar" method="POST">
                                                            @csrf @method("delete")
                                                            <button type="submit"
                                                                class="btn-accion-tabla eliminar tooltipsC text-danger"
                                                                title="Eliminar este registro"
                                                                id_registro="{{ $item->id }}">
                                                                <i class="fas fa-user-slash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-3 mb-5">
                                <div class="col-12 pl-2">
                                    <button class="btn btn-success bg-success btn-xs ml-2 pl-2 pr-2" data-toggle="modal"
                                        data-target="#nuevo_demandado_modal"><i class="fas fa-pen-square"></i> Adicionar
                                        demandado</button>
                                </div>
                            </div>
                            <hr style="border-top: solid 1px DARKOLIVEGREEN">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <h6><strong>Demandantes:</strong></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-sm tabla-data"
                                        id="tabla_demandantes_proceso">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Nombres
                                                </th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">
                                                    Identificaci&oacute;n</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Correo
                                                    Electronico</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">
                                                    Tel&eacute;fono</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">
                                                    Direcci&oacute;n</th>
                                                <th scope="col" style="white-space:nowrap;vertical-align: middle;"
                                                    class="text-center">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($proceso->demandantes as $item)
                                                <tr>
                                                    <td style="white-space:nowrap;">{{ $item->nombres }}</td>
                                                    <td style="white-space:nowrap;" class="text-center">
                                                        {{ $item->tipos_docu->abreb_id . ' ' . $item->identificacion }}
                                                    </td>
                                                    @if ($item->email != null)
                                                        <td style="white-space:nowrap;" class="text-center">
                                                            {{ $item->email }}</td>
                                                    @else
                                                        <td style="white-space:nowrap;" class="text-center">
                                                            {{ '---' }}</td>
                                                    @endif
                                                    @if ($item->telefono != null)
                                                        <td style="white-space:nowrap;" class="text-center">
                                                            {{ $item->telefono }}</td>
                                                    @else
                                                        <td style="white-space:nowrap;" class="text-center">
                                                            {{ '---' }}</td>
                                                    @endif
                                                    @if ($item->direccion != null)
                                                        <td style="white-space:nowrap;" class="text-center">
                                                            {{ $item->direccion }}</td>
                                                    @else
                                                        <td style="white-space:nowrap;" class="text-center">
                                                            {{ '---' }}</td>
                                                    @endif
                                                    <td style="white-space:nowrap;" class="text-center">
                                                        <form
                                                            action="{{ route('eliminar_demandante_proceso', ['id_demandante' => $item->id]) }}"
                                                            class="d-inline form-eliminar" method="POST">
                                                            @csrf @method("delete")
                                                            <button type="submit"
                                                                class="btn-accion-tabla eliminar tooltipsC text-danger"
                                                                title="Eliminar este registro"
                                                                id_registro="{{ $item->id }}">
                                                                <i class="fas fa-user-slash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-3 mb-5">
                                <div class="col-12 pl-2">
                                    <button class="btn btn-success bg-success btn-xs ml-2 pl-2 pr-2" data-toggle="modal"
                                        data-target="#nuevo_demandante_modal"><i class="fas fa-pen-square"></i> Adicionar
                                        demandado</button>
                                </div>
                            </div>
                            <hr style="border-top: 2px solid black;">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <h6><strong>Datos Proceso</strong></h6>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6 text-right"><button
                                                class="btn btn-primary bg-primary btn-xs ml-2" data-toggle="modal"
                                                data-target="#editar_datos_proceso_2_modal"><i
                                                    class="fas fa-pen-square"></i> Editar datos del proceso</button></div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Estado
                                                    del Proceso</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Cod
                                                    Actual del Proceso</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Etapa
                                                    del Proceso</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Cuantia
                                                </th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Riesgo
                                                    de Perdida</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="row_datos_proceso">
                                                <td style="white-space:nowrap;" class="text-center">
                                                    {{ $proceso->estados_proceso->estado_proceso }}</td>
                                                <td style="white-space:nowrap;" class="text-center">
                                                    {{ $proceso->codigo_unico_proceso_act }}</td>
                                                <td style="white-space:nowrap;" class="text-center">
                                                    {{ $proceso->etapas_proceso->etapa_proceso }}</td>
                                                <td style="white-space:nowrap;" class="text-center">
                                                    {{ $proceso->cuantia }}
                                                </td>
                                                <td style="white-space:nowrap;" class="text-center">
                                                    {{ $proceso->riesgos_perdida->riesgo_perdida }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr style="border-top: 2px solid black;">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <h6><strong>Apoderados:</strong></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table tabla-data" id="tabla_apoderados_proceso">
                                        <thead>
                                            <tr>
                                                <th style="white-space:nowrap;" class="text-center" scope="col">Nombres</th>
                                                <th style="white-space:nowrap;" class="text-center" scope="col">
                                                    Identificaci&oacute;n</th>
                                                <th style="white-space:nowrap;" class="text-center" scope="col">Correo</th>
                                                <th style="white-space:nowrap;" class="text-center" scope="col">
                                                    Tel&eacute;fono</th>
                                                <th style="white-space:nowrap;" class="text-center" scope="col">tarjeta
                                                    Profesional</th>
                                                <th style="white-space:nowrap;" class="text-center" scope="col">Opciones
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($proceso->apoderados_proceso as $apoderado_pro)
                                                <tr>
                                                    <td style="white-space:nowrap;">
                                                        {{ $apoderado_pro->nombres . ' ' . $apoderado_pro->apellidos }}
                                                    </td>
                                                    <td style="white-space:nowrap;" class="text-center">
                                                        {{ $apoderado_pro->usuario->tipos_docu->abreb_id }}
                                                        {{ $apoderado_pro->identificacion }}</td>
                                                    <td style="white-space:nowrap;" class="text-center">
                                                        {{ $apoderado_pro->email }}</td>
                                                    <td style="white-space:nowrap;" class="text-center">
                                                        {{ $apoderado_pro->telefono }}</td>
                                                    <td style="white-space:nowrap;" class="text-center">
                                                        {{ $apoderado_pro->tarjet_profes }}</td>
                                                    <td style="white-space:nowrap;" class="text-center">
                                                        <form
                                                            action="{{ route('eliminar_apoderado_proceso', ['id_apoderado' => $apoderado_pro->id, 'id_proceso' => $proceso->id]) }}"
                                                            class="d-inline form-eliminar" method="POST">
                                                            @csrf
                                                            @method("delete")
                                                            <button type="submit"
                                                                class="btn-accion-tabla eliminar tooltipsC text-danger"
                                                                title="Eliminar este registro"
                                                                id_registro="{{ $apoderado_pro->id }}">
                                                                <i class="fas fa-user-slash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-3 mb-5">
                                <div class="col-12 pl-2">
                                    <button class="btn btn-success bg-success btn-xs ml-2 pl-2 pr-2" data-toggle="modal"
                                        data-target="#modal_adicionar_apoderado"><i class="fas fa-pen-square"></i> Adicionar
                                        apoderado</button>
                                </div>
                            </div>
                            <hr style="border-top: solid 1px DARKOLIVEGREEN">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <h6><strong>Asistentes:</strong></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table tabla-data" id="tabla_asistentes_proceso">
                                        <thead>
                                            <tr>
                                                <th style="white-space:nowrap;" class="text-center" scope="col">Nombres</th>
                                                <th style="white-space:nowrap;" class="text-center" scope="col">
                                                    Identificaci&oacute;n</th>
                                                <th style="white-space:nowrap;" class="text-center" scope="col">Correo</th>
                                                <th style="white-space:nowrap;" class="text-center" scope="col">
                                                    Tel&eacute;fono</th>
                                                <th style="white-space:nowrap;" class="text-center" scope="col">tarjeta
                                                    Profesional</th>
                                                <th style="white-space:nowrap;" class="text-center" scope="col">Opciones
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($proceso->asistentes_proceso as $asisentes_pro)
                                                <tr>
                                                    <td style="white-space:nowrap;">
                                                        {{ $asisentes_pro->nombres . ' ' . $asisentes_pro->apellidos }}
                                                    </td>
                                                    <td style="white-space:nowrap;" class="text-center">
                                                        {{ $asisentes_pro->usuario->tipos_docu->abreb_id }}
                                                        {{ $asisentes_pro->identificacion }}</td>
                                                    <td style="white-space:nowrap;" class="text-center">
                                                        {{ $asisentes_pro->email }}</td>
                                                    <td style="white-space:nowrap;" class="text-center">
                                                        {{ $asisentes_pro->telefono }}</td>
                                                    <td style="white-space:nowrap;" class="text-center">
                                                        {{ $asisentes_pro->tarjet_profes }}</td>
                                                    <td style="white-space:nowrap;" class="text-center">
                                                        <form
                                                            action="{{ route('eliminar_asistente_proceso', ['id_asistente' => $asisentes_pro->id, 'id_proceso' => $proceso->id]) }}"
                                                            class="d-inline form-eliminar" method="POST">
                                                            @csrf @method("delete")
                                                            <button type="submit"
                                                                class="btn-accion-tabla eliminar tooltipsC text-danger"
                                                                title="Eliminar este registro"
                                                                id_registro="{{ $asisentes_pro->id }}">
                                                                <i class="fas fa-user-slash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-3 mb-5">
                                <div class="col-12 pl-2">
                                    <button class="btn btn-success bg-success btn-xs ml-2 pl-2 pr-2" data-toggle="modal"
                                        data-target="#modal_adicionar_asistente"><i class="fas fa-pen-square"></i> Adicionar
                                        asistente</button>
                                </div>
                            </div>
                            <hr style="border-top: 2px solid black;">
                            <div class="row mb-3">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <h6><strong>Actuaciones</strong></h6>
                                </div>
                                <div class="col-12-col-md-6 col-lg-6 text-right pr-2">
                                    <a href="{{ route('actuaciones_procesos_crear', ['procesos_id' => $proceso->id]) }}"
                                        class="btn btn-warning bg-warning btn-xs ml-2 pl-2 pr-2"><i
                                            class="fas fa-pen-square"></i> Editar Actuaciones</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Fecha
                                                    Actuaci&oacute;n</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">
                                                    Descripci&oacute;n</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Termino
                                                </th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Fecha
                                                    Finalizaci&oacute;n</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">
                                                    Documentos</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">
                                                    Apoderado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($proceso->actuaciones as $actuacion)
                                                <tr>
                                                    <td style="white-space:nowrap;" class="text-center">
                                                        {{ $actuacion->fecha_actuacion }}</td>
                                                    <td style="white-space:nowrap;" class="text-center">
                                                        {{ $actuacion->descripcion_actuacion }}</td>
                                                    <td style="white-space:nowrap;" class="text-center">
                                                        {{ $actuacion->termino }}</td>
                                                    <td style="white-space:nowrap;" class="text-center">
                                                        {{ $actuacion->fecha_finalizacion }}</td>
                                                    <td style="white-space:nowrap;" class="text-center">
                                                        @foreach ($actuacion->documentos_actuaciones as $documento)
                                                            <p><a href="{{ asset('documentos/doc_actuaciones/' . $documento->url_doc) }}"
                                                                    target="_blank" rel="noopener noreferrer"> <i
                                                                        class="{{ icono_extension($documento->tipo_documento) }} pl-2">
                                                                        {{ '  ' . $documento->nombre_doc }}</i></a></p>
                                                        @endforeach
                                                    </td>
                                                    <td style="white-space:nowrap;" class="text-center">
                                                        {{ $actuacion->apoderado }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr style="border-top: 2px solid black;">
                            <div class="row mb-3">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <h6><strong>Documentos</strong></h6>
                                </div>
                                <div class="col-12-col-md-6 col-lg-6 text-right pr-2">
                                    <a href="{{ route('documentos_procesos_crear', ['procesos_id' => $proceso->id]) }}"
                                        class="btn btn-success bg-success btn-xs ml-2 pl-2 pr-2"><i
                                            class="fas fa-plus-circle mr-2"></i>Nuevo Documento</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-sm tabla-data">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Fecha
                                                    Documento</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">
                                                    Descripci&oacute;n</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">
                                                    Documento</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Usuario
                                                </th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Opciones
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($proceso->documentos_proceso as $documento)
                                                <tr>
                                                    <td style="white-space:nowrap;" class="text-center">
                                                        {{ $documento->fecha_documento }}</td>
                                                    <td style="white-space:nowrap;" class="text-center">
                                                        {{ $documento->descripcion_documento }}</td>
                                                    <td style="white-space:nowrap;" class="text-center">
                                                        <p><a href="{{ asset('documentos/doc_actuaciones/' . $documento->url_doc) }}"
                                                                target="_blank" rel="noopener noreferrer"> <i
                                                                    class="{{ icono_extension($documento->tipo_documento) }} pl-2">
                                                                    {{ '  ' . $documento->nombre_doc }}</i></a></p>
                                                    </td>
                                                    <td style="white-space:nowrap;" class="text-center">
                                                        {{ $documento->usuario }}</td>
                                                    <td style="white-space:nowrap;" class="text-center">
                                                        @if (session('rol_id') < 3)
                                                            <form
                                                                action="{{ route('eliminar_documentos_proc_crear', ['id' => $documento->id]) }}"
                                                                class="d-inline form-eliminar" method="POST">
                                                                @csrf
                                                                @method("delete")
                                                                <button type="submit"
                                                                    class="btn-accion-tabla eliminar tooltipsC text-danger"
                                                                    title="Eliminar este registro">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr style="border-top: 2px solid black;">
                            <div class="row mb-3">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <h6><strong>Fallos Proceso</strong></h6>
                                </div>
                                <div class="col-12-col-md-6 col-lg-6 text-right pr-2">
                                    <a href="{{ route('falllos_procesos_index', ['procesos_id' => $proceso->id]) }}"
                                        class="btn btn-warning bg-warning btn-xs ml-2 pl-2 pr-2"><i
                                            class="fas fa-pen-square"></i> Editar Fallos</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Fallo
                                                    1era Instancia</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">1era
                                                    Fecha Ejecutoria</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Condena
                                                    1era Instancia</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Fallo
                                                    2da Instancia</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">2da
                                                    Fecha Ejecutoria</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Condena
                                                    2da Instancia</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Fallo
                                                    3era Instancia</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">3era
                                                    Fecha Ejecutoria</th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Condena
                                                    3era Instancia</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center" style="vertical-align: middle;white-space:nowrap;">
                                                    {{ $proceso->fallo_1era }}</td>
                                                <td class="text-center" style="vertical-align: middle;white-space:nowrap;">
                                                    {{ $proceso->fecha_ejecutoria_1era }}</td>
                                                <td class="text-center" style="vertical-align: middle;white-space:nowrap;">
                                                    {{ $proceso->condena_1era }}</td>
                                                <td class="text-center" style="vertical-align: middle;white-space:nowrap;">
                                                    {{ $proceso->fallo_2da }}</td>
                                                <td class="text-center" style="vertical-align: middle;white-space:nowrap;">
                                                    {{ $proceso->fecha_ejecutoria_2da }}</td>
                                                <td class="text-center" style="vertical-align: middle;white-space:nowrap;">
                                                    {{ $proceso->condena_2da }}</td>
                                                <td class="text-center" style="vertical-align: middle;white-space:nowrap;">
                                                    {{ $proceso->fallo_3era }}</td>
                                                <td class="text-center" style="vertical-align: middle;white-space:nowrap;">
                                                    {{ $proceso->fecha_ejecutoria_3era }}</td>
                                                <td class="text-center" style="vertical-align: middle;white-space:nowrap;">
                                                    {{ $proceso->condena_3era }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr style="border-top: 2px solid black;">
                            <div class="row mb-3">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <h6><strong>Notas Proceso</strong></h6>
                                </div>
                                <div class="col-12-col-md-6 col-lg-6 text-right pr-2">
                                    <a href="{{ route('anotaciones_procesos_index', ['procesos_id' => $proceso->id]) }}"
                                        class="btn btn-success bg-success btn-xs ml-2 pl-2 pr-2"><i
                                            class="fas fa-plus-circle mr-2"></i>Nueva Anotaci&oacute;n</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Fecha
                                                </th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Usuario
                                                </th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">Nota
                                                </th>
                                                <th scope="col" class="text-center" style="vertical-align: middle;">
                                                    Documento</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($proceso->anotaciones as $anotacion)
                                                <tr>
                                                    <td class="text-center"
                                                        style="vertical-align: middle;white-space:nowrap;">
                                                        {{ $anotacion->fecha }}</td>
                                                    <td class="text-center"
                                                        style="vertical-align: middle;white-space:nowrap;">
                                                        {{ $anotacion->usuario }}</td>
                                                    <td class="text-center"
                                                        style="vertical-align: middle;white-space:nowrap;">
                                                        {{ $anotacion->nota }}</td>
                                                    <td style="white-space:nowrap;" class="text-center">
                                                        @foreach ($anotacion->documentos_anotaciones as $documento)
                                                            <p><a href="{{ asset('documentos/doc_anotaciones/' . $documento->url_doc) }}"
                                                                    target="_blank" rel="noopener noreferrer"> <i
                                                                        class="{{ icono_extension($documento->tipo_documento) }} pl-2">
                                                                        {{ '  ' . $documento->nombre_doc }}</i></a></p>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="border-top: 2px solid black;">
                    <div class="row mb-3">
                        <div class="col-6 col-md-2 col-lg-2 form-group">
                            <a href="{{ route('admin-procesos-index') }}"
                                class="btn btn-primary bg-primary  form-control">Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <!-- Modales -->
        @include('intranet.procesos.procesos.modales_edicion_proceso')
        <!-- ------------------------------------------------------------------------------------------------------------------------- -->
        <!-- ------------------------------------------------------------------------------------------------------------------------- -->

    </div>
@endsection
<!-- ************************************************************* -->
<!-- scripts hoja -->
@section('scripts_pagina')
    <script src="{{ asset('js/admin/procesos/edicion_proceso/edicion_procesos.js') }}"></script>
@endsection
<!-- ************************************************************* -->
