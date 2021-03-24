@extends("theme.back.plantilla")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
    @include('includes.funciones_php')
@endsection
<!-- titulo hoja -->
@section('estilosHojas')
    <!-- Pagina CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin/hojavida/index.css') }}">
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
                <div class="col-12 col-md-6">
                    <h5>Nueva Hoja de Vida</h5>
                </div>
                <div class="col-12 col-md-6">
                    <a href="{{ route('hojas_de_vida-index', ['id' => $id]) }}"
                        class="btn btn-info btn-xs btn-sombra text-center pl-4 pr-4 float-md-right mr-md-4"><i
                            class="fas fa-reply mr-3"></i>
                        Volver</a>
                </div>
            </div>
            <div class="row d-flex justify-content-around mt-5 mb-5">
                <div class="col-11 col-md-10 col-lg-10">
                    <form class="row d-flex justify-content-between"
                        action="{{ route('hojas_de_vida-guardar', ['id' => $id]) }}" method="post">
                        @csrf
                        @method('post')
                        <div class="col-12 col-md-1 form-group">
                            <input class="form-check-input" type="checkbox" value="lider" id="lider" name="lider">
                            <label class="form-check-label requerido" for="lider">
                                Líder
                            </label>
                        </div>
                        <div class="col-12 col-md-2 form-group">
                            <label for="nivel_id">Área</label>
                            <select class="form-control form-control-sm" id="nivel_id"
                                data_url="{{ route('cargar_areas') }}">
                                <option value="">Seleccione un nivel</option>
                                @foreach ($niveles as $nivel)
                                    <option value="{{ $nivel->id }}">{{ $nivel->nivel }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-3 form-group">
                            <label for="area_id">Nivel</label>
                            <select class="form-control form-control-sm" id="area_id"
                                data_url="{{ route('cargar_cargos') }}">
                                <option value="">Seleccione un primero nivel</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-3 form-group">
                            <label for="hv_cargo_id">Cargo</label>
                            <select class="form-control form-control-sm" name="hv_cargo_id" id="hv_cargo_id" required>
                                <option value="">Seleccione primero un área</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-3 form-group">
                            <label for="tipo">Tipo</label>
                            <select class="form-control form-control-sm" name="tipo" id="tipo" required>
                                <option value="1">Colaborador</option>
                                <option value="2">Administrador</option>
                                <option value="3">Super-Administrador</option>
                            </select>
                        </div>
                        <div class="col-3 col-md-1 form-group">
                            <label class="requerido" for="tipo_docu_id">T. Doc.</label>
                            <select class="form-control form-control-sm" name="tipo_docu_id" id="tipo_docu_id" required>
                                @foreach ($tipos_doc as $item)
                                    <option value="{{ $item->id }}">{{ $item->abreb_id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-8 col-md-2 form-group">
                            <label class="requerido" for="identificacion">Identificaci&oacute;n</label>
                            <input type="text" class="form-control form-control-sm" name="identificacion"
                                id="identificacion" value="{{ old('identificacion') }}" required>
                        </div>
                        <div class="col-12 col-md-4 form-group">
                            <label class="requerido" for="nombres">Nombres</label>
                            <input type="text" class="form-control form-control-sm" name="nombres" id="nombres"
                                value="{{ old('nombres') }}" required>
                        </div>
                        <div class="col-12 col-md-4 form-group">
                            <label class="requerido" for="apellidos">Apellidos</label>
                            <input type="text" class="form-control form-control-sm" name="apellidos" id="apellidos"
                                value="{{ old('apellidos') }}" required>
                        </div>
                        <div class="col-12 col-md-3 form-group">
                            <label class="requerido" for="email">Correo Electr&oacute;nico</label>
                            <input type="email" class="form-control form-control-sm" name="email" id="email" required
                                value="{{ old('email') }}">
                        </div>
                        <div class="col-12 col-md-2 form-group">
                            <label class="requerido" for="telefono">Celular</label>
                            <input type="text" class="form-control form-control-sm" name="telefono" id="telefono"
                                value="{{ old('telefono') }}" required>
                        </div>
                        <div class="col-12 col-md-2 form-group">
                            <label class="requerido" for="sexo">Sexo</label>
                            <select class="form-control form-control-sm" name="sexo" id="sexo" required>
                                <option value="Femenino">Femenino</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-2 form-group">
                            <label class="requerido" for="password">Contraseña Inicial</label>
                            <input type="password" class="form-control form-control-sm" name="password" id="password"
                                required>
                        </div>
                        <div class="col-12 col-md-2 form-group">
                            <label class="requerido" for="re_password">Re-Contraseña</label>
                            <input type="password" class="form-control form-control-sm" name="re_password" id="re_password"
                                required>
                        </div>
                        <div class="col-12 mt-5 form-group pl-4">
                            <button type="submit" class="bnt btn-primary btn-sm btn-sombra pl-5 pr-5">Guardar</button>
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
    <script src="{{ asset('js/intranet/hojasvida/crear.js') }}"></script>
@endsection
<!-- ************************************************************* -->
