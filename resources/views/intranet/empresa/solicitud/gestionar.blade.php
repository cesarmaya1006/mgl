@extends("theme.back.plantilla")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
    @include('includes.funciones_php')
@endsection
<!-- titulo hoja -->
@section('estilosHojas')
    <!-- Pagina CSS -->
    <link rel="stylesheet" href="{{ asset('css/intranet/solicitudes/index.css') }}">
    <style>
        .loader {
            background-color: rgb(249, 249, 249);
        }

    </style>
@endsection
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('tituloHoja')
    Solicitudes

@endsection
<!-- ************************************************************* -->
<!-- ************************************************************* -->
<!-- Cuerpo hoja -->
@section('cuerpo_pagina')
    <div class="loader" id="cargando"><img class="img-fluid" src="{{ asset('imagenes/sistema/cargando.gif') }}" alt="">
    </div>
    <div class="card" style="border-top: 8px solid rgb(38, 160, 241);">
        @include('includes.error-form')
        @include('includes.mensaje')
        <div class="card-header">
            <div class="row d-flex justify-content-around">
                <div class="col-12 col-md-10 text-md-right">
                    <a href="{{ route('consultas_solicitudes-index') }}"
                        class="btn btn-info btn-sm text-center pl-3 pr-3 mr-3" style="font-size: 0.9em;"><i
                            class="fas fa-undo-alt mr-2"></i>Volver</a>
                </div>
                <div class="col-12 col-md-10">
                    <div class="row">
                        <div class="col-12 text-center mb-3">
                            <h6><strong>{{ $solicitud->titulo }}</strong></h6>
                        </div>
                        <div class="col-12 col-md-6">Fecha Solicitud: {{ $solicitud->fecha_solicitud }}</div>
                        <div class="col-12 col-md-6 text-capitalize">Tipo: {{ $solicitud->tipo }}</div>
                        <div class="col-12 col-md-6">
                            <?php
                            $date1 = new DateTime($solicitud->fecha_solicitud);
                            $date2 = new DateTime(Date('Y-m-d'));
                            $diff = date_diff($date1, $date2);
                            $differenceFormat = '%a';
                            ?>
                            Dias de gestión: {{ $diff->format($differenceFormat) }}
                        </div>
                        <div class="col-12 col-md-6 text-capitalize">Titulo: {{ $solicitud->titulo }}</div>
                        <div class="col-12 col-md-6 text-capitalize">Empresa: {{ $solicitud->empresa->nombre }}</div>
                        @if (session('rol_id') < 5)
                            <div class="col-12 col-md-6 text-capitalize form-group d-flex flex-row">
                                @csrf
                                <label for="estado_solicitud">Estado:</label>
                                <select id="estado_solicitud"
                                    data_url="{{ route('consultas_solicitudes-camb_estd_solulicitud') }}"
                                    data_id="{{ $solicitud->id }}" class="form-control form-control-sm ml-4"
                                    name="estado_solicitud">
                                    <option value="Nueva" {{ $solicitud->estado == 'Nueva' ? 'selected' : '' }}>Nueva
                                    </option>
                                    <option value="En gestión"
                                        {{ $solicitud->estado == 'En gestión' ? 'selected' : '' }}>En
                                        gestión</option>
                                    <option value="Cerrada" {{ $solicitud->estado == 'Cerrada' ? 'selected' : '' }}>
                                        Cerrada
                                    </option>
                                </select>
                            </div>
                        @else
                            <div class="col-12 col-md-6 text-capitalize form-group d-flex flex-row">
                                Estado: <strong class="mr-4 ml-3"><span
                                        id="span_cerrada">{{ $solicitud->estado }}</span></strong> <button
                                    id="cerrar_solicitud"
                                    data_url="{{ route('consultas_solicitudes-cerrar_solicitud') }}"
                                    data_id="{{ $solicitud->id }}" class="btn btn-danger btn-xs"
                                    {{ $solicitud->estado == 'Cerrada' ? 'disabled' : '' }}>Cerrar</button>
                            </div>
                        @endif
                        <div class="col-12 mt-4">
                            <div class="row mb-3">
                                <div class="col-12"><strong>Responsables:</strong></div>
                            </div>
                            <div class="row d-flex justify-content-between">
                                <div class="col-12 col-md-6 table responsive">
                                    <table class="table table-hover table-sm tabla-data" id="tabla_responsables">
                                        <thead>
                                            <tr>
                                                <th scope="col">Perfil</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($solicitud->usuarios as $responsable)
                                                <tr>
                                                    @foreach ($responsable->roles as $rol)
                                                        @if ($rol->id < 4)
                                                            <td>{{ $rol->nombre }}</td>
                                                            <td>{{ $responsable->nombres . ' ' . $responsable->apellidos }}
                                                            </td>
                                                            @if (session('rol_id') < 3)
                                                                <td>
                                                                    <form
                                                                        action="{{ route('consultas_solicitudes_gestionar_responsable-delete', ['cli_solicitud_id' => $solicitud->id, 'usuario_id' => $responsable->id]) }}"
                                                                        class="d-inline form-eliminar" method="POST">
                                                                        @csrf @method("delete")
                                                                        <button type="submit"
                                                                            class="btn-accion-tabla eliminar tooltipsC"
                                                                            title="Eliminar este registro"><i
                                                                                class="fas fa-minus-circle text-danger"></i></button>
                                                                    </form>
                                                                </td>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @if (session('rol_id') < 3)
                                    <div class="col-12 col-md-5 text-center text-md-right">
                                        <div class="row ">
                                            <div class="col-11 form-group">
                                                <select id="responsable" class="form-control form-control-sm"
                                                    name="responsable">
                                                    @foreach ($responsables as $responsable)
                                                        <option value="{{ $responsable->id }}">
                                                            @foreach ($responsable->roles as $rol)
                                                                {{ $rol->nombre }}
                                                            @endforeach:
                                                            {{ $responsable->apellidos . ' ' . $responsable->nombres }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-1">
                                                <a id="nuevo_responsable" href="#"
                                                    data_url="{{ route('consultas_solicitudes-gestionar_responsable') }}"
                                                    data_eliminar="{{ route('consultas_solicitudes_gestionar_responsable-delete', ['cli_solicitud_id' => '9999', 'usuario_id' => '8888']) }}"
                                                    class="btn-accion-tabla eliminar tooltipsC text-success pull-right"
                                                    data_id="{{ $solicitud->id }}" title="Adicionar Responsable"><i
                                                        class="fas fa-plus-circle"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                <div class="col-12 col-md-6 col-lg-6 text-md-left text-lg-left pl-2">
                    <h5>Gestion Solicitud</h5>
                </div>
                <div class="col-12 col-md-6 col-lg-6 text-md-right text-lg-right pl-2">
                    <a href="{{ route('consultas_solicitudes-historial', ['id' => $solicitud->id]) }}"
                        class="btn btn-success btn-sm text-center pl-3 pr-3 mr-3" style="font-size: 0.9em;"><i
                            class="fas fa-plus-circle mr-2"></i>Historial</a>
                </div>
            </div>
            <div class="row d-flex justify-content-around pt-3 mb-3" style="font-size: 0.8em;">
                <div class="col-12 col-md-10 table-responsive">
                    <table class="table table-striped table-bordered table-hover table-sm tabla-gestion display">
                        <thead>
                            <tr>
                                <th scope="col">Fecha Gestión</th>
                                <th scope="col">Titulo</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Documentos Gestión</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($solicitud->gestiones as $gestion)
                                <tr>
                                    <td>{{ $gestion->fecha_gestion }}</td>
                                    <td>{{ $gestion->titulo }}</td>
                                    <td>{{ $gestion->usuario->nombres . ' ' . $gestion->usuario->apellidos }}</td>
                                    <td style="white-space: normal; width: 300px;text-align: left;">
                                        {{ $gestion->comentario }}</td>
                                    <td id="documentosGesID_{{ $gestion->id }}" style="text-align: left;">
                                        @foreach ($gestion->documentos as $documento)
                                            <span>
                                                @if (session('rol_id') < 5)
                                                    <form
                                                        action="{{ route('doc_historial-eliminar', ['id' => $documento->id]) }}"
                                                        class="d-inline form-eliminar_doc" method="POST">
                                                        @csrf @method("delete")
                                                        <button type="submit" class="btn-accion-tabla eliminar tooltipsC"
                                                            title="Eliminar documento"><i
                                                                class="fas fa-trash-alt text-danger"></i></button>
                                                    </form>
                                                @endif
                                                <a class="ml-3 text-uppercase"
                                                    href="{{ asset('documentos/doc_solicitudes/' . $documento->archivo) }}"
                                                    target="_blank">{{ $documento->titulo }}</a>
                                                <br>
                                            </span>

                                        @endforeach
                                    </td>
                                    <td>
                                        <a id="nuevo_documento_gestion" id_gest="{{ $gestion->id }}"
                                            rol_id="{{ session('rol_id') }}"
                                            data_url="{{ route('doc_historial-guardar', ['id' => $gestion->id]) }}"
                                            class="btn-accion-tabla eliminar tooltipsC text-success pull-right ml-3 nuevo_documento_gestion"
                                            title="Adicionar documento" style="cursor: pointer;"><i
                                                class="fas fa-file-medical"></i></a>
                                        @if (session('rol_id') < 5)
                                            <form action="{{ route('historial-eliminar', ['id' => $gestion->id]) }}"
                                                class="d-inline form-eliminar" method="POST">
                                                @csrf @method("delete")
                                                <button type="submit" class="btn-accion-tabla eliminar tooltipsC"
                                                    title="Eliminar este registro"><i
                                                        class="fas fa-trash-alt text-danger"></i></button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modales Documento historial -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Nuevo Documento Historial</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="loader" id="cargando"><img class="img-fluid"
                            src="{{ asset('imagenes/sistema/cargando.gif') }}" alt=""></div>
                    <div class="container-fluid">
                        <form action="" id="form_nuevodoc"
                            class="row d-flex justify-content-around pt-3 pb-3 pl-5 form-horizontal" autocomplete="off"
                            enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('post')
                            <div class="col-10 form-group">
                                <label for="nombre_doc">Titulo</label>
                                <input type="text" class="form-control form-control-sm" name="titulo" id="nombre_doc"
                                    required>
                                <small id="helpId" class="form-text text-muted">Nombre del documento</small>
                            </div>
                            <div class="col-10 form-group">
                                <input class="form-control form-control-sm" type="file" name="archivo" id="documento"
                                    style="font-size: 0.9em;" required>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer pr-5">
                    <button type="button" class="btn btn-secondary btn-xs mr-5 pl-4 pr-4"
                        data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-info btn-xs pl-4 pr-4" rol_id="{{ session('rol_id') }}"
                        id_gest="algo" data_url="algo" id="guardarDochistorial">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- *********************************************************************************************************************************** -->
    <!-- *********************************************************************************************************************************** -->
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
    <script src="{{ asset('js/intranet/empresas/solicitudes/gestionar.js') }}"></script>
@endsection
<!-- ************************************************************* -->
