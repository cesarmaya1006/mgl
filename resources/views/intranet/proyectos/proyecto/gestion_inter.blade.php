<?php
$tareasVige = 0;
$tareasProx = 0;
$tareasVenc = 0;
?>
@foreach ($proyecto->componentes as $componente)
    @foreach ($componente->tareas as $tarea)
        <?php
        //-------------------------------------------------
        $date1 = new DateTime($tarea->fec_creacion);
        $date2 = new DateTime($tarea->fec_limite);
        $diff = date_diff($date1, $date2);
        $differenceFormat = '%a';
        $diasTotalTarea = $diff->format($differenceFormat);
        if($diasTotalTarea==0){$diasTotalTarea=1;}
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
                @if ($porcVenc > 80) <?php $tareasProx++; ?>
            @else
                <?php $tareasVige++; ?> @endif
            @endif
        @else
            @if ($tarea->responsable_id == session('id_usuario'))
                @if ($tarea->fec_limite < date('Y-m-d'))
                    <?php $tareasVenc++; ?>
                @else
                    <?php $porcVenc = ($diasGestionTarea * 100) / $diasTotalTarea; ?>
                    @if ($porcVenc > 80) <?php $tareasProx++; ?>
                @else
                    <?php $tareasVige++; ?> @endif
                @endif
            @endif
        @endif
    @endforeach
@endforeach
@extends("theme.back.plantilla")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php') @include('includes.funciones_php') @endsection
<!-- titulo hoja -->
@section('estilosHojas')
    <!-- Pagina CSS -->
