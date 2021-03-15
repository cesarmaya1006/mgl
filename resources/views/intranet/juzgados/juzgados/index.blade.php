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
    Modulo Juzgados
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
            <h5>Juzgados</h5>
        </div>
    </div>
    <hr>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-11 table-responsive">
            <table class="table table-striped table-hover table-sm display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Jurisdicci&oacute;n</th>
                        <th>Departamento</th>
                        <th>Distrito</th>
                        <th>Circuito</th>
                        <th>Municipio</th>
                        <th>Codigo de despacho</th>
                        <th>Despacho</th>
                        <th>Juez</th>
                        <th>Correo Electronico</th>
                        <th>Direcci&oacute;n</th>
                        <th>Tel&eacute;fono</th>
                    </tr>
                </thead>
                <tbody id="contenido_tabla_data_1">
                    @foreach ($juzgados as $juzgado)
                        <tr>
                            <td>{{ $juzgado->id }}</td>
                            <td>{{ $juzgado->jurisdiccion_juzgados->jurisdiccion }}</td>
                            <td>{{ $juzgado->municipios->circuitos->distritos->departamentos->departamento }}</td>
                            <td>{{ $juzgado->municipios->circuitos->distritos->distrito }}</td>
                            <td>{{ $juzgado->municipios->circuitos->circuito }}</td>
                            <td>{{ $juzgado->municipios->municipio }}</td>
                            <td>{{ $juzgado->codigo_despacho }}</td>
                            <td style="white-space:nowrap;">{{ $juzgado->despacho }}</td>
                            <td style="white-space:nowrap;">{{ $juzgado->juez }}</td>
                            <td>{{ $juzgado->email }}</td>
                            <td>{{ $juzgado->direccion }}</td>
                            <td>{{ $juzgado->telefono }}</td>
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
