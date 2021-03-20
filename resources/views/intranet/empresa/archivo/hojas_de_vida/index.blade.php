@extends("theme.back.plantilla")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
    @include('includes.funciones_php')
@endsection
<!-- titulo hoja -->
@section('estilosHojas')
    <!-- Pagina CSS -->
    <link rel="stylesheet" href="{{ asset('css/intranet/empresas/hojas_de_vida.css') }}">
@endsection
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('tituloHoja')
    Modulo Empresas
@endsection
<!-- ************************************************************* -->
<!-- ************************************************************* -->
<!-- Cuerpo hoja -->
@section('cuerpo_pagina')
    <?php $indOpcion = 0; ?>
    @foreach ($empresa->empleados as $empleado)
        @if ($empleado->id == session('id_usuario'))
            @if ($empleado->opciones->count() > 0)
                @foreach ($empleado->opciones as $opcion)
                    @if ($opcion->id == 1)
                        <?php $indOpcion = 1; ?>
                        @break
                    @endif
                @endforeach
            @else
                <?php $indOpcion = 0; ?>
            @endif
        @endif
    @endforeach
    <div class="card" style="border-top: 8px solid rgb(38, 160, 241);">
        @include('includes.error-form')
        @include('includes.mensaje')
        <div class="card-header">
            <div class="row mb-3">
                <div class="col-12 col-md-6 pl-2">
                    <h4><strong>Hojas de Vida</strong></h4>
                </div>
                @if ($indOpcion > 0)
                    <div class="col-12 col-md-6 pl-2">
                        <a href="{{ route('archivo-hojas_de_vida-exportarExcel', ['id' => $empresa->id]) }}"
                            class="btn btn-success btn-xs btn-sombra pl-3 pr-3 float-md-end mr-3"><i
                                class="fas fa-file-excel mr-2"></i>
                            Exportar</a>
                        <a href="{{ route('hojas_de_vida-crear', ['id' => $empresa->id]) }}"
                            class="btn btn-primary btn-xs btn-sombra pl-3 pr-3 float-md-end mr-5"><i
                                class="fas fa-plus-circle mr-2"></i> Agregar Usuario</a>
                    </div>
                @endif
            </div>
            <div class="row d-flex justify-content-around pt-3 mb-3 pl-2 pr-2">
                <div class="col-12 col-md-10 table-responsive">
                    <table class="table {{ $indOpcion > 0 ? 'display' : '' }} ">
                        <tbody>
                            @foreach ($empresa->empleados as $empleado)
                                @if ($indOpcion == 0)
                                    @if ($empleado->id == session('id_usuario'))
                                        <tr>
                                            <td>
                                                <div class="card card-widget widget-user shadow">
                                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                                    <div class="widget-user-header bg-info">
                                                        <h6 class="widget-user-username">
                                                            {{ $empleado->usuario->nombres . ' ' . $empleado->usuario->apellidos }}
                                                        </h6>
                                                        <p class="widget-user-desc">{{ $empleado->cargo->cargo }}</p>
                                                    </div>
                                                    <div class="widget-user-image">
                                                        <img class="img-circle elevation-4"
                                                            src="{{ asset('imagenes/hojas_de_vida/' . $empleado->foto) }}"
                                                            alt="{{ $empleado->usuario->nombres . ' ' . $empleado->usuario->apellidos }}">
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="row d-flex justify-content-md-center">
                                                            <div class="col-sm-2 border-right">
                                                                <div class="description-block">
                                                                    <h5 class="description-header">Identificación</h5>
                                                                    <span
                                                                        class="description-text">{{ $empleado->usuario->identificacion }}</span>
                                                                </div>
                                                                <!-- /.description-block -->
                                                            </div>
                                                            <!-- /.col -->
                                                            <div class="col-sm-2 border-right">
                                                                <div class="description-block">
                                                                    <h5 class="description-header">Teléfono</h5>
                                                                    <span
                                                                        class="description-text">{{ $empleado->usuario->telefono }}</span>
                                                                </div>
                                                                <!-- /.description-block -->
                                                            </div>
                                                            <!-- /.col -->
                                                            <div class="col-sm-3 border-right">
                                                                <div class="description-block">
                                                                    <h5 class="description-header">Email</h5>
                                                                    <span
                                                                        class="description-text text-lowercase text-nowrap">{{ $empleado->usuario->email }}</span>
                                                                </div>
                                                                <!-- /.description-block -->
                                                            </div>
                                                            <!-- /.col -->
                                                            <div class="col-sm-2 border-right">
                                                                <div class="description-block">
                                                                    <h5 class="description-header">Vinculación</h5>
                                                                    <span
                                                                        class="description-text text-lowercase text-nowrap">{{ $empleado->vinculacion }}</span>
                                                                </div>
                                                                <!-- /.description-block -->
                                                            </div>
                                                            <!-- /.col -->
                                                            <div class="col-sm-3">
                                                                <div class="description-block">
                                                                    <h5 class="description-header">Opciones</h5>
                                                                    <span
                                                                        class="description-text d-flex justify-content-md-between mt-2">
                                                                        <a href="{{ route('hojas_de_vida-editar', ['id' => $empleado->id]) }}"
                                                                            class="btn btn-primary pl-1 pr-1 btn-xs btn-sombra"><i
                                                                                class="fa fa-edit mr-1"
                                                                                aria-hidden="true"></i>
                                                                            Editar</a>
                                                                        <a href="{{ route('hojas_de_vida-detalles', ['id' => $empleado->id]) }}"
                                                                            class="btn btn-info pl-1 pr-1 btn-xs btn-sombra"><i
                                                                                class="fa fa-eye mr-1"
                                                                                aria-hidden="true"></i>
                                                                            Detalles</a>
                                                                    </span>
                                                                </div>
                                                                <!-- /.description-block -->
                                                            </div>
                                                            <!-- /.col -->
                                                        </div>
                                                        <!-- /.row -->
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @break
                                    @endif
                                @else
                                    <tr>
                                        <td>
                                            <div class="card card-widget widget-user shadow">
                                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                                <div class="widget-user-header bg-info">
                                                    <h6 class="widget-user-username">
                                                        {{ $empleado->usuario->nombres . ' ' . $empleado->usuario->apellidos }}
                                                    </h6>
                                                    <p class="widget-user-desc">{{ $empleado->cargo->cargo }}</p>
                                                </div>
                                                <div class="widget-user-image">
                                                    <img class="img-circle elevation-4"
                                                        src="{{ asset('imagenes/hojas_de_vida/' . $empleado->foto) }}"
                                                        alt="{{ $empleado->usuario->nombres . ' ' . $empleado->usuario->apellidos }}">
                                                </div>
                                                <div class="card-footer">
                                                    <div class="row d-flex justify-content-md-center">
                                                        <div class="col-sm-2 border-right">
                                                            <div class="description-block">
                                                                <h5 class="description-header">Identificación</h5>
                                                                <span
                                                                    class="description-text">{{ $empleado->usuario->identificacion }}</span>
                                                            </div>
                                                            <!-- /.description-block -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col-sm-2 border-right">
                                                            <div class="description-block">
                                                                <h5 class="description-header">Teléfono</h5>
                                                                <span
                                                                    class="description-text">{{ $empleado->usuario->telefono }}</span>
                                                            </div>
                                                            <!-- /.description-block -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col-sm-3 border-right">
                                                            <div class="description-block">
                                                                <h5 class="description-header">Email</h5>
                                                                <span
                                                                    class="description-text text-lowercase text-nowrap">{{ $empleado->usuario->email }}</span>
                                                            </div>
                                                            <!-- /.description-block -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col-sm-2 border-right">
                                                            <div class="description-block">
                                                                <h5 class="description-header">Vinculación</h5>
                                                                <span
                                                                    class="description-text text-lowercase text-nowrap">{{ $empleado->vinculacion }}</span>
                                                            </div>
                                                            <!-- /.description-block -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col-sm-3">
                                                            <div class="description-block">
                                                                <h5 class="description-header">Opciones</h5>
                                                                <span
                                                                    class="description-text d-flex justify-content-md-between mt-2">
                                                                    <a href="{{ route('hojas_de_vida-editar', ['id' => $empleado->id]) }}"
                                                                        class="btn btn-primary pl-1 pr-1 btn-xs btn-sombra"><i
                                                                            class="fa fa-edit mr-1" aria-hidden="true"></i>
                                                                        Editar</a>
                                                                    <a href="{{ route('hojas_de_vida-detalles', ['id' => $empleado->id]) }}"
                                                                        class="btn btn-info pl-1 pr-1 btn-xs btn-sombra"><i
                                                                            class="fa fa-eye mr-1" aria-hidden="true"></i>
                                                                        Detalles</a>
                                                                </span>
                                                            </div>
                                                            <!-- /.description-block -->
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                    <!-- /.row -->
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
    <script src="{{ asset('js/intranet/empresas/hojas_de_vida.js') }}"></script>
@endsection
<!-- ************************************************************* -->
