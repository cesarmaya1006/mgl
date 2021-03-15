<!-- ----------------------------------------------------------------------------------------- -->
<!-- Editar Codigo de proceso -->
<div class="modal fade" id="cambio_cod_proceso" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle" style="1em;">Editar codigo inicial del proceso</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Codigo unico del proceso (inicial)</label>
                            <input type="text" class="form-control" name="inp_camb_codigo_unico_proceso" id="inp_camb_codigo_unico_proceso" value="{{ $proceso->codigo_unico_proceso }}" data_id_proceso="{{ $proceso->id }}">
                            <small id="helpId" class="form-text text-muted">C&oacute;digo &uacute;nico del proceso</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm pl-3 pr-3" data-dismiss="modal">Cerrar</button>
                <button type="button" id="boton_cambio_c_u_p" class="btn btn-primary btn-sm pl-3 pr-3" data-dismiss="modal" data_url="{{ route('cambio_cod_unico_proceso_ini') }}">Cambiar</button>
            </div>
        </div>
    </div>
</div>
<!-- ----------------------------------------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------------- -->
<!-- Editar Tipo de proceso -->
<div class="modal fade" id="cambio_tipo_proceso" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle" style="1em;">Editar tipo de proceso</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Codigo unico del proceso (inicial)</label>
                            <select class="form-control" name="tipo_proceso_id" id="tipo_proceso_id">
                                @foreach ($tipos_procesos as $item)
                                <option value="{{$item->id}}" @if($proceso->tipo_proceso_id== $item->id) {{'selected'}} @endif>{{$item->tipo_proceso}}</option>
                                @endforeach
                            </select>
                            <small id="helpId" class="form-text text-muted">Tipo de proceso</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm pl-3 pr-3" data-dismiss="modal">Cerrar</button>
                <button type="button" id="boton_cambio_tipo_proc" class="btn btn-primary btn-sm pl-3 pr-3" data-dismiss="modal" data_url="{{ route('cambio_tipo_proceso') }}" data_id_proceso="{{ $proceso->id }}">Cambiar</button>
            </div>
        </div>
    </div>
