@extends("theme.back.plantilla")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
    @include('includes.funciones_php')
@endsection
<!-- titulo hoja -->
@section('estilosHojas')
    <!-- Pagina CSS -->
    <link rel="stylesheet" href="{{ asset('css/proyectos/proyectos.css') }}">
@endsection
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('tituloHoja')
    Componente Proyectos
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
                    <h4>Historiales - crear documento</h4>
                </div>
                <div class="col-12 col-md-6 col-lg-6 text-md-right text-lg-right pl-2 pr-md-5 pr-lg-5">
                    <a href="{{ route('proyecto-tareas-index', ['id' => $historial->tarea->id]) }}"
                        class="btn btn-info btn-xs text-center pl-5 pr-5"><i class="fas fa-undo-alt mr-2"></i>Volver</a>
                </div>
            </div>
            <hr>
            <form class="row d-flex justify-content-around"
                action="{{ route('proyecto-historiales-guardar_doc', ['id' => $historial->tarea->id]) }}" method="POST"
                autocomplete="off" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="col-10 col-md-5 form-group">
                    <label for="nombre" class="col-form-label-sm requerido">Nombre del Documento</label>
                    <input type="text" class="form-control form-control-sm" name="nombre" id="nombre"
                        aria-describedby="helpId" placeholder="" required>
                    <input type="hidden" name="historial_id" value="{{ $historial->id }}">
                    <input type="file" accept="application/pdf" class="form-control form-control-sm" name="documento"
                        id="documento" aria-describedby="helpId" placeholder="" required>
                </div>
                <div class="col-12">
                    <div class="row d-flex justify-content-around">
                        <div class="col-10 col-md-5">
                            <button type="submit" class="btn btn-primary btn-xs pl-3 pr-3">Guardar</button>
                        </div>
                    </div>
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
    <script src="{{ asset('js/admin/proyectos/proveedores/index.js') }}"></script>
@endsection
<!-- ************************************************************* -->
