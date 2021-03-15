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
                    <h5>Proceso disciplinario faltas y sanciones:
                        {{ $empleado->usuario->nombres . ' ' . $empleado->usuario->apellidos }}</h5>
                </div>
                <div class="col-12 col-md-6 col-lg-6 text-md-right text-lg-right pl-2 pr-md-5 pr-lg-5">
                    <a href="{{ route('proceso_discip-index', ['id' => $empleado->empresa->id]) }}"
                        class="btn btn-info btn-sm text-center pl-3 pr-3 mr-3" style="font-size: 0.9em;"><i
                            class="fas fa-undo-alt mr-2"></i>Volver</a>
                    <a href="{{ route('proceso_discip-crear', ['id' => $empleado->id]) }}"
                        class="btn btn-success btn-sm text-center pl-3 pr-3" style="font-size: 0.9em;"><i
                            class="fas fa-plus-circle mr-2"></i> Nuevo Proc Disciplinario</a>
                </div>
            </div>
            <hr>
            <div class="row  d-flex justify-content-around">
                <div class="col-10 col-md-10 table-responsive">
                    <table class="table table-striped table-hover table-bordered table-sm tabla-data">
                        <thead class="thead-inverse">
                            @if ($procesos->count() > 0)
                                <tr>
                                    <th class="text-center">Fecha</th>
                                    <th>Descripción</th>
                                    <th class="text-center">Citacion</th>
                                    <th class="text-center">Acta de descargos</th>
                                    <th class="text-center">Documento de Cierre</th>
                                    <th class="text-center">Recurso</th>
                                    <th class="text-center">Decisión de Segunda Instancia</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                            @else
                                <tr>
                                    <th class="text-center" colspan="5">Documentos</th>
                                </tr>
                            @endif
                        </thead>
                        <tbody>
                            @if ($procesos->count() > 0)
                                @foreach ($procesos as $proceso)
                                    <tr>
                                        <td class="text-center">{{ $proceso->fecha }}</td>
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
                                            <td class="text-center" style="white-space:nowrap;vertical-align:middle;"><a
                                                    href="{{ asset('documentos/doc_empleados/' . $proceso->cierre) }}"
                                                    target="_blank">{{ $proceso->cierre }}</a></td>
                                        @else
                                            <td class="text-center">---</td>
                                        @endif
                                        @if ($proceso->recurso != null)
                                            <td class="text-center" style="white-space:nowrap;vertical-align:middle;"><a
                                                    href="{{ asset('documentos/doc_empleados/' . $proceso->recurso) }}"
                                                    target="_blank">{{ $proceso->recurso }}</a></td>
                                        @else
                                            <td class="text-center">---</td>
                                        @endif
                                        @if ($proceso->segunda != null)
                                            <td class="text-center" style="white-space:nowrap;vertical-align:middle;"><a
                                                    href="{{ asset('documentos/doc_empleados/' . $proceso->segunda) }}"
                                                    target="_blank">{{ $proceso->segunda }}</a></td>
                                        @else
                                            <td class="text-center">---</td>
                                        @endif
                                        <td class="text-center"
                                            style="width: 50px;white-space:nowrap;vertical-align:middle;">
                                            <a href="{{ route('proceso_discip-n_archivo', ['id' => $empleado->id, 'id_p' => $proceso->id]) }}"
                                                class="btn-accion-tabla tooltipsC" title="Editar"><i
                                                    class="far fa-edit text-warning"></i></a>
                                            <!-- <form action="{{ route('proceso_discip-eliminar', ['id' => $proceso->id]) }}" class="d-inline form-eliminar" method="POST">
                                                @csrf @method("delete")
                                                <button type="submit" class="btn-accion-tabla eliminar tooltipsC" title="Eliminar este registro"><i class="fas fa-trash-alt text-danger"></i></button>
                                            </form> -->
                                        </td>
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
