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
                    <h5>Editar Idiomas {{ $empleado->usuario->nombres . ' ' . $empleado->usuario->apellidos }}</h5>
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
                        action="{{ route('hojas_de_vida-idiomas-guardar', ['id' => $empleado->id]) }}" autocomplete="off"
                        enctype="multipart/form-data" method="POST" style="font-size: 0.8em;background-color: #ffffff">
                        @csrf
                        @method('post')
                        <div class="col-12 mb-3">
                            <h6 style="text-decoration: underline;"><strong>Agregar Idioma</strong></h6>
                        </div>
                        <div class="col-12">
                            <div class="row d-flex justify-content-around w-100">
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Completa Select text -->
                                <input type="hidden" name="empleado_id" id="empleado_id" value="{{ $empleado->id }}">
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Idioma Input text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="requerido" for="idioma">Idioma</label>
                                    <input type="text" class="form-control form-control-sm" name="idioma" id="idioma"
                                        aria-describedby="helpId" placeholder="" required>
                                    <small id="helpId" class="form-text text-muted">Idioma</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Idioma habla Select text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="requerido" for="habla">Habla</label>
                                    <select class="form-control form-control-sm" name="habla" id="habla" required>
                                        <option value="">Seleccione Opción</option>
                                        <option value="Bien">Bien</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Nativo">Nativo</option>
                                    </select>
                                    <small id="helpId" class="form-text text-muted">Habla</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Idioma lee Select text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="requerido" for="lee">Lee</label>
                                    <select class="form-control form-control-sm" name="lee" id="lee" required>
                                        <option value="">Seleccione Opción</option>
                                        <option value="Bien">Bien</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Nativo">Nativo</option>
                                    </select>
                                    <small id="helpId" class="form-text text-muted">Lee</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Idioma escribe Select text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="requerido" for="escribe">Escribe</label>
                                    <select class="form-control form-control-sm" name="escribe" id="escribe" required>
                                        <option value="">Seleccione Opción</option>
                                        <option value="Bien">Bien</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Nativo">Nativo</option>
                                    </select>
                                    <small id="helpId" class="form-text text-muted">Escribe</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Idioma examen Input text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="" for="examen">Examen</label>
                                    <input type="text" class="form-control form-control-sm" name="examen" id="examen"
                                        aria-describedby="helpId" placeholder="">
                                    <small id="helpId" class="form-text text-muted">Examen</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Fecha Grado Date text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="" for="fecha_examen">Fecha examen</label>
                                    <input type="date" class="form-control form-control-sm" max="{{ date('Y-m-d') }}"
                                        name="fecha_examen" id="fecha_examen" aria-describedby="helpId" placeholder="">
                                    <small id="helpId" class="form-text text-muted">Fecha examen</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Idioma resultado Input text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="" for="resultado">Resultado</label>
                                    <input type="number" class="form-control form-control-sm text-center" min="0" max="5"
                                        name="resultado" id="resultado" value="0.0" step=".1" aria-describedby="helpId"
                                        placeholder="">
                                    <small id="helpId" class="form-text text-muted">Resultado</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Soporte Date text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="" for="soporte">Soporte Pdf</label>
                                    <input class="form-control form-control-sm" type="file" name="soporte" id="soporte"
                                        accept="application/pdf" style="font-size: 0.9em;">
                                    <small id="helpId" class="form-text text-muted">Soporte Pdf</small>
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
