@extends("theme.back.plantilla")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
    @include('includes.funciones_php')
@endsection
<!-- titulo hoja -->
@section('estilosHojas')
    <!-- Pagina CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin/hojavida/editar.css') }}">
@endsection
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('tituloHoja')
    Hojas de Vida
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
                    <h5>Editar Publicaciones {{ $empleado->usuario->nombres . ' ' . $empleado->usuario->apellidos }}</h5>
                </div>
                <div class="col-12 col-md-6 col-lg-6 text-md-right text-lg-right pl-2 pr-md-5 pr-lg-5">
                    <a href="{{ route('hojas_de_vida-editar', ['id' => $empleado->id]) }}"
                        class="btn btn-info btn-sm text-center pl-3 pr-3 mr-3"><i
                            class="fas fa-undo-alt mr-2"></i>Volver</a>
                </div>
            </div>
            <hr>
            <div class="row d-flex justify-content-around mt-3 mb-4" id="listado_empleados">
                <div class="col-12 col-md-11">
                    @csrf
                    @method('put')
                    <form class="row d-flex justify-content-around pt-3 pb-3 pl-5 form-horizontal"
                        action="{{ route('hojas_de_vida-publicaciones-guardar', ['id' => $empleado->id]) }}"
                        autocomplete="off" enctype="multipart/form-data" method="POST"
                        style="font-size: 0.8em;background-color: #ffffff">
                        @csrf
                        @method('post')
                        <div class="col-12 mb-3">
                            <h6 style="text-decoration: underline;"><strong>Agregar Publicación</strong></h6>
                        </div>
                        <div class="col-12">
                            <div class="row d-flex justify-content-around w-100">
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Completa Select text -->
                                <input type="hidden" name="empleado_id" id="empleado_id" value="{{ $empleado->id }}">
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Titulo Input text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="requerido" for="titulo">Titulo</label>
                                    <input type="text" class="form-control form-control-sm text-center" name="titulo"
                                        id="titulo" aria-describedby="helpId" placeholder="" required>
                                    <small id="helpId" class="form-text text-muted">Titulo</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Titulo Input text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="" for="isbn">ISBN</label>
                                    <input type="text" class="form-control form-control-sm text-center" name="isbn"
                                        id="isbn" aria-describedby="helpId" placeholder="">
                                    <small id="helpId" class="form-text text-muted">ISBN</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Titulo Input text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="" for="pagina_legal">Página legal</label>
                                    <input type="text" class="form-control form-control-sm text-center" name="pagina_legal"
                                        id="pagina_legal" aria-describedby="helpId" placeholder="">
                                    <small id="helpId" class="form-text text-muted">Página legal</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Titulo Input text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="requerido" for="autores">Autores</label>
                                    <input type="text" class="form-control form-control-sm text-center" name="autores"
                                        id="autores" aria-describedby="helpId" placeholder="" required>
                                    <small id="helpId" class="form-text text-muted">Autores</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Titulo Input text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="requerido" for="revista">Revista o medio de puplicación</label>
                                    <input type="text" class="form-control form-control-sm text-center" name="revista"
                                        id="revista" aria-describedby="helpId" placeholder="" required>
                                    <small id="helpId" class="form-text text-muted">Revista o medio de puplicación</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Titulo Input text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="" for="base_datos">Base de datos</label>
                                    <input type="text" class="form-control form-control-sm text-center" name="base_datos"
                                        id="base_datos" aria-describedby="helpId" placeholder="">
                                    <small id="helpId" class="form-text text-muted">Base de datos</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Titulo Input text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="requerido" for="cuartil">Cuartil</label>
                                    <input type="text" class="form-control form-control-sm text-center" name="cuartil"
                                        id="cuartil" aria-describedby="helpId" placeholder="" required>
                                    <small id="helpId" class="form-text text-muted">Cuartil</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <div class="col-10 mt-4 mb-2 mr-md-4 form-group">
                                    <button type="submit" class="btn btn-primary btn-xs pl-5 pr-5">Guardar</button>
                                </div>
                            </div>
                        </div>
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
    <script src="{{ asset('js/admin/hojasvida/editar_emp.js') }}"></script>
@endsection
<!-- ************************************************************* -->
