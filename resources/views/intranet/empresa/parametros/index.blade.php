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
    <div class="row">
        <div class="col-12 col-md-6 mb-3 pl-4">
            <h5>Parametros Administrativos</h5>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-7 pr-3 pl-3 mb-5 table-responsive border-bottom border-3 border-secondary pb-5">
            <table class="table display">
                <thead>
                    <tr>
                        <th>Niveles <a
                                href="{{ route('admin-param_hojas_de_vida-crear_nivel', ['id' => $empleado->empresa->id]) }}"
                                class="btn-accion-tabla position-absolute end-0 mr-5 text-success" title="Nuevo Registro">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i></a></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleado->empresa->niveles as $nivel)
                        <tr>
                            <td>{{ $nivel->nivel }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-12 col-md-7 pr-3 pl-3 mb-5 table-responsive border-bottom border-3 border-secondary pb-5">
            <table class="table display">
                <thead>
                    <tr>
                        <th>Areas <a
                                href="{{ route('admin-param_hojas_de_vida-crear_area', ['id' => $empleado->empresa->id]) }}"
                                class="btn-accion-tabla position-absolute end-0 mr-5 text-success" title="Nuevo Registro">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i></a></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleado->empresa->niveles as $nivel)
                        @foreach ($nivel->areas as $area)
                            <tr>
                                <td>{{ $area->area }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-12 col-md-7 pr-3 pl-3 mb-5 table-responsive border-bottom border-3 border-secondary pb-5">
            <table class="table display">
                <thead>
                    <tr>
                        <th>Cargos <a
                                href="{{ route('admin-param_hojas_de_vida-crear_cargo', ['id' => $empleado->empresa->id]) }}"
                                class="btn-accion-tabla position-absolute end-0 mr-5 text-success" title="Nuevo Registro">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i></a></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleado->empresa->niveles as $nivel)
                        @foreach ($nivel->areas as $area)
                            @foreach ($area->cargos as $cargo)
                                <tr>
                                    <td>{{ $cargo->cargo }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>
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
