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
                    <h5>Nuevo Documento Políticas, Reglamentos y otros - {{ session('id_usuario') }}</h5>
                </div>
                <div class="col-12 col-md-6 col-lg-6 text-md-right text-lg-right pl-2 pr-md-5 pr-lg-5">
                    <a href="{{ route('politica-index', ['id' => $id]) }}"
                        class="btn btn-info btn-sm text-center pl-3 pr-3 mr-3" style="font-size: 0.9em;"><i
                            class="fas fa-undo-alt mr-2"></i>Volver</a>
                </div>
            </div>
            <hr>
            <form class="row d-flex justify-content-around" action="{{ route('politica-guardar', ['id' => $id]) }}"
                method="POST" autocomplete="off" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="col-10 col-md-7 form-group">
                    <label for="tipo">Tipo de documento</label>
                    <select id="tipo" class="form-control form-control-sm" name="tipo">
                        <option value="Política">Política</option>
                        <option value="Reglamento">Reglamento</option>
                        <option value="Convención colectiva">Convención colectiva</option>
                        <option value="Pacto colectivo">Pacto colectivo</option>
                        <option value="Plan de beneficios">Plan de beneficios</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
                <div class="col-10 col-md-7 form-group">
                    <input type="hidden" name="empresa_id" value="{{$id}}">
                    <label for="nom_documento" class="col-form-label-sm">Nombre del Documento</label>
                    <input type="text" class="form-control form-control-sm" name="nom_documento" id="nom_documento"
                        aria-describedby="helpId" placeholder="" required>
                    <input type="file" accept="application/pdf" class="form-control form-control-sm" name="documento"
                        id="documento" aria-describedby="helpId" placeholder="" required>
                </div>
                <div class="col-12 col-md-7 mt-3 mb-5">
                    <div class="row">
                        <div class="col-10 col-md-7">
                            <button type="submit" class="btn btn-primary btn-xs pl-5 pr-5">Guardar</button>
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
    <script src="{{ asset('js/intranet/empresas/archivo/soportes.js') }}"></script>
@endsection
<!-- ************************************************************* -->
