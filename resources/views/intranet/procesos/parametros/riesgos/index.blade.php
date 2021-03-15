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
    Modulo Procesos
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
            <h5>Parametrización riesgos perdidas</h5>
        </div>
    </div>
    <hr>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-11 table-responsive">
            <table class="table table-striped table-hover table-sm display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Riesgo Perdida</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($riesgos as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->riesgo_perdida }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
