@extends("admin.plantilla.plantilla")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
@include('includes.funciones_php')
@endsection
<!-- titulo hoja -->
@section('estilosHojas')
<!-- Pagina CSS -->
<link rel="stylesheet" href="{{ asset('css/admin/solicitudes/index.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css"/>
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
<div class="card" style="border-top: 8px solid rgb(38, 160, 241);">
    @include('includes.error-form')
    @include('includes.mensaje')
    <div class="card-header">
        <div class="row d-flex justify-content-around">
            <div class="col-12 col-md-10 text-md-right">
                <a href="{{ URL::previous() }}" class="btn btn-info btn-sm text-center pl-3 pr-3 mr-3" style="font-size: 0.9em;"><i class="fas fa-undo-alt mr-2"></i>Volver</a>
            </div>
            <div class="col-12 col-md-10">
                <div class="row">
                    <div class="col-12 text-center mb-3">
                        <h6><strong>{{$solicitud->titulo}}</strong></h6>
                    </div>
                    <div class="col-12 col-md-6">Fecha Solicitud: {{$solicitud->fecha_solicitud}}</div>
                    <div class="col-12 col-md-6 text-capitalize">Tipo: {{$solicitud->tipo}}</div>
                    <div class="col-12 col-md-6">
                        <?php $date1 = new DateTime($solicitud->fecha_solicitud);$date2 = new DateTime(Date('Y-m-d')); $diff = date_diff($date1,$date2);$differenceFormat = '%a'; ?>
                        Dias de gestión: {{$diff->format($differenceFormat)}}
                    </div>
                    <div class="col-12 col-md-6 text-capitalize">Titulo: {{$solicitud->titulo}}</div>
                    <div class="col-12 col-md-6 text-capitalize">Empresa: {{$solicitud->empresas->nombres.' '.$solicitud->empresas->apellidos}}</div>
                    <div class="col-12 mt-4" >
                        <div class="row mb-3">
                            <div class="col-12"><strong>Responsables:</strong></div>
                        </div>
                        <div class="row d-flex justify-content-between">
                            <div class="col-12 col-md-6 table responsive">
                                <table class="table table-hover table-sm tabla-data" id="tabla_responsables">
                                    <thead>
                                      <tr>
                                        <th class="text-center" scope="col">Perfil</th>
                                        <th class="text-center" scope="col">Nombre</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($solicitud->responsables as $responsable)
                                        <tr>
                                            @foreach ($responsable->roles as $rol)
                                            <td>{{$rol->nombre}}</td>
                                            @endforeach
                                            <td>{{$responsable->nombres.' '.$responsable->apellidos}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
        </div>
        <div class="row d-flex justify-content-around pt-3 mb-3" style="font-size: 0.8em;">
            <div class="col-12 col-md-10 table-responsive">
                <table class="table table-striped table-bordered table-hover table-sm display">
                    <thead>
                        <tr>
                            <th scope="col">Fecha Gestión</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Documentos Gestión</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($solicitud->gestiones as $gestion)
                        <tr>
                            <td>{{$gestion->fecha_gestion}}</td>
                            <td>{{$gestion->titulo}}</td>
                            <td>{{$gestion->usuario->nombres.' '.$gestion->usuario->apellidos}}</td>
                            <td style="white-space: normal; width: 300px;text-align: left;">{{$gestion->comentario}}</td>
                            <td id="documentosGesID_{{$gestion->id}}" style="text-align: left;">
                                @foreach ($gestion->documentos as $documento)
                                <span>
                                    <a class="ml-3 text-uppercase" href="{{asset('documentos/doc_solicitudes/'.$documento->archivo)}}" target="_blank">{{$documento->titulo}}</a>
                                    <br>
                                </span>
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
<!-- *********************************************************************************************************************************** -->
<!-- *********************************************************************************************************************************** -->
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
<script src="{{ asset('js/admin/solicitudes/index.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>
@endsection
<!-- ************************************************************* -->
