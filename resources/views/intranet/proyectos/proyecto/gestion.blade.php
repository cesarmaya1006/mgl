@extends("theme.back.plantilla")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
    @include('includes.funciones_php')
@endsection
<!-- titulo hoja -->
@section('estilosHojas')
    <!-- Pagina CSS -->

@endsection
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('tituloHoja')
    Modulo Proyectos
@endsection
<!-- ************************************************************* -->
<!-- ************************************************************* -->
<!-- Cuerpo hoja -->
@section('cuerpo_pagina')
    <div class="card" style="border-top: 8px solid rgb(38, 160, 241);">
        @include('includes.error-form')
        @include('includes.mensaje')
        <div class="card-header pb-5" style="font-size: 1em;">
            <div class="row mb-3">
                <div class="col-12 col-md-10 text-md-left pl-2 d-flex flex-row">
                    <h4>Gestión Proyecto - {{ $proyecto->titulo }}</h4>
                    <a href="" class="btn-accion-tabla text-info ml-4" title="Editar proyecto"><i class="fas fa-edit"
                            style="font-size: 1.5em"></i></a>
                </div>
                <div class="col-12 col-md-2 text-md-right pl-2 pr-md-5">
                    <a href="{{ route('proyecto-gestion-inter', ['id' => $proyecto->id]) }}"
                        class="btn btn-info btn-xs btn-sombra text-center btn-xs pl-3 pr-3 mr-3"><i
                            class="fas fa-undo-alt mr-2"></i>Volver</a>
                </div>
            </div>
            <hr>
            <!-- Datos Proyecto  -->
            <div class="row">
                <div class="col-12">
                    <h5><strong>Datos de proyecto</strong></h5>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 pr-md-3">
                    <div class="row">
                        <div class="col-4 text-right"><strong>Lider del proyecto:</strong></div>
                        <div class="col-8">
                            {{ $proyecto->lider->usuario->nombres . ' ' . $proyecto->lider->usuario->apellidos }}</div>
                    </div>
                </div>
                <div class="col-12 col-md-6 pl-md-3">
                    <div class="row">
                        <div class="col-4 text-right"><strong>Objetivo principal:</strong></div>
                        <div class="col-8 text-justify">{{ $proyecto->objetivo }}</div>
                    </div>
                </div>
                <div class="col-12 col-md-6 pr-md-3">
                    <div class="row">
                        <div class="col-4 text-right"><strong>Fecha de creación:</strong></div>
                        <div class="col-8">{{ $proyecto->fec_creacion }}</div>
                    </div>
                </div>
                <div class="col-12 col-md-6 pl-md-3">
                    <div class="row">
                        <div class="col-4 text-right"><strong>Estado:</strong></div>
                        <div
                            class="col-8 {{ $proyecto->estado == 'Nuevo' ? 'text-success' : ($proyecto->estado == 'En curso' ? 'text-indigo' : ($proyecto->estado == 'Extendido' ? 'text-danger' : '')) }}">
                            <strong>{{ $proyecto->estado }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 pr-md-3">
                    <div class="row">
                        <div class="col-4 text-right"><strong>Progreso:</strong></div>
                        <?php
                        switch ($proyecto->progreso) {
                        case 0:
                        $color = 'indigo';
                        break;
                        case $proyecto->progreso <= 25: $color='navy' ; break; case $proyecto->progreso <= 50:
                                $color='dodgerblue' ; break; case $proyecto->progreso <= 75: $color='aquamarine' ; break;
                                    default: $color='lime' ; break; } $porcentaje1=$proyecto->progreso;
                                    $porcentaje2 = 100 - $porcentaje1;
                                    $red = 0;
                                    $green = ($porcentaje1 * 255) / 100;
                                    $blue = ($porcentaje2 * 255) / 100;
                                    ?>
                                    <div class="col-8" style="color: {{ $color }}">
                                        {{ number_format($proyecto->progreso, 2, ',', '.') }} %
                                    </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 pl-md-3">
                    <div class="row">
                        <div class="col-4 text-right"><strong>Tiempo gestión:</strong></div>
                        <?php
                        $date1 = new DateTime($proyecto->fec_creacion);
                        $date2 = new DateTime(Date('Y-m-d'));
                        $diff = date_diff($date1, $date2);
                        $differenceFormat = '%a';
                        ?>
                        <div class="col-8"><strong>{{ $diff->format($differenceFormat) }} días</strong></div>
                    </div>
                </div>
            </div>
            <hr>
            <!-- Involucrados Proyecto  -->
            <div class="row">
                <div class="col-12 mt-2 mb-3">
                    <h5><strong>Asignados al proyecto</strong></h5>
                </div>
                <div class="col-12 col-md-4 table-responsive">
                    <table class="table table-light table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="2">Personal asignado al proyecto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proyecto->empleados as $empleado)
                                <tr>
                                    <td class="text-capitalize">
                                        {{ $empleado->cargo->cargo }}
                                    </td>
                                    <td>{{ ucfirst(strtolower($empleado->usuario->nombres)) . ' ' . ucfirst(strtolower($empleado->usuario->apellidos)) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-12 col-md-4 table-responsive">
                    <table class="table table-light table-sm tabla-clientes" id="tabla_clientes">
                        <thead class="thead-light">
                            <tr>
                                <th>Clientes <a id="anexar_cliente"
                                        class="btn-accion-tabla text-success ml-4 position-absolute end-0 mr-3"
                                        title="Anexar cliente" style="cursor: pointer;"><i
                                            class="fas fa-plus-square mr-2"></i></a></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proyecto->clientes as $cliente)
                                <tr>
                                    <td>{{ ucfirst(strtolower($cliente->nombre)) }}
                                        <form
                                            action="{{ route('proyecto-gestion_cliente-borrar', ['id_cli' => $cliente->id, 'id_pro' => $proyecto->id]) }}"
                                            class="d-inline form-eliminar position-absolute end-0 mr-3" method="POST">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="btn-accion-tabla eliminar tooltipsC"
                                                title="Eliminar este registro"><i
                                                    class="fas fa-trash-alt text-danger"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-12 col-md-4 table-responsive">
                    <table class="table table-light table-sm tabla-proveedores" id="tabla_proveedores">
                        <thead class="thead-light">
                            <tr>
                                <th>Proveedores <a id="anexar_proveedor"
                                        class="btn-accion-tabla text-success ml-4 position-absolute end-0 mr-3"
                                        title="Anexar proveedor" style="cursor: pointer;"><i
                                            class="fas fa-plus-square mr-2"></i></a></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proyecto->proveedores as $proveedor)
                                <tr>
                                    <td>{{ ucfirst(strtolower($proveedor->nombre)) }}
                                        <form
                                            action="{{ route('proyecto-gestion_proveedor-borrar', ['id_cli' => $proveedor->id, 'id_pro' => $proyecto->id]) }}"
                                            class="d-inline form-eliminar position-absolute end-0 mr-3" method="POST">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="btn-accion-tabla eliminar tooltipsC"
                                                title="Eliminar este registro"><i
                                                    class="fas fa-trash-alt text-danger"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <!-- Modulos Proyecto  -->
            <div class="row">
                <div class="col-12 mt-2 mb-3 d-flex flex-row">
                    <h5><strong>Componentes</strong></h5>
                    <a href="{{ route('proyecto-componente-crear', ['id' => $proyecto->id]) }}"
                        class="btn btn-success btn-sm text-center pl-3 pr-3 position-absolute end-0 mr-3"
                        style="font-size: 0.9em;"><i class="fas fa-plus-circle mr-2"></i> Nuevo componente</a>
                </div>
                <!-- Modulo 1  -->
                <!-- ******************************************************************************************  -->
                @foreach ($proyecto->componentes as $componente)

                    <div class="col-12">
                        <div class="card collapsed-card"
                            style="border-top: 5px solid <?php semaforoImpacto($componente->impacto); ?>;">
                            <div class="card-header text-black">
                                <h6 class="card-title">{{ $componente->titulo }}</h6>
                                <a href="{{ route('proyecto-componente-editar', ['id' => $componente->id]) }}"
                                    class="btn-accion-tabla text-primary ml-4 position-absolute end-0 mr-5"
                                    title="Editar Componente" style="cursor: pointer;"><i class="fas fa-edit fa-2x mr-5"
                                        style="font-size: 1.3em;"></i></a>
                                <div class="card-tools">
                                    <button type="button" class="btn-accion-tabla text-dark" data-card-widget="collapse"><i
                                            class="fas fa-plus"></i></button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: none;">
                                <div class="row mb-3">
                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-4 text-right"><strong>Responsable:</strong></div>
                                            <div class="col-8">
                                                {{ $componente->responsable->usuario->nombres . ' ' . $componente->responsable->usuario->apellidos }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 text-right"><strong>Cargo:</strong></div>
                                            <div class="col-8">
                                                {{$componente->responsable->cargo->cargo }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 text-right"><strong>Fecha d creación:</strong></div>
                                            <div class="col-8">{{ $componente->fec_creacion }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 text-right"><strong>Estado:</strong></div>
                                            <div class="col-8">{{ $componente->estado }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 text-right"><strong>Impacto:</strong></div>
                                            <div class="col-8">{{ $componente->impacto }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-4 text-right"><strong>Porcentaje de avance:</strong></div>
                                            <div class="col-8">
                                                {{ number_format(intval($componente->progreso), 2, ',', '.') }} %</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 text-right"><strong>Objetivo:</strong></div>
                                            <div class="col-8">
                                                <p class="text-justify">{{ $componente->objetivo }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-4 pl-4 w-100">
                                    <div class="col-12">
                                        <strong>Tareas</strong>
                                        <a href="{{ route('proyecto-tareas-crear', ['id' => $componente->id]) }}"
                                            class="btn btn-success btn-xs btn-sombra text-center pl-3 pr-3 float-md-right"><i class="fas fa-plus-circle mr-2"></i> Nueva
                                            tarea</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped table-hover table-sm">
                                            <thead>
                                                <tr>
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
                                                @foreach ($componente->tareas as $tarea)
                                                    <tr>
                                                        <td>{{ ucfirst(strtolower($tarea->responsable->usuario->nombres)) . ' ' . ucfirst(strtolower($tarea->responsable->usuario->apellidos)) }}
                                                        </td>
                                                        <td>{{ $tarea->titulo }}</td>
                                                        <td class="text-center">{{ $tarea->fec_creacion }}</td>
                                                        <td class="text-center">{{ $tarea->fec_limite }}</td>
                                                        <td class="text-center">{{ $tarea->progreso }} %</td>
                                                        <td class="text-center">{{ $tarea->estado }}</td>
                                                        <td class="text-center">{{ $tarea->impacto }}</td>
                                                        <td>{{ $tarea->objetivo }}</td>
                                                        <td>
                                                            <a href="{{ route('proyecto-tareas-index', ['id' => $tarea->id]) }}"
                                                                class="btn-accion-tabla text-primary"
                                                                title="Gestionar tarea"><i class="fas fa-eye mr-2"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                @endforeach
                <!-- ******************************************************************************************  -->
            </div>
            <hr>
            <!-- Estadisticas Proyecto  -->
            <div class="row">
                <div class="col-12 mt-2 mb-3">
                    <h5><strong>Estadísticas</strong></h5>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- *********************************************************************************************************************************** -->
    <!-- Modales -->
    <!-- -------------------------------------------------------------------------------------- -->
    <!-- Modal Clientes -->
    <div class="modal fade" id="clientesModal" tabindex="-1" aria-labelledby="clientesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="clientesModalLabel">Anexar cliente al proyecto</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="empresacliente_id"></label>
                        <select id="empresacliente_id" name="empresacliente_id" class="form-control form-control-sm"
                            name="">
                            @foreach ($clientes as $cliente)
                                <?php $insertar = 0; ?>
                                @foreach ($proyecto->clientes as $item)
                                    <?php if ($cliente->id == $item->id) {
                                    $insertar = 1;
                                    } ?>
                                @endforeach
                                @if ($insertar == 0)
                                    <option value="{{ $cliente->id }}" id="{{ $cliente->id }}">
                                        {{ $cliente->nombre }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <small id="helpId" class="form-text text-muted">Elija un cliente</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="submit_nuevoCliente"
                        data_url="{{ route('proyecto-gestion_cliente-nuevo', ['id' => $proyecto->id]) }}"
                        data_token="{{ csrf_token() }}" type="button" class="btn btn-success btn-xs">Anexar
                        Cliente</button>
                </div>
            </div>
        </div>
    </div>
    <!-- -------------------------------------------------------------------------------------- -->
    <!-- Modal Proveedores -->
    <div class="modal fade" id="proveedoresModal" tabindex="-1" aria-labelledby="proveedoresModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="proveedoresModalLabel">Anexar proveedor al proyecto</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="proyecto_proveedor_id"></label>
                        <select id="proyecto_proveedor_id" name="proyecto_proveedor_id" class="form-control form-control-sm"
                            name="">
                            @foreach ($proveedores as $proveedor)
                                <?php $insertar = 0; ?>
                                @foreach ($proyecto->proveedores as $item)
                                    <?php if ($proveedor->id == $item->id) {
                                    $insertar = 1;
                                    } ?>
                                @endforeach
                                @if ($insertar == 0)
                                    <option value="{{ $proveedor->id }}" id="{{ $proveedor->id }}">
                                        {{ $proveedor->nombre }}</option>
                                @endif
                            @endforeach
                        </select>
                        <small id="helpId" class="form-text text-muted">Elija un proveedor</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="submit_nuevoProveedor"
                        data_url="{{ route('proyecto-gestion_proveedor-nuevo', ['id' => $proyecto->id]) }}"
                        data_token="{{ csrf_token() }}" type="button" class="btn btn-success btn-xs">Anexar
                        Proveedor</button>
                </div>
            </div>
        </div>
    </div>
    <!-- -------------------------------------------------------------------------------------- -->
    <!-- *********************************************************************************************************************************** -->
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
    <script src="{{ asset('js/intranet/proyectos/gestion.js') }}"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light1",
                title: {
                    text: "Estado de componentes",
                    fontSize: 20,
                },
                dataPointMaxWidth: 60,
                axisY: {
                    title: "Cumplimiento en %",
                    maximum: 100,
                },
                data: [{
                    type: "column",
                    yValueFormatString: "##0.## ",
                    titleFontSize: 5,
                    dataPoints: <?php echo json_encode($dataPoints,
                    JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }

    </script>
@endsection
<!-- ************************************************************* -->