<link rel="stylesheet" href="{{ asset('css/proyectos/proyectos.css') }}"> @endsection
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('tituloHoja') Modulo Proyectos @endsection
<!-- ************************************************************* -->
<!-- ************************************************************* -->
<!-- Cuerpo hoja -->
@section('cuerpo_pagina')
    <hr>
    <div class="row">
        <div class="col-12">
            @include('includes.error-form') @include('includes.mensaje')
        </div>
    </div>
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detalles Proyecto</h3>
                <a href="{{ route('proyecto-interfaz') }}"
                    class="btn btn-accion-tabla text-primary position-absolute end-0 mr-5"><i class="fas fa-reply fa-2x"
                        aria-hidden="true"></i></a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                        <div class="row d-flex justify-content-around">
                            <div class="col-4 col-md-3">
                                <p class="text-sm">Estado Proyecto
                                    <b class="d-block">{{ $proyecto->estado }} </b>
                                </p>
                            </div>
                            <div class="col-4 col-md-3">
                                <p class="text-sm">Progreso Proyecto
                                    <b class="d-block">{{ number_format($proyecto->progreso, 2, ',', '.') }} %</b>
                                </p>
                            </div>
                            <div class="col-4 col-md-3">
                                <p class="text-sm">Días de Gestión
                                    <?php
                                    $date1 = new DateTime($proyecto->fec_creacion);
                                    $date2 = new DateTime(Date('Y-m-d'));
                                    $diff = date_diff($date1, $date2);
                                    $differenceFormat = '%a';
                                    ?>
                                    <b class="d-block">{{ $diff->format($differenceFormat) }} días</b>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Tareas estado normal</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{ $tareasVige }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Tareas proximas a
                                            vencer</span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">{{ $tareasProx }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Tareas vencidas</span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">{{ $tareasVenc }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h5>Actividad Reciente</h5>
                                <!-- *************************************** -->
                                <!-- Activiadad Reciente -->
                                <?php $cantBordeComp = 0; ?>
                                @foreach ($proyecto->componentes as $componente)
                                    <?php $cantBordeComp++; ?>
                                    <div class="row mt-4"
                                        style="{{ $cantBordeComp > 1 ? 'border-bottom: 2px solid black' : '' }}">
                                        <div class="col-12 d-flex flex-row pb-2" style="border-bottom: 1px outset grey">
                                            <h6 class="mr-5">
                                                {{ $componente->titulo }}</h6>
                                            <div class="project_progress" style="width: 25%;">
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-green" role="progressbar"
                                                        aria-volumenow="{{ $componente->progreso }}" aria-volumemin="0"
                                                        aria-volumemax="100" style="width: {{ $componente->progreso }}%">
                                                    </div>
                                                </div>
                                                <small>
                                                    {{ number_format($componente->progreso, 2, ',', '.') }} %
                                                </small>
                                            </div>
                                        </div>
                                        <?php $cantBorde = 0; ?>
                                        @foreach ($componente->tareas as $tarea)
                                            <?php $cantBorde++; ?>
                                            <div class="col-12 pl-3 pt-3 {{ $cantBorde > 1 ? 'border-top' : '' }}">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h6>{{ $tarea->titulo }}</h6>
                                                        <div class="project_progress" style="width: 25%;">
                                                            <div class="progress progress-sm">
                                                                <div class="progress-bar bg-gradient-blue"
                                                                    role="progressbar"
                                                                    aria-volumenow="{{ $tarea->progreso }}"
                                                                    aria-volumemin="0" aria-volumemax="100"
                                                                    style="width: {{ $tarea->progreso }}%">
                                                                </div>
                                                            </div>
                                                            <small>
                                                                {{ number_format($tarea->progreso, 2, ',', '.') }} %
                                                            </small>
                                                        </div>
                                                    </div>
                                                    @if ($tarea->historiales->count() > 0)
                                                        <?php $cantHistoriales = 1; ?>
                                                        @foreach ($tarea->historiales as $historial)
                                                            @if ($cantHistoriales < 2)
                                                                <div class="col-12">
                                                                    <div class="post">
                                                                        <div class="user-block">
                                                                                        <img class="img-circle img-bordered-sm"
                                                                                            title="{{ $historial->usuhistorial->usuario->nombres . ' ' . $historial->usuhistorial->usuario->apellidos }}"
                                                                                            src="{{ asset('imagenes/hojas_de_vida/' . $historial->usuhistorial->foto) }}"
                                                                                            alt="{{ $historial->usuhistorial->usuario->nombres . ' ' . $historial->usuhistorial->usuario->apellidos }}">

                                                                            <span
                                                                                class="username">{{ $historial->usuhistorial->usuario->nombres . ' ' . $historial->usuhistorial->usuario->apellidos }}</span>
                                                                            <span
                                                                                class="description">{{ $historial->titulo }}
                                                                                -
                                                                                {{ $historial->fecha . '  ' . Date('H:i:s', strtotime($historial->created_at)) }}</span>
                                                                            <span class="description">
                                                                                {{ $historial->resumen }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <?php $cantHistoriales++; ?>
                                                        @endforeach
                                                    @else
                                                        <div class="col-12">Tarea sin historial</div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                                <!-- *************************************** -->
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                        <h4 class="text-primary">{{ $proyecto->titulo }}</h4>
                        <p class="text-muted">{{ $proyecto->objetivo }}</p>
                        <br>
                        <div class="text-muted">
                            @if ($proyecto->clientes->count() > 0)
                                <p class="text-sm">Clientes:
                                    @foreach ($proyecto->clientes as $cliente)
                                        <b class="d-block">{{ $cliente->nombre }}</b>
                                        <span style="font-size: 0.8em">Tel: {{ $cliente->telefono }}</span>
                                    @endforeach
                                </p>
                            @endif
                            @if ($proyecto->proveedores->count() > 0)
                                <p class="text-sm">Proveedores:
                                    @foreach ($proyecto->proveedores as $proveedor)
                                        <b class="d-block">{{ $proveedor->nombre }}</b>
                                        <span style="font-size: 0.8em">Tel: {{ $proveedor->telefono }}</span>
                                    @endforeach
                                </p>
                            @endif
                            <p class="text-sm">Lider del proyecto
                                <b
                                    class="d-block">{{ $proyecto->lider->usuario->nombres . ' ' . $proyecto->lider->usuario->apellidos }}</b>
                                <span style="font-size: 0.8em">
                                    {{ $proyecto->lider->cargo->cargo }}
                                </span>
                            </p>
                            @if ($proyecto->empleados->count() > 0)
                                <p class="text-sm">Equipo de trabajo:
                                    @foreach ($proyecto->empleados as $empleado)
                                        @if ($empleado->id != $proyecto->lider_id)
                                            <b
                                                class="d-block">{{ $empleado->usuario->nombres . ' ' . $empleado->usuario->apellidos }}</b>
                                            <span style="font-size: 0.8em">
                                                {{ $empleado->cargo->cargo }}
                                            </span>
                                        @endif
                                    @endforeach
                                </p>
                            @endif
                        </div>
                        <div class="text-center mt-5 mb-3">
                            <a href="{{ route('proyecto-gestion', ['id' => $proyecto->id]) }}"
                                class="btn btn-sm btn-primary btn-xs pl-3 pr-3 ">Gestionar Proyecto</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>

    <!-- *********************************************************************************************************************************** -->
    <!-- *********************************************************************************************************************************** -->
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
    <script src="{{ asset('js/admin/proyectos/index.js') }}"></script>
@endsection
<!-- ************************************************************* -->
