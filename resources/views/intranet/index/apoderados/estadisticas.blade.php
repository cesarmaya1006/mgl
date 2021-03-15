<div class="row d-flex justify-content-around">
    <div class="col-11 text-center">
        <h4><strong>Estadísticas de procesos</strong></h4>
        <hr>
    </div>
    <div class="col-11">
        <section class="content" style="height: auto !important; min-height: 0px !important;">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-teal">
                        <div class="inner">
                            <?php
                            $cant_proc_activos = 0;
                            $procesos_apo = $procesos->where('estado_proceso_id', 1);
                            ?>
                            @foreach ($procesos_apo as $proceso)
                                @foreach ($proceso->apoderados_proceso as $apoderado)
                                    @if ($apoderado->id == session('id_usuario'))
                                        <?php $cant_proc_activos++; ?>
                                    @endif
                                @endforeach
                            @endforeach
                            <h3>{{ $cant_proc_activos }}</h3>

                            <p>Activos</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-orange">
                        <div class="inner">
                            <?php
                            $cant_proc_sin_not = 0;
                            $procesos_apo = $procesos->where('estado_notifi', 'Sin Notificar');
                            ?>
                            @foreach ($procesos_apo as $proceso)
                                @foreach ($proceso->apoderados_proceso as $apoderado)
                                    @if ($apoderado->id == session('id_usuario'))
                                        <?php $cant_proc_sin_not++; ?>
                                    @endif
                                @endforeach
                            @endforeach
                            <h3>{{ $cant_proc_sin_not }}</h3>

                            <p>Sin Notificar</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <?php
                            $cant_proc_fallo_fav = 0;
                            $procesos_apo = $procesos->filter(function ($procesos) {
                            return $procesos->fallo_1era == 'A Favor' || $procesos->fallo_2da == 'A Favor' ||
                            $procesos->fallo_3era == 'A Favor';
                            });
                            ?>
                            @foreach ($procesos_apo as $proceso)
                                @foreach ($proceso->apoderados_proceso as $apoderado)
                                    @if ($apoderado->id == session('id_usuario'))
                                        <?php $cant_proc_fallo_fav++; ?>
                                    @endif
                                @endforeach
                            @endforeach
                            <h3>{{ $cant_proc_fallo_fav }}</h3>

                            <p>Fallo a favor</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-navy">
                        <div class="inner">
                            <?php
                            $cant_proc_fallo_cont = 0;
                            $procesos_apo = $procesos->filter(function ($procesos) {
                            return $procesos->fallo_1era == 'En Contra' || $procesos->fallo_2da == 'En Contra' ||
                            $procesos->fallo_3era == 'En Contra';
                            });
                            ?>
                            @foreach ($procesos_apo as $proceso)
                                @foreach ($proceso->apoderados_proceso as $apoderado)
                                    @if ($apoderado->id == session('id_usuario'))
                                        <?php $cant_proc_fallo_cont++; ?>
                                    @endif
                                @endforeach
                            @endforeach
                            <h3>{{ $cant_proc_fallo_cont }}</h3>

                            <p>Fallo en Contra</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </section>
    </div>
</div>
<div class="row d-flex justify-content-around mb-5 mt-5">
    <div class="col-11 col-md-10 mb-5">
        <div id="chartContainer_apo_1" style="height: 370px; width: 100%;"></div>
    </div>
    <div class="col-11 col-md-10 mb-5">
        <div id="chartContainer_apo_2" style="height: 370px; width: 100%;"></div>
    </div>
</div>
<br>
<div class="row d-flex justify-content-around">
    <div class="col-11 col-md-10 mb-5">
        <div id="chartContainer_apo_3" style="height: 370px; width: 100%;"></div>
    </div>
    <div class="col-11 col-md-10 mb-5">
        <div id="chartContainer_apo_4" style="height: 370px; width: 100%;"></div>
    </div>
