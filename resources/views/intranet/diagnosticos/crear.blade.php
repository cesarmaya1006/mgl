@extends("theme.back.plantilla")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
    @include('includes.funciones_php')
@endsection
<!-- titulo hoja -->
@section('estilosHojas')
    <!-- Pagina CSS -->
    <link rel="stylesheet" href="{{ asset('css/intranet/empresas/proyectos.css') }}">
@endsection
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('tituloHoja')
    Modulo Diagnósticos
@endsection
<!-- ************************************************************* -->
<!-- ************************************************************* -->
<!-- Cuerpo hoja -->
@section('cuerpo_pagina')
    <hr>
    <div class="row">
        <div class="col-12">
            @include('includes.error-form')
            @include('includes.mensaje')
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 mb-3 pl-4">
            <h5>Diagnósticos-crear</h5>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <a href="{{ route('diagnosticos-index') }}" class="btn btn-info btn-sombra btn-xs pl-4 pr-4 float-right mr-4">
                <i class="fas fa-reply mr-2" aria-hidden="true"></i>
                Volver
            </a>
        </div>
    </div>
    <hr>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-10">
            <form class="row d-flex justify-content-md-center" action="{{ route('diagnosticos-guardar') }}" method="POST"
                autocomplete="off" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="col-12 col-md-2 form-group">
                    <label class="requerido" for="empresa_id">Empresa</label>
                    <select class="form-control form-control-sm" name="empresa_id" id="empresa_id" required>
                        @foreach ($empresas as $empresa)
                            <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-2 form-group">
                    <label for="fec_creacion">Fecha</label>
                    <span class="form-control form-control-sm">{{ date('Y-m-d') }}</span>
                    <input type="hidden" name="fec_creacion" id="fec_creacion" value="{{ date('Y-m-d') }}">
                    <small id="helpId" class="form-text text-muted">Fecha de creación</small>
                </div>
                <div class="col-12 col-md-3 form-group">
                    <label class="requerido" for="titulo">Titulo</label>
                    <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId"
                        placeholder="Titulo del diagnóstico" required>
                    <small id="helpId" class="form-text text-muted">Titulo</small>
                </div>
                <div class="col-12 col-md-7 form-group">
                    <label class="requerido" for="nombre" class="col-form-label-sm">Nombre del Documento</label>
                    <input type="text" class="form-control form-control-sm" name="nombre" id="nombre"
                        aria-describedby="helpId" placeholder="" required>
                    <input type="file" accept="application/pdf" class="form-control form-control-sm" name="documento"
                        id="documento" aria-describedby="helpId" placeholder="" required>
                </div>
                <div class="col-12 text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-xs btn-sombra pl-4 pr-4">Agregar Diagnostico</button>
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
    <script src="{{ asset('js/intranet/empresas/index.js') }}"></script>
@endsection
<!-- ************************************************************* -->
