@extends("theme.back.plantilla")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
    @include('includes.funciones_php')
@endsection
<!-- titulo hoja -->
@section('estilosHojas')
    <!-- Pagina CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin/solicitudes/crear.css') }}">
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
            <div class="row mb-3">
                <div class="col-12 col-md-6 col-lg-6 text-md-left text-lg-left pl-2">
                    <h5>Nueva Solicitud</h5>
                </div>
                <div class="col-12 col-md-6 col-lg-6 text-md-right text-lg-right pl-2">
                    <a href="{{ route('consultas_solicitudes-index') }}"
                        class="btn btn-info btn-xs btn-sombra pl-3 pr-3"><i class="fas fa-undo mr-3"></i>Volver</a>
                </div>
            </div>
            <hr>
            <form class="row d-flex justify-content-between"
                action="{{ route('consultas_solicitudes-guardar', ['id' => $empleado->id]) }}" method="post">
                @csrf
                @method('post')
                <input type="hidden" name="empresa_id" value="{{ $empleado->empresa->id }}">
                <input type="hidden" name="empleado_id" value="{{ $empleado->id }}">
                <input type="hidden" name="estado" value="Nueva">
                <input type="hidden" name="fecha_solicitud" value="{{ date('Y-m-d') }}">
                <div class="col-10 col-md-2 form-group">
                    <label class="requerido" for="fecha_solicitud">Fecha solicitud</label>
                    <span class="form-control form-control-sm text-center">{{ date('Y-m-d') }}</span>
                    <small id="helpId" class="form-text text-muted">Fecha de la solicitud</small>
                </div>

                <div class="col-10 col-md-3 col-lg-3 pl-1 pr-1 form-group">
                    <label for="tipo">Tipo de Solicitud</label>
                    <select id="tipo" class="form-control form-control-sm" name="tipo" required>
                        <option value="">Seleccione una opción</option>
                        <option value="juridica">Juridica</option>
                        <option value="laboral">Laboral</option>
                        <option value="otra">Otra</option>
                    </select>
                </div>
                <div class="col-10 col-md-3 col-lg-3 pl-1 pr-1 form-group">
                    <label for="titulo">Titulo</label>
                    <input type="text" class="form-control form-control-sm" name="titulo" id="titulo" required>
                    <small id="helpId" class="form-text text-muted">Titulo de la solicitud</small>
                </div>
                <div class="col-12 col-md-3 mt-md-4">
                    <button type="submit" class="btn btn-primary btn-xs btn-sombra pl-4 pr-4">Guardar</button>
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
    <script src="{{ asset('js/admin/solicitudes/crear.js') }}"></script>
@endsection
<!-- ************************************************************* -->
