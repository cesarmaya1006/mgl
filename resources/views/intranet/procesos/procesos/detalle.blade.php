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
    Modulo Procesos <a href="{{ route('admin-procesos-index') }}"
        class="btn btn-info btn-xs btn-sombra pl-4 pr-4 position-absolute end-0 mr-5"><i class="fas fa-reply mr-2"></i>
        Volver</a>
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
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-11">
            <div class="card card-widget">
                <div class="card-header">
                    <div class="user-block d-flex flex-row">
                        <span class="username">
                            <h5 class="text-primary">Proceso -
                                {{ $proceso->codigo_unico_proceso }}</h5>
                        </span>
                        <a href="{{ route('admin-procesos-exportar', ['id' => $proceso->id]) }}" target="_blank"
                            class="btn btn-xs btn-success btn-sombra pl-4 pr-4 position-absolute end-0 mr-4"><i
                                class="far fa-file-pdf mr-3" aria-hidden="true"></i>Exportar</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- post text -->
                    <div class="row">
                        <div class="col-12 text-center">
                            <h6><strong>Datos Proceso</strong></h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-6 col-md-5 text-right"><span><strong>Estado Notificación:</strong></span>
                                </div>
                                <div class="col-6 col-md-7 text-left">{{ $proceso->estado_notifi }}</div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-5 text-right"><span><strong>Fecha Notificación:</strong></span>
                                </div>
                                <div class="col-6 col-md-7 text-left">{{ $proceso->fecha_notifi }}</div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-5 text-right"><span><strong>Fecha Con. Juridico:</strong></span>
                                </div>
                                <div class="col-6 col-md-7 text-left">{{ $proceso->fecha_conoci_juridi }}</div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-5 text-right"><span><strong>Tipo Proceso:</strong></span>
                                </div>
                                <div class="col-6 col-md-7 text-left">{{ $proceso->tipos_proceso->tipo_proceso }}</div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-5 text-right"><span><strong>Estado Proceso:</strong></span>
                                </div>
                                <div class="col-6 col-md-7 text-left">{{ $proceso->estados_proceso->estado_proceso }}
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-6 col-md-5 text-right"><span><strong>Fecha Admisión:</strong></span>
                                </div>
                                <div class="col-6 col-md-7 text-left">{{ $proceso->fecha_admin }}</div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-5 text-right"><span><strong>Fecha Radicación:</strong></span>
                                </div>
                                <div class="col-6 col-md-7 text-left">{{ $proceso->fecha_radicacion }}</div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-5 text-right"><span><strong>Cuantia:</strong></span>
                                </div>
                                <div class="col-6 col-md-7 text-left">{{ $proceso->cuantia }}</div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-5 text-right"><span><strong>Etapa Proceso:</strong></span>
                                </div>
                                <div class="col-6 col-md-7 text-left">{{ $proceso->etapas_proceso->etapa_proceso }}</div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12 text-center">
                            <h6><strong>Datos Juzgado</strong></h6>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-6 col-md-5 text-right"><span><strong>Jurisdicción:</strong></span></div>
                                <div class="col-6 col-md-7">{{ $proceso->juzgados->jurisdiccion_juzgados->jurisdiccion }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-5 text-right"><span><strong>Municipio:</strong></span></div>
                                <div class="col-6 col-md-7">{{ $proceso->juzgados->municipios->municipio }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-5 text-right"><span><strong>Circuito:</strong></span></div>
                                <div class="col-6 col-md-7">{{ $proceso->juzgados->municipios->circuitos->circuito }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-5 text-right"><span><strong>Distrito:</strong></span></div>
                                <div class="col-6 col-md-7">
                                    {{ $proceso->juzgados->municipios->circuitos->distritos->distrito }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-5 text-right"><span><strong>Departamento:</strong></span></div>
                                <div class="col-6 col-md-7">
                                    {{ $proceso->juzgados->municipios->circuitos->distritos->departamentos->departamento }}
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-6 col-md-5 text-right">
                                    <h6><strong>Despacho:</strong></h6>
                                </div>
                                <div class="col-6 col-md-7">{{ $proceso->juzgados->despacho }}</div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-5 text-right">
                                    <h6><strong>Juez:</strong></h6>
                                </div>
                                <div class="col-6 col-md-7">{{ $proceso->juzgados->juez }}</div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-5 text-right">
                                    <h6><strong>Correo Electrónico:</strong></h6>
                                </div>
                                <div class="col-6 col-md-7">{{ $proceso->juzgados->email }}</div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-5 text-right">
                                    <h6><strong>Dirección:</strong></h6>
                                </div>
                                <div class="col-6 col-md-7">{{ $proceso->juzgados->direccion }}</div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-5 text-right">
                                    <h6><strong>Teléfono:</strong></h6>
                                </div>
                                <div class="col-6 col-md-7">{{ $proceso->juzgados->telefono }}</div>
                            </div>
                        </div>
                    </div>
                    @if ($proceso->fallo_1era != null)
                        <hr>
                        <div class="row">
                            <div class="col-12 text-center">
                                <h6><strong>Fallos</strong></h6>
                            </div>
                            <div class="col-12 mt-3 text-center">
                                Fallo primera instancia
                            </div>
                            <div class="col-12 mt-2 mb-4">
                                <div class="row">
                                    <div class="col-12 col-md-4 text-center">Fallo</div>
                                    <div class="col-12 col-md-4 text-center">Fecha Ejecutoria</div>
                                    <div class="col-12 col-md-4 text-center">Condena</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-4 text-center">{{ $proceso->fallo_1era }}</div>
                                    <div class="col-12 col-md-4 text-center">{{ $proceso->fecha_ejecutoria_1era }}</div>
                                    <div class="col-12 col-md-4 text-center">{{ $proceso->condena_1era }}</div>
                                </div>
                            </div>
                            <div class="col-12 mt-3 text-center">
                                Fallo segunda instancia
                            </div>
                            <div class="col-12 mt-2 mb-4">
                                <div class="row">
                                    <div class="col-12 col-md-4 text-center">Fallo</div>
                                    <div class="col-12 col-md-4 text-center">Fecha Ejecutoria</div>
                                    <div class="col-12 col-md-4 text-center">Condena</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-4 text-center">{{ $proceso->fallo_2da }}</div>
                                    <div class="col-12 col-md-4 text-center">{{ $proceso->fecha_ejecutoria_2da }}</div>
                                    <div class="col-12 col-md-4 text-center">{{ $proceso->condena_2da }}</div>
                                </div>
                            </div>
                            <div class="col-12 mt-3 text-center">
                                Fallo tercera instancia
                            </div>
                            <div class="col-12 mt-2 mb-4">
                                <div class="row">
                                    <div class="col-12 col-md-4 text-center">Fallo</div>
                                    <div class="col-12 col-md-4 text-center">Fecha Ejecutoria</div>
                                    <div class="col-12 col-md-4 text-center">Condena</div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-4 text-center">{{ $proceso->fallo_3era }}</div>
                                    <div class="col-12 col-md-4 text-center">{{ $proceso->fecha_ejecutoria_3era }}</div>
                                    <div class="col-12 col-md-4 text-center">{{ $proceso->condena_3era }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <hr>
                    <div class="row">
                        <div class="col-12 text-center">
                            <h6><strong>Apoderados y Asistentes</strong></h6>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-12 text-center"><span><strong>Apoderados</strong></span></div>
                                @foreach ($proceso->apoderados_proceso as $apoderado)
                                    <div class="col-12 text-center">
                                        <p>Lic. {{ $apoderado->usuario->nombres . ' ' . $apoderado->usuario->apellidos }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-12 text-center"><span><strong>Asistentes</strong></span></div>
                                @foreach ($proceso->asistentes_proceso as $asistente)
                                    <div class="col-12 text-center">
                                        <p>Asist.
                                            {{ $asistente->usuario->nombres . ' ' . $asistente->usuario->apellidos }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12 text-center">
                            <h6><strong>Demandados y Demandantes</strong></h6>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-12 text-center"><span><strong>Demandados</strong></span></div>
                                @foreach ($proceso->demandados as $demandado)
                                    <div class="col-12 text-center">
                                        <p>{{ $demandado->nombres . ' ' . $demandado->apellidos }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-12 text-center"><span><strong>Demandantes</strong></span></div>
                                @foreach ($proceso->demandantes as $demandante)
                                    <div class="col-12 text-center">
                                        <p>{{ $demandante->nombres }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12 text-center">
                            <h6><strong>Actuaciones</strong></h6>
                        </div>
                        <div class="col-12 mt-3 table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Fecha Actuación</th>
                                        <th>Descripción</th>
                                        <th>Termino</th>
                                        <th>Fecha Finalización</th>
                                        <th>Apoderado</th>
                                        <th>Documentos</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proceso->actuaciones as $actuacion)
                                        <tr>
                                            <td class="text-nowrap">{{ $actuacion->fecha_actuacion }}</td>
                                            <td>{{ $actuacion->descripcion_actuacion }}</td>
                                            <td class="text-nowrap">{{ $actuacion->termino }}</td>
                                            <td class="text-nowrap">{{ $actuacion->fecha_finalizacion }}</td>
                                            <td class="text-nowrap">{{ $actuacion->apoderado }}</td>
                                            <td>
                                                @foreach ($actuacion->documentos as $Documento)
                                                    <a href="{{ asset('documentos/doc_actuaciones' . $documento->url_doc) }}"
                                                        target="_blank"
                                                        rel="noopener noreferrer">{{ $documento->nombre_doc }}</a>
                                                @endforeach
                                            </td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
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
