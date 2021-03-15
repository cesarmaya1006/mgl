<?php
$tareasVige = 0;
$tareasProx = 0;
$tareasVenc = 0;
?>
@extends("theme.back.plantilla")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
    @include('includes.funciones_php')
@endsection
<!-- titulo hoja -->
@section('estilosHojas')
    <!-- Pagina CSS -->
    <link rel="stylesheet" href="{{ asset('css/intranet/proyectos/index.css') }}">
    <link href="{{ asset('fullcalendar/lib/main.css') }}" rel='stylesheet' />
    <script src="{{ asset('fullcalendar/lib/main.js') }}"></script>
    <script src="{{ asset('fullcalendar/lib/locales-all.js') }}"></script>
@endsection
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('tituloHoja')
    Modulo Proyectos
    @if ($empleado->lider)
        <a href="{{ route('proyecto-crear') }}"
            class="btn btn-info btn-xs btn-sombra pl-3 pr-3 float-md-right mr-md-5 mt-3 mt-md-1"><i
                class="fa fa-plus-circle mr-2" aria-hidden="true"></i> Nuevo Proyecto</a>
    @endif
@endsection
<!-- ************************************************************* -->
<!-- ************************************************************* -->
<!-- Cuerpo hoja -->
@section('cuerpo_pagina')
    @foreach ($proyectos as $proyecto)
        @foreach ($proyecto->componentes as $componente)
            @foreach ($componente->tareas as $tarea)
                <?php
                //-------------------------------------------------
                $date1 = new DateTime($tarea->fec_creacion);
                $date2 = new DateTime($tarea->fec_limite);
                $diff = date_diff($date1, $date2);
                $differenceFormat = '%a';
                $diasTotalTarea = $diff->format($differenceFormat);
                if ($diasTotalTarea == 0) {
                $diasTotalTarea = 1;
                }
                //-------------------------------------------------
                $date1 = new DateTime($tarea->fec_creacion);
                $date2 = new DateTime(date('Y-m-d'));
                $diff = date_diff($date1, $date2);
                $differenceFormat = '%a';
                $diasGestionTarea = $diff->format($differenceFormat);

                //---------------------------------------------------
                ?>
                @if ($empleado->lider)
                    @if ($tarea->fec_limite < date('Y-m-d'))
                        <?php $tareasVenc++; ?>
                    @else
                        <?php $porcVenc = ($diasGestionTarea * 100) / $diasTotalTarea; ?>
                        @if ($porcVenc > 80 || $diasTotalTarea - $diasGestionTarea < 3) <?php $tareasProx++; ?>
                        @else
                                                                                                                                                                            <?php $tareasVige++; ?> @endif @endif
                        @else
                            @if ($tarea->responsable_id == session('id_usuario'))
                                @if ($tarea->fec_limite < date('Y-m-d'))
                                    <?php $tareasVenc++; ?>
                                @else
                                    <?php $porcVenc = ($diasGestionTarea * 100) / $diasTotalTarea; ?>
                                    @if ($porcVenc > 80) <?php $tareasProx++;
                                    ?>
                                @else
                                    <?php $tareasVige++; ?> @endif
                                @endif
                            @endif
                    @endif
                @endforeach
            @endforeach
        @endforeach
        <hr>
        <div class="row">
            <div class="col-12">
                @include('includes.error-form')
                @include('includes.mensaje')
            </div>
        </div>
        <!-- *********************************************************************************************************************************** -->

        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Proyectos</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0 table-responsive" style="display: block;">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Proyecto</th>
                                <th>Lider</th>
                                <th>Miembros de Equipo</th>
                                <th>Gestión/Días</th>
                                <th>Progreso proyecto</th>
                                <th class="text-center">Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proyectos->whereNotBetween('estado', ['Cerrado']) as $proyecto)
                                <tr>
                                    <td>{{ $proyecto->id }}</td>
                                    <td>
                                        <a
                                            href="{{ route('proyecto-gestion-inter', ['id' => $proyecto->id]) }}">{{ $proyecto->titulo }}</a>
                                        <br>
                                        <small>Creado {{ $proyecto->fec_creacion }}</small>
                                    </td>
                                    <td>
                                        @if ($proyecto->lider->foto != null)
                                            <img alt="Avatar" class="table-avatar"
                                                title="{{ $proyecto->lider->usuario->nombres . ' ' . $proyecto->lider->usuario->apellidos }}"
                                                src="{{ asset('imagenes/hojas_de_vida/' . $proyecto->lider->foto) }}">
                                        @else
                                            <img alt="Avatar" class="table-avatar"
                                                title="{{ $proyecto->lider->usuario->nombres . ' ' . $proyecto->lider->usuario->apellidos }}"
                                                src="{{ asset('imagenes/usuarios/usuario-inicial.jpg') }}">
                                        @endif
                                    </td>
                                    <td>
                                        <ul class="list-inline">
                                            @foreach ($proyecto->empleados as $empleado)
                                                <li class="list-inline-item">
                                                    @if ($empleado->id != $proyecto->lider_id)
                                                        @if ($empleado->foto != null)
                                                            <img alt="Avatar" class="table-avatar"
                                                                title="{{ $empleado->usuario->nombres . ' ' . $empleado->usuario->apellidos }}"
                                                                src="{{ asset('imagenes/hojas_de_vida/' . $empleado->foto) }}">
                                                        @else
                                                            <img alt="Avatar" class="table-avatar"
                                                                title="{{ $empleado->usuario->nombres . ' ' . $empleado->usuario->apellidos }}"
                                                                src="{{ asset('imagenes/usuarios/usuario-inicial.jpg') }}">
                                                        @endif
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        $date1 = new DateTime($proyecto->fec_creacion);
                                        $date2 = new DateTime(Date('Y-m-d'));
                                        $diff = date_diff($date1, $date2);
                                        $differenceFormat = '%a';
                                        ?>
                                        {{ $diff->format($differenceFormat) }} días

                                    </td>
                                    <td class="project_progress">
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-green" role="progressbar"
                                                aria-volumenow="{{ $proyecto->progreso }}" aria-volumemin="0"
                                                aria-volumemax="100" style="width: {{ $proyecto->progreso }}%">
                                            </div>
                                        </div>
                                        <small>
                                            {{ number_format($proyecto->progreso, 2, ',', '.') }} %
                                        </small>
                                    </td>
                                    <td class="project-state">
                                        <span
                                            class="badge {{ $proyecto->estado == 'Nuevo' ? 'badge-success' : 'badge-info' }} ">{{ $proyecto->estado }}</span>
                                    </td>
                                    <td class="project-actions text-right">
                                        <a href="{{ route('proyecto-gestion-inter', ['id' => $proyecto->id]) }}"
                                            class="btn btn-primary btn-sm pl-3 pr-3" style="font-size: 0.8em;"><i
                                                class="fas fa-folder mr-1"></i>Ver</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="8">
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                Listado de Tareas
                                            </div>
                                            <div class="col-12 table-responsive">
                                                <table class="table table-striped table-hover table-sm display">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th class="text-center" scope="col">Componente</th>
                                                            <th class="text-center" scope="col">Responsable</th>
                                                            <th class="text-center" scope="col">Titulo</th>
                                                            <th class="text-center" scope="col">Fecha de creación</th>
                                                            <th class="text-center" scope="col">Fecha límite</th>
                                                            <th class="text-center" scope="col">Progreso</th>
                                                            <th class="text-center" scope="col">Estado</th>
                                                            <th class="text-center" scope="col">Impacto</th>
                                                            <th class="text-center" scope="col">Objetivo</th>
                                                            <th class="text-center"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($proyecto->componentes as $componente)
                                                            @foreach ($componente->tareas as $tarea)
                                                                <tr>
                                                                    <td>{{ $componente->titulo }}</td>
                                                                    <td>{{ ucfirst(strtolower($tarea->responsable->usuario->nombres)) . ' ' . ucfirst(strtolower($tarea->responsable->usuario->apellidos)) }}
                                                                    </td>
                                                                    <td>{{ $tarea->titulo }}</td>
                                                                    <td class="text-center">{{ $tarea->fec_creacion }}
                                                                    </td>
                                                                    <td class="text-center">{{ $tarea->fec_limite }}</td>
                                                                    <td class="text-center">{{ $tarea->progreso }} %</td>
                                                                    <td class="text-center">{{ $tarea->estado }}</td>
                                                                    <td class="text-center">{{ $tarea->impacto }}</td>
                                                                    <td>{{ $tarea->objetivo }}</td>
                                                                    <td>
                                                                        <a href="{{ route('proyecto-tareas-index', ['id' => $tarea->id]) }}"
                                                                            class="btn-accion-tabla text-primary"
                                                                            title="Gestionar tarea"><i
                                                                                class="fas fa-eye mr-2"></i></a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- *********************************************************************************************************************************** -->
        <hr>
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-10">
                <h5>Calendario de Tareas</h5>
            </div>
            <div class="col-12 col-md-10">
                <!-- <div id='calendar'></div> -->
                {!! $calendar->calendar() !!}
            </div>
        </div>
        <!-- *********************************************************************************************************************************** -->
    @endsection
    <!-- ************************************************************* -->
    <!-- script hoja -->
    @section('scripts_pagina')
        <script src="{{ asset('js/intranet/proyectos/index.js') }}"></script>
        <script src="{{ asset('lte/plugins/chart.js/Chart.min.js') }}"></script>
        {!! $calendar->script() !!}

    @endsection
    <!-- ************************************************************* -->
