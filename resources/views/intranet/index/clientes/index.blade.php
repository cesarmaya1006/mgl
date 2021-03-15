<div class="row d-flex justify-content-around">
    <div class="col-10">
        <div class="row d-flex justify-content-around">
            <div class="col-6 col-md-2 col-lg-2 pl-2 pr-2">
                <div class="row">
                    <div class="col-12 text-center pl-4 pr-4"><a href="{{route('archivo-index')}}"><img class="img-fluid" src="{{asset('imagenes/sistema/ICONO1.png')}}"></a></div>
                </div>
                <div class="row">
                    <div class="col-12 text-center"><h6><strong>Archivo</strong></h6></div>
                </div>
                <div class="row">
                    <div class="col-12 text-center pl-2 pr-2">
                        <p>Archive y gestione sus procesos de recursos humanos y contratación</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-2 col-lg-2 pl-2 pr-2">
                <div class="row">
                    <div class="col-12 text-center pl-4 pr-4"><a href="{{route('procesos_listado')}}"><img class="img-fluid" src="{{asset('imagenes/sistema/ICONO3.png')}}"></a></div>
                </div>
                <div class="row">
                    <div class="col-12 text-center"><h6><strong>Procesos Judiciales</strong></h6></div>
                </div>
                <div class="row">
                    <div class="col-12 text-center pl-2 pr-2">
                        <p>consulte y gestione sus procesos judiciales y administrativos</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-2 col-lg-2 pl-2 pr-2">
                <div class="row">
                    <div class="col-12 text-center pl-4 pr-4"><a href="{{route('consultas_solicitudes-index')}}"><img class="img-fluid" src="{{asset('imagenes/sistema/ICONO2.png')}}"></a></div>
                </div>
                <div class="row">
                    <div class="col-12 text-center"><h6><strong>Consultas y Solicitudes</strong></h6></div>
                </div>
                <div class="row">
                    <div class="col-12 text-center pl-2 pr-2">
                        <p>Consulte y tenga el apoyo de nuestro equipo de abogados</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-2 col-lg-2 pl-2 pr-2">
                <div class="row">
                    <div class="col-12 text-center pl-4 pr-4"><a href="{{route('proyecto-index',['id'=>session('id_usuario')])}}"><img class="img-fluid" src="{{asset('imagenes/sistema/15 proyectos.png')}}"></a></div>
                </div>
                <div class="row">
                    <div class="col-12 text-center"><h6><strong>Gestión de Proyectos</strong></h6></div>
                </div>
                <div class="row">
                    <div class="col-12 text-center pl-2 pr-2">
                        <p>Gestione y haga seguimiento a sus proyectos</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-2 col-lg-2 pl-2 pr-2">
                <div class="row">
                    <div class="col-12 text-center pl-4 pr-4"><a href="#"><img class="img-fluid" src="{{asset('imagenes/sistema/ICONO4.png')}}"></a></div>
                </div>
                <div class="row">
                    <div class="col-12 text-center"><h6><strong>Diagnósticos Legales</strong></h6></div>
                </div>
                <div class="row">
                    <div class="col-12 text-center pl-2 pr-2">
                        <p>Haga seguimiento al estado legal de su empresa u organización</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-2 col-lg-2 pl-2 pr-2">
                <div class="row">
                    <div class="col-12 text-center pl-4 pr-4"><a href="{{route('boletines-index')}}"><img class="img-fluid" src="{{asset('imagenes/sistema/ICONO6.png')}}"></a></div>
                </div>
                <div class="row">
                    <div class="col-12 text-center"><h6><strong>Boletines de Actualización</strong></h6></div>
                </div>
                <div class="row">
                    <div class="col-12 text-center pl-2 pr-2">
                        <p>Consulte cambios normativos y las implicaciones para su empresa u organización</p>
                    </div>
                </div>
            </div>
            <!-- <div class="col-6 col-md-2 col-lg-2 pl-2 pr-2">
                <div class="row">
                    <div class="col-12 text-center pl-4 pr-4"><a href="#"><img class="img-fluid" src="{{asset('imagenes/sistema/ICONO7.png')}}"></a></div>
                </div>
                <div class="row">
                    <div class="col-12 text-center"><h6><strong>Publicaciones</strong></h6></div>
                </div>
                <div class="row">
                    <div class="col-12 text-center pl-2 pr-2">
                        <p>Publique anuncios para sus trabajadores y/o colaboradores</p>
                    </div>
                </div>
            -->
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row d-flex justify-content-around">
    <div class="col-12 text-center">
        <h4>Procesos judiciales Asociados a la Empresa</h4>
    </div>
    <div class="col-11">
        {!! $procesos->links() !!}
    </div>
    <div class="col-11 table-responsive">
        <table class="table">
            <thead>
                <tr>
                  <th scope="col" class="text-center" style="vertical-align: middle;">id</th>
                  <th scope="col" class="text-center" style="vertical-align: middle;">Estado Notificaci&oacute;n</th>
                  <th scope="col" class="text-center" style="vertical-align: middle;">Fecha Notificaci&oacute;n</th>
                  <th scope="col" class="text-center" style="vertical-align: middle;">Fecha Conocimiento Jurídico</th>
                  <th scope="col" class="text-center" style="vertical-align: middle;">C&oacute;digo Proceso</th>
                  <th scope="col" class="text-center" style="vertical-align: middle;">Tipo de Proceso</th>
                  <th scope="col" class="text-center" style="vertical-align: middle;">Cliente</th>
                  <th scope="col" class="text-center" style="vertical-align: middle;">Apoderado</th>
                  <th scope="col" class="text-center" style="vertical-align: middle;">Asistente</th>
                  <th scope="col" class="text-center" style="vertical-align: middle;">Fecha de Admisi&oacute;n</th>
                  <th scope="col" class="text-center" style="vertical-align: middle;">Fecha de radicaci&oacute;n</th>
                  <th scope="col" class="text-center" style="vertical-align: middle;">Juzgado</th>
                  <th scope="col" class="text-center" style="vertical-align: middle;">Cuantía</th>
                  <th scope="col" class="text-center" style="vertical-align: middle;">Demandantes</th>
                  <th scope="col" class="text-center" style="vertical-align: middle;">Demandados</th>
                  <th scope="col" class="text-center" style="vertical-align: middle;">Riesgo Pérdida</th>
                  <th class="width70" style="vertical-align: middle;">Opciones</th>
                </tr>
              </thead>
              <tbody id="contenido_tabla_list_procesos">
                  @if (session('rol_id')<3)
                  @foreach ($procesos as $proceso)
                  <tr>
                      <td style="white-space:nowrap;" class="text-center">{{$proceso->id}}</td>
                      <td style="white-space:nowrap;" class="text-center">{{$proceso->estado_notifi}}</td>
                      @if ($proceso->fecha_notifi!=NULL)
                      <td style="white-space:nowrap;" class="text-center">{{$proceso->fecha_notifi}}</td>
                      @else
                      <td style="white-space:nowrap;" class="text-center">{{'---'}}</td>
                      @endif
                      @if ($proceso->fecha_conoci_juridi!=NULL)
                      <td style="white-space:nowrap;" class="text-center">{{$proceso->fecha_conoci_juridi}}</td>
                      @else
                      <td style="white-space:nowrap;" class="text-center">{{'---'}}</td>
                      @endif
                      <td style="white-space:nowrap;" class="text-center">{{$proceso->codigo_unico_proceso}}</td>
                      <td style="white-space:nowrap;" class="text-center">{{$proceso->tipos_proceso->tipo_proceso}}</td>
                      <td style="white-space:nowrap;">
                      @foreach ($proceso->clientes_proceso as $cliente)
                      <p>{{$cliente->nombres.' '.$cliente->apellidos}}</p>
                      @endforeach
                      </td>
                      <td style="white-space:nowrap;">
                      @foreach ($proceso->apoderados_proceso as $apoderado)
                      <p>{{$apoderado->nombres.' '.$apoderado->apellidos}}</p>
                      @endforeach
                      </td>
                      <td style="white-space:nowrap;">
                      @foreach ($proceso->asistentes_proceso as $asistente)
                      <p>{{$asistente->nombres.' '.$asistente->apellidos}}</p>
                      @endforeach
                      </td>
                      @if ($proceso->fecha_admin!=NULL)
                      <td style="white-space:nowrap;" class="text-center">{{$proceso->fecha_admin}}</td>
                      @else
                      <td style="white-space:nowrap;" class="text-center">{{'---'}}</td>
                      @endif
                      @if ($proceso->fecha_radicacion!=NULL)
                      <td style="white-space:nowrap;" class="text-center">{{$proceso->fecha_radicacion}}</td>
                      @else
                      <td style="white-space:nowrap;" class="text-center">{{'---'}}</td>
                      @endif
                      <td style="white-space:nowrap;">{{$proceso->juzgados->despacho}}</td>
                      <td style="white-space:nowrap;" class="text-right">{{'$ '.number_format($proceso->cuantia, 2, '.', ',')}}</td>
                      <td style="white-space:nowrap;">
                      @foreach ($proceso->demandantes as $demandante)
                      <p>{{$demandante->nombres}}</p>
                      @endforeach
                      </td>
                      <td style="white-space:nowrap;">
                          @foreach ($proceso->demandados as $demandado)
                          <p>{{$demandado->nombres}}</p>
                          @endforeach
                          </td>
                          <td style="white-space:nowrap;">{{$proceso->riesgos_perdida->riesgo_perdida}}</td>
                      <td style="text-align: center;vertical-align: middle;">
                          <a href="{{route('procesos_detalle', ['id' => $proceso->id])}}" class="btn-accion-tabla tooltipsC" title="Detalles del proceso">
                              <i class="fas fa-search-plus"></i>
                          </a>
                          <a href="{{route('procesos_editar', ['id' => $proceso->id])}}" class="btn-accion-tabla tooltipsC text-warning" title="Editar proceso">
                              <i class="fas fa-edit"></i>
                          </a>
                      </td>
                  </tr>
                  @endforeach
                  @elseif(session('rol_id')==3)
                  @foreach ($procesos as $proceso)
                  @foreach ($proceso->apoderados_proceso as $apoderado)
                  @if ($apoderado->id == session('id_usuario'))
                  <tr>
                      <td style="white-space:nowrap;" class="text-center">{{$proceso->id}}</td>
                      <td style="white-space:nowrap;" class="text-center">{{$proceso->estado_notifi}}</td>
                      @if ($proceso->fecha_notifi!=NULL)
                      <td style="white-space:nowrap;" class="text-center">{{$proceso->fecha_notifi}}</td>
                      @else
                      <td style="white-space:nowrap;" class="text-center">{{'---'}}</td>
                      @endif
                      @if ($proceso->fecha_conoci_juridi!=NULL)
                      <td style="white-space:nowrap;" class="text-center">{{$proceso->fecha_conoci_juridi}}</td>
                      @else
                      <td style="white-space:nowrap;" class="text-center">{{'---'}}</td>
                      @endif
                      <td style="white-space:nowrap;" class="text-center">{{$proceso->codigo_unico_proceso}}</td>
                      <td style="white-space:nowrap;" class="text-center">{{$proceso->tipos_proceso->tipo_proceso}}</td>
                      <td style="white-space:nowrap;">
                      @foreach ($proceso->clientes_proceso as $cliente)
                      <p>{{$cliente->nombres.' '.$cliente->apellidos}}</p>
                      @endforeach
                      </td>
                      <td style="white-space:nowrap;">
                      @foreach ($proceso->apoderados_proceso as $apoderado)
                      <p>{{$apoderado->nombres.' '.$apoderado->apellidos}}</p>
                      @endforeach
                      </td>
                      <td style="white-space:nowrap;">
                      @foreach ($proceso->asistentes_proceso as $asistente)
                      <p>{{$asistente->nombres.' '.$asistente->apellidos}}</p>
                      @endforeach
                      </td>
                      @if ($proceso->fecha_admin!=NULL)
                      <td style="white-space:nowrap;" class="text-center">{{$proceso->fecha_admin}}</td>
                      @else
                      <td style="white-space:nowrap;" class="text-center">{{'---'}}</td>
                      @endif
                      @if ($proceso->fecha_radicacion!=NULL)
                      <td style="white-space:nowrap;" class="text-center">{{$proceso->fecha_radicacion}}</td>
                      @else
                      <td style="white-space:nowrap;" class="text-center">{{'---'}}</td>
                      @endif
                      <td style="white-space:nowrap;">{{$proceso->juzgados->despacho}}</td>
                      <td style="white-space:nowrap;" class="text-right">{{'$ '.number_format($proceso->cuantia, 2, '.', ',')}}</td>
                      <td style="white-space:nowrap;">
                      @foreach ($proceso->demandantes as $demandante)
                      <p>{{$demandante->nombres}}</p>
                      @endforeach
                      </td>
                      <td style="white-space:nowrap;">
                          @foreach ($proceso->demandados as $demandado)
                          <p>{{$demandado->nombres}}</p>
                          @endforeach
                          </td>
                          <td style="white-space:nowrap;">{{$proceso->riesgos_perdida->riesgo_perdida}}</td>
                      <td style="text-align: center;vertical-align: middle;">
                          <a href="{{route('procesos_detalle', ['id' => $proceso->id])}}" class="btn-accion-tabla tooltipsC" title="Detalles del proceso">
                              <i class="fas fa-search-plus"></i>
                          </a>
                          <a href="{{route('procesos_editar', ['id' => $proceso->id])}}" class="btn-accion-tabla tooltipsC text-warning" title="Editar proceso">
                              <i class="fas fa-edit"></i>
                          </a>
                      </td>
                  </tr>
                  @endif
                  @endforeach
                  @endforeach
                  @endif
              </tbody>
        </table>
    </div>
</div>
<hr>
<div class="row d-flex justify-content-around">
    <div class="col-12">
        <div id="empelados" style="height: 370px; width: 100%;"></div>
    </div>
    <div class="col-12 col-md-4">
        <div id="consultasSolicitudes" style="height: 370px; width: 100%;"></div>
    </div>
</div>
<script>
    window.onload = function () {
        var chart = new CanvasJS.Chart("empelados", {
            animationEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title: {
                text: "Estadistica Empleados"
            },axisY: {
                title: "Numero de Consultas"
                },

                data: [{type: "column",

                dataPoints: <?php echo json_encode($empleados, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
        //-----------------------------------------------------------------------------
        var chart = new CanvasJS.Chart("consultasSolicitudes", {
            animationEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title: {
                text: "Consultas y Solicitudes"
            },axisY: {
                title: "Numero de Consultas"
                },

                data: [{type: "column",

                dataPoints: <?php echo json_encode($consultas, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
    }
</script>