</div>
<!-- ----------------------------------------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------------- -->
<!-- Adicionar Cliente al proceso -->
<div class="modal fade bd-example-modal-lg" id="modal_adicionar_cliente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Elija un nuevo cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-around">
                    <div class="col-10 form-group">
                        <label class="requerido" for="cliente_id">Cliente</label>
                        <select class="form-control" name="new_cliente_proceso_id" id="new_cliente_proceso_id" required>
                            @foreach ($clientes as $cliente)
                            <option value="{{$cliente->id}}">{{$cliente->nombres}} @if($cliente->apellidos!='-') {{$cliente->apellidos}}@endif</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-10 form-group">
                        <label class="requerido" for="cliente_id">Papel del cliente</label>
                        <select class="form-control" name="new_papel_cliente_proceso_id" id="new_papel_cliente_proceso_id" required>
                            @foreach ($papel_clientes as $papel_cliente)
                            <option value="{{$papel_cliente->id}}">{{$papel_cliente->papel}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm pl-3 pr-3" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary btn-sm pl-3 pr-3" id="bnt_nuevo_cliente_proceso" data_ruta_eliminar="{{route('eliminar_cliente_proceso', ['id_cliente' => '1','id_proceso' => '1'])}}" data_url="{{ route('nuevo_cliente_proceso')}}" data_id_proceso="{{$proceso->id}}" data_token="{{ csrf_token() }}" data-dismiss="modal">Crear</button>
            </div>
        </div>
    </div>
</div>
<!-- ----------------------------------------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------------- -->
<!-- Cambiar Cliente al proceso -->
<div class="modal fade bd-example-modal-lg" id="modal_cambiar_cliente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Elija un nuevo cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-around">
                    <div class="col-10 form-group">
                        <label class="requerido" for="cliente_id">Cliente</label>
                        <select class="form-control" name="camb_cliente_id" id="camb_cliente_id" required>
                            @foreach ($clientes as $cliente)
                            <option value="{{$cliente->id}}">{{$cliente->nombres}} @if($cliente->apellidos!='-') {{$cliente->apellidos}}@endif</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm pl-3 pr-3" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary btn-sm pl-3 pr-3" id="bnt_cambiar_cliente" data_url="{{ route('cambiar_cliente_proceso')}}" data_id_proceso="{{$proceso->id}}" data-dismiss="modal">Cambiar</button>
            </div>
        </div>
    </div>
</div>
<!-- ------------------------------------------------------------------------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------------- -->
<!-- Cambiar juzgado -->
<div class="modal fade bd-example-modal-lg" id="cambio_juzgado_proceso" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Cambiar Juzgado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-around">
                    <div class="col-10 form-group">
                        <label class="requerido" for="cliente_id">Jurisdicci&oacute;n</label>
                        <select class="form-control"  id="jurisdiccion_id" data_url="{{ route('cargar_departamentos') }}" required>
                            <option>Elija una jurisdicci&oacute;n</option>
                            @foreach ($jurisdicciones as $jurisdiccion)
                            <option value="{{$jurisdiccion->id}}">{{$jurisdiccion->jurisdiccion}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-10 form-group">
                        <label class="requerido" for="departamento_id">Departamentos</label>
                        <select class="form-control"  id="departamento_id" data_url="{{ route('cargar_distritos') }}">
                            <option>Elija primero una Jurisdicci&oacute;n</option>
                        </select>
                    </div>
                    <div class="col-10 form-group">
                        <label class="requerido" for="distrito_id">Distritos</label>
                        <select class="form-control"  id="distrito_id" data_url="{{ route('cargar_circuitos') }}">
                            <option>Elija primero un departamento</option>
                        </select>
                    </div>
                    <div class="col-10 form-group">
                        <label class="requerido" for="circuito_id">Circuito</label>
                        <select class="form-control"  id="circuito_id" data_url="{{ route('cargar_municipios') }}">
                            <option>Elija primero un distrito</option>
                        </select>
                    </div>
                    <div class="col-10 form-group">
                        <label class="requerido" for="municipio_id">Municipios</label>
                        <select class="form-control"  id="municipio_id" data_url="{{ route('cargar_juzgados') }}">
                            <option>Elija primero una circuito</option>
                        </select>
                    </div>
                    <div class="col-10 form-group">
                        <label class="requerido" for="juzgado_id">Juzgados</label>
                        <select class="form-control" name="juzgado_id" id="juzgado_id">
                            <option value="">Elija primero un municipio</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm pl-3 pr-3" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary btn-sm pl-3 pr-3" id="bnt_cambiar_juzgado" data_url="{{ route('cambiar_juzgado_proceso')}}" data_id_proceso="{{$proceso->id}}" data-dismiss="modal">Cambiar</button>
            </div>
        </div>
    </div>
</div>
<!-- ------------------------------------------------------------------------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------------- -->
<!-- Cambiar Estado de notificacion -->
<div class="modal fade bd-example-modal-lg" id="cambio_est_not_proceso" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Cambiar Estado y fecha de notificacion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-around">
                    <div class="col-10 form-group">
                        <label class="requerido" for="cliente_id">Cliente</label>
                        <input class="form-control" type="date" name="fecha_notifi" id="fecha_notifi" max="{{date('Y-m-d')}}" value="{{$proceso->fecha_notifi}}">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm pl-3 pr-3" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary btn-sm pl-3 pr-3" id="bnt_cambiar_estado_noti_proceso" data_url="{{ route('cambiar_estado_notificacion_proceso')}}" data_id_proceso="{{$proceso->id}}" data-dismiss="modal">Cambiar</button>
            </div>
        </div>
    </div>
</div>
<!-- ------------------------------------------------------------------------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------------- -->
<!-- Cambiar Estado de conocimiento juridico -->
<div class="modal fade bd-example-modal-lg" id="cambio_con_jur_proceso" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Cambiar Estado y fecha de conocimiento jur&iacute;dico</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-around">
                    <div class="col-10 form-group">
                        <label class="requerido" for="cliente_id">Cliente</label>
                        <input class="form-control" type="date" name="fecha_conoci_juridi" id="fecha_conoci_juridi" max="{{date('Y-m-d')}}" value="{{$proceso->fecha_conoci_juridi}}">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm pl-3 pr-3" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary btn-sm pl-3 pr-3" id="bnt_cambiar_estado_con_jur_proceso" data_url="{{ route('cambiar_estado_con_jur_proceso')}}" data_id_proceso="{{$proceso->id}}" data-dismiss="modal">Cambiar</button>
            </div>
        </div>
    </div>
</div>
<!-- ------------------------------------------------------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------------------------------------------------------- -->
<!-- Nuevo demandado -->
<div class="modal fade bd-example-modal-lg" id="nuevo_demandado_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Adicionar demandado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label class="requerido" for="tipo_docu_id">Tipo Doc.</label>
                            <select class="form-control"  id="tipo_docu_id" name="tipo_docu_id">
                                <option value="">Elija tipo</option>
                                @foreach ($tipos_identificacion as $tipo)
                                <option value="{{$tipo->id}}">{{$tipo->abreb_id}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="form-group">
                            <label for="identificacion">Identificaci&oacute;n</label>
                            <input type="text" class="form-control" name="identificacion" id="identificacion">
                            <small id="helpId" class="form-text text-muted">Num. Documento</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="nombres">Nombres</label>
                            <input type="text" class="form-control" name="nombres" id="nombres">
                            <small id="helpId" class="form-text text-muted">Nombres del demandado</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="email">Correo electr&oacute;nico</label>
                            <input type="email" class="form-control" name="email" id="email">
                            <small id="helpId" class="form-text text-muted">Correo electr&oacute;nico</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="telefono">Tel&eacute;fono</label>
                            <input type="text" class="form-control" name="telefono" id="telefono">
                            <small id="helpId" class="form-text text-muted">Tel&eacute;fono</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="direccion">Direcci&oacute;n</label>
                            <input type="text" class="form-control" name="direccion" id="direccion">
                            <small id="helpId" class="form-text text-muted">Direcci&oacute;n</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm pl-3 pr-3" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary btn-sm pl-3 pr-3" id="bnt_nuevo_demandado_proceso" data_url="{{ route('nuevo_demandado_proceso')}}" data_id_proceso="{{$proceso->id}}" ruta_eliminar_demandado="{{route('eliminar_demandado_proceso', ['id_demandado' => '1'])}}"  data_token="{{ csrf_token() }}" data-dismiss="modal">Cambiar</button>
            </div>
        </div>
    </div>
</div>
<!-- ------------------------------------------------------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------------------------------------------------------- -->
<!-- Nuevo demandante -->
<div class="modal fade bd-example-modal-lg" id="nuevo_demandante_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Adicionar demandante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label class="requerido" for="tipo_docu_id_2">Tipo Doc.</label>
                            <select class="form-control"  id="tipo_docu_id_2" name="tipo_docu_id_2">
                                <option value="">Elija tipo</option>
                                @foreach ($tipos_identificacion as $tipo)
                                <option value="{{$tipo->id}}">{{$tipo->abreb_id}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="form-group">
                            <label for="identificacion_2">Identificaci&oacute;n</label>
                            <input type="text" class="form-control" name="identificacion_2" id="identificacion_2">
                            <small id="helpId" class="form-text text-muted">Num. Documento</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="nombres_2">Nombres</label>
                            <input type="text" class="form-control" name="nombres_2" id="nombres_2">
                            <small id="helpId" class="form-text text-muted">Nombres del demandante</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="email_2">Correo electr&oacute;nico</label>
                            <input type="email" class="form-control" name="email_2" id="email_2">
                            <small id="helpId" class="form-text text-muted">Correo electr&oacute;nico</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="telefono_2">Tel&eacute;fono</label>
                            <input type="text" class="form-control" name="telefono_2" id="telefono_2">
                            <small id="helpId" class="form-text text-muted">Tel&eacute;fono</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="direccion_2">Direcci&oacute;n</label>
                            <input type="text" class="form-control" name="direccion_2" id="direccion_2">
                            <small id="helpId" class="form-text text-muted">Direcci&oacute;n</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm pl-3 pr-3" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary btn-sm pl-3 pr-3" id="bnt_nuevo_demandante_proceso" data_url="{{ route('nuevo_demandante_proceso')}}" data_id_proceso="{{$proceso->id}}" ruta_eliminar_demandante="{{route('eliminar_demandante_proceso', ['id_demandante' => '1'])}}"  data_token="{{ csrf_token() }}" data-dismiss="modal">Cambiar</button>
            </div>
        </div>
    </div>
</div>
<!-- ------------------------------------------------------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------------------------------------------------------- -->
<!-- Nuevo demandante -->
<div class="modal fade bd-example-modal-lg" id="editar_datos_proceso_2_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Datos del proceso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="requerido" for="estado_proceso_id">Estado del proceso</label>
                            <select class="form-control"  id="estado_proceso_id" name="estado_proceso_id">
                                @foreach ($estados_procesos as $estado)
                                <option value="{{$estado->id}}" @if($estado->id == $proceso->estado_proceso_id) {{'selected'}} @endif>{{$estado->estado_proceso}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="codigo_unico_proceso_act">Codigo actual del proceso</label>
                            <input type="text" class="form-control" name="codigo_unico_proceso_act" id="codigo_unico_proceso_act" value="{{$proceso->codigo_unico_proceso_act}}">
                            <small id="helpId" class="form-text text-muted">Codigo actual del proceso</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="requerido" for="etapa_proceso_id">Etapa del proceso</label>
                            <select class="form-control"  id="etapa_proceso_id" name="etapa_proceso_id">
                                @foreach ($etapas_procesos as $etapa)
                                <option value="{{$etapa->id}}" @if($etapa->id == $proceso->etapa_proceso_id) {{'selected'}} @endif>{{$etapa->etapa_proceso}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="cuantia">Cuant&iacute;a del proceso</label>
                            <input type="number"  min="0" class="form-control" name="cuantia" id="cuantia" value="{{$proceso->cuantia}}">
                            <small id="helpId" class="form-text text-muted">Cuant&iacute;a del proceso</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="requerido" for="riesgo_perdida_id">Riesgo de perdida</label>
                            <select class="form-control"  id="riesgo_perdida_id" name="riesgo_perdida_id">
                                @foreach ($riegos_perdida as $riesgo)
                                <option value="{{$riesgo->id}}" @if($riesgo->id == $proceso->riesgo_perdida_id) {{'selected'}} @endif>{{$riesgo->riesgo_perdida}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm pl-3 pr-3" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary btn-sm pl-3 pr-3" id="bnt_editar_datos_proceso" data_url="{{ route('editar_datos_proceso')}}" data_id_proceso="{{$proceso->id}}" data-dismiss="modal">Cambiar</button>
            </div>
        </div>
    </div>
</div>
<!-- ------------------------------------------------------------------------------------------------------------------------- -->
<div class="modal fade bd-example-modal-lg" id="modal_adicionar_apoderado" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Elija un nuevo apoderado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-around">
                    <div class="col-10 form-group">
                        <label class="requerido" for="new_apoderado_proceso_id">Apoderado</label>
                        <select class="form-control" name="new_apoderado_proceso_id" id="new_apoderado_proceso_id" required>
                            @foreach ($apoderados as $apoderado)
                            <option value="{{$apoderado->id}}">{{$apoderado->nombres.' '.$apoderado->apellidos}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary bg-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary bg-primary" id="bnt_nuevo_apoderado_proceso" data_ruta_eliminar="{{route('eliminar_apoderado_proceso', ['id_apoderado' => '1','id_proceso' => '1'])}}" data_url="{{ route('nuevo_apoderado_proceso')}}" data_id_proceso="{{$proceso->id}}" data_token="{{ csrf_token() }}" data-dismiss="modal">Adicionar apoderado</button>
            </div>
        </div>
    </div>
</div>
<!-- ------------------------------------------------------------------------------------------------------------------------- -->
<div class="modal fade bd-example-modal-lg" id="modal_adicionar_asistente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Elija un nuevo asistente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-around">
                    <div class="col-10 form-group">
                        <label class="requerido" for="new_asistente_proceso_id">Asistentes</label>
                        <select class="form-control" name="new_asistente_proceso_id" id="new_asistente_proceso_id" required>
                            @foreach ($asistentes as $asistente)
                            <option value="{{$asistente->id}}">{{$asistente->nombres.' '.$asistente->apellidos}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary bg-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary bg-primary" id="bnt_nuevo_asistente_proceso" data_ruta_eliminar="{{route('eliminar_asistente_proceso', ['id_asistente' => '1','id_proceso' => '1'])}}" data_url="{{ route('nuevo_asistente_proceso')}}" data_id_proceso="{{$proceso->id}}" data_token="{{ csrf_token() }}" data-dismiss="modal">Adicionar asistente</button>
            </div>
        </div>
    </div>
</div>
<!-- ------------------------------------------------------------------------------------------------------------------------- -->
