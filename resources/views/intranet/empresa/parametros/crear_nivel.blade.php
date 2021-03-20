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
    Modulo Empresas
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
    <div class="row pl-4 pr-4">
        <div class="col-6">
            <h5>Crear Área</h5>
        </div>
        <div class="col-6">
            <a href="{{ route('param_hojas_de_vida-index') }}"
                class="btn btn-info btn-xs btn-sombra pl-4 pr-4 mr-4 position-absolute end-0"><i class="fa fa-reply mr-3"
                    aria-hidden="true"></i> Volver</a>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-12">
            <form action="{{ route('admin-param_hojas_de_vida-guardar_nivel', ['id' => $id]) }}"
                class="row form-horizontal mt-3 mb-5 d-flex justify-content-around" method="POST" autocomplete="off"
                enctype="multipart/form-data">
                @csrf
                @method('post')
                <input type="hidden" name="empresa_id" value="{{ $id }}" required>
                <div class="col-4 form-group">
                    <label for="nivel">Área</label>
                    <input type="text" class="form-control form-control-sm" name="nivel" id="nivel"
                        aria-describedby="helpId" placeholder="" required>
                    <small id="helpId" class="form-text text-muted">Área</small>
                </div>
                <div class="col-12 text-center form-group">
                    <button type="submit" class="btn btn-primary btn-xs pl-4 pr-4">Crear Área</button>
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
