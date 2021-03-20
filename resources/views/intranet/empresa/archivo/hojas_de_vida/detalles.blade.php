@extends("theme.back.plantilla")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
    @include('includes.funciones_php')
@endsection
<!-- titulo hoja -->
@section('estilosHojas')
    <!-- Pagina CSS -->
    <link rel="stylesheet" href="{{ asset('css/hojavida/detalles.css') }}">
@endsection
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('tituloHoja')
    Hojas de Vida
@endsection
<!-- ************************************************************* -->
<!-- ************************************************************* -->
<!-- Cuerpo hoja -->
@section('cuerpo_pagina')
    <div class="card" style="border-top: 8px solid rgb(38, 160, 241);">
        @include('includes.error-form')
        @include('includes.mensaje')
        <div class="card-header">
            <div class="row mb-3">
                <div class="col-12 col-md-4 text-md-left text-lg-left pl-2">
                    <h5>Detalles Hoja de Vida</h5>
                </div>
                <div class="col-12 col-md-8 text-md-right text-lg-right pl-2 pr-md-5 pr-lg-5">
                    <a href="{{ route('generatePDF', ['id' => $empleado->id]) }}" target="_blank"
                        class="btn btn-dark btn-xs text-center pl-3 pr-3 mr-3"><i class="fas fa-book mr-2"></i> Exportar</a>
                    <a href="{{ route('hojas_de_vida-documentacion', ['id' => $empleado->id]) }}"
                        class="btn btn-dark btn-xs text-center pl-3 pr-3 mr-3"><i class="fas fa-book mr-2"></i> Listado
                        de documentos del trabajador por archivo</a>
                    <a href="{{ route('hojas_de_vida-index', ['id' => $empleado->empresa->id]) }}"
                        class="btn btn-info btn-xs text-center pl-3 pr-3 mr-3"><i
                            class="fas fa-undo-alt mr-2"></i>Volver</a>
                </div>
            </div>
            <div class="row d-flex justify-content-around mt-5 mb-5">
                <div class="col-12 col-md-10 col-lg-10">
                    <div class="row d-flex justify-content-around p-3 m-3"
                        style="border: solid 1px black;border-radius: 5px;">
                        <div class="col-12 col-md-10 col-lg-11">
                            <div class="row p-3 text-white"
                                style="background-image: url('{{ asset('imagenes/sistema/fondo_hv.jpg') }}');background-repeat: no-repeat;background-size: 100% 100%;">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-center">
                                            <img class="img-fluid img-thumbnail"
                                                src="{{ asset($empleado->foto != null ? 'imagenes/hojas_de_vida/' . $empleado->foto : 'imagenes/hojas_de_vida/usuario-inicial.jpg') }}"
                                                alt="" style="width: 100%;height: auto;max-width: 150px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-8 col-lg-8">
                                    <div class="row">
                                        <div class="col-12">
                                            <h2>{{ $empleado->usuario->nombres . ' ' . $empleado->usuario->apellidos }}
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-around pl-3 pr-3 mt-4">
                                        <div class="col-11">
                                            <p class="text-justify">{{ $empleado->descripcion }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row d-flex justify-content-center">
                                <div class="col-12 col-md-10 col-lg-10">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6 p-1">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5>Datos Personales</h5>
                                                </div>
                                                <div class="col-12">
                                                    <div class="linea_titulo"
                                                        style="width: 100%;height: 2px; background-color: rgb(4, 46, 0)">
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row" style="font-size: 0.8em;">
                                                <div class="col-12 table-responsive">
                                                    <table style="width: 100%;">
                                                        <tr>
                                                            <td style="text-align: right;">
                                                                <strong>Nombre Completo:</strong>
                                                            </td>
                                                            <td style="text-align: left;">
                                                                {{ $empleado->usuario->nombres }}
                                                                {{ $empleado->usuario->apellidos }}
                                                            </td>
                                                            <td style="text-align: right;"></td>
                                                            <td style="text-align: left;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: right;">
                                                                <strong>Documento de Identidad:</strong>
                                                            </td>
                                                            <td style="text-align: left;">
                                                                {{ $empleado->usuario->tipos_docu->abreb_id }}
                                                                {{ $empleado->usuario->identificacion }}
                                                            </td>
                                                            <td style="text-align: right;"></td>
                                                            <td style="text-align: left;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: right;">
                                                                <strong>Fecha de Nacimiento:</strong>
                                                            </td>
                                                            <td style="text-align: left;">
                                                                {{ date('d/m/Y', strtotime($empleado->fecha_nacimiento)) }}
                                                                </h6>
                                                            </td>
                                                            <td style="text-align: right;">
                                                                <strong>Edad:</strong>
                                                            </td>
                                                            <td class="text-nowrap" style="text-align: left;">
                                                                {{ $edad }} Años</h6>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: right;">
                                                                <strong>Nacionalidad:</strong>
                                                            </td>
                                                            <td style="text-align: left;">
                                                                {{ $empleado->nacionalidad }}
                                                            </td>
                                                            <td style="text-align: right;">
                                                                <strong>País:</strong>
                                                            </td>
                                                            <td style="text-align: left;">
                                                                {{ $empleado->pais_nacionalidad }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: right;">
                                                                <strong>Libreta Militar:</strong>
                                                            </td>
                                                            <td style="text-align: left;">
                                                                {{ $empleado->tipo_libreta }}
                                                            </td>
                                                            <td style="text-align: right;">
                                                                <strong>Num. Libreta:</strong>
                                                            </td>
                                                            <td style="text-align: left;">
                                                                {{ $empleado->n_libreta }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: right;">
                                                                <strong>País de Nac:</strong>
                                                            </td>
                                                            <td style="text-align: left;">
                                                                {{ $empleado->pais_nacimiento }}
                                                            </td>
                                                            <td style="text-align: right;">
                                                                <h6></h6>
                                                            </td>
                                                            <td style="text-align: left;">
                                                                <h6></h6>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: right;">
                                                                <strong>Lugar de Nacimiento:</strong>
                                                            </td>
                                                            <td style="text-align: left;">
                                                                {{ $empleado->lugar_nacimiento }}
                                                            </td>
                                                            <td style="text-align: right;"></td>
                                                            <td style="text-align: left;"></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6 p-1">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5>Datos de Contacto</h5>
                                                </div>
                                                <div class="col-12">
                                                    <div class="linea_titulo"
                                                        style="width: 100%;height: 2px; background-color: rgb(4, 46, 0)">
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-12 table-responsive">
                                                    <table style="width: 100%;font-size: 0.8em;">
                                                        <tr>
                                                            <td style="text-align: right;">
                                                                <strong>País:</strong>
                                                            </td>
                                                            <td style="text-align: left;">
                                                                {{ $empleado->pais_residencia }}
                                                            </td>
                                                            <td style="text-align: right;">
                                                                <strong>Departamento:</strong>
                                                            </td>
                                                            <td style="text-align: left;">
                                                                {{ $empleado->departamento_residencia }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: right;">
                                                                <strong>Cuidad:</strong>
                                                            </td>
                                                            <td style="text-align: left;">
                                                                {{ $empleado->municipio_residencia }}
                                                            </td>
                                                            <td style="text-align: right;"></td>
                                                            <td style="text-align: left;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: right;">
                                                                <strong>Dirección:</strong>
                                                            </td>
                                                            <td style="text-align: left;">
                                                                {{ $empleado->direccion }}
                                                            </td>
                                                            <td style="text-align: right;"></td>
                                                            <td style="text-align: left;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: right;">
                                                                <strong>Correo Electrónico:</strong>
                                                            </td>
                                                            <td style="text-align: left;">
                                                                {{ $empleado->usuario->email }}
                                                            </td>
                                                            <td style="text-align: right;"></td>
                                                            <td style="text-align: left;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: right;">
                                                                <strong>Celular:</strong>
                                                            </td>
                                                            <td style="text-align: left;">
                                                                {{ $empleado->usuario->telefono }}
                                                            </td>
                                                            <td style="text-align: right;">
                                                                <strong>Tel Fijo:</strong>
                                                            </td>
                                                            <td style="text-align: left;">
                                                                {{ $empleado->telefono_fijo }}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="row mb-5">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5>Formación Académica</h5>
                                                </div>
                                                <div class="col-12">
                                                    <div class="linea_titulo"
                                                        style="width: 100%;height: 2px; background-color: rgb(4, 46, 0)">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row mb-2">
                                                <div class="col-12 pl-3">
                                                    <strong>Educación Básica</strong>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 table-responsive">
                                                    <table class="table table-sm">
                                                        <tr style="border-bottom: 2px solid black">
                                                            <th class="text-center" scope="col">Estado</th>
                                                            <th class="text-center" scope="col">Último Grado Cursado</th>
                                                            <th class="text-center" scope="col">Título Obtenido</th>
                                                            <th class="text-center" scope="col">Establecimiento Educativo
                                                            </th>
                                                            <th class="text-center" scope="col">Fecha de Grado o Último Año
                                                                Cursado</th>
                                                            <th class="text-center" scope="col">Soporte</th>
                                                            <th class="text-center" scope="col"></th>
                                                        </tr>
                                                        @foreach ($empleado->edu_basica as $item)
                                                            <tr>
                                                                <td>{{ $item->completa }}</td>
                                                                <td>{{ $item->ultimo_cursado }}</td>
                                                                <td>{{ $item->titulo }}</td>
                                                                <td>{{ $item->establecimiento }}</td>
                                                                <td>{{ $item->fecha_ultimo }}</td>
                                                                <td><a href="{{ asset('documentos/hojas_de_vida/' . $item->soporte) }}"
                                                                        target="_blank">{{ $item->soporte }}</a></td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                            <br>
                                            <hr>
                                            <div class="row mb-2">
                                                <div class="col-12 pl-3">
                                                    <strong>Educación Superior</strong>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 table-responsive">
                                                    <table class="table table-sm">
                                                        <tr style="border-bottom: 2px solid black">
                                                            <th class="text-center" scope="col">Estado</th>
                                                            <th class="text-center" scope="col">Título Obtenido</th>
                                                            <th class="text-center" scope="col">Establecimiento Educativo
                                                            </th>
                                                            <th class="text-center" scope="col">Fecha de Grado o Último Año
                                                                Cursado</th>
                                                            <th class="text-center" scope="col">Num Tarjeta Prof.</th>
                                                            <th class="text-center" scope="col">Soporte</th>
                                                        </tr>
                                                        @foreach ($empleado->edu_superior as $item)
                                                            <tr>
                                                                <td>{{ $item->completa }}</td>
                                                                <td>{{ $item->titulo }}</td>
                                                                <td>{{ $item->establecimiento }}</td>
                                                                <td>{{ $item->fecha_ultimo }}</td>
                                                                <td>{{ $item->tarjeta_prof }}</td>
                                                                <td><a href="{{ asset('documentos/hojas_de_vida/' . $item->soporte) }}"
                                                                        target="_blank">{{ $item->soporte }}</a></td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                            <br>
                                            <hr>
                                            <div class="row mb-2">
                                                <div class="col-12 pl-3">
                                                    <strong>Educación Complementaria</strong>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 table-responsive">
                                                    <table class="table table-sm">
                                                        <tr style="border-bottom: 2px solid black">
                                                            <th class="text-center" scope="col">Estado</th>
                                                            <th class="text-center" scope="col">Título Obtenido</th>
                                                            <th class="text-center" scope="col">Establecimiento Educativo
                                                            </th>
                                                            <th class="text-center" scope="col">Cant Horas</th>
                                                            <th class="text-center" scope="col">Fecha de Inicio</th>
                                                            <th class="text-center" scope="col">Fecha de Termino</th>
                                                            <th class="text-center" scope="col">Soporte</th>
                                                        </tr>
                                                        @foreach ($empleado->edu_otra as $item)
                                                            <tr>
                                                                <td>{{ $item->completa }}</td>
                                                                <td>{{ $item->titulo }}</td>
                                                                <td>{{ $item->establecimiento }}</td>
                                                                <td>{{ $item->cant_horas }}</td>
                                                                <td>{{ $item->fecha_inicio }}</td>
                                                                <td>{{ $item->fecha_termino }}</td>
                                                                <td><a href="{{ asset('documentos/hojas_de_vida/' . $item->soporte) }}"
                                                                        target="_blank">{{ $item->soporte }}</a></td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5>Publicaciones, Investigaciones, Logros e Idiomas</h5>
                                                </div>
                                                <div class="col-12">
                                                    <div class="linea_titulo"
                                                        style="width: 100%;height: 2px; background-color: rgb(4, 46, 0)">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row mb-2">
                                                <div class="col-12 pl-3">
                                                    <strong>Publicaciones, Investigaciones y Logros Laborales</strong>
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 table-responsive">
                                                    <table class="table table-sm">
                                                        <tr style="border-bottom: 2px solid black">
                                                            <th class="text-center" scope="col">Titulo</th>
                                                            <th class="text-center" scope="col">ISBN</th>
                                                            <th class="text-center" scope="col">Pagina Legal</th>
                                                            <th class="text-center" scope="col">Autores</th>
                                                            <th class="text-center" scope="col">Revista</th>
                                                            <th class="text-center" scope="col">Base de datos</th>
                                                            <th class="text-center" scope="col">Cuartil</th>
                                                        </tr>
                                                        @foreach ($empleado->publicaciones as $item)
                                                            <tr>
                                                                <td>{{ $item->titulo }}</td>
                                                                <td>{{ $item->isbn }}</td>
                                                                <td>{{ $item->pagina_legal }}</td>
                                                                <td>{{ $item->autores }}</td>
                                                                <td>{{ $item->revista }}</td>
                                                                <td>{{ $item->base_datos }}</td>
                                                                <td>{{ $item->cuartil }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                            <br>
                                            <hr>
                                            <div class="row mb-2">
                                                <div class="col-12 pl-3">
                                                    <strong>Idiomas</strong>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 table-responsive">
                                                    <table class="table table-sm">
                                                        <tr style="border-bottom: 2px solid black">
                                                            <th class="text-center" scope="col">Idioma</th>
                                                            <th class="text-center" scope="col">Habla</th>
                                                            <th class="text-center" scope="col">lee</th>
                                                            <th class="text-center" scope="col">Escribe</th>
                                                            <th class="text-center" scope="col">Examen</th>
                                                            <th class="text-center" scope="col">fecha de Examen</th>
                                                            <th class="text-center" scope="col">Resultado</th>
                                                            <th class="text-center" scope="col">Soporte</th>
                                                        </tr>
                                                        @foreach ($empleado->idiomas as $item)
                                                            <tr>
                                                                <td>{{ $item->idioma }}</td>
                                                                <td>{{ $item->habla }}</td>
                                                                <td>{{ $item->lee }}</td>
                                                                <td>{{ $item->escribe }}</td>
                                                                <td>{{ $item->examen }}</td>
                                                                <td>{{ $item->fecha_examen }}</td>
                                                                <td>{{ $item->resultado }}</td>
                                                                <td><a href="{{ asset('documentos/hojas_de_vida/' . $item->soporte) }}"
                                                                        target="_blank">{{ $item->soporte }}</a></td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5>Experiencia Laboral</h5>
                                                </div>
                                                <div class="col-12">
                                                    <div class="linea_titulo"
                                                        style="width: 100%;height: 2px; background-color: rgb(4, 46, 0)">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-12 table-responsive">
                                                    <table class="table table-sm">
                                                        <tr style="border-bottom: 2px solid black">
                                                            <th class="text-center" scope="col">Entidad</th>
                                                            <th class="text-center" scope="col">Tipo de Entidad</th>
                                                            <th class="text-center" scope="col">Pais</th>
                                                            <th class="text-center" scope="col">Departamento</th>
                                                            <th class="text-center" scope="col">Municipio</th>
                                                            <th class="text-center" scope="col">Dirección</th>
                                                            <th class="text-center" scope="col">Teléfono</th>
                                                            <th class="text-center" scope="col">Fecha de Ingreso</th>
                                                            <th class="text-center" scope="col">Fecha de Termino</th>
                                                            <th class="text-center" scope="col">Tipo de Contrato</th>
                                                            <th class="text-center" scope="col">Destinación de Tiempo</th>
                                                            <th class="text-center" scope="col">Cargo</th>
                                                            <th class="text-center" scope="col">Dependencia</th>
                                                            <th class="text-center" scope="col">Jefe Inmediato</th>
                                                            <th class="text-center" scope="col">Observaciones</th>
                                                            <th class="text-center" scope="col">Soporte</th>
                                                            <th class="text-center" scope="col"></th>
                                                        </tr>
                                                        <?php
                                                        $exp_lab_for_temp = $empleado->experienciaslab;
                                                        $exp_lab_for = $exp_lab_for_temp->sortByDesc('fecha_termino');
                                                        ?>
                                                        @foreach ($exp_lab_for as $item)
                                                            @if ($item->actual == 'Si')
                                                                <tr>
                                                                    <td>{{ $item->entidad }}
                                                                        {{ $item->actual == 'Si' ? ' - Actual' : '' }}
                                                                    </td>
                                                                    <td>{{ $item->tipo_entidad }}</td>
                                                                    <td>{{ $item->pais }}</td>
                                                                    <td>{{ $item->pais == 'COLOMBIA' ? $item->departamento : '---' }}
                                                                    </td>
                                                                    <td>{{ $item->pais == 'COLOMBIA' ? $item->municipio : '---' }}
                                                                    </td>
                                                                    <td>{{ $item->direccion }}</td>
                                                                    <td>{{ $item->telefono }}</td>
                                                                    <td>{{ $item->fecha_ingreso }}</td>
                                                                    <td>{{ $item->actual == 'Si' ? 'Actual' : $item->fecha_termino }}
                                                                    </td>
                                                                    <td>{{ $item->tipo_contrato }}</td>
                                                                    <td>{{ $item->tiempo_contrato }}</td>
                                                                    <td>{{ $item->cargo }}</td>
                                                                    <td>{{ $item->dependencia }}</td>
                                                                    <td>{{ $item->jefe_inmediato }}</td>
                                                                    <td
                                                                        style="vertical-align: normal;max-width: 300px;min-height: 200px;">
                                                                        {{ $item->observaciones }}</td>
                                                                    <td><a href="{{ asset('documentos/hojas_de_vida/' . $item->soporte) }}"
                                                                            target="_blank">{{ $item->soporte }}</a></td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                        @foreach ($exp_lab_for as $item)
                                                            @if ($item->actual == 'No')
                                                                <tr>
                                                                    <td>{{ $item->entidad }}
                                                                        {{ $item->actual == 'Si' ? ' - Actual' : '' }}
                                                                    </td>
                                                                    <td>{{ $item->tipo_entidad }}</td>
                                                                    <td>{{ $item->pais }}</td>
                                                                    <td>{{ $item->pais == 'COLOMBIA' ? $item->departamento : '---' }}
                                                                    </td>
                                                                    <td>{{ $item->pais == 'COLOMBIA' ? $item->municipio : '---' }}
                                                                    </td>
                                                                    <td>{{ $item->direccion }}</td>
                                                                    <td>{{ $item->telefono }}</td>
                                                                    <td>{{ $item->fecha_ingreso }}</td>
                                                                    <td>{{ $item->actual == 'Si' ? 'Actual' : $item->fecha_termino }}
                                                                    </td>
                                                                    <td>{{ $item->tipo_contrato }}</td>
                                                                    <td>{{ $item->tiempo_contrato }}</td>
                                                                    <td>{{ $item->cargo }}</td>
                                                                    <td>{{ $item->dependencia }}</td>
                                                                    <td>{{ $item->jefe_inmediato }}</td>
                                                                    <td
                                                                        style="vertical-align: normal;max-width: 300px;min-height: 200px;">
                                                                        {{ $item->observaciones }}</td>
                                                                    <td><a href="{{ asset('documentos/hojas_de_vida/' . $item->soporte) }}"
                                                                            target="_blank">{{ $item->soporte }}</a>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5>Experiencia Laboral Independiente</h5>
                                                </div>
                                                <div class="col-12">
                                                    <div class="linea_titulo"
                                                        style="width: 100%;height: 2px; background-color: rgb(4, 46, 0)">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-12 table-responsive">
                                                    <table class="table table-sm">
                                                        <tr style="border-bottom: 2px solid black">
                                                            <th class="text-center" scope="col">Entidad</th>
                                                            <th class="text-center" scope="col">Tipo de Entidad</th>
                                                            <th class="text-center" scope="col">Actividad</th>
                                                            <th class="text-center" scope="col">Producto</th>
                                                            <th class="text-center" scope="col">Pais</th>
                                                            <th class="text-center" scope="col">Departamento</th>
                                                            <th class="text-center" scope="col">Municipio</th>
                                                            <th class="text-center" scope="col">Dirección</th>
                                                            <th class="text-center" scope="col">Teléfono</th>
                                                            <th class="text-center" scope="col">Fecha de Inicio</th>
                                                            <th class="text-center" scope="col">Fecha de Termino</th>
                                                            <th class="text-center" scope="col">Tipo de Contrato</th>
                                                            <th class="text-center" scope="col">Observaciones</th>
                                                            <th class="text-center" scope="col">Soporte</th>
                                                        </tr>
                                                        <?php
                                                        $exp_lab_for_temp = $empleado->experienciasindp;
                                                        $exp_lab_indp = $exp_lab_for_temp->sortByDesc('fecha_termino');
                                                        ?>
                                                        @foreach ($exp_lab_indp as $item)
                                                            <tr>
                                                                <td>{{ $item->entidad }}</td>
                                                                <td>{{ $item->tipo_entidad }}</td>
                                                                <td>{{ $item->actividad }}</td>
                                                                <td>{{ $item->producto }}</td>
                                                                <td>{{ $item->pais }}</td>
                                                                <td>{{ $item->pais == 'COLOMBIA' ? $item->departamento : '---' }}
                                                                </td>
                                                                <td>{{ $item->pais == 'COLOMBIA' ? $item->municipio : '---' }}
                                                                </td>
                                                                <td>{{ $item->direccion }}</td>
                                                                <td>{{ $item->telefono }}</td>
                                                                <td>{{ $item->fecha_inicio }}</td>
                                                                <td>{{ $item->fecha_termino }}</td>
                                                                <td
                                                                    style="vertical-align: normal;max-width: 300px;min-height: 200px;">
                                                                    {{ $item->observaciones }}</td>
                                                                <td><a href="{{ asset('documentos/hojas_de_vida/' . $item->soporte) }}"
                                                                        target="_blank">{{ $item->soporte }}</a></td>
                                                                <td class="text-center" style="min-width: 100px;">
                                                                    <form
                                                                        action="{{ route('mi_hoja_de_vida-experienciaindp-eliminar', ['id' => $item->id]) }}"
                                                                        class="d-inline form-eliminar" method="POST">
                                                                        @csrf @method("delete")
                                                                        <button type="submit"
                                                                            class="btn-accion-tabla eliminar tooltipsC text-danger"
                                                                            title="Eliminar este registro">
                                                                            <i class="fas fa-trash-alt"></i>
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                        <div class="col-12 mb-2 mt-3">
                                            <div class="row d-flex justify-content-around w-100">
                                                <div class="col-12 pl-4">
                                                    <h6 style="text-decoration: underline;">Tiempo total de experiencia y
                                                        situación laboral</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3 table-responsive pb-3"
                                            style="border-bottom: 0.5px solid gray">
                                            <table class="table table-striped table-bordered table-hover"
                                                style="width: 100%; font-size: 1.2em;">
                                                <thead style="background-color: rgb(205, 207, 209)">
                                                    <tr>
                                                        <th scope="col" class="text-center" rowspan="2"
                                                            style="vertical-align: middle;"><strong>Ocupación</strong></th>
                                                        <th scope="col" class="text-center" colspan="3"><strong>Tiempo de
                                                                experiencia</strong></th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col" class="text-center"><strong>Años</strong></th>
                                                        <th scope="col" class="text-center"><strong>Meses</strong></th>
                                                        <th scope="col" class="text-center"><strong>Dias</strong></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th><strong>Sector Público</strong></th>
                                                        <td class="text-center" id="secPubAnnos_f">
                                                            {{ $respuesta['secPubAnnos_f'] }}</td>
                                                        <td class="text-center" id="secPubMeses_f">
                                                            {{ $respuesta['secPubMeses_f'] }}</td>
                                                        <td class="text-center" id="secPubDias_f">
                                                            {{ $respuesta['secPubDias_f'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th><strong>Sector Privado</strong></th>
                                                        <td class="text-center" id="secPrivAnnos_f">
                                                            {{ $respuesta['secPrivAnnos_f'] }}</td>
                                                        <td class="text-center" id="secPrivMeses_f">
                                                            {{ $respuesta['secPrivMeses_f'] }}</td>
                                                        <td class="text-center" id="secPrivDias_f">
                                                            {{ $respuesta['secPrivDias_f'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th><strong>Trabajador Independiente</strong></th>
                                                        <td class="text-center" id="secIndpAnnos_f">
                                                            {{ $respuesta['secIndpAnnos_f'] }}</td>
                                                        <td class="text-center" id="secIndpMeses_f">
                                                            {{ $respuesta['secIndpMeses_f'] }}</td>
                                                        <td class="text-center" id="secIndpDias_f">
                                                            {{ $respuesta['secIndpDias_f'] }}</td>
                                                    </tr>
                                                    <tr style="background-color: rgb(205, 207, 209)">
                                                        <th><strong>Total tiempo de experiencia</strong></th>
                                                        <td class="text-center" id="annos_total_f">
                                                            <strong>{{ $respuesta['annos_total_f'] }} Años</strong>
                                                        </td>
                                                        <td class="text-center" id="meses_total_f">
                                                            <strong>{{ $respuesta['meses_total_f'] }} Meses</strong>
                                                        </td>
                                                        <td class="text-center" id="dias_total_f">
                                                            <strong>{{ $respuesta['dias_total_f'] }} Dias</strong>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <script src="{{ asset('js/admin/hojasvida/index.js') }}"></script>
@endsection
<!-- ************************************************************* -->
