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

    <hr>
    <div class="row">
        <div class="col-12">
            @include('includes.error-form')
            @include('includes.mensaje')
        </div>
    </div>
    <!-- *********************************************************************************************************************************** -->

    <section class="content">
        <div class="row d-flex justify-content-between">
            <div class="col-12 col-md-3">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title text-center">Estadistica de Tareas</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-9">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Listado de tareas</h3>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-hover table-sm display">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center text-nowrap" scope="col">Componente</th>
                                    <th class="text-center text-nowrap" scope="col">Responsable</th>
                                    <th class="text-center text-nowrap" scope="col">Titulo</th>
                                    <th class="text-center text-nowrap" scope="col">Fecha de creación</th>
                                    <th class="text-center text-nowrap" scope="col">Fecha límite</th>
                                    <th class="text-center text-nowrap" scope="col">Progreso</th>
                                    <th class="text-center text-nowrap" scope="col">Estado</th>
                                    <th class="text-center text-nowrap" scope="col">Impacto</th>
                                    <th class="text-center text-nowrap" scope="col">Objetivo</th>
                                    <th class="text-center text-nowrap"></th>
                                </tr>
                            </thead>
                            <tbody style="overflow-x: auto;">
                                @foreach ($proyectos as $proyecto)
                                    @foreach ($proyecto->componentes as $componente)
                                        @foreach ($componente->tareas->sortBy('id') as $tarea)
                                            @if ($tarea->progreso < 100)
                                                @if ($tarea->responsable_id == session('id_usuario') ||
                                                $empleado->lider) <tr>
                                                <td
                                                class="text-nowrap">{{ $componente->titulo }}</td>
                                                <td class="text-nowrap">
                                                {{ ucfirst(strtolower($tarea->responsable->usuario->nombres)) . ' ' . ucfirst(strtolower($tarea->responsable->usuario->apellidos)) }}
                                                </td>
                                                <td class="text-nowrap">{{ $tarea->titulo }}</td>
                                                <td class="text-center">{{ $tarea->fec_creacion }}
                                                </td>
                                                <td
                                                class="text-center">{{ $tarea->fec_limite }}</td>
                                                <td class="text-center">{{ $tarea->progreso }}
                                                %</td>
                                                <td class="text-center">{{ $tarea->estado }}</td>
                                                <td class="text-center">{{ $tarea->impacto }}</td>
                                                <td style="min-width: 400px;max-width:
                                                400px;">{{ $tarea->objetivo }}
                                                </td>
                                                <td>
                                                <a
                                                href="{{ route('proyecto-tareas-index', ['id' => $tarea->id]) }}"
                                                class="btn-accion-tabla text-primary" title="Gestionar
                                                tarea"><i
                                                class="fas fa-eye mr-2"></i></a>
                                                </td>
                                                </tr> @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
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
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    {!! $calendar->script() !!}

    <script>
        $(function() {

            var dataTareas = {
                labels: [
                    'Vigentes',
                    'Por Vencer',
                    'Vencidas',
                ],
                datasets: [{
                    data: [ <?php echo $valoresTareas[
                        'tareasVige']; ?> , <?php
                        echo $valoresTareas['tareasProx']; ?> , <?php
                        echo $valoresTareas['tareasVenc']; ?>
                    ],
                    backgroundColor: ['#00a65a', '#f39c12', '#f56954'],
                }]
            }
            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = dataTareas;
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var pieChart = new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })


        })

    </script>



@endsection
<!-- ************************************************************* -->
