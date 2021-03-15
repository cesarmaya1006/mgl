@extends("theme.back.plantilla")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
    @include('includes.funciones_php')
@endsection
<!-- titulo hoja -->
@section('estilosHojas')
    <!-- Pagina CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin/hojavida/editar.css') }}">
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
                <div class="col-12 col-md-6 col-lg-6 text-md-left text-lg-left pl-2">
                    <h5>Documentos {{ $empleado->usuario->nombres . ' ' . $empleado->usuario->apellidos }}</h5>
                </div>
                <div class="col-12 col-md-6 col-lg-6 text-md-right text-lg-right pl-2 pr-md-5 pr-lg-5">
                    <a href="{{ route('hojas_de_vida-detalles', ['id' => $empleado->id]) }}"
                        class="btn btn-info btn-sm text-center pl-3 pr-3 mr-3"><i
                            class="fas fa-undo-alt mr-2"></i>Volver</a>
                </div>
            </div>
            <hr>
            <div class="row d-flex justify-content-around mt-3 mb-5">
                <div class="col-12 col-md-11">
                    <div class="row d-flex justify-content-around">
                        <!-- **********************************************************************  -->
                        <!-- documentos de Afiliacion  -->
                        <div class="col-12 col-md-5 table-responsive mb-4">
                            <table class="table table-striped table-hover table-sm tabla-data">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">
                                            <h6><strong>Documentos de afiliacion</strong></h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($empleado->documentos->where('tipo', 'soporte_afiliacion')->count() > 0)
                                        @foreach ($empleado->documentos as $documento)
                                            @if ($empleado->documento->tipo == 'soporte_afiliacion')
                                                <tr>
                                                    <td class="text-center"><a
                                                            href="{{ asset('documentos/doc_empleados/' . $documento->documento) }}"
                                                            target="_blank"
                                                            rel="noopener noreferrer">{{ $documento->nom_documento }}</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center">Sin Documentación</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- **********************************************************************  -->
                        <!-- Documentos Contractuales  -->
                        <div class="col-12 col-md-5 table-responsive mb-4">
                            <table class="table table-striped table-hover table-sm tabla-data">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">
                                            <h6><strong>Documentos Contractuales</strong></h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($empleado->documentos->where('tipo', 'doc_contractuales')->count() > 0)
                                        @foreach ($empleado->documentos as $documento)
                                            @if ($documento->tipo == 'doc_contractuales')
                                                <tr>
                                                    <td class="text-center"><a
                                                            href="{{ asset('documentos/doc_empleados/' . $documento->documento) }}"
                                                            target="_blank"
                                                            rel="noopener noreferrer">{{ $documento->nom_documento }}</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center">Sin Documentación</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- **********************************************************************  -->
                        <!-- Situaciones laborales generales  -->
                        <div class="col-12 col-md-5 table-responsive mb-4">
                            <table class="table table-striped table-hover table-sm tabla-data">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">
                                            <h6><strong>Situaciones laborales generales</strong></h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($empleado->documentos->where('tipo', 'sit_laboral')->count() > 0)
                                        @foreach ($empleado->documentos as $documento)
                                            @if ($documento->tipo == 'sit_laboral')
                                                <tr>
                                                    <td class="text-center"><a
                                                            href="{{ asset('documentos/doc_empleados/' . $documento->documento) }}"
                                                            target="_blank"
                                                            rel="noopener noreferrer">{{ $documento->nom_documento }}</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center">Sin Documentación</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- **********************************************************************  -->
                        <!-- documentos de Dotaciones  -->
                        <div class="col-12 col-md-5 table-responsive mb-4">
                            <table class="table table-striped table-hover table-sm tabla-data">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th class="text-center" colspan="2">
                                            <h6><strong>Documentos dotaciones</strong></h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($empleado->documentos->where('tipo', 'dotacion')->count() > 0)
                                        @foreach ($empleado->documentos as $documento)
                                            @if ($documento->tipo == 'dotacion')
                                                <tr>
                                                    <td class="text-center"><a
                                                            href="{{ asset('documentos/doc_empleados/' . $documento->documento) }}"
                                                            target="_blank">{{ $documento->nom_documento }}</a></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="2">Sin Documentos</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- **********************************************************************  -->
                        <!-- documentos Evaluaciones de desempeño  -->
                        <div class="col-12 col-md-5 table-responsive mb-4">
                            <table class="table table-striped table-hover table-sm tabla-data">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th class="text-center" colspan="2">
                                            <h6><strong>Evaluaciones de desempeño</strong></h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($empleado->documentos->where('tipo', 'evaluacion_desemp')->count() > 0)
                                        @foreach ($empleado->documentos as $documento)
                                            @if ($documento->tipo == 'evaluacion_desemp')
                                                <tr>
                                                    <td class="text-center"><a
                                                            href="{{ asset('documentos/doc_empleados/' . $documento->documento) }}"
                                                            target="_blank">{{ $documento->nom_documento }}</a></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="2">Sin Documentos</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- **********************************************************************  -->
                        <!-- documentos Vacaciones y licencias  -->
                        <div class="col-12 col-md-5 table-responsive mb-4">
                            <table class="table table-striped table-hover table-sm tabla-data">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th class="text-center" colspan="2">
                                            <h6><strong>Vacaciones y licencias</strong></h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($empleado->documentos->where('tipo', 'vacaciones')->count() > 0)
                                        @foreach ($empleado->documentos as $documento)
                                            @if ($documento->tipo == 'vacaciones')
                                                <tr>
                                                    <td class="text-center"><a
                                                            href="{{ asset('documentos/doc_empleados/' . $documento->documento) }}"
                                                            target="_blank">{{ $documento->nom_documento }}</a></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="2">Sin Documentos</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- **********************************************************************  -->
                        <!-- documentos Capacitaciones y certificaciones  -->
                        <div class="col-12 col-md-5 table-responsive mb-4">
                            <table class="table table-striped table-hover table-sm tabla-data">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th class="text-center" colspan="2">
                                            <h6><strong>Capacitaciones y certificaciones</strong></h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($empleado->documentos->where('tipo', 'capacitacion')->count() > 0)
                                        @foreach ($empleado->documentos as $documento)
                                            @if ($documento->tipo == 'capacitacion')
                                                <tr>
                                                    <td class="text-center"><a
                                                            href="{{ asset('documentos/doc_empleados/' . $documento->documento) }}"
                                                            target="_blank">{{ $documento->nom_documento }}</a></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="2">Sin Documentos</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- **********************************************************************  -->
                        <!-- documentos Documentos de Retiro  -->
                        <div class="col-12 col-md-5 table-responsive mb-4">
                            <table class="table table-striped table-hover table-sm tabla-data">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th class="text-center" colspan="2">
                                            <h6><strong>Documentos de retiro</strong></h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($empleado->documentos->where('tipo', 'doc_retiro')->count() > 0)
                                        @foreach ($empleado->documentos as $documento)
                                            @if ($documento->tipo == 'doc_retiro')
                                                <tr>
                                                    <td class="text-center"><a
                                                            href="{{ asset('documentos/doc_empleados/' . $documento->documento) }}"
                                                            target="_blank">{{ $documento->nom_documento }}</a></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="2">Sin Documentos</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- **********************************************************************  -->
                    </div>
                    <hr>
                    <div class="row">
                        <!-- **********************************************************************  -->
                        <!-- Historias clínicas ocupacionales  -->
                        <div class="col-12 table-responsive mb-4">
                            <div class="row mb-3">
                                <div class="col-12 text-center">
                                    <h5><strong>Historias clínicas ocupacionales</strong></h5>
                                </div>
                            </div>
                            <div class="row  d-flex justify-content-around">
                                <div class="col-10 col-md-5">
                                    <div class="row">
                                        <div class="col-12 text-center mb-2" style="border-bottom: 2px solid black;">
                                            <h6><strong>Examenes Medicos</strong></h6>
                                        </div>
                                        <div class="col-12 table-responsive">
                                            <table class="table table-striped table-hover table-sm tabla-data">
                                                <thead class="thead-inverse">
                                                    <tr>
                                                        <th class="text-center" colspan="2"
                                                            style="border-bottom: 1px solid black">Examenes Medicos Ingreso
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($empleado->documentos->where('tipo', 'his_clin-exa-ingreso')->count() > 0)
                                                        @foreach ($empleado->documentos as $soporte)
                                                            @if ($soporte->tipo == 'his_clin-exa-ingreso')
                                                                <tr>
                                                                    <td class="text-center"><a
                                                                            href="{{ asset('documentos/doc_empleados/' . $soporte->documento) }}"
                                                                            target="_blank">{{ $soporte->nom_documento }}</a>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <form
                                                                            action="{{ route('his_clin_ocup-eliminar', ['id' => $soporte->id]) }}"
                                                                            class="d-inline form-eliminar" method="POST">
                                                                            @csrf @method("delete")
                                                                            <button type="submit"
                                                                                class="btn-accion-tabla eliminar tooltipsC"
                                                                                title="Eliminar este registro"><i
                                                                                    class="fas fa-trash-alt text-danger"></i></button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td class="text-center" colspan="2">Sin Documentos</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                                <thead class="thead-inverse">
                                                    <tr>
                                                        <th class="text-center" colspan="2"
                                                            style="border-bottom: 1px solid black">Examenes Medicos
                                                            Periodicos</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($empleado->documentos->where('tipo', 'his_clin-exa-periodico')->count() > 0)
                                                        @foreach ($empleado->documentos as $soporte)
                                                            @if ($soporte->tipo == 'his_clin-exa-periodico')
                                                                <tr>
                                                                    <td class="text-center"><a
                                                                            href="{{ asset('documentos/doc_empleados/' . $soporte->documento) }}"
                                                                            target="_blank">{{ $soporte->nom_documento }}</a>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <form
                                                                            action="{{ route('his_clin_ocup-eliminar', ['id' => $soporte->id]) }}"
                                                                            class="d-inline form-eliminar" method="POST">
                                                                            @csrf @method("delete")
                                                                            <button type="submit"
                                                                                class="btn-accion-tabla eliminar tooltipsC"
                                                                                title="Eliminar este registro"><i
                                                                                    class="fas fa-trash-alt text-danger"></i></button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td class="text-center" colspan="2">Sin Documentos</td>
                                                        </tr>
                                                    @endif
                                                </tbody>

                                                <thead class="thead-inverse">
                                                    <tr>
                                                        <th class="text-center" colspan="2"
                                                            style="border-bottom: 1px solid black">Examenes Medicos de
                                                            Retiro</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($empleado->documentos->where('tipo', 'his_clin-exa-retiro')->count() > 0)
                                                        @foreach ($empleado->documentos as $soporte)
                                                            @if ($soporte->tipo == 'his_clin-exa-retiro')
                                                                <tr>
                                                                    <td class="text-center"><a
                                                                            href="{{ asset('documentos/doc_empleados/' . $soporte->documento) }}"
                                                                            target="_blank">{{ $soporte->nom_documento }}</a>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <form
                                                                            action="{{ route('his_clin_ocup-eliminar', ['id' => $soporte->id]) }}"
                                                                            class="d-inline form-eliminar" method="POST">
                                                                            @csrf @method("delete")
                                                                            <button type="submit"
                                                                                class="btn-accion-tabla eliminar tooltipsC"
                                                                                title="Eliminar este registro"><i
                                                                                    class="fas fa-trash-alt text-danger"></i></button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td class="text-center" colspan="2">Sin Documentos</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10 col-md-5">
                                    <div class="row">
                                        <div class="col-12 text-center mb-2" style="border-bottom: 2px solid black;">
                                            <h6><strong>Accidente o Enfermedad Laboral</strong></h6>
                                        </div>
                                        <div class="col-12 table-responsive">
                                            <table class="table table-striped table-hover table-sm tabla-data">
                                                <thead class="thead-inverse">
                                                    <tr>
                                                        <th class="text-center" colspan="2"
                                                            style="border-bottom: 1px solid black">Informes</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($empleado->documentos->where('tipo', 'his_clin-acc-informe')->count() > 0)
                                                        @foreach ($empleado->documentos as $soporte)
                                                            @if ($soporte->tipo == 'his_clin-acc-informe')
                                                                <tr>
                                                                    <td class="text-center"><a
                                                                            href="{{ asset('documentos/doc_empleados/' . $soporte->documento) }}"
                                                                            target="_blank">{{ $soporte->nom_documento }}</a>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <form
                                                                            action="{{ route('his_clin_ocup-eliminar', ['id' => $soporte->id]) }}"
                                                                            class="d-inline form-eliminar" method="POST">
                                                                            @csrf @method("delete")
                                                                            <button type="submit"
                                                                                class="btn-accion-tabla eliminar tooltipsC"
                                                                                title="Eliminar este registro"><i
                                                                                    class="fas fa-trash-alt text-danger"></i></button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td class="text-center" colspan="2">Sin Documentos</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                                <thead class="thead-inverse">
                                                    <tr>
                                                        <th class="text-center" colspan="2"
                                                            style="border-bottom: 1px solid black">FURAT</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($empleado->documentos->where('tipo', 'his_clin-acc-furat')->count() > 0)
                                                        @foreach ($empleado->documentos as $soporte)
                                                            @if ($soporte->tipo == 'his_clin-acc-furat')
                                                                <tr>
                                                                    <td class="text-center"><a
                                                                            href="{{ asset('documentos/doc_empleados/' . $soporte->documento) }}"
                                                                            target="_blank">{{ $soporte->nom_documento }}</a>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <form
                                                                            action="{{ route('his_clin_ocup-eliminar', ['id' => $soporte->id]) }}"
                                                                            class="d-inline form-eliminar" method="POST">
                                                                            @csrf @method("delete")
                                                                            <button type="submit"
                                                                                class="btn-accion-tabla eliminar tooltipsC"
                                                                                title="Eliminar este registro"><i
                                                                                    class="fas fa-trash-alt text-danger"></i></button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td class="text-center" colspan="2">Sin Documentos</td>
                                                        </tr>
                                                    @endif
                                                </tbody>

                                                <thead class="thead-inverse">
                                                    <tr>
                                                        <th class="text-center" colspan="2"
                                                            style="border-bottom: 1px solid black">Otros</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($empleado->documentos->where('tipo', 'his_clin-acc-otros')->count() > 0)
                                                        @foreach ($empleado->documentos as $soporte)
                                                            @if ($soporte->tipo == 'his_clin-acc-otros')
                                                                <tr>
                                                                    <td class="text-center"><a
                                                                            href="{{ asset('documentos/doc_empleados/' . $soporte->documento) }}"
                                                                            target="_blank">{{ $soporte->nom_documento }}</a>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <form
                                                                            action="{{ route('his_clin_ocup-eliminar', ['id' => $soporte->id]) }}"
                                                                            class="d-inline form-eliminar" method="POST">
                                                                            @csrf @method("delete")
                                                                            <button type="submit"
                                                                                class="btn-accion-tabla eliminar tooltipsC"
                                                                                title="Eliminar este registro"><i
                                                                                    class="fas fa-trash-alt text-danger"></i></button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td class="text-center" colspan="2">Sin Documentos</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10 col-md-5 mt-5">
                                    <div class="row">
                                        <div class="col-12 text-center mb-2" style="border-bottom: 2px solid black;">
                                            <h6><strong>Afectaciones de salud de origen comun</strong></h6>
                                        </div>
                                        <div class="col-12 table-responsive">
                                            <table class="table table-striped table-hover table-sm tabla-data">
                                                <thead class="thead-inverse">
                                                    <tr>
                                                        <th class="text-center" colspan="2"
                                                            style="border-bottom: 1px solid black">Incapacidades</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($empleado->documentos->where('tipo', 'his_clin-afe-incapacidades')->count() > 0)
                                                        @foreach ($empleado->documentos as $soporte)
                                                            @if ($soporte->tipo == 'his_clin-afe-incapacidades')
                                                                <tr>
                                                                    <td class="text-center"><a
                                                                            href="{{ asset('documentos/doc_empleados/' . $soporte->documento) }}"
                                                                            target="_blank">{{ $soporte->nom_documento }}</a>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <form
                                                                            action="{{ route('his_clin_ocup-eliminar', ['id' => $soporte->id]) }}"
                                                                            class="d-inline form-eliminar" method="POST">
                                                                            @csrf @method("delete")
                                                                            <button type="submit"
                                                                                class="btn-accion-tabla eliminar tooltipsC"
                                                                                title="Eliminar este registro"><i
                                                                                    class="fas fa-trash-alt text-danger"></i></button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td class="text-center" colspan="2">Sin Documentos</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                                <thead class="thead-inverse">
                                                    <tr>
                                                        <th class="text-center" colspan="2"
                                                            style="border-bottom: 1px solid black">Restricciones Laborales
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($empleado->documentos->where('tipo', 'his_clin-afe-resticciones')->count() > 0)
                                                        @foreach ($empleado->documentos as $soporte)
                                                            @if ($soporte->tipo == 'his_clin-afe-resticciones')
                                                                <tr>
                                                                    <td class="text-center"><a
                                                                            href="{{ asset('documentos/doc_empleados/' . $soporte->documento) }}"
                                                                            target="_blank">{{ $soporte->nom_documento }}</a>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <form
                                                                            action="{{ route('his_clin_ocup-eliminar', ['id' => $soporte->id]) }}"
                                                                            class="d-inline form-eliminar" method="POST">
                                                                            @csrf @method("delete")
                                                                            <button type="submit"
                                                                                class="btn-accion-tabla eliminar tooltipsC"
                                                                                title="Eliminar este registro"><i
                                                                                    class="fas fa-trash-alt text-danger"></i></button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td class="text-center" colspan="2">Sin Documentos</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                                <thead class="thead-inverse">
                                                    <tr>
                                                        <th class="text-center" colspan="2"
                                                            style="border-bottom: 1px solid black">Dictamenes de PCL</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($empleado->documentos->where('tipo', 'his_clin-afe-dictamenes')->count() > 0)
                                                        @foreach ($empleado->documentos as $soporte)
                                                            @if ($soporte->tipo == 'his_clin-afe-dictamenes')
                                                                <tr>
                                                                    <td class="text-center"><a
                                                                            href="{{ asset('documentos/doc_empleados/' . $soporte->documento) }}"
                                                                            target="_blank">{{ $soporte->nom_documento }}</a>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <form
                                                                            action="{{ route('his_clin_ocup-eliminar', ['id' => $soporte->id]) }}"
                                                                            class="d-inline form-eliminar" method="POST">
                                                                            @csrf @method("delete")
                                                                            <button type="submit"
                                                                                class="btn-accion-tabla eliminar tooltipsC"
                                                                                title="Eliminar este registro"><i
                                                                                    class="fas fa-trash-alt text-danger"></i></button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td class="text-center" colspan="2">Sin Documentos</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                                <thead class="thead-inverse">
                                                    <tr>
                                                        <th class="text-center" colspan="2"
                                                            style="border-bottom: 1px solid black">Otros</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($empleado->documentos->where('tipo', 'his_clin-afe-otros')->count() > 0)
                                                        @foreach ($empleado->documentos as $soporte)
                                                            @if ($soporte->tipo == 'his_clin-afe-otros')
                                                                <tr>
                                                                    <td class="text-center"><a
                                                                            href="{{ asset('documentos/doc_empleados/' . $soporte->documento) }}"
                                                                            target="_blank">{{ $soporte->nom_documento }}</a>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <form
                                                                            action="{{ route('his_clin_ocup-eliminar', ['id' => $soporte->id]) }}"
                                                                            class="d-inline form-eliminar" method="POST">
                                                                            @csrf @method("delete")
                                                                            <button type="submit"
                                                                                class="btn-accion-tabla eliminar tooltipsC"
                                                                                title="Eliminar este registro"><i
                                                                                    class="fas fa-trash-alt text-danger"></i></button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td class="text-center" colspan="2">Sin Documentos</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- **********************************************************************  -->
                    </div>
                    <hr>
                    <div class="row">
                        <!-- **********************************************************************  -->
                        <!-- Historias clínicas ocupacionales  -->
                        <div class="col-12 mb-4">
                            <div class="row mb-3">
                                <div class="col-12 text-center">
                                    <h5><strong>Procesos disciplinarios</strong></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 table-responsive">
                            <table class="table table-striped table-hover table-bordered table-sm tabla-data">
                                <thead class="thead-inverse">
                                    @if ($empleado->procesos->count() > 0)
                                        <tr>
                                            <th class="text-center">Fecha</th>
                                            <th>Descripción</th>
                                            <th class="text-center">Citacion</th>
                                            <th class="text-center">Acta de descargos</th>
                                            <th class="text-center">Documento de Cierre</th>
                                            <th class="text-center">Recurso</th>
                                            <th class="text-center">Decisión de Segunda Instancia</th>
                                        </tr>
                                    @else
                                        <tr>
                                            <th class="text-center" colspan="5">Documentos</th>
                                        </tr>
                                    @endif
                                </thead>
                                <tbody>
                                    @if ($empleado->procesos->count() > 0)
                                        @foreach ($empleado->procesos as $proceso)
                                            <tr>
                                                <td class="text-center" style="white-space:nowrap;vertical-align:middle;">
                                                    {{ $proceso->fecha }}</td>
                                                <td style="width: 250px;">{{ $proceso->descripcion }}</td>
                                                <td class="text-center" style="white-space:nowrap;vertical-align:middle;"><a
                                                        href="{{ asset('documentos/doc_empleados/' . $proceso->inicio) }}"
                                                        target="_blank">{{ $proceso->inicio }}</a></td>
                                                @if ($proceso->descargos != null)
                                                    <td class="text-center"><a
                                                            href="{{ asset('documentos/doc_empleados/' . $proceso->descargos) }}"
                                                            target="_blank">{{ $proceso->descargos }}</a></td>
                                                @else
                                                    <td class="text-center">---</td>
                                                @endif
                                                @if ($proceso->cierre != null)
                                                    <td class="text-center"
                                                        style="white-space:nowrap;vertical-align:middle;"><a
                                                            href="{{ asset('documentos/doc_empleados/' . $proceso->cierre) }}"
                                                            target="_blank">{{ $proceso->cierre }}</a></td>
                                                @else
                                                    <td class="text-center">---</td>
                                                @endif
                                                @if ($proceso->recurso != null)
                                                    <td class="text-center"
                                                        style="white-space:nowrap;vertical-align:middle;"><a
                                                            href="{{ asset('documentos/doc_empleados/' . $proceso->recurso) }}"
                                                            target="_blank">{{ $proceso->recurso }}</a></td>
                                                @else
                                                    <td class="text-center">---</td>
                                                @endif
                                                @if ($proceso->segunda != null)
                                                    <td class="text-center"
                                                        style="white-space:nowrap;vertical-align:middle;"><a
                                                            href="{{ asset('documentos/doc_empleados/' . $proceso->segunda) }}"
                                                            target="_blank">{{ $proceso->segunda }}</a></td>
                                                @else
                                                    <td class="text-center">---</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="5">Sin Proccesos Disciplinarios</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- **********************************************************************  -->
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
    <script src="{{ asset('js/admin/hojasvida/editar_emp.js') }}"></script>
@endsection
<!-- ************************************************************* -->
