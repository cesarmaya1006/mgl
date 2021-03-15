@extends("theme.back.plantilla")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
@include('includes.funciones_php')
@endsection
<!-- titulo hoja -->
@section('estilosHojas')
<!-- Pagina CSS -->
<link rel="stylesheet" href="{{ asset('css/proyectos/proyectos.css') }}">
@endsection
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('tituloHoja')
Componente Proyectos
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
                <h4>Historiales - crear</h4>
            </div>
            <div class="col-12 col-md-6 col-lg-6 text-md-right text-lg-right pl-2 pr-md-5 pr-lg-5">
                <a href="{{route('proyecto-tareas-index',['id'=>$tarea->id])}}" class="btn btn-info btn-xs text-center pl-5 pr-5"><i class="fas fa-undo-alt mr-2"></i>Volver</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12 col-md-4">Usuario: <strong style="font-size: 1.2em;">{{$tarea->responsable->nombres.' '.$tarea->responsable->apellidos}}</strong></div>
            <div class="col-12 col-md-4">Fecha: <strong style="font-size: 1.2em;">{{date('Y-m-d')}}</strong></div>
        </div>
        <hr>
        <form class="row d-flex justify-content-between" action="{{route('proyecto-historiales-guardar',  ['id' => $id])}}" method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf
            @method('post')
            <input type="hidden" name="tarea_id" value="{{$tarea->id}}" required>
            <input type="hidden" name="fecha" value="{{date('Y-m-d')}}" required>
            <input type="hidden" name="usuariohistorial_id" value="{{session('id_usuario')}}" required>
            <div class="col-12 col-md-6 form-group">
                <label for="titulo">Titulo historial</label>
                <input type="text" class="form-control form-control-sm" name="titulo" id="titulo" value="{{old('titulo')}}" required>
                <small id="helpId" class="form-text text-muted">Titulo historial</small>
            </div>
            <div class="col-12 col-md-4 form-group">
                <label for="usuarioasignado_id">Asignación de tarea</label>
                <select class="form-control form-control-sm" name="usuarioasignado_id" id="usuarioasignado_id"  aria-describedby="helpId" required>
                    <option value="">Seleccione un responsable</option>
                    @foreach ($tarea->componente->proyecto->empresa->empleados as $empleado)
                    <option value="{{$empleado->id}}">{{$empleado->usuario->nombres.' '.$empleado->usuario->apellidos}}</option>
                    @endforeach
                </select>
                <small id="helpId" class="form-text text-muted">Asignación de tarea</small>
            </div>
            <div class="col-12 col-md-2 form-group">
                <label for="progreso">Progreso de la tarea</label>
                <input type="number" min="{{$tarea->historiales->count()>0?$tarea->historiales->last()->progreso:'0'}}" max="100" value="{{$tarea->historiales->count()>0?$tarea->historiales->last()->progreso:'0'}}" class="form-control form-control-sm text-center" name="progreso" id="progreso" required>
                <small id="helpId" class="form-text text-muted">Progreso de la tarea</small>
            </div>
            <div class="col-12 form-group">
                <label for="resumen">Resumen / Acción</label>
                <textarea class="form-control form-control-sm" name="resumen" id="resumen" cols="30" rows="3" style="resize: none;" required>{{old('resumen')}}</textarea>
                <small id="helpId" class="form-text text-muted">Resumen / Acción</small>
            </div>
            <div class="col-12 mt-3 mb-3 ml-5">
                <button type="submit" class="btn btn-primary btn-xs pl-5 pr-5">Crear Historial</button>
            </div>
        </form>
    </div>
</div>
<!-- *********************************************************************************************************************************** -->
<!-- *********************************************************************************************************************************** -->
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
<script src="{{ asset('js/admin/proyectos/proveedores/index.js') }}"></script>
@endsection
<!-- ************************************************************* -->
