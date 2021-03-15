@extends("theme.back.plantilla")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
    @include('includes.funciones_php')
@endsection
<!-- titulo hoja -->
@section('estilosHojas')
    <!-- Pagina CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin/solicitudes/index.css') }}">

@endsection
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('tituloHoja')
    Solicitudes
@endsection
<!-- ************************************************************* -->
<!-- ************************************************************* -->
<!-- Cuerpo hoja -->
@section('cuerpo_pagina')
    <div class="card" style="border-top: 8px solid rgb(38, 160, 241);">
        <div class="row d-flex justify-content-center">
            <div class="col-11 col-md-8">
                @include('includes.error-form')
                @include('includes.mensaje')
            </div>
        </div>
        <div class="card-header">
            <div class="row mb-3">
                <div class="col-12 col-md-6 col-lg-6 text-md-left text-lg-left pl-2">
                    <h5>Historial de Solicitudes</h5>
                </div>
                @if (session('rol_id') > 4)
                    <div class="col-12 col-md-6 col-lg-6 text-md-right text-lg-right pl-2">
                        <a href="{{ route('consultas_solicitudes-crear') }}"
                            class="btn btn-success btn-xs btn-sombra pl-3 pr-3"><i class="fas fa-plus-circle mr-3"></i>Nueva
                            Solicitud</a>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Solicitudes Vigentes</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-sm table-hover display">
                                <thead>
                                    <tr>
                                        <th scope="col">Fecha Solicitud</th>
                                        <th scope="col">Empresa</th>
                                        <th scope="col">Creador</th>
                                        <th scope="col">Dias Gestión</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Titulo</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($solicitudes->whereNotIn('estado', ['Cerrada']) as $solicitud)
                                        <tr>
                                            <td>{{ $solicitud->fecha_solicitud }}</td>
                                            <td>{{ $solicitud->empresa->nombre }}</td>
                                            <td>{{ $solicitud->empleado->usuario->nombres . ' ' . $solicitud->empleado->usuario->apellidos }}
                                            </td>
                                            <?php
                                            $date1 = new DateTime($solicitud->fecha_solicitud);
                                            $date2 = new DateTime(Date('Y-m-d'));
                                            $diff = date_diff($date1, $date2);
                                            $differenceFormat = '%a';
                                            ?>
                                            <td>{{ $diff->format($differenceFormat) }}</td>
                                            <td>{{ $solicitud->tipo }}</td>
                                            <td>{{ $solicitud->titulo }}</td>
                                            <td>{{ $solicitud->estado }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('consultas_solicitudes-gestionar', ['id' => $solicitud->id]) }}"
                                                    class="btn-accion-tabla eliminar tooltipsC text-info"
                                                    title="Gestionar"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            @if ($solicitudes->Where('estado', 'Cerrada')->count())
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Solicitudes Archivadas</h3>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-sm table-hover display">
                                    <thead>
                                        <tr>
                                            <th scope="col">Fecha Solicitud</th>
                                            <th scope="col">Fecha Cierre</th>
                                            <th scope="col">Empresa</th>
                                            <th scope="col">Creador</th>
                                            <th scope="col">Dias Gestión</th>
                                            <th scope="col">Tipo</th>
                                            <th scope="col">Titulo</th>
                                            <th scope="col">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($solicitudes->where('estado', 'Cerrada') as $solicitud)
                                            <tr>
                                                <td class="text-center">{{ $solicitud->fecha_solicitud }}</td>
                                                <td class="text-center">{{ $solicitud->fecha_cierre }}</td>
                                                <td>{{ $solicitud->empresa->nombre }}</td>
                                                <td>{{ $solicitud->empleado->usuario->nombres . ' ' . $solicitud->empleado->usuario->apellidos }}
                                                </td>
                                                <?php
                                                $date1 = new DateTime($solicitud->fecha_solicitud);
                                                $date2 = new DateTime(Date('Y-m-d'));
                                                $diff = date_diff($date1, $date2);
                                                $differenceFormat = '%a';
                                                ?>
                                                <td class="text-center">{{ $diff->format($differenceFormat) }}</td>
                                                <td>{{ $solicitud->tipo }}</td>
                                                <td>{{ $solicitud->titulo }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('consultas_solicitudes-ver', ['id' => $solicitud->id, 'tipo' => 'cliente']) }}"
                                                        class="btn-accion-tabla eliminar tooltipsC text-info"
                                                        title="Gestionar"><i class="fas fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- *********************************************************************************************************************************** -->
    <!-- *********************************************************************************************************************************** -->
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
    <script src="{{ asset('js/intranet/empresas/solicitudes/index.js') }}"></script>
@endsection
<!-- ************************************************************* -->
