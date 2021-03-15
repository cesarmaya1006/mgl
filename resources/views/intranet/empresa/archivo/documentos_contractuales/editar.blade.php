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
                    <h5>Documentos contractuales: {{ $empleado->usuario->nombres . ' ' . $empleado->usuario->apellidos }}
                    </h5>
                </div>
                <div class="col-12 col-md-6 col-lg-6 text-md-right text-lg-right pl-2 pr-md-5 pr-lg-5">
                    <a href="{{ route('documentoscontractuales-index', ['id' => $empleado->empresa->id]) }}"
                        class="btn btn-info btn-sm text-center pl-3 pr-3 mr-3" style="font-size: 0.9em;"><i
                            class="fas fa-undo-alt mr-2"></i>Volver</a>
                    <a href="{{ route('documentoscontractuales-crear', ['id' => $empleado->id]) }}"
                        class="btn btn-success btn-sm text-center pl-3 pr-3" style="font-size: 0.9em;"><i
                            class="fas fa-plus-circle mr-2"></i> Nuevo Soporte</a>
                </div>
            </div>
            <hr>
            <div class="row  d-flex justify-content-around">
                <div class="col-10 col-md-5 table-responsive">
                    <table class="table table-striped table-hover table-sm tabla-data">
                        <thead class="thead-inverse">
                            @if ($soportes->count() > 0)
                                <tr>
                                    <th class="text-center">Documentos</th>
                                    <th></th>
                                </tr>
                            @else
                                <tr>
                                    <th class="text-center" colspan="2">Documentos</th>
                                </tr>
                            @endif
                        </thead>
                        <tbody>
                            @if ($soportes->count() > 0)
                                @foreach ($soportes as $soporte)
                                    <tr>
                                        <td class="text-center"><a
                                                href="{{ asset('documentos/doc_empleados/' . $soporte->documento) }}"
                                                target="_blank">{{ $soporte->nom_documento }}</a></td>
                                        <td class="text-center">
                                            <form
                                                action="{{ route('documentoscontractuales-eliminar', ['id' => $soporte->id]) }}"
                                                class="d-inline form-eliminar" method="POST">
                                                @csrf @method("delete")
                                                <button type="submit" class="btn-accion-tabla eliminar tooltipsC"
                                                    title="Eliminar este registro"><i
                                                        class="fas fa-trash-alt text-danger"></i></button>
                                            </form>
                                        </td>
                                    </tr>
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
    <!-- *********************************************************************************************************************************** -->
    <!-- *********************************************************************************************************************************** -->
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
    <script src="{{ asset('js/intranet/empresas/archivo/soportes.js') }}"></script>
@endsection
<!-- ************************************************************* -->
