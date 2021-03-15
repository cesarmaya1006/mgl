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
    Modulo Procesos
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
    <div class="row">
        <div class="col-12 col-md-6 mb-3 pl-4">
            <h5>Listados Procesos</h5>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-11 table-responsive">
            <table class="table table-sm display">
                <thead>
                    <tr>
                        <th scope="col" class="text-center text-nowrap" style="vertical-align: middle;">id</th>
                        <th scope="col" class="text-center text-nowrap" style="vertical-align: middle;">Estado
                            Notificaci&oacute;n</th>
                        <th scope="col" class="text-center text-nowrap" style="vertical-align: middle;">Fecha
                            Notificaci&oacute;n</th>
                        <th scope="col" class="text-center text-nowrap" style="vertical-align: middle;">Fecha Conocimiento
                            Jurídico</th>
                        <th scope="col" class="text-center text-nowrap" style="vertical-align: middle;">C&oacute;digo
                            Proceso</th>
                        <th scope="col" class="text-center text-nowrap" style="vertical-align: middle;">Tipo de Proceso</th>
                        <th scope="col" class="text-center text-nowrap" style="vertical-align: middle;">Cliente</th>
                        <th scope="col" class="text-center text-nowrap" style="vertical-align: middle;">Apoderado</th>
                        <th scope="col" class="text-center text-nowrap" style="vertical-align: middle;">Asistente</th>
                        <th scope="col" class="text-center text-nowrap" style="vertical-align: middle;">Fecha de
                            Admisi&oacute;n</th>
                        <th scope="col" class="text-center text-nowrap" style="vertical-align: middle;">Fecha de
                            radicaci&oacute;n</th>
                        <th scope="col" class="text-center text-nowrap" style="vertical-align: middle;">Juzgado</th>
                        <th scope="col" class="text-center text-nowrap" style="vertical-align: middle;">Cuantía</th>
                        <th scope="col" class="text-center text-nowrap" style="vertical-align: middle;">Demandantes</th>
                        <th scope="col" class="text-center text-nowrap" style="vertical-align: middle;">Demandados</th>
                        @if (session('rol_id') < 5)
                            <th scope="col" class="text-center text-nowrap" style="vertical-align: middle;">Riesgo Pérdida

                            </th>
                        @endif
                        <th class="width70" style="vertical-align: middle;">Opciones</th>
                    </tr>
                </thead>
                <tbody id="contenido_tabla_list_procesos">
                    @foreach ($procesos as $proceso)
                        <tr>
                            <td class="text-nowrap text-center">{{ $proceso->id }}</td>
                            <td class="text-nowrap text-center">{{ $proceso->estado_notifi }}</td>
                            <td class="text-nowrap text-center">{{ $proceso->fecha_notifi }}</td>
                            <td class="text-nowrap text-center">{{ $proceso->fecha_conoci_juridi }}</td>
                            <td class="text-nowrap text-center">{{ $proceso->codigo_unico_proceso }}</td>
                            <td class="text-nowrap">{{ $proceso->tipos_proceso->tipo_proceso }}</td>
                            <td class="text-nowrap">
                                @foreach ($proceso->empresas as $empresa)
                                    {{ $empresa->nombre }}
                                @endforeach
                            </td>
                            <td>
                                @foreach ($proceso->apoderados_proceso as $apoderado)
                                    <p class="text-nowrap">Lic.
                                        {{ $apoderado->usuario->nombres . ' ' . $apoderado->usuario->apellidos }}</p>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($proceso->asistentes_proceso as $asistente)
                                    <p class="text-nowrap">Asist.
                                        {{ $asistente->usuario->nombres . ' ' . $asistente->usuario->apellidos }}</p>
                                @endforeach
                            </td>
                            <td class="text-nowrap text-center">{{ $proceso->fecha_admin }}</td>
                            <td class="text-nowrap text-center">{{ $proceso->fecha_radicacion }}</td>
                            <td class="text-nowrap">{{ $proceso->juzgados->despacho }}</td>
                            <td class="text-nowrap text- right">{{ $proceso->cuantia }}</td>
                            <td>
                                @foreach ($proceso->demandantes as $demandante)
                                    <p class="text-nowrap">{{ $demandante->nombres }}</p>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($proceso->demandados as $demandado)
                                    <p class="text-nowrap">{{ $demandado->nombres }}</p>
                                @endforeach
                            </td>
                            @if (session('rol_id') < 5)
                                <td class="text-nowrap">{{ $proceso->riesgos_perdida->riesgo_perdida }}</td>
                            @endif
                            <td class="text-center">
                                <a href="{{ route('admin-procesos-detalle', ['id' => $proceso->id]) }}"
                                    class="btn btn-accion-tabla text-primary mr-2 ml-2" title="Ver"><i
                                        class="fas fa-eye"></i></a>
                                @if (session('rol_id') < 5)
                                    <a href="{{ route('admin-procesos-editar', ['id' => $proceso->id]) }}"
                                        class="btn btn-accion-tabla text-primary mr-2 ml-2" title="Editar"><i
                                            class="fas fa-edit"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
