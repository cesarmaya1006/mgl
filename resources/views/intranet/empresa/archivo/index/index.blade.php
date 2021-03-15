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

    <div class="card" style="border-top: 8px solid rgb(38, 160, 241);">
        @include('includes.error-form')
        @include('includes.mensaje')
        <div class="card-header">
            <div class="row mb-3">
                <div class="col-12 col-md-6 col-lg-6 text-md-left text-lg-left pl-2">
                    <h6><strong>Documentación Laboral</strong></h6>
                </div>
            </div>
            <div class="row d-flex justify-content-around pt-3 mb-3 pl-2 pr-2">
                @foreach ($empleado->opciones->sortBy('id') as $opcion)
                    <div class="col-5 col-md-2 pl-2 pr-2">
                        <div class="row">
                            <div class="col-12 text-center pl-3 pr-3">
                                <a href="{{ route($opcion->url, ['id' => $empleado->empresa_id]) }}"><img
                                        class="img-fluid" src="{{ asset('imagenes/sistema/' . $opcion->imagen) }}"
                                        style="max-width: 150px;width: 80%;"></a>
                            </div>
                            <div class="col-12 text-center pl-3 pr-3">
                                <h6><strong>{{ $opcion->titulo }}</strong></h6>
                            </div>
                            <div class="col-12 text-center pl-3 pr-3" style="font-size: 0.8em;">
                                <p class="text-justify">{{ $opcion->contenido }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
    <script src="{{ asset('js/intranet/empresas/index.js') }}"></script>
@endsection
<!-- ************************************************************* -->
