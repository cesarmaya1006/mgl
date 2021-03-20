@extends("theme.back.plantilla")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
    @include('includes.funciones_php')
@endsection
<!-- titulo hoja -->
@section('estilosHojas')
    <!-- Pagina CSS -->
    <link rel="stylesheet" href="{{ asset('css/intranet/hojavida/editar.css') }}">
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
                    <h5>Editar HV {{ $empleado->usuario->nombres . ' ' . $empleado->usuario->apellidos }}<br>Última
                        Edición {{ $empleado->updated_at }}</h5>
                </div>
                <div class="col-12 col-md-6 col-lg-6 text-md-right text-lg-right pl-2 pr-md-5 pr-lg-5">
                    <a href="{{ route('hojas_de_vida-index', ['id' => $empleado->empresa->id]) }}"
                        class="btn btn-info btn-sm text-center pl-3 pr-3 mr-3"><i
                            class="fas fa-undo-alt mr-2"></i>Volver</a>
                </div>
            </div>
            <hr>
            <div class="row d-flex justify-content-around mt-3 mb-5" id="listado_empleados">
                <div class="col-12 col-md-11">
                    @csrf
                    @method('put')
                    <form class="row d-flex justify-content-around pt-3 pb-3 pl-5 form-horizontal"
                        action="{{ route('hojas_de_vida-guardar-infemp', ['id' => $empleado->id]) }}" autocomplete="off"
                        enctype="multipart/form-data" method="POST" style="font-size: 0.8em;background-color: #efefef">
                        @csrf
                        @method('put')
                        <div class="col-12 mb-3">
                            <h6 style="text-decoration: underline;"><strong>Datos Personales</strong></h6>
                        </div>
                        <div class="col-12">
                            <div class="row d-flex justify-content-around w-100">
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Tipo Empleado Select text -->
                                <div class="col-10 col-md-4 form-group">
                                    <label class="requerido" for="nivel_id">Área</label>
                                    <select class="form-control form-control-sm" id="nivel_id"
                                        data_url="{{ route('cargar_areas') }}">
                                        @foreach ($niveles as $nivel)
                                            <option value="{{ $nivel->id }}"
                                                {{ $empleado->cargo->area->nivel->id == $nivel->id ? 'selected' : '' }}>
                                                {{ $nivel->nivel }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- nivel Cargo Select text -->
                                <div class="col-10 col-md-4 form-group">
                                    <label class="requerido" for="area_id">Nivel</label>
                                    <select class="form-control form-control-sm" id="area_id"
                                        data_url="{{ route('cargar_cargos') }}">
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}"
                                                {{ $empleado->cargo->area->id == $area->id ? 'selected' : '' }}>
                                                {{ $area->area }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Cargo Select text -->
                                <div class="col-10 col-md-4 form-group">
                                    <label class="requerido" for="hv_cargo_id">Cargo</label>
                                    <select class="form-control form-control-sm" name="hv_cargo_id" id="hv_cargo_id"
                                        required>
                                        @foreach ($cargos as $cargo)
                                            <option value="{{ $cargo->id }}"
                                                {{ $empleado->cargo->id == $cargo->id ? 'selected' : '' }}>
                                                {{ $cargo->cargo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                            </div>
                            <hr>
                            <div class="row d-flex justify-content-around w-100">
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Identificacion Input text -->
                                <div class="col-10 col-md-1 form-group">
                                    <label class="requerido" for="docutipos_id">T Ident</label>
                                    <select class="form-control form-control-sm" name="docutipos_id" id="docutipos_id">
                                        <option value="">Tipo de doc.</option>
                                        @foreach ($tipos_doc as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $item->id == $empleado->usuario->docutipos_id ? 'selected' : '' }}>
                                                {{ $item->abreb_id }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Identificacion Input text -->
                                <div class="col-10 col-md-2 form-group">
                                    <label class="requerido" for="identificacion">N° Identificación</label>
                                    <input type="text" class="form-control form-control-sm text-center"
                                        name="identificacion" id="identificacion" aria-describedby="helpId" placeholder=""
                                        value="{{ $empleado->usuario->identificacion }}" required>
                                    <small id="helpId" class="form-text text-muted">N° Identificación completos</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Nombres Input text -->
                                <div class="col-10 col-md-4 form-group">
                                    <label class="requerido" for="nombres">Nombres</label>
                                    <input type="text" class="form-control form-control-sm" name="nombres" id="nombres"
                                        aria-describedby="helpId" placeholder=""
                                        value="{{ $empleado->usuario->nombres }}" required>
                                    <small id="helpId" class="form-text text-muted">Nombres</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Primer Apellido Input text -->
                                <div class="col-10 col-md-4 form-group">
                                    <label class="requerido" for="apellidos">Apellidos</label>
                                    <input type="text" class="form-control form-control-sm" name="apellidos" id="apellidos"
                                        aria-describedby="helpId" placeholder=""
                                        value="{{ $empleado->usuario->apellidos }}" required>
                                    <small id="helpId" class="form-text text-muted">Apellidos</small>
                                </div>
                                <!-- *********************************************************************** -->
                                <!-- Sexo Select text -->
                                <div class="col-10 col-md-2 form-group">
                                    <label class="requerido" for="sexo">Sexo</label>
                                    <select class="form-control form-control-sm" name="sexo" id="sexo" required>
                                        <option value="Femenino" {{ $empleado->sexo == 'Femenino' ? 'selected' : '' }}>
                                            Femenino
                                        </option>
                                        <option value="Masculino" {{ $empleado->sexo == 'Masculino' ? 'selected' : '' }}>
                                            Masculino</option>
                                        <option value="Otro" {{ $empleado->sexo == 'Otro' ? 'selected' : '' }}>Otro
                                        </option>
                                    </select>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Correo Input text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="requerido" for="email">Correo electrónico</label>
                                    <input type="email" class="form-control form-control-sm" name="email" id="email"
                                        aria-describedby="helpId" placeholder="" value="{{ $empleado->usuario->email }}"
                                        required>
                                    <small id="helpId" class="form-text text-muted">Correo electrónico</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Telefono Input text -->
                                <div class="col-10 col-md-2 form-group">
                                    <label class="requerido" for="telefono">Celular</label>
                                    <input type="text" class="form-control form-control-sm" maxlength="10" name="telefono"
                                        id="telefono" aria-describedby="helpId" placeholder=""
                                        value="{{ $empleado->usuario->telefono }}"
                                        onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                                        required>
                                    <small id="helpId" class="form-text text-muted">Celular</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Telefono fijo Input text -->
                                <div class="col-10 col-md-2 form-group">
                                    <label class="" for="telefono_fijo">Teléfono fijo</label>
                                    <input type="text" class="form-control form-control-sm" maxlength="10"
                                        name="telefono_fijo" id="telefono_fijo" aria-describedby="helpId" placeholder=""
                                        value="{{ $empleado->telefono_fijo }}"
                                        onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                    <small id="helpId" class="form-text text-muted">Teléfono fijo</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Fec nacimiento Input text -->
                                <div class="col-10 col-md-3 pl-md-4 pr-md-4 form-group">
                                    <label class="" for="fecha_nacimiento">Fec Nacimiento</label>
                                    <?php
                                    $fecha_actual = date('Y-m-d');
                                    $max_fecha = date('Y-m-d', strtotime($fecha_actual . '- 18 year'));
                                    ?>
                                    <input type="date" class="form-control form-control-sm" max="{{ $max_fecha }}"
                                        name="fecha_nacimiento" id="fecha_nacimiento" aria-describedby="helpId"
                                        placeholder="" value="{{ $empleado->fecha_nacimiento }}">
                                    <small id="helpId" class="form-text text-muted">Fec Nacimiento</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- *********************************************************************** -->
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Pais Residencia Selsect text -->
                                <div class="col-10 col-md-2 form-group">
                                    <label class="" for="pais_residencia">País Residencia</label>
                                    <select class="form-control form-control-sm" name="pais_residencia"
                                        id="pais_residencia">
                                        <option value="">Ingrese un valor.</option>
                                        @foreach ($paises as $pais)
                                            <option value="{{ $pais->pais }}"
                                                {{ $pais->pais == $empleado->pais_residencia ? 'Selected' : '' }}>
                                                {{ $pais->pais }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Deparatmento Residencia Selsect text -->
                                <div class="col-10 col-md-2 form-group">
                                    <label class="" for="departamento_residencia">Depart Residencia</label>
                                    <select class="form-control form-control-sm" name="departamento_residencia"
                                        id="departamento_residencia" data_url="{{ route('hv_cargar_municipios') }}"
                                        {{ $empleado->pais_residencia == 'COLOMBIA' ? '' : 'disabled' }}>
                                        <option value="">Ingrese un valor.</option>
                                        @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->departamento }}"
                                                {{ $departamento->departamento == $empleado->departamento_residencia ? 'Selected' : '' }}>
                                                {{ $departamento->departamento }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Municipio Residencia Selsect text -->
                                <div class="col-10 col-md-2 form-group">
                                    <label class="" for="municipio_residencia">Municipio Residencia</label>
                                    <select class="form-control form-control-sm" name="municipio_residencia"
                                        id="municipio_residencia"
                                        {{ $empleado->pais_residencia == 'COLOMBIA' ? '' : 'disabled' }}>
                                        <option value="">Ingrese un valor.</option>
                                    </select>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Direccion Input text -->
                                <div class="col-10 col-md-6 form-group">
                                    <label class="" for="direccion">Dirección</label>
                                    <input type="text" class="form-control form-control-sm" name="direccion" id="direccion"
                                        aria-describedby="helpId" placeholder="" value="{{ $empleado->direccion }}">
                                    <small id="helpId" class="form-text text-muted">Dirección</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- *********************************************************************** -->
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Pais Nacimiento Selsect text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="" for="pais_nacionalidad">País Nacimiento</label>
                                    <select class="form-control form-control-sm" name="pais_nacionalidad"
                                        id="pais_nacionalidad">
                                        <option value="">Ingrese un valor.</option>
                                        @foreach ($paises as $pais)
                                            <option value="{{ $pais->pais }}"
                                                {{ $pais->pais == $empleado->pais_nacionalidad ? 'Selected' : '' }}>
                                                {{ $pais->pais }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Lugar de Nacimiento Input text -->
                                <div class="col-10 col-md-4 form-group">
                                    <label class="" for="lugar_nacimiento">Lugar de Nacimiento</label>
                                    <input type="text" class="form-control form-control-sm" name="lugar_nacimiento"
                                        id="lugar_nacimiento" aria-describedby="helpId" placeholder=""
                                        value="{{ $empleado->lugar_nacimiento }}">
                                    <small id="helpId" class="form-text text-muted">Lugar de Nacimiento</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Tipo de L.M. Input text -->
                                <div class="col-10 col-md-3 form-group">
                                    <label class="" for="tipo_libreta">Tipo de L.M.</label>
                                    <input type="text" class="form-control form-control-sm text-center" name="tipo_libreta"
                                        id="tipo_libreta" aria-describedby="helpId" placeholder=""
                                        value="{{ $empleado->tipo_libreta }}">
                                    <small id="helpId" class="form-text text-muted">Tipo de L.M.</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Número de L.M. Input text -->
                                <div class="col-10 col-md-2 form-group">
                                    <label class="" for="n_libreta">Número de L.M.</label>
                                    <input type="text" class="form-control form-control-sm text-center" name="n_libreta"
                                        id="n_libreta" aria-describedby="helpId" placeholder=""
                                        value="{{ $empleado->n_libreta }}">
                                    <small id="helpId" class="form-text text-muted">Número de L.M.</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Descripcion Input text -->
                                <div class="col-10 col-md-7 form-group">
                                    <label class="" for="descripcion">Perfil</label>
                                    <textarea class="form-control form-control-sm" name="descripcion" id="descripcion"
                                        rows="8">{{ $empleado->descripcion }}</textarea>
                                    <small id="helpId" class="form-text text-muted">Perfil</small>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <!-- Foto Input text -->
                                <div class="col-10 col-md-5 form-group">
                                    <div class="row d-flex justify-content-around">
                                        <div class="col-12 text-center">
                                            <label class="" for="foto	">Imagen Personal</label>
                                        </div>
                                        <div class="col-12 col-md-5 text-center">
                                            <img class="img-fluid" id="img_personal"
                                                src="{{ $empleado->foto != null ? asset('imagenes/hojas_de_vida/' . $empleado->foto) : asset('imagenes/hojas_de_vida/usuario-inicial.jpg') }}"
                                                style="width: 100%;height: auto;margin: auto;">
                                        </div>
                                        <div class="col-12">
                                            <input class="form-control form-control-sm" type="file" name="foto" id="foto"
                                                accept="image/x-png,image/gif,image/jpeg"
                                                onchange="document.getElementById('img_personal').src = window.URL.createObjectURL(this.files[0])"
                                                style="font-size: 8pt;">
                                            <small id="helpId" class="form-text text-muted">Imagen Personal 800px * 600px a
                                                72dpi</small>
                                        </div>
                                    </div>
                                </div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                <div class="col-10 mb-4 mr-md-4 form-group">
                                    <button type="submit" class="btn btn-secondary btn-xs pl-5 pr-5">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="row d-flex justify-content-around pt-3 pb-3 pl-5" style="background-color: #edfdee">
                        <div class="col-12 mb-3">
                            <h6 style="text-decoration: underline;"><strong>Formación Academica - Publicaciones -
                                    Idiomas</strong></h6>
                        </div>
                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                        <div class="col-12 mb-4 mt-3">
                            <div class="row d-flex justify-content-around w-100">
                                <div class="col-12 col-md-6 pl-4">
                                    <h6 style="text-decoration: underline;">Educación Básica</h6>
                                </div>
                                <div class="col-12 col-md-6 pr-4"><a
                                        href="{{ route('hojas_de_vida-edubasica', ['id' => $empleado->id]) }}"
                                        class="btn btn-success btn-sm pl-3 pr-3 float-md-right" style="font-size: 0.9em;"><i
                                            class="fas fa-folder-plus mr-3"></i>Nuevo Registro</a></div>
                            </div>
                        </div>
                        <div class="col-12 mb-3 table-responsive pb-3" style="border-bottom: 0.5px solid gray">
                            <table class="table table-striped table-bordered table-hover table-sm tabla-data">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">Estado</th>
                                        <th class="text-center" scope="col">Último grado cursado</th>
                                        <th class="text-center" scope="col">Título obtenido</th>
                                        <th class="text-center" scope="col">Establecimiento educativo</th>
                                        <th class="text-center" scope="col">Fecha grado o ult curs</th>
                                        <th class="text-center" scope="col">Soporte</th>
                                        <th class="text-center" scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($empleado->edu_basica as $item)
                                        <tr>
                                            <td>{{ $item->completa }}</td>
                                            <td>{{ $item->ultimo_cursado }}</td>
                                            <td>{{ $item->titulo }}</td>
                                            <td>{{ $item->establecimiento }}</td>
                                            <td>{{ $item->fecha_ultimo }}</td>
                                            <td><a href="{{ asset('documentos/hojas_de_vida/' . $item->soporte) }}"
                                                    target="_blank">{{ $item->soporte }}</a></td>
                                            <td class="text-center" style="min-width: 100px;">
                                                <form
                                                    action="{{ route('hojas_de_vida-eliminaredubasica', ['id' => $item->id]) }}"
                                                    class="d-inline form-eliminar" method="POST">
                                                    @csrf @method("delete")
                                                    <button type="submit"
                                                        class="btn-accion-tabla eliminar tooltipsC text-danger"
                                                        title="Eliminar este registro">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                        <div class="col-12 mb-4 mt-3">
                            <div class="row d-flex justify-content-around w-100">
                                <div class="col-12 col-md-6 pl-4">
                                    <h6 style="text-decoration: underline;">Educación Superior</h6>
                                </div>
                                <div class="col-12 col-md-6 pr-4"><a
                                        href="{{ route('hojas_de_vida-edusuperior', ['id' => $empleado->id]) }}"
                                        class="btn btn-success btn-sm pl-3 pr-3 float-md-right" style="font-size: 0.9em;"><i
                                            class="fas fa-folder-plus mr-3"></i>Nuevo Registro</a></div>
                            </div>
                        </div>
                        <div class="col-12 mb-3 table-responsive pb-3" style="border-bottom: 0.5px solid gray">
                            <table class="table table-striped table-bordered table-hover table-sm tabla-data">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">Estado</th>
                                        <th class="text-center" scope="col">Título obtenido</th>
                                        <th class="text-center" scope="col">Establecimiento educativo</th>
                                        <th class="text-center" scope="col">Fecha grado o ult curs</th>
                                        <th class="text-center" scope="col">Num tarjeta prof.</th>
                                        <th class="text-center" scope="col">Soporte</th>
                                        <th class="text-center" scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($empleado->edu_superior as $item)
                                        <tr>
                                            <td>{{ $item->completa }}</td>
                                            <td>{{ $item->titulo }}</td>
                                            <td>{{ $item->establecimiento }}</td>
                                            <td>{{ $item->fecha_ultimo }}</td>
                                            <td>{{ $item->tarjeta_prof }}</td>
                                            <td><a href="{{ asset('documentos/hojas_de_vida/' . $item->soporte) }}"
                                                    target="_blank">{{ $item->soporte }}</a></td>
                                            <td class="text-center" style="min-width: 100px;">
                                                <form
                                                    action="{{ route('hojas_de_vida-eliminaredusuperior', ['id' => $item->id]) }}"
                                                    class="d-inline form-eliminar" method="POST">
                                                    @csrf @method("delete")
                                                    <button type="submit"
                                                        class="btn-accion-tabla eliminar tooltipsC text-danger"
                                                        title="Eliminar este registro">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                        <div class="col-12 mb-4 mt-3">
                            <div class="row d-flex justify-content-around w-100">
                                <div class="col-12 col-md-6 pl-4">
                                    <h6 style="text-decoration: underline;">Otra Educación</h6>
                                </div>
                                <div class="col-12 col-md-6 pr-4"><a
                                        href="{{ route('hojas_de_vida-eduotra', ['id' => $empleado->id]) }}"
                                        class="btn btn-success btn-sm pl-3 pr-3 float-md-right" style="font-size: 0.9em;"><i
                                            class="fas fa-folder-plus mr-3"></i>Nuevo Registro</a></div>
                            </div>
                        </div>
                        <div class="col-12 mb-3 table-responsive pb-3" style="border-bottom: 0.5px solid gray">
                            <table class="table table-striped table-bordered table-hover table-sm tabla-data">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">Estado</th>
                                        <th class="text-center" scope="col">Título Obtenido</th>
                                        <th class="text-center" scope="col">Establecimiento Educativo</th>
                                        <th class="text-center" scope="col">Cant Horas</th>
                                        <th class="text-center" scope="col">Fecha de Inicio</th>
                                        <th class="text-center" scope="col">Fecha de Termino</th>
                                        <th class="text-center" scope="col">Soporte</th>
                                        <th class="text-center" scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($empleado->edu_otra as $item)
                                        <tr>
                                            <td>{{ $item->completa }}</td>
                                            <td>{{ $item->titulo }}</td>
                                            <td>{{ $item->establecimiento }}</td>
                                            <td class="text-center">{{ $item->cant_horas }}</td>
                                            <td class="text-center">{{ $item->fecha_inicio }}</td>
                                            <td class="text-center">{{ $item->fecha_termino }}</td>
                                            <td><a href="{{ asset('documentos/hojas_de_vida/' . $item->soporte) }}"
                                                    target="_blank">{{ $item->soporte }}</a></td>
                                            <td class="text-center" style="min-width: 100px;">
                                                <form
                                                    action="{{ route('mi_hoja_de_vida-edu_otra-eliminar', ['id' => $item->id]) }}"
                                                    class="d-inline form-eliminar" method="POST">
                                                    @csrf
                                                    @method("delete")
                                                    <button type="submit"
                                                        class="btn-accion-tabla eliminar tooltipsC text-danger"
                                                        title="Eliminar este registro">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                        <div class="col-12 mb-4 mt-3">
                            <div class="row d-flex justify-content-around w-100">
                                <div class="col-12 col-md-6 pl-4">
                                    <h6 style="text-decoration: underline;">Publicaciones</h6>
                                </div>
                                <div class="col-12 col-md-6 pr-4"><a
                                        href="{{ route('hojas_de_vida-publicaciones', ['id' => $empleado->id]) }}"
                                        class="btn btn-success btn-sm pl-3 pr-3 float-md-right" style="font-size: 0.9em;"><i
                                            class="fas fa-folder-plus mr-3"></i>Nuevo Registro</a></div>
                            </div>
                        </div>
                        <div class="col-12 mb-3 table-responsive pb-3" style="border-bottom: 0.5px solid gray">
                            <table class="table table-striped table-bordered table-hover table-sm tabla-data">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">Titulo</th>
                                        <th class="text-center" scope="col">ISBN</th>
                                        <th class="text-center" scope="col">Pagina Legal</th>
                                        <th class="text-center" scope="col">Autores</th>
                                        <th class="text-center" scope="col">Revista</th>
                                        <th class="text-center" scope="col">Base de datos</th>
                                        <th class="text-center" scope="col">Cuartil</th>
                                        <th class="text-center" scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($empleado->publicaciones as $item)
                                        <tr>
                                            <td>{{ $item->titulo }}</td>
                                            <td>{{ $item->isbn }}</td>
                                            <td>{{ $item->pagina_legal }}</td>
                                            <td>{{ $item->autores }}</td>
                                            <td>{{ $item->revista }}</td>
                                            <td>{{ $item->base_datos }}</td>
                                            <td>{{ $item->cuartil }}</td>
                                            <td class="text-center" style="min-width: 100px;">
                                                <form
                                                    action="{{ route('mi_hoja_de_vida-publicacion-eliminar', ['id' => $item->id]) }}"
                                                    class="d-inline form-eliminar" method="POST">
                                                    @csrf
                                                    @method("delete")
                                                    <button type="submit"
                                                        class="btn-accion-tabla eliminar tooltipsC text-danger"
                                                        title="Eliminar este registro">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                        <div class="col-12 mb-4 mt-3">
                            <div class="row d-flex justify-content-around w-100">
                                <div class="col-12 col-md-6 pl-4">
                                    <h6 style="text-decoration: underline;">Idiomas</h6>
                                </div>
                                <div class="col-12 col-md-6 pr-4"><a
                                        href="{{ route('hojas_de_vida-idiomas', ['id' => $empleado->id]) }}"
                                        class="btn btn-success btn-sm pl-3 pr-3 float-md-right" style="font-size: 0.9em;"><i
                                            class="fas fa-folder-plus mr-3"></i>Nuevo Registro</a></div>
                            </div>
                        </div>
                        <div class="col-12 mb-3 table-responsive pb-3" style="border-bottom: 0.5px solid gray">
                            <table class="table table-striped table-bordered table-hover table-sm tabla-data">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">Idioma</th>
                                        <th class="text-center" scope="col">Habla</th>
                                        <th class="text-center" scope="col">lee</th>
                                        <th class="text-center" scope="col">Escribe</th>
                                        <th class="text-center" scope="col">Examen</th>
                                        <th class="text-center" scope="col">fecha de Examen</th>
                                        <th class="text-center" scope="col">Resultado</th>
                                        <th class="text-center" scope="col">Soporte</th>
                                        <th class="text-center" scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($empleado->idiomas as $item)
                                        <tr>
                                            <td>{{ $item->idioma }}</td>
                                            <td class="text-center">{{ $item->habla }}</td>
                                            <td class="text-center">{{ $item->lee }}</td>
                                            <td class="text-center">{{ $item->escribe }}</td>
                                            <td class="text-center">{{ $item->examen }}</td>
                                            <td class="text-center">{{ $item->fecha_examen }}</td>
                                            <td class="text-center">{{ $item->resultado }}</td>
                                            <td><a href="{{ asset('documentos/hojas_de_vida/' . $item->soporte) }}"
                                                    target="_blank">{{ $item->soporte }}</a></td>
                                            <td class="text-center" style="min-width: 100px;">
                                                <form
                                                    action="{{ route('mi_hoja_de_vida-idioma-eliminar', ['id' => $item->id]) }}"
                                                    class="d-inline form-eliminar" method="POST">
                                                    @csrf
                                                    @method("delete")
                                                    <button type="submit"
                                                        class="btn-accion-tabla eliminar tooltipsC text-danger"
                                                        title="Eliminar este registro">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                    </div>
                    <hr>
                    <div class="row d-flex justify-content-around pt-3 pb-3 pl-5" style="background-color: #edf0fd">
                        <div class="col-12 mb-3">
                            <h6 style="text-decoration: underline;"><strong>Experiencia laboral</strong></h6>
                        </div>
                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                        <div class="col-12 mb-4 mt-3">
                            <div class="row d-flex justify-content-around w-100">
                                <div class="col-12 col-md-6 pl-4">
                                    <h6 style="text-decoration: underline;">Experiencia laboral Formal</h6>
                                </div>
                                <div class="col-12 col-md-6 pr-4"><a
                                        href="{{ route('hojas_de_vida-laboralformal', ['id' => $empleado->id]) }}"
                                        class="btn btn-primary btn-sm pl-3 pr-3 float-md-right" style="font-size: 0.9em;"><i
                                            class="fas fa-folder-plus mr-3"></i>Nuevo Registro</a></div>
                            </div>
                        </div>
                        <div class="col-12 mb-3 table-responsive pb-3" style="border-bottom: 0.5px solid gray">
                            <table class="table table-striped table-bordered table-hover table-sm tabla-data">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">Entidad</th>
                                        <th class="text-center" scope="col">Tipo de Entidad</th>
                                        <th class="text-center" scope="col">Pais</th>
                                        <th class="text-center" scope="col">Departamento</th>
                                        <th class="text-center" scope="col">Municipio</th>
                                        <th class="text-center" scope="col">Dirección</th>
                                        <th class="text-center" scope="col">Teléfono</th>
                                        <th class="text-center" scope="col">Fecha de Ingreso</th>
                                        <th class="text-center" scope="col">Fecha de Termino</th>
                                        <th class="text-center" scope="col">Tipo de Contrato</th>
                                        <th class="text-center" scope="col">Destinación de Tiempo</th>
                                        <th class="text-center" scope="col">Cargo</th>
                                        <th class="text-center" scope="col">Dependencia</th>
                                        <th class="text-center" scope="col">Jefe Inmediato</th>
                                        <th class="text-center" scope="col">Observaciones</th>
                                        <th class="text-center" scope="col">Soporte</th>
                                        <th class="text-center" scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $exp_lab_for_temp = $empleado->experienciaslab;
                                    $exp_lab_for = $exp_lab_for_temp->sortByDesc('fecha_termino');
                                    ?>
                                    @foreach ($exp_lab_for as $item)
                                        @if ($item->actual == 'Si')
                                            <tr>
                                                <td style="white-space:nowrap;">{{ $item->entidad }}
                                                    {{ $item->actual == 'Si' ? ' - Actual' : '' }}</td>
                                                <td style="white-space:nowrap;">{{ $item->tipo_entidad }}</td>
                                                <td style="white-space:nowrap;">{{ $item->pais }}</td>
                                                <td style="white-space:nowrap;">
                                                    {{ $item->pais == 'COLOMBIA' ? $item->departamento : '---' }}</td>
                                                <td style="white-space:nowrap;">
                                                    {{ $item->pais == 'COLOMBIA' ? $item->municipio : '---' }}</td>
                                                <td style="white-space:nowrap;">{{ $item->direccion }}</td>
                                                <td style="white-space:nowrap;">{{ $item->telefono }}</td>
                                                <td style="white-space:nowrap;">{{ $item->fecha_ingreso }}</td>
                                                <td style="white-space:nowrap;">
                                                    {{ $item->actual == 'Si' ? 'Actual' : $item->fecha_termino }}</td>
                                                <td style="white-space:nowrap;">{{ $item->tipo_contrato }}</td>
                                                <td style="white-space:nowrap;">{{ $item->tiempo_contrato }}</td>
                                                <td style="white-space:nowrap;">{{ $item->cargo }}</td>
                                                <td style="white-space:nowrap;">{{ $item->dependencia }}</td>
                                                <td style="white-space:nowrap;">{{ $item->jefe_inmediato }}</td>
                                                <td style="vertical-align: normal;max-width: 300px;min-height: 200px;">
                                                    {{ $item->observaciones }}</td>
                                                <td style="white-space:nowrap;"><a
                                                        href="{{ asset('documentos/hojas_de_vida/' . $item->soporte) }}"
                                                        target="_blank">{{ $item->soporte }}</a></td>
                                                <td class="text-center" style="min-width: 100px;">
                                                    <form
                                                        action="{{ route('mi_hoja_de_vida-experiencialab-eliminar', ['id' => $item->id]) }}"
                                                        class="d-inline form-eliminar" method="POST">
                                                        @csrf @method("delete")
                                                        <button type="submit"
                                                            class="btn-accion-tabla eliminar tooltipsC text-danger"
                                                            title="Eliminar este registro">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @foreach ($exp_lab_for as $item)
                                        @if ($item->actual == 'No')
                                            <tr>
                                                <td style="white-space:nowrap;">{{ $item->entidad }}
                                                    {{ $item->actual == 'Si' ? ' - Actual' : '' }}</td>
                                                <td style="white-space:nowrap;">{{ $item->tipo_entidad }}</td>
                                                <td style="white-space:nowrap;">{{ $item->pais }}</td>
                                                <td style="white-space:nowrap;">
                                                    {{ $item->pais == 'COLOMBIA' ? $item->departamento : '---' }}</td>
                                                <td style="white-space:nowrap;">
                                                    {{ $item->pais == 'COLOMBIA' ? $item->municipio : '---' }}</td>
                                                <td style="white-space:nowrap;">{{ $item->direccion }}</td>
                                                <td style="white-space:nowrap;">{{ $item->telefono }}</td>
                                                <td style="white-space:nowrap;">{{ $item->fecha_ingreso }}</td>
                                                <td style="white-space:nowrap;">
                                                    {{ $item->actual == 'Si' ? 'Actual' : $item->fecha_termino }}</td>
                                                <td style="white-space:nowrap;">{{ $item->tipo_contrato }}</td>
                                                <td style="white-space:nowrap;">{{ $item->tiempo_contrato }}</td>
                                                <td style="white-space:nowrap;">{{ $item->cargo }}</td>
                                                <td style="white-space:nowrap;">{{ $item->dependencia }}</td>
                                                <td style="white-space:nowrap;">{{ $item->jefe_inmediato }}</td>
                                                <td style="vertical-align: normal;max-width: 300px;min-height: 200px;">
                                                    {{ $item->observaciones }}</td>
                                                <td style="white-space:nowrap;"><a
                                                        href="{{ asset('documentos/hojas_de_vida/' . $item->soporte) }}"
                                                        target="_blank">{{ $item->soporte }}</a></td>
                                                <td class="text-center" style="min-width: 100px;">
                                                    <form
                                                        action="{{ route('mi_hoja_de_vida-experiencialab-eliminar', ['id' => $item->id]) }}"
                                                        class="d-inline form-eliminar" method="POST">
                                                        @csrf @method("delete")
                                                        <button type="submit"
                                                            class="btn-accion-tabla eliminar tooltipsC text-danger"
                                                            title="Eliminar este registro">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                        <div class="col-12 mb-4 mt-3">
                            <div class="row d-flex justify-content-around w-100">
                                <div class="col-12 col-md-6 pl-4">
                                    <h6 style="text-decoration: underline;">Experiencia laboral Informal</h6>
                                </div>
                                <div class="col-12 col-md-6 pr-4"><a
                                        href="{{ route('hojas_de_vida-laboralinformal', ['id' => $empleado->id]) }}"
                                        class="btn btn-primary btn-sm pl-3 pr-3 float-md-right" style="font-size: 0.9em;"><i
                                            class="fas fa-folder-plus mr-3"></i>Nuevo Registro</a></div>
                            </div>
                        </div>
                        <div class="col-12 mb-3 table-responsive pb-3" style="border-bottom: 0.5px solid gray">
                            <table class="table table-striped table-bordered table-hover table-sm tabla-data">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">Entidad</th>
                                        <th class="text-center" scope="col">Tipo de Entidad</th>
                                        <th class="text-center" scope="col">Actividad</th>
                                        <th class="text-center" scope="col">Producto</th>
                                        <th class="text-center" scope="col">Pais</th>
                                        <th class="text-center" scope="col">Departamento</th>
                                        <th class="text-center" scope="col">Municipio</th>
                                        <th class="text-center" scope="col">Dirección</th>
                                        <th class="text-center" scope="col">Teléfono</th>
                                        <th class="text-center" scope="col">Fecha de Inicio</th>
                                        <th class="text-center" scope="col">Fecha de Termino</th>
                                        <th class="text-center" scope="col">Tipo de Contrato</th>
                                        <th class="text-center" scope="col">Observaciones</th>
                                        <th class="text-center" scope="col">Soporte</th>
                                        <th class="text-center" scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $exp_lab_for_temp = $empleado->experienciasindp;
                                    $exp_lab_indp = $exp_lab_for_temp->sortByDesc('fecha_termino');
                                    ?>
                                    @foreach ($exp_lab_indp as $item)
                                        <tr>
                                            <td style="white-space:nowrap;">{{ $item->entidad }}</td>
                                            <td style="white-space:nowrap;">{{ $item->tipo_entidad }}</td>
                                            <td style="white-space:nowrap;">{{ $item->actividad }}</td>
                                            <td style="white-space:nowrap;">{{ $item->producto }}</td>
                                            <td style="white-space:nowrap;">{{ $item->pais }}</td>
                                            <td style="white-space:nowrap;">
                                                {{ $item->pais == 'COLOMBIA' ? $item->departamento : '---' }}</td>
                                            <td style="white-space:nowrap;">
                                                {{ $item->pais == 'COLOMBIA' ? $item->municipio : '---' }}</td>
                                            <td style="white-space:nowrap;">{{ $item->direccion }}</td>
                                            <td style="white-space:nowrap;">{{ $item->telefono }}</td>
                                            <td style="white-space:nowrap;">{{ $item->fecha_inicio }}</td>
                                            <td style="white-space:nowrap;">{{ $item->fecha_termino }}</td>
                                            <td style="vertical-align: normal;max-width: 300px;min-height: 200px;">
                                                {{ $item->observaciones }}</td>
                                            <td style="white-space:nowrap;"><a
                                                    href="{{ asset('documentos/hojas_de_vida/' . $item->soporte) }}"
                                                    target="_blank">{{ $item->soporte }}</a></td>
                                            <td class="text-center" style="min-width: 100px;">
                                                <form
                                                    action="{{ route('mi_hoja_de_vida-experienciaindp-eliminar', ['id' => $item->id]) }}"
                                                    class="d-inline form-eliminar" method="POST">
                                                    @csrf @method("delete")
                                                    <button type="submit"
                                                        class="btn-accion-tabla eliminar tooltipsC text-danger"
                                                        title="Eliminar este registro">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                        <div class="col-12 mb-2 mt-3">
                            <div class="row d-flex justify-content-around w-100">
                                <div class="col-12 pl-4">
                                    <h6 style="text-decoration: underline;">Tiempo total de experiencia y situación laboral
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3 table-responsive pb-3" style="border-bottom: 0.5px solid gray">
                            <table class="table table-striped table-bordered table-hover"
                                style="width: 100%; font-size: 1.2em;">
                                <thead style="background-color: rgb(205, 207, 209)">
                                    <tr>
                                        <th scope="col" class="text-center" rowspan="2" style="vertical-align: middle;">
                                            <strong>Ocupación</strong>
                                        </th>
                                        <th scope="col" class="text-center" colspan="3"><strong>Tiempo de
                                                experiencia</strong></th>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="text-center"><strong>Años</strong></th>
                                        <th scope="col" class="text-center"><strong>Meses</strong></th>
                                        <th scope="col" class="text-center"><strong>Dias</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th><strong>Sector Público</strong></th>
                                        <td class="text-center" id="secPubAnnos_f">{{ $respuesta['secPubAnnos_f'] }}
                                        </td>
                                        <td class="text-center" id="secPubMeses_f">{{ $respuesta['secPubMeses_f'] }}
                                        </td>
                                        <td class="text-center" id="secPubDias_f">{{ $respuesta['secPubDias_f'] }}</td>
                                    </tr>
                                    <tr>
                                        <th><strong>Sector Privado</strong></th>
                                        <td class="text-center" id="secPrivAnnos_f">{{ $respuesta['secPrivAnnos_f'] }}
                                        </td>
                                        <td class="text-center" id="secPrivMeses_f">{{ $respuesta['secPrivMeses_f'] }}
                                        </td>
                                        <td class="text-center" id="secPrivDias_f">{{ $respuesta['secPrivDias_f'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><strong>Trabajador Independiente</strong></th>
                                        <td class="text-center" id="secIndpAnnos_f">{{ $respuesta['secIndpAnnos_f'] }}
                                        </td>
                                        <td class="text-center" id="secIndpMeses_f">{{ $respuesta['secIndpMeses_f'] }}
                                        </td>
                                        <td class="text-center" id="secIndpDias_f">{{ $respuesta['secIndpDias_f'] }}
                                        </td>
                                    </tr>
                                    <tr style="background-color: rgb(205, 207, 209)">
                                        <th><strong>Total tiempo de experiencia</strong></th>
                                        <td class="text-center" id="annos_total_f">
                                            <strong>{{ $respuesta['annos_total_f'] }} Años</strong>
                                        </td>
                                        <td class="text-center" id="meses_total_f">
                                            <strong>{{ $respuesta['meses_total_f'] }} Meses</strong>
                                        </td>
                                        <td class="text-center" id="dias_total_f">
                                            <strong>{{ $respuesta['dias_total_f'] }}
                                                Dias</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <span class="d-none" id="empleado_id"
                                data_url="{{ route('hojas_de_vida-calcularTiempoLaboral', ['id' => $empleado->id]) }}">{{ $empleado->id }}</span>
                        </div>
                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                    </div>
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
    <script src="{{ asset('js/intranet/hojasvida/editar.js') }}"></script>
@endsection
<!-- ************************************************************* -->
