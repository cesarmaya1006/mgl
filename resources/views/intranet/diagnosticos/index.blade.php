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
    Modulo Diagnosticos
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
            <h5>Diagnosticos</h5>
        </div>
        <div class="col-12 col-md-6 mb-3">
            @if (session('rol_id') < 5)
                <a href="{{ route('diagnosticos-crear') }}"
                    class="btn btn-info btn-sombra btn-xs pl-4 pr-4 float-right mr-4">
                    <i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>
                    Agregar Diagnostico
                </a>
            @endif
        </div>
    </div>
    <hr>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-11 table-responsive">
            <table class="table table-striped table-hover table-sm display">
                <thead>
                    <tr>
                        <th class="text-center">Id</th>
                        <th>Fecha</th>
                        @if (session('rol_id') < 5)
                            <th>Empresa</th>
                        @endif
                        <th>Título</th>
                        <th>Documento</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($diagnosticos as $diagnostico)
                        <tr>
                            <td>{{ $diagnostico->id }}</td>
                            <td>{{ $diagnostico->fec_creacion }}</td>
                            @if (session('rol_id') < 5)
                                <td>{{ $diagnostico->empresa->nombre }}</td>
                            @endif
                            <td>{{ $diagnostico->titulo }}</td>
                            <td><a href="{{ asset('documentos/doc_solicitudes/' . $diagnostico->documento) }}" target="_blank"
                                    rel="noopener noreferrer">{{ $diagnostico->nombre }}</a></td>
                        </tr>
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
