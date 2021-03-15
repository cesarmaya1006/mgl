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
                    <h5>Editar experiencia laboral formal
                        {{ $empleado->usuario->nombres . ' ' . $empleado->usuario->apellidos }}</h5>
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
                        action="{{ route('hojas_de_vida-laboralformal-guardar', ['id' => $empleado->id]) }}"
                        autocomplete="off" enctype="multipart/form-data" method="POST"
                        style="font-size: 0.8em;background-color: #ffffff">
                        @csrf
                        @method('post')
                        <div class="col-12 mb-3">
                            <h6 style="text-decoration: underline;"><strong>Agregar experiencia laboral formal</strong></h6>
                        </div>
                        <div class="col-12">
                            <div class="row d-flex justify-content-star w-100">
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Completa Select text -->
                                <input type="hidden" name="empleado_id" id="empleado_id" value="{{ $empleado->id }}">
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Empleo actual select text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="requerido" for="actual">Empleo Actual</label>
                                    <select class="form-control form-control-sm" name="actual" id="actual" required>
                                        <option value="">Seleccione Opción</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                    <small id="helpId" class="form-text text-muted">Empleo Actual</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Entidad Input text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="requerido" for="entidad">Entidad/Empresa</label>
                                    <input type="text" class="form-control form-control-sm" name="entidad" id="entidad"
                                        aria-describedby="helpId" placeholder="" required>
                                    <small id="helpId" class="form-text text-muted">Entidad/Empresa</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Tipo de entidad select text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="requerido" for="tipo_entidad">Tipo de Entidad</label>
                                    <select class="form-control form-control-sm" name="tipo_entidad" id="tipo_entidad"
                                        required>
                                        <option value="">Seleccione Opción</option>
                                        <option value="Pública">Pública</option>
                                        <option value="Privada">Privada</option>
                                    </select>
                                    <small id="helpId" class="form-text text-muted">Tipo de Entidad</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- País select  -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="requerido" for="pais">País</label>
                                    <select class="form-control form-control-sm" name="pais" id="pais">
                                        <option value="">Ingrese un valor.</option>
                                        @foreach ($paises as $pais)
                                            <option value="{{ $pais->pais }}" {{ $pais->pais == 'COLOMBIA' ? 'Selected' : '' }}>
                                                {{ $pais->pais }}</option>
                                        @endforeach
                                    </select>
                                    <small id="helpId" class="form-text text-muted">País</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Departamento select  -->
                                <div class="col-10 col-md-3 form-group" id="caja_departamento">
                                    <label class="requerido" for="departamento" id="label_departamento">Departamento</label>
                                    <select class="form-control form-control-sm" name="departamento"
                                        data_url="{{ route('hv_cargar_municipios') }}" id="departamento">
                                        <option value="">Ingrese un valor.</option>
                                        @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->departamento }}">
                                                {{ $departamento->departamento }}</option>
                                        @endforeach
                                    </select>
                                    <small id="helpId" class="form-text text-muted">Departamento</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Municipio select  -->
                                <div class="col-10 col-md-3 form-group" id="caja_municipio">
                                    <label class="requerido" for="municipio" id="label_municipio">Municipio</label>
                                    <select class="form-control form-control-sm" name="municipio" id="municipio" }}>
                                        <option value="">Elija primero un Depto.</option>
                                    </select>
                                    <small id="helpId" class="form-text text-muted">Municipio</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Direccion Input text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="requerido" for="direccion">Dirección</label>
                                    <input type="text" class="form-control form-control-sm" name="direccion" id="direccion"
                                        aria-describedby="helpId" placeholder="" required>
                                    <small id="helpId" class="form-text text-muted">Dirección</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Telefono Input text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="requerido" for="telefono">Teléfono</label>
                                    <input type="text" class="form-control form-control-sm" maxlength="13" name="telefono"
                                        id="telefono" aria-describedby="helpId" placeholder="" value=""
                                        onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                                        required>
                                    <small id="helpId" class="form-text text-muted">Teléfono</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Fecha Grado Date text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="requerido" for="fecha_ingreso">Fecha Ingreso</label>
                                    <input type="date" class="form-control form-control-sm"
                                        max="{{ date('Y-m-d', strtotime(date('Y-m-d') . '- 1 days')) }}"
                                        value="{{ date('Y-m-d', strtotime(date('Y-m-d') . '- 1 days')) }}"
                                        name="fecha_ingreso" id="fecha_ingreso" aria-describedby="helpId" placeholder=""
                                        required>
                                    <small id="helpId" class="form-text text-muted">Fecha Ingreso</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Fecha Grado Date text -->
                                <div class="col-10 col-md-3 form-group d-none" id="cajon_fecha_termino">
                                    <label class="" for="fecha_termino" id="label_fecha_termino">Fecha termino</label>
                                    <input type="date" class="form-control form-control-sm" min="{{ date('Y-m-d') }}"
                                        name="fecha_termino" id="fecha_termino" aria-describedby="helpId" placeholder="">
                                    <small id="helpId" class="form-text text-muted">Fecha termino</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Tipo contrato select  -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="requerido" for="tipo_contrato">Tipo de Contrato</label>
                                    <select class="form-control form-control-sm" name="tipo_contrato" id="tipo_contrato"
                                        required>
                                        <option value="">Seleccione Opción</option>
                                        <option value="A Término Indefinido ">A Término Indefinido </option>
                                        <option value="A Término Fijo">A Término Fijo</option>
                                        <option value="De Obra o Labor">De Obra o Labor</option>
                                        <option value="Temporal, Ocasional o Accidental">Temporal, Ocasional o Accidental
                                        </option>
                                        <option value="Civil por Prestación de Servicios">Civil por Prestación de Servicios
                                        </option>
                                        <option value="De Aprendizaje">De Aprendizaje</option>
                                    </select>
                                    <small id="helpId" class="form-text text-muted">Tipo de Contrato</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Destinación de Tiempo select  -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="requerido" for="tiempo_contrato">Destinación de Tiempo</label>
                                    <select class="form-control form-control-sm" name="tiempo_contrato" id="tiempo_contrato"
                                        required>
                                        <option value="">Seleccione Opción</option>
                                        <option value="Tiempo Completo">Tiempo Completo </option>
                                        <option value="Medio Tiempo">Medio Tiempo</option>
                                        <option value="Por Horas o Días">Por Horas o Días</option>
                                    </select>
                                    <small id="helpId" class="form-text text-muted">Destinación de Tiempo</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Cargo Input text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="requerido" for="cargo">Cargo</label>
                                    <input type="text" class="form-control form-control-sm" name="cargo" id="cargo"
                                        aria-describedby="helpId" placeholder="" required>
                                    <small id="helpId" class="form-text text-muted">Cargo</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Dependencia Input text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="requerido" for="dependencia">Dependencia</label>
                                    <input type="text" class="form-control form-control-sm" name="dependencia"
                                        id="dependencia" aria-describedby="helpId" placeholder="" required>
                                    <small id="helpId" class="form-text text-muted">Dependencia</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Jefe Inmediato Input text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="requerido" for="jefe_inmediato">Jefe inmediato</label>
                                    <input type="text" class="form-control form-control-sm" name="jefe_inmediato"
                                        id="jefe_inmediato" aria-describedby="helpId" placeholder="" required>
                                    <small id="helpId" class="form-text text-muted">Jefe inmediato</small>
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
                                <!-- Observaciones text area -->
                                <div class="col-10 col-md-12 form-group">
                                    <label class="" for="observaciones	">Observaciones</label>
                                    <textarea class="form-control form-control-sm" name="observaciones" id="observaciones"
                                        rows="3" required></textarea>
                                    <small id="helpId" class="form-text text-muted">Observaciones</small>
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
    <script src="{{ asset('js/admin/hojasvida/infolaboralformal.js') }}"></script>
@endsection
<!-- ************************************************************* -->
