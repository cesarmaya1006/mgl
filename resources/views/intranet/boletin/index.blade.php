@extends("theme.back.plantilla")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
    @include('includes.funciones_php')
@endsection
<!-- titulo hoja -->
@section('estilosHojas')
    <!-- Pagina CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin/hojavida/boletines.css') }}">
@endsection
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('tituloHoja')
    Historial de Boletines
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
                    <h5>Listado de Boletines</h5>
                </div>
            </div>
            <div class="row d-flex justify-content-around pt-3 mb-3">
                <div class="col-10 table-responsive">
                    <table class="table table-striped table-bordered table-hover table-sm display">
                        <thead>
                            <tr>
                                <th scope="col">Fecha</th>
                                <th scope="col">Titulo</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Imagen</th>
                                <th scope="col">Documento</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($boletines as $boletin)
                                <tr>
                                    <td>{{ $boletin->created_at }}</td>
                                    <td style="white-space: normal;max-width: 200px;">{{ $boletin->titulo }}</td>
                                    <td class="d-flex flex-nowrap" style="white-space: normal;max-width: 200px;">
                                        {{ $boletin->descripcion }}</td>
                                    <td><img class="img-fluid" src="{{ asset('imagenes/noticias/' . $boletin->foto) }}"
                                            style="width: 100%; height: auto; max-width: 150px;"></td>
                                    <td><a
                                            href="{{ asset('documentos/noticias/' . $boletin->documento) }}">{{ $boletin->nombre_doc }}</a>
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
@section('scripts_pagina')
    <script src="{{ asset('js/admin/hojasvida/index.js') }}"></script>
@endsection
<!-- ************************************************************* -->
