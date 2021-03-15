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
                    <h5>Manuales de Función</h5>
                </div>
                <div class="col-12 col-md-6 col-lg-6 text-md-right text-lg-right pl-2 pr-md-5 pr-lg-5">
                    @if (session('rol_id') < 3)
                        <a href="{{ route('archivo-indexclientes', ['id' => $id]) }}"
                            class="btn btn-info btn-sm text-center pl-3 pr-3 mr-3"><i
                                class="fas fa-undo-alt mr-2"></i>Volver</a>
                    @else
                        <a href="{{ route('archivo-index') }}" class="btn btn-info btn-sm text-center pl-3 pr-3 mr-3"><i
                                class="fas fa-undo-alt mr-2"></i>Volver</a>
                    @endif
                </div>
            </div>
            <hr>
            <div class="row d-flex justify-content-around mt-3 mb-5" id="listado_empleados">
                <div class="col-10 col-md-6 col-lg-8 table-responsive">
                    <table class="table table-striped table-bordered table-hover table-sm tabla-data display">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">Nivel</th>
                                <th class="text-center" scope="col">Area</th>
                                <th class="text-center" scope="col">Cargo</th>
                                <th class="text-center" scope="col">Manual</th>
                                <th class="text-center" scope="col">Ultima Actualización</th>
                                <th class="text-center" scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($niveles as $nivel)
                                @foreach ($nivel->areas as $area)
                                    @foreach ($area->cargos as $cargo)
                                        <tr id="cargo_{{ $cargo->id }}">
                                            <td class="text-center">{{ $nivel->nivel }}</td>
                                            <td class="text-center">{{ $area->area }}</td>
                                            <td class="text-center">{{ $cargo->cargo }}</td>
                                            <td class="text-center">
                                                @if ($cargo->manual != null) <a
                                                        href="{{ asset('documentos/manuales/' . $cargo->manual) }}"
                                                    target="_blank">{{ $cargo->manual }}</a> @else No registra manual
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($cargo->manual != null)
                                                {{ $cargo->updated_at }} @else --- @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($cargo->manual != null)
                                                    <form
                                                        action="{{ route('manuales-elim_manual', ['id' => $cargo->id]) }}"
                                                        redireccion="{{ route('manuales-index', ['id' => $cargo->area->nivel->empresa->id]) }}"
                                                        class="d-inline form-eliminar" method="POST">
                                                        @csrf @method("put")
                                                        <button type="submit" class="btn-accion-tabla eliminar tooltipsC"
                                                            title="Eliminar este registro"><i
                                                                class="fas fa-trash-alt text-danger"></i></button>
                                                    </form>
                                                @else
                                                    <a href="{{ route('manuales-nuev_manual', ['id' => $cargo->id]) }}"
                                                        class="btn-accion-tabla eliminar tooltipsC"><i
                                                            class="fas fa-plus-circle text-success"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach

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
    <script src="{{ asset('js/intranet/empresas/archivo/manuales.js') }}"></script>
@endsection
<!-- ************************************************************* -->
