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
                    <h5>Permisos de acceso al sistema</h5>
                </div>
                <div class="col-12 col-md-6 col-lg-6 text-md-right text-lg-right pl-2 pr-md-5 pr-lg-5">
                    <a href="{{ route('archivo-index') }}" class="btn btn-info btn-sm text-center pl-3 pr-3 mr-3"><i
                            class="fas fa-undo-alt mr-2"></i>Volver</a>
                </div>
            </div>
            <hr>
            <div class="row d-flex justify-content-around mt-3 mb-5" id="listado_empleados">
                <div class="col-12 table-responsive">
                    @csrf
                    <table class="table table-striped table-bordered table-hover table-sm tabla-data display">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">Cargo</th>
                                <th class="text-center" scope="col">Identificacion</th>
                                <th class="text-center" scope="col">Empleado</th>
                                <th class="text-center" scope="col">Permisos Actuales</th>
                                <th class="text-center" scope="col">Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($empleados as $empleado)
                                <tr>
                                    <td class="text-nowrap">{{ $empleado->cargo->cargo }}</td>
                                    <td class="text-nowrap">{{ $empleado->usuario->identificacion }}</td>
                                    <td class="text-nowrap">
                                        {{ $empleado->usuario->nombres . ' ' . $empleado->usuario->apellidos }}</td>
                                    <td>
                                        <div class="row">
                                            @foreach ($empleado->opciones as $opcion)
                                                <div class="col-12 col-md-6">
                                                    <li>{{ $opcion->titulo }}</li>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="text-center"><a
                                            href="{{ route('permisos-editar', ['id' => $empleado->id]) }}"
                                            class="btn-accion-tabla eliminar tooltipsC"><i
                                                class="fas fa-folder-open text-info"></i></a>
                                    </td>
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
<!-- script hoja -->
@section('scripts_pagina')
    <script src="{{ asset('js/intranet/empresas/archivo/permisos.js') }}"></script>
@endsection
<!-- ************************************************************* -->