</div>
<hr>
<div class="row d-flex justify-content-around mb-5 mt-5">
    <div class="col-11 co-md-10 col-lg-10 table-responsive">
        <table class="table table-striped table-bordered table-hover table-sm" style="max-height: 700px;">
            <thead>
                <tr>
                    <th scope="col" class="text-center" style="vertical-align: middle;">id</th>
                    <th scope="col" class="text-center" style="vertical-align: middle;">Estado Notificaci&oacute;n</th>
                    <th scope="col" class="text-center" style="vertical-align: middle;">Fecha Notificaci&oacute;n</th>
                    <th scope="col" class="text-center" style="vertical-align: middle;">Fecha Concimiento Juridico</th>
                    <th scope="col" class="text-center" style="vertical-align: middle;">C&oacute;digo Proceso</th>
                    <th scope="col" class="text-center" style="vertical-align: middle;">Tipo de Proceso</th>
                    <th scope="col" class="text-center" style="vertical-align: middle;">Cliente</th>
                    <th scope="col" class="text-center" style="vertical-align: middle;">Apoderado</th>
                    <th scope="col" class="text-center" style="vertical-align: middle;">Asistente</th>
                    <th scope="col" class="text-center" style="vertical-align: middle;">Fecha de Admici&oacute;n</th>
                    <th scope="col" class="text-center" style="vertical-align: middle;">Fecha de radicaci&oacute;n</th>
                    <th scope="col" class="text-center" style="vertical-align: middle;">Juzgado</th>
                    <th scope="col" class="text-center" style="vertical-align: middle;">Cuantia</th>
                    <th scope="col" class="text-center" style="vertical-align: middle;">Demandantes</th>
                    <th scope="col" class="text-center" style="vertical-align: middle;">Demandados</th>
                    <th scope="col" class="text-center" style="vertical-align: middle;">Riesgo Perdida</th>
                    <th class="width70" style="vertical-align: middle;">Opciones</th>
                </tr>
            </thead>
            <tbody id="contenido_tabla_list_procesos">
                @foreach ($procesos as $item)
                    @foreach ($item->apoderados_proceso as $apoderado)
                        @if ($apoderado->id == session('id_usuario'))
                            <tr>
                                <td style="white-space:nowrap;" class="text-center">{{ $item->id }}</td>
                                <td style="white-space:nowrap;" class="text-center">{{ $item->estado_notifi }}</td>
                                @if ($item->fecha_notifi != null)
                                    <td style="white-space:nowrap;" class="text-center">{{ $item->fecha_notifi }}
                                    </td>
                                @else
                                    <td style="white-space:nowrap;" class="text-center">{{ '---' }}</td>
                                @endif
                                @if ($item->fecha_conoci_juridi != null)
                                    <td style="white-space:nowrap;" class="text-center">
                                        {{ $item->fecha_conoci_juridi }}</td>
                                @else
                                    <td style="white-space:nowrap;" class="text-center">{{ '---' }}</td>
                                @endif
                                <td style="white-space:nowrap;" class="text-center">{{ $item->codigo_unico_proceso }}
                                </td>
                                <td style="white-space:nowrap;" class="text-center">
                                    {{ $item->tipos_proceso->tipo_proceso }}</td>
                                <td style="white-space:nowrap;">
                                    @foreach ($item->empresas as $cliente)
                                        <p>{{ $cliente->nombres . ' ' . $cliente->apellidos }}</p>
                                    @endforeach
                                </td>
                                <td style="white-space:nowrap;">
                                    @foreach ($item->apoderados_proceso as $apoderado)
                                        <p>{{ $apoderado->nombres . ' ' . $apoderado->apellidos }}</p>
                                    @endforeach
                                </td>
                                <td style="white-space:nowrap;">
                                    @foreach ($item->asistentes_proceso as $asistente)
                                        <p>{{ $asistente->nombres . ' ' . $asistente->apellidos }}</p>
                                    @endforeach
                                </td>
                                @if ($item->fecha_admin != null)
                                    <td style="white-space:nowrap;" class="text-center">{{ $item->fecha_admin }}</td>
                                @else
                                    <td style="white-space:nowrap;" class="text-center">{{ '---' }}</td>
                                @endif
                                @if ($item->fecha_radicacion != null)
                                    <td style="white-space:nowrap;" class="text-center">{{ $item->fecha_radicacion }}
                                    </td>
                                @else
                                    <td style="white-space:nowrap;" class="text-center">{{ '---' }}</td>
                                @endif
                                <td style="white-space:nowrap;">{{ $item->juzgados->despacho }}</td>
                                <td style="white-space:nowrap;" class="text-right">
                                    {{ '$ ' . number_format($item->cuantia, 2, '.', ',') }}</td>
                                <td style="white-space:nowrap;">
                                    @foreach ($item->demandantes as $demandante)
                                        <p>{{ $demandante->nombres }}</p>
                                    @endforeach
                                </td>
                                <td style="white-space:nowrap;">
                                    @foreach ($item->demandados as $demandado)
                                        <p>{{ $demandado->nombres }}</p>
                                    @endforeach
                                </td>
                                <td style="white-space:nowrap;">{{ $item->riesgos_perdida->riesgo_perdida }}</td>
                                <td style="text-align: center;vertical-align: middle;">
                                    <a href="{{ route('admin-procesos-detalle', ['id' => $item->id]) }}"
                                        class="btn-accion-tabla tooltipsC" title="Detalles del proceso">
                                        <i class="fas fa-search-plus"></i>
                                    </a>
                                    <a href="{{ route('admin-procesos-editar', ['id' => $item->id]) }}"
                                        class="btn-accion-tabla tooltipsC text-warning" title="Editar proceso">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer_apo_1", {
            animationEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title: {
                text: "Procesos por notificación",
                fontSize: 20,
            },
            axisY: {
                title: "Cant Procesos",
                fontSize: 10,
            },
            data: [{
                type: "column",
                dataPoints: <?php echo json_encode($respuesta_estad_apoderados_1,
                    JSON_NUMERIC_CHECK); ?> ,
                fontSize: 8,
            }]
        });
        chart.render();
        //--------------------------------------------------------
        var chart = new CanvasJS.Chart("chartContainer_apo_2", {
            animationEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title: {
                text: "Procesos por probabilidad de perdida",
                fontSize: 20,
            },
            axisY: {
                title: "Cant Procesos",
                fontSize: 10,
            },
            data: [{
                type: "column",
                dataPoints: <?php echo json_encode($respuesta_estad_apoderados_2,
                    JSON_NUMERIC_CHECK); ?> ,
                fontSize: 8,
            }]
        });
        chart.render();
        //--------------------------------------------------------
        var chart = new CanvasJS.Chart("chartContainer_apo_3", {
            animationEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title: {
                text: "Procesos por tipo",
                fontSize: 20,
            },
            axisY: {
                title: "Cant Procesos",
                fontSize: 10,
            },
            data: [{
                type: "column",
                dataPoints: <?php echo json_encode($respuesta_estad_apoderados_3,
                    JSON_NUMERIC_CHECK); ?> ,
                fontSize: 8,
            }]
        });
        chart.render();
        //--------------------------------------------------------
        var chart = new CanvasJS.Chart("chartContainer_apo_4", {
            animationEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title: {
                text: "Procesos por etapa",
                fontSize: 20
            },
            axisY: {
                title: "Cant Procesos",
                fontSize: 10
            },
            data: [{
                type: "column",
                dataPoints: <?php echo json_encode($respuesta_estad_apoderados_4,
                    JSON_NUMERIC_CHECK); ?> ,
                fontSize: 4
            }]
        });
        chart.render();

    }

</script>
