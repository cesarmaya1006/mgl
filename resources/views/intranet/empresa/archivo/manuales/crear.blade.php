@extends("theme.back.plantilla")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
    @include('includes.funciones_php')
@endsection
<!-- titulo hoja -->
@section('estilosHojas')
    <!-- Pagina CSS -->

@endsection
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('tituloHoja')
    Archivo Laboral
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
                    <h5>Agregar Manual de Función</h5>
                </div>
                <div class="col-12 col-md-6 col-lg-6 text-md-right text-lg-right pl-2 pr-md-5 pr-lg-5">
                    <a href="{{ route('manuales-index', ['id' => $cargo->area->nivel->empresa_id]) }}"
                        class="btn btn-info btn-sm text-center pl-3 pr-3 mr-3"><i
                            class="fas fa-undo-alt mr-2"></i>Volver</a>
                </div>
            </div>
            <hr>
            <div class="row d-flex justify-content-around mt-3 mb-5" id="listado_empleados">
                <div class="col-10 col-md-6 col-lg-8">
                    <form action="{{ route('manuales-nuev_manual-guardar', ['id' => $id]) }}"
                        class="row form-horizontal mt-3 mb-5 d-flex justify-content-around" method="POST" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class=" col-6 form-group text-right">
                            <label for="manual">Nuevo Manual</label>
                            <input type="hidden" name="" id="" value="{{ $id }}">
                            <input type="file" accept="application/pdf" class="form-control" name="manual" id="manual"
                                aria-describedby="helpId" placeholder="" required>
                            <small id="helpId" class="form-text text-muted">Archivo en pdf</small>
                        </div>
                        <div class="col-6 align-self-center pl-5"><button type="submit" class="btn btn-primary"
                                style="width: 150px;">Guardar</button></div>
                    </form>
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
    <script src="{{ asset('js/admin/archivo/manuales.js') }}"></script>
@endsection
<!-- ************************************************************* -->
