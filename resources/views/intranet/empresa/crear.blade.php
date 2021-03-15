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
    <div class="row d-flex justify-content-center">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3 pl-4">
                            <h3 class="card-title">Agregar Empresa</h3>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <a href="{{ route('admin-empresa-index') }}"
                                class="btn btn-info btn-sombra btn-xs pl-4 pr-4 float-right mr-4">
                                <i class="fas fa-reply mr-2" aria-hidden="true"></i>
                                Volver
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body pb-4">
                    <form class="row d-flex justify-content-between form-horizontal pl-md-5 pr-md-5"
                        action="{{ route('admin-empresa-guardar') }}" id="form-general" method="POST" autocomplete="off">
                        @csrf
                        @method('post')
                        <div class="col-5 col-md-2 form-group">
                            <label for="docutipos_id">Tipo de identificación</label>
                            <select id="docutipos_id" class="form-control form-control-sm" name="docutipos_id" required>
                                <option value="">Elija tipo</option>
                                @foreach ($tiposdocu as $tipoDocu)
                                    <option value="{{ $tipoDocu->id }}">{{ $tipoDocu->abreb_id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-7 col-md-2 form-group">
                            <label for="identificacion">Identificación</label>
                            <input type="text" class="form-control form-control-sm" name="identificacion"
                                id="identificacion" required>
                        </div>
                        <div class="col-12 col-md-4 form-group">
                            <label for="nombre">Empresa</label>
                            <input type="text" class="form-control form-control-sm" name="nombre" id="nombre" required>
                        </div>
                        <div class="col-12 col-md-4 form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" class="form-control form-control-sm" name="email" id="email" required>
                        </div>
                        <div class="col-12 col-md-2 form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="tel" class="form-control form-control-sm" name="telefono" id="telefono" required>
                        </div>

                        <div class="col-12 col-md-4 form-group">
                            <label for="contacto">Contacto</label>
                            <input type="text" class="form-control form-control-sm" name="contacto" id="contacto" required>
                        </div>
                        <div class="col-12 col-md-4 form-group">
                            <label for="cargo">Cargo contacto</label>
                            <input type="text" class="form-control form-control-sm" name="cargo" id="cargo" required>
                        </div>
                        <div class="col-12 pl-4 mt-4">
                            <button type="submit" class="btn btn-sombra btn-primary btn-xs pl-4 pr-4">Agregar
                                Empresa</button>
                        </div>
                    </form>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
            </div>
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
