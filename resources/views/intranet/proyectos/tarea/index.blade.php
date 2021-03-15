@extends("theme.back.plantilla")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
    @include('includes.funciones_php')
@endsection
<!-- titulo hoja -->
@section('estilosHojas')
    <!-- Pagina CSS -->
    <link rel="stylesheet" href="{{ asset('css/proyectos/proyectos.css') }}">
@endsection
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('tituloHoja')
    Componente Proyectos
@endsection
<!-- ************************************************************* -->
<!-- ************************************************************* -->
<!-- Cuerpo hoja -->
@section('cuerpo_pagina')
    <div class="card" style="border-top: 8px solid rgb(38, 160, 241);">
        @include('includes.error-form')
        @include('includes.mensaje')
        <div class="card-header pb-5">
            <div class="row mb-3">
                <div class="col-12 col-md-6 col-lg-6 text-md-left text-lg-left pl-2">
                    <h4>Tarea: {{ $tarea->titulo }}</h4>
                </div>
                <div class="col-12 col-md-6 col-lg-6 text-md-right text-lg-right pl-2 pr-md-5 pr-lg-5">
                    <a href="{{ route('proyecto-gestion', ['id' => $tarea->componente->proyecto->id]) }}"
                        class="btn btn-info btn-xs text-center pl-5 pr-5"><i class="fas fa-undo-alt mr-2"></i>Volver</a>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <h6><strong>Datos Proyecto</strong></h6>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <table class="table table-row table-sm">
                        <tbody>
                            <tr>
                                <td class="text-right">Proyecto:</td>
                                <td class="text-left">{{ $tarea->componente->proyecto->titulo }}</td>
                            </tr>
                            <tr>
                                <td class="text-right">Responsable:</td>
                                <td class="text-left">
                                    {{ $tarea->componente->proyecto->lider->nombres . ' ' . $tarea->componente->proyecto->lider->apellidos }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right">Personal asignado:</td>
                                <td class="text-left text-uppercase">
                                    @foreach ($tarea->componente->proyecto->empleados as $empleado)
                                        {{ $empleado->nombres . ' ' . $empleado->apellidos }} <br>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right">Clientes:</td>
                                <td class="text-left">
                                    @foreach ($tarea->componente->proyecto->clientes as $cliente)
                                        {{ $cliente->nombre }} <br>
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 col-md-6">
                    <table class="table table-row table-sm">
                        <tbody>
                            <tr>
                                <td class="text-right">Proveedores:</td>
                                <td class="text-left">
                                    @foreach ($tarea->componente->proyecto->proveedores as $proveedor)
                                        {{ $proveedor->nombre }} <br>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right">Fecha Creación:</td>
                                <td class="text-left">{{ $tarea->componente->proyecto->fec_creacion }}</td>
                            </tr>
                            <tr>
                                <td class="text-right">Días de Gestión:</td>
                                <?php
                                $date1 = new DateTime($tarea->componente->proyecto->fec_creacion);
                                $date2 = new DateTime(Date('Y-m-d'));
                                $diff = date_diff($date1, $date2);
                                $differenceFormat = '%a';
                                ?>
                                <td class="text-left" style="vertical-align: middle;">
                                    {{ $diff->format($differenceFormat) }}
                                    días</td>
                            </tr>
                            <tr>
                                <td class="text-right">Procentaje de Avance</td>
                                <td class="text-left">
                                    {{ number_format($tarea->componente->proyecto->progreso, 2, ',', '.') }} %</td>
                            </tr>
                            <tr>
                                <td class="text-right">Componentes:</td>
                                <td class="text-justify">{{ $tarea->componente->proyecto->componentes->count() }}</td>
                            </tr>
                            <tr>
                                <td class="text-right">Tareas:</td>
                                <td class="text-justify">
                                    <?php $cantTareas = 0; ?>
                                    @foreach ($tarea->componente->proyecto->componentes as $componente)
                                        <?php $cantTareas += $componente->tareas->count(); ?>
                                    @endforeach
                                    {{ $cantTareas }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right">Objetivo:</td>
                                <td class="text-justify">{{ $tarea->componente->proyecto->objetivo }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <h6><strong>Datos Componente</strong></h6>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <table class="table table-row table-sm">
                        <tbody>
                            <tr>
                                <td class="text-right">Componente:</td>
                                <td class="text-left">{{ $tarea->componente->titulo }}</td>
                            </tr>
                            <tr>
                                <td class="text-right">Responsable:</td>
                                <td class="text-left">
                                    {{ $tarea->componente->responsable->nombres . ' ' . $tarea->componente->responsable->apellidos }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right">Fecha de Creación:</td>
                                <td class="text-left">{{ $tarea->componente->fec_creacion }}</td>
                            </tr>
                            <tr>
                                <td class="text-right">Tareas:</td>
                                <td class="text-left">{{ $tarea->componente->tareas->count() }}</td>
                            </tr>
                            <tr>
                                <td class="text-right">Impacto:</td>
                                <td class="text-left">{{ $tarea->componente->impacto }}</td>
                            </tr>
                            <tr>
                                <td class="text-right">Estado:</td>
                                <td class="text-left">{{ $tarea->componente->estado }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 col-md-6">
                    <table class="table table-row table-sm">
                        <tbody>
                            <tr>
                                <td class="text-right">Progreso:</td>
                                <td class="text-left">
                                    {{ number_format(intval($tarea->componente->progreso), 2, ',', '.') }}
                                    %</td>
                            </tr>
                            <tr>
                                <td class="text-right">Dias de gestión:</td><?php
                                $date1 = new DateTime($tarea->componente->fec_creacion);
                                $date2 = new DateTime(Date('Y-m-d'));
                                $diff = date_diff($date1, $date2);
                                $differenceFormat = '%a';
                                ?>
                                <td class="text-left" style="vertical-align: middle;">
                                    {{ $diff->format($differenceFormat) }} días</td>
                            </tr>
                            <tr>
                                <td class="text-right">Objetivo:</td>
                                <td class="text-left">{{ $tarea->componente->objetivo }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <h6><strong>Datos Tarea</strong></h6>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <table class="table table-row table-sm">
                        <tbody>
                            <tr>
                                <td class="text-right">Titulo tarea:</td>
                                <td class="text-left text-capitalize">{{ $tarea->titulo }}</td>
                            </tr>
                            <tr>
                                <td class="text-right">Responsable:</td>
                                <td class="text-left">
                                    {{ $tarea->responsable->nombres . ' ' . $tarea->responsable->apellidos }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right">Fecha de Creación:</td>
                                <td class="text-left">{{ $tarea->fec_creacion }}</td>
                            </tr>
                            <tr>
                                <td class="text-right">Fecha limite:</td>
                                <td class="text-left">{{ $tarea->fec_limite }}</td>
                            </tr>
                            <tr>
                                <td class="text-right">Impacto:</td>
                                <td class="text-left">{{ $tarea->impacto }}</td>
                            </tr>
                            <tr>
                                <td class="text-right">Estado:</td>
                                <td class="text-left">{{ $tarea->estado }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 col-md-6">
                    <table class="table table-row table-sm">
                        <tbody>
                            <tr>
                                <td class="text-right">Progreso:</td>
                                <td class="text-left">{{ number_format($tarea->progreso, 2, ',', '.') }} %</td>
                            </tr>
                            <tr>
                                <td class="text-right">Dias de gestión:</td>
                                <?php
                                $date1 = new DateTime($tarea->fec_creacion);
                                $date2 = new DateTime(Date('Y-m-d'));
                                $diff = date_diff($date1, $date2);
                                $differenceFormat = '%a';
                                ?>
                                <td class="text-left" style="vertical-align: middle;">
                                    {{ $diff->format($differenceFormat) }} días</td>
                            </tr>
                            <tr>
                                <td class="text-right">Objetivo:</td>
                                <td class="text-left">{{ $tarea->objetivo }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                <div class="col-12 d-flex flex-row">
                    <h6><strong>Historial de la tarea</strong></h6>
                    @if ($tarea->progreso < 100)
                        <a href="{{ route('proyecto-historiales-crear', ['id' => $tarea->id]) }}"
                            class="btn btn-success btn-sm text-center pl-3 pr-3 position-absolute end-0 mr-3"
                            style="font-size: 0.9em;"><i class="fas fa-plus-circle mr-2"></i> Nuevo historial</a>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped table-hover table-sm display">
                        <thead class="thead-light">
                            <tr>
                                <td>id</td>
                                <td>Titulo</td>
                                <td>Fecha</td>
                                <td>Usuario historial</td>
                                <td>Usuario asignado</td>
                                <td>Avance Progresivo</td>
                                <td>Resumen</td>
                                <td>Documentos</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tarea->historiales as $historial)
                                <tr>
                                    <td>{{ $historial->id }}</td>
                                    <td class="text-left">{{ $historial->titulo }}</td>
                                    <td>{{ $historial->fecha }}</td>
                                    <td class="text-left">
                                        {{ $historial->usuhistorial->usuario->nombres . ' ' . $historial->usuhistorial->usuario->apellidos }}
                                    </td>
                                    <td class="text-left">
                                        {{ $historial->asignado->usuario->nombres . ' ' . $historial->asignado->usuario->apellidos }}
                                    </td>
                                    <td>{{ $historial->progreso }} %</td>
                                    <td class="text-left">{{ $historial->resumen }}</td>
                                    <td class="d-flex flex-column">
                                        @foreach ($historial->documentos as $documento)
                                            <span><a href="{{ asset('documentos/doc_historial/' . $documento->documento) }}"
                                                    target="_blank"
                                                    rel="noopener noreferrer">{{ $documento->nombre }}</a></span>
                                        @endforeach
                                    </td>
                                    <td><a href="{{ route('proyecto-historiales-crear_doc', ['id' => $historial->id]) }}"
                                            class="btn btn-accion-tabla btn-xs text-success"><i class="fas fa-file-upload"
                                                aria-hidden="true"></i></a></td>
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
    <script src="{{ asset('js/admin/proyectos/proveedores/index.js') }}"></script>
@endsection
<!-- ************************************************************* -->
