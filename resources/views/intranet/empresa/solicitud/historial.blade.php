@extends("theme.back.plantilla")
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
    Solicitudes
@endsection
<!-- ************************************************************* -->
<!-- ************************************************************* -->
<!-- Cuerpo hoja -->
@section('cuerpo_pagina')
    <div class="card" style="border-top: 8px solid rgb(38, 160, 241);">
        @include('includes.error-form')
        @include('includes.mensaje')
        <div class="card-header pb-4" style="font-size: 0.8em;">
            <div class="row d-flex justify-content-around">
                <div class="col-12 col-md-6 col-lg-6 text-md-left text-lg-left pl-2">
                    <h5>Nuevo historial de Solicitud</h5>
                </div>
                <div class="col-12 col-md-6 text-md-right">
                    <a href="{{ route('consultas_solicitudes-gestionar', ['id' => $id]) }}"
                        class="btn btn-info btn-sm text-center pl-3 pr-3 mr-3" style="font-size: 0.9em;"><i
                            class="fas fa-undo-alt mr-2"></i>Volver</a>
                </div>
            </div>
            <hr>
            <form class="row d-flex justify-content-around form-horizontal"
                action="{{ route('historial-guardar', ['id' => $id]) }}" method="POST" autocomplete="off"
                enctype="multipart/form-data">
                @csrf
                @method('post')
                <input type="hidden" name="solicitud_id" value="{{ $id }}">
                <input type="hidden" name="usuario_id" value="{{ session('id_usuario') }}">
                <input type="hidden" name="fecha_gestion" value="{{ date('Y-m-d') }}">
                <div class="col-12 col-md-2 form-group">
                    <label class="requerido" for="fecha_gestion">Fecha de gestión</label>
                    <span class="form-control form-control-sm text-center">{{ date('Y-m-d') }}</span>
                    <small id="helpId" class="form-text text-muted">Fecha de gestión</small>
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label class="requerido" for="titulo">Titulo historial</label>
                    <input type="text" class="form-control form-control-sm" name="titulo" id="titulo"
                        aria-describedby="helpId" placeholder="" required>
                    <small id="helpId" class="form-text text-muted">Titulo historial</small>
                </div>
                <div class="col-12 col-md-6 form-group">
                    <label class="requerido" for="comentario">Contenido historial</label>
                    <textarea id="comentario" class="form-control form-control-sm" name="comentario" rows="3"
                        aria-describedby="helpId" required></textarea>
                    <small id="helpId" class="form-text text-muted">Contenido historial</small>
                </div>
                <div class="col-12 pl-5">
                    <button class="btn btn-primary btn-xs pl-5 pr-5" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
    <!-- *********************************************************************************************************************************** -->
    <!-- *********************************************************************************************************************************** -->
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
    <script src="{{ asset('js/admin/solicitudes/historial.js') }}"></script>
@endsection
<!-- ************************************************************* -->
