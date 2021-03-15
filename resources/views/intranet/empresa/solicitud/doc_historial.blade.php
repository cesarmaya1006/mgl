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
@endsection
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('tituloHoja')
Documentos Historial Solicitudes
@endsection
<!-- ************************************************************* -->
<!-- ************************************************************* -->
<!-- Cuerpo hoja -->
@section('cuerpo_pagina')
<div class="card" style="border-top: 8px solid rgb(38, 160, 241);">
    @include('includes.error-form')
    @include('includes.mensaje')
    <div class="card-header">
        <div class="row mb-3">
            <div class="col-12 col-md-6 col-lg-6 text-md-left text-lg-left pl-2">
                <h6>Añadir Documentos Historial: {{$solicitud->titulo}}</h6>
            </div>
            <div class="col-12 col-md-6 col-lg-6 text-md-right text-lg-right pl-2">
                <a href="{{route('consultas_solicitudes-gestionar', ['id' => $solicitud->id])}}" class="btn btn-info btn-xs pl-3 pr-3"><i class="fas fa-undo mr-3"></i>Volver</a>
            </div>
        </div>
        <div class="row">
            <div class="col-6 pl-2 pr-2 table-responsive">
                <table class="table table-striped table-bordered table-hover table-sm tabla-data">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Documentos en el historial</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gestion->documentos_gestion as $documento)
                        <tr>
                            <td><a href="{{asset('documentos/doc_historial/'.$documento->documento)}}" target="_blank">{{$documento->nom_documento}}</a></td>
                            <td>
                                <form action="{{route('doc_historial-eliminar', ['id' => $documento->id])}}" class="d-inline form-eliminar" method="POST">
                                    @csrf
                                    @method("delete")
                                    <button type="submit" class="btn-accion-tabla eliminar tooltipsC text-danger" title="Eliminar este registro">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-6 pl-5 pr-5">
                <div class="row">
                    <form action="{{route('doc_historial-guardar', ['id' => $gestion->id])}}" class="row d-flex justify-content-center pt-3 mb-3" method="post" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="col-12 form-group">
                            <label class="requerido" for="nom_documento">Agregar Documento</label>
                            <input class="form-control form-control-sm" type="text" name="nom_documento" id="nom_documento" required>
                            <input class="form-control form-control-sm" type="file" name="documento" id="documento" required>
                        </div>
                        <div class="col-12 col-md-4 col-lg-4 ml-2 form-group d-flex align-items-center pt-4">
                            <button type="submit" class="btn btn-primary form-control form-control-sm btn-xs">Guardar</button>
                        </div>
                    </form>
                </div>
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
<script src="{{ asset('js/admin/solicitudes/doc_historial.js') }}"></script>
@endsection
<!-- ************************************************************* -->
