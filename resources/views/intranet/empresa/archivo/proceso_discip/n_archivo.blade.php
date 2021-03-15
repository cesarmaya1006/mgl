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
    Archivo Laboral
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
                <div class="col-12 col-md-6 col-lg-6 text-md-left text-lg-left pl-2">
                    <h5>Proceso disciplinario faltas y sanciones: {{ $empleado->primer_nombre }}
                        {{ $empleado->segundo_nombre }} {{ $empleado->primer_apellido }}
                        {{ $empleado->segundo_apellido }}
                    </h5>
                    <br>
                    <h4>Documentos Proceso N. {{ $proceso->id }}</h4>
                </div>
                <div class="col-12 col-md-6 col-lg-6 text-md-right text-lg-right pl-2 pr-md-5 pr-lg-5">
                    <a href="{{ route('proceso_discip-editar', ['id' => $empleado->id]) }}"
                        class="btn btn-info btn-sm text-center pl-3 pr-3 mr-3" style="font-size: 0.9em;"><i
                            class="fas fa-undo-alt mr-2"></i>Volver</a>
                </div>
            </div>
            <hr>
            <div class="row  d-flex justify-content-around">
                <div class="col-10 col-md-10 table-responsive">
                    <div class="row">
                        <div class="col-12 col-md-3 ml-3 table-responsive">
                            <table class="table table-striped table-hover table-bordered table-sm tabla-data">
                                <tbody>
                                    <tr>
                                        <td>Documento de Citación</td>
                                        <td><a href="{{ asset('documentos/doc_empleados/' . $proceso->inicio) }}"
                                                target="_blank">{{ $proceso->inicio }}</a></td>
                                        <td><a href="{{ route('proceso_discip-e_archivo', ['id' => $empleado->id, 'id_p' => $proceso->id, 'doc' => 'inicio']) }}"
                                                class="btn-accion-tabla tooltipsC" title="Editar"><i
                                                    class="far fa-edit text-info"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 col-md-3 ml-3 table-responsive">
                            <table class="table table-striped table-hover table-bordered table-sm tabla-data">
                                <tbody>
                                    <tr>
                                        <td>Acta de Descargos</td>
                                        <td>
                                            @if ($proceso->descargos != null)
                                                <a href="{{ asset('documentos/doc_empleados/' . $proceso->descargos) }}"
                                                    target="_blank">{{ $proceso->descargos }}</a>
                                            @else
                                                Sin Documento
                                            @endif
                                        </td>
                                        <td>
                                            @if ($proceso->descargos != null)
                                                <a href="{{ route('proceso_discip-e_archivo', ['id' => $empleado->id, 'id_p' => $proceso->id, 'doc' => 'descargos']) }}"
                                                    class="btn-accion-tabla tooltipsC" title="Editar"><i
                                                        class="far fa-edit text-info"></i></a>
                                            @else
                                                <a href="{{ route('proceso_discip-e_archivo', ['id' => $empleado->id, 'id_p' => $proceso->id, 'doc' => 'descargos']) }}"
                                                    class="btn-accion-tabla tooltipsC" title="Editar"><i
                                                        class="fas fa-plus-square text-success"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 col-md-3 ml-3 table-responsive">
                            <table class="table table-striped table-hover table-bordered table-sm tabla-data">
                                <tbody>
                                    <tr>
                                        <td>Documento de Cierre</td>
                                        <td>
                                            @if ($proceso->cierre != null)
                                                <a href="{{ asset('documentos/doc_empleados/' . $proceso->cierre) }}"
                                                    target="_blank">{{ $proceso->cierre }}</a>
                                            @else
                                                Sin Documento
                                            @endif
                                        </td>
                                        <td>
                                            @if ($proceso->cierre != null)
                                                <a href="{{ route('proceso_discip-e_archivo', ['id' => $empleado->id, 'id_p' => $proceso->id, 'doc' => 'cierre']) }}"
                                                    class="btn-accion-tabla tooltipsC" title="Editar"><i
                                                        class="far fa-edit text-info"></i></a>
                                            @else
                                                <a href="{{ route('proceso_discip-e_archivo', ['id' => $empleado->id, 'id_p' => $proceso->id, 'doc' => 'cierre']) }}"
                                                    class="btn-accion-tabla tooltipsC" title="Editar"><i
                                                        class="fas fa-plus-square text-success"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 col-md-3 ml-3 table-responsive">
                            <table class="table table-striped table-hover table-bordered table-sm tabla-data">
                                <tbody>
                                    <tr>
                                        <td>Documento de Recurso</td>
                                        <td>
                                            @if ($proceso->recurso != null)
                                                <a href="{{ asset('documentos/doc_empleados/' . $proceso->recurso) }}"
                                                    target="_blank">{{ $proceso->recurso }}</a>
                                            @else
                                                Sin Documento
                                            @endif
                                        </td>
                                        <td>
                                            @if ($proceso->recurso != null)
                                                <a href="{{ route('proceso_discip-e_archivo', ['id' => $empleado->id, 'id_p' => $proceso->id, 'doc' => 'recurso']) }}"
                                                    class="btn-accion-tabla tooltipsC" title="Editar"><i
                                                        class="far fa-edit text-info"></i></a>
                                            @else
                                                <a href="{{ route('proceso_discip-e_archivo', ['id' => $empleado->id, 'id_p' => $proceso->id, 'doc' => 'recurso']) }}"
                                                    class="btn-accion-tabla tooltipsC" title="Editar"><i
                                                        class="fas fa-plus-square text-success"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 col-md-3 ml-3 table-responsive">
                            <table class="table table-striped table-hover table-bordered table-sm tabla-data">
                                <tbody>
                                    <tr>
                                        <td>Descion de Segunda Instancia</td>
                                        <td>
                                            @if ($proceso->segunda != null)
                                                <a href="{{ asset('documentos/doc_empleados/' . $proceso->segunda) }}"
                                                    target="_blank">{{ $proceso->segunda }}</a>
                                            @else
                                                Sin Documento
                                            @endif
                                        </td>
                                        <td>
                                            @if ($proceso->segunda != null)
                                                <a href="{{ route('proceso_discip-e_archivo', ['id' => $empleado->id, 'id_p' => $proceso->id, 'doc' => 'segunda']) }}"
                                                    class="btn-accion-tabla tooltipsC" title="Editar"><i
                                                        class="far fa-edit text-info"></i></a>
                                            @else
                                                <a href="{{ route('proceso_discip-e_archivo', ['id' => $empleado->id, 'id_p' => $proceso->id, 'doc' => 'segunda']) }}"
                                                    class="btn-accion-tabla tooltipsC" title="Editar"><i
                                                        class="fas fa-plus-square text-success"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
    <script src="{{ asset('js/intranet/empresas/archivo/proc_disciplinario.js') }}"></script>
@endsection
<!-- ************************************************************* -->
