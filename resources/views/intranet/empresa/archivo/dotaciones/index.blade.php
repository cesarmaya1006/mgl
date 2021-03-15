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
                    <h5>Entrega de dotación, elementos de trabajo y de protección</h5>
                </div>
                <div class="col-12 col-md-6 col-lg-6 text-md-right text-lg-right pl-2 pr-md-5 pr-lg-5">
                    @if (session('rol_id') < 3)
                        <a href="{{ route('archivo-indexclientes', ['id' => $id]) }}"
                            class="btn btn-info btn-sm text-center pl-3 pr-3 mr-3"><i
                                class="fas fa-undo-alt mr-2"></i>Volver</a>
                    @else
                        <a href="{{ route('archivo-index') }}" class="btn btn-info btn-sm text-center pl-3 pr-3 mr-3"><i
                                class="fas fa-undo-alt mr-2"></i>Volver</a>
                    @endif
                </div>
            </div>
            <!--
                                    <hr>
                                    <div class="row row d-flex justify-content-around mt-3">
                                        <div class="col-10 col-md-5">
                                            <div class="form-group">
                                              <label for="">Filtrar por Apellido</label>
                                              <input type="text" name="apellido" id="apellido" class="form-control" data_url="{{ route('soportes_afiliacion-filtar') }}" ruta_editar="{{ route('dotaciones-editar', ['id' => 1]) }}" placeholder="" aria-describedby="helpId">
                                            </div>
                                        </div>
                                    </div>
                                    -->
            <hr>
            <div class="row d-flex justify-content-around mt-3 mb-5" id="listado_empleados">
                <div class="col-10 col-md-6 col-lg-8 table-responsive">
                    <table class="table table-striped table-bordered table-hover table-sm display">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">Cargo</th>
                                <th class="text-center" scope="col">Identificacion</th>
                                <th class="text-center" scope="col">Empleado</th>
                                <th class="text-center" scope="col">Editar</th>
                            </tr>
                        </thead>
                        <tbody id="contenido_tabla">
                            @foreach ($empleados as $empleado)
                                <tr>
                                    <td>{{ $empleado->cargo->cargo }}</td>
                                    <td>{{ $empleado->usuario->identificacion }}</td>
                                    <td>{{ $empleado->usuario->nombres . ' ' . $empleado->usuario->apellidos }}</td>
                                    <td class="text-center"><a
                                            href="{{ route('dotaciones-editar', ['id' => $empleado->id]) }}"
                                            class="btn-accion-tabla eliminar tooltipsC"><i
                                                class="fas fa-folder-open text-info"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    <script src="{{ asset('js/intranet/empresas/archivo/soportes.js') }}"></script>
@endsection
<!-- ************************************************************* -->
