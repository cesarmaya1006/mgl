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
                    <h5>Editar Educación Otra {{ $empleado->usuario->nombres . ' ' . $empleado->usuario->apellidos }}</h5>
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
                        action="{{ route('hojas_de_vida-eduotra-guardar', ['id' => $empleado->id]) }}" autocomplete="off"
                        enctype="multipart/form-data" method="POST" style="font-size: 0.8em;background-color: #ffffff">
                        @csrf
                        @method('post')
                        <div class="col-12 mb-3">
                            <h6 style="text-decoration: underline;"><strong>Agregar Eduación</strong></h6>
                        </div>
                        <div class="col-12">
                            <div class="row d-flex justify-content-around w-100">
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Completa Select text -->
                                <input type="hidden" name="empleado_id" id="empleado_id" value="{{ $empleado->id }}">
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Completa Select text -->
                                <div class="col-10 col-md-2 form-group">
                                    <label class="requerido" for="completa">Completa/Incompleta</label>
                                    <select class="form-control form-control-sm" name="completa" id="completa" required>
                                        <option value="">Selc Opción</option>
                                        <option value="Completa">Completa</option>
                                        <option value="Incompleta">Incompleta</option>
                                    </select>
                                    <small id="helpId" class="form-text text-muted">Completa/Incompleta</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Titulo Input text -->
                                <div class="col-10 col-md-4 form-group">
                                    <label class="requerido" for="titulo">Titulo Obtenido</label>
                                    <input type="text" class="form-control form-control-sm text-center" name="titulo"
                                        id="titulo" aria-describedby="helpId" placeholder="" required>
                                    <small id="helpId" class="form-text text-muted">Titulo Obtenido</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Establecimiento Input text -->
                                <div class="col-10 col-md-4 form-group">
                                    <label class="requerido" for="establecimiento">Establecimiento</label>
                                    <input type="text" class="form-control form-control-sm text-center"
                                        name="establecimiento" id="establecimiento" aria-describedby="helpId" placeholder=""
                                        required>
                                    <small id="helpId" class="form-text text-muted">Establecimiento</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Cantidad horas Date text -->
                                <div class="col-10 col-md-2 form-group">
                                    <label class="requerido" for="cant_horas">Cant Horas</label>
                                    <input class="form-control form-control-sm text-center" type="number" min="1" value="1"
                                        name="cant_horas" id="cant_horas" aria-describedby="helpId" placeholder="">
                                    <small id="helpId" class="form-text text-muted">Cant Horas</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Fecha Grado Date text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="requerido" for="fecha_inicio">Fecha inicio</label>
                                    <input type="date" class="form-control form-control-sm"
                                        max="{{ date('Y-m-d', strtotime(date('Y-m-d') . '- 1 days')) }}"
                                        value="{{ date('Y-m-d', strtotime(date('Y-m-d') . '- 1 days')) }}"
                                        name="fecha_inicio" id="fecha_inicio" aria-describedby="helpId" placeholder="">
                                    <small id="helpId" class="form-text text-muted">Fecha inicio</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Fecha Grado Date text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="requerido" for="fecha_termino">Fecha termino</label>
                                    <input type="date" class="form-control form-control-sm" min="{{ date('Y-m-d') }}"
                                        max="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" name="fecha_termino"
                                        id="fecha_termino" aria-describedby="helpId" placeholder="">
                                    <small id="helpId" class="form-text text-muted">Fecha termino</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Fecha Grado Date text -->
                                <div class="col-10 col-md-5 form-group">
                                    <label class="requerido" for="soporte">Soporte Pdf</label>
                                    <input class="form-control form-control-sm" type="file" name="soporte" id="soporte"
                                        accept="application/pdf" required>
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
