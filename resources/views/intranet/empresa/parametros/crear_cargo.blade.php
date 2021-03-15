@extends("theme.back.plantilla")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
    @include('includes.funciones_php')
@endsection
<!-- titulo hoja -->
@section('estilosHojas')
    <!-- Pagina CSS -->
    <link rel="stylesheet" href="{{ asset('css/intranet/empresas/parametros.css') }}">
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
    <div class="row pr-4 pl-4">
        <div class="col-6">
            <h5>Crear Cargo</h5>
        </div>
        <div class="col-6">
            <a href="{{ route('param_hojas_de_vida-index') }}"
                class="btn btn-info btn-xs btn-sombra pl-4 pr-4 mr-4 position-absolute end-0"><i class="fa fa-reply mr-3"
                    aria-hidden="true"></i> Volver</a>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-12">
            <form action="{{ route('admin-param_hojas_de_vida-guardar_cargo', ['id' => $id]) }}"
                class="row form-horizontal mt-3 mb-5 d-flex justify-content-around" method="POST" autocomplete="off"
                enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="col-4 form-group">
                    <label for="nivel_id">Nivel</label>
                    <select class="form-control form-control-sm" id="nivel_id" data_url="{{ route('cargar_areas') }}">
                        <option value="">Seleccione un nivel</option>
                        @foreach ($niveles as $nivel)
                            <option value="{{ $nivel->id }}">{{ $nivel->nivel }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4 form-group">
                    <label for="area_id">Area</label>
                    <select class="form-control form-control-sm" name="area_id" id="area_id" required>
                        <option value="">Seleccione un primero nivel</option>
                    </select>
                </div>
                <div class="col-4 form-group">
                    <label for="cargo">Cargo</label>
                    <input type="text" class="form-control form-control-sm" name="cargo" id="cargo"
                        aria-describedby="helpId" placeholder="" required>
                    <small id="helpId" class="form-text text-muted">Cargo</small>
                </div>

                <div class="col-12 text-center form-group">
                    <button type="submit" class="btn btn-primary btn-xs pl-4 pr-4">Crear Cargo</button>
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
    <script src="{{ asset('js/intranet/empresas/parametros.js') }}"></script>
@endsection
<!-- ************************************************************* -->
