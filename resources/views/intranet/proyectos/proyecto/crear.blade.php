    @extends("theme.back.plantilla")
    <!-- ************************************************************* -->
    <!-- Funciones php -->
    @section('funciones_php')
        @include('includes.funciones_php')
    @endsection
    <!-- titulo hoja -->
    @section('estilosHojas')
        <!-- Pagina CSS -->
        <link rel="stylesheet" href="{{ asset('css/intranet/proyectos/index.css') }}">
    @endsection
    <!-- ************************************************************* -->
    <!-- titulo hoja -->
    @section('tituloHoja')
        Modulo Proyectos - Crear
    @endsection
    <!-- ************************************************************* -->
    <!-- ************************************************************* -->
    <!-- Cuerpo hoja -->
    @section('cuerpo_pagina')
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-11">
                <div class="card card-light">
                    <div class="card-header">
                        <h3 class="card-title">Nuevo Proyecto</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form role="form" action="{{ route('proyecto-guardar') }}"
                            class="row form-horizontal mt-3 mb-5 d-flex justify-content-between" method="POST"
                            autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <input type="hidden" name="empresa_id" value="{{ $empleado->empresa->id }}">
                            <input type="hidden" name="estado" value="Nuevo">
                            <input type="hidden" name="progreso" value="0">
                            <div class="col-12 col-md-2 form-group">
                                <label for="fec_creacion">Fecha Proyecto</label>
                                <input type="hidden" name="fec_creacion" value="{{ date('Y-m-d') }}">
                                <span class="form-control form-control-sm">{{ date('Y-m-d') }}</span>
                                <small id="helpId" class="form-text text-muted">Fecha creación proyecto</small>
                            </div>
                            <div class="col-12 col-md-4 form-group">
                                <label for="titulo">Lider Proyecto</label>
                                <select class="form-control form-control-sm" name="lider_id" id="lider_id" required>
                                    <option value="">Seleccione un Lider</option>
                                    @foreach ($empleado->empresa->empleados as $empleado)
                                        @if ($empleado->lider)
                                            <option value="{{ $empleado->id }}" class="text-uppercase">
                                                {{ $empleado->cargo->cargo . ' - ' . $empleado->usuario->nombres . ' ' . $empleado->usuario->apellidos }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                <small id="helpId" class="form-text text-muted">Lider Proyecto</small>
                            </div>
                            <div class="col-12 col-md-4 form-group">
                                <label for="titulo">Titulo Proyecto</label>
                                <input type="text" class="form-control form-control-sm" name="titulo" id="titulo"
                                    aria-describedby="helpId" onkeyup="mayus(this);" required>
                                <small id="helpId" class="form-text text-muted">Titulo Proyecto</small>
                            </div>
                            <div class="col-12 form-group">
                                <label for="titulo">Titulo Proyecto</label>
                                <textarea class="form-control form-control-sm" id="objetivo" name="objetivo" rows="3"
                                    placeholder="Ingrese el objetivo de proyecto" required></textarea>
                                <small id="helpId" class="form-text text-muted">Titulo Proyecto</small>
                            </div>
                            <div class="col-12 mt-4 pl-3">
                                <button type="submit" class="btn btn-primary btn-xs btn-sombra pl-4 pr-4">Crear
                                    Proyecto</button>
                            </div>
                        </form>
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
        <script src="{{ asset('js/intranet/proyectos/index.js') }}"></script>
    @endsection
    <!-- ************************************************************* -->
