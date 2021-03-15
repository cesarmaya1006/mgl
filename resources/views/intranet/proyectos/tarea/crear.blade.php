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
                <h4>Tareas - crear</h4>
            </div>
            <div class="col-12 col-md-6 col-lg-6 text-md-right text-lg-right pl-2 pr-md-5 pr-lg-5">
                <a href="{{route('proyecto-gestion',['id'=>$componente->proyecto->id])}}" class="btn btn-info btn-xs text-center pl-5 pr-5"><i class="fas fa-undo-alt mr-2"></i>Volver</a>
            </div>
        </div>
        <hr>
        <form class="row d-flex justify-content-between" action="{{route('proyecto-tareas-guardar',  ['id' => $componente->id])}}" method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf
            @method('post')
            <input type="hidden" name="componente_id" value="{{$componente->id}}">
            <input type="hidden" name="fec_creacion" value="{{date('Y-m-d')}}">
            <div class="col-12 col-md-2 form-group">
                <label for="fecha">Fecha inicio</label>
                <span class="form-control form-control-sm text-center">{{date('Y-m-d')}}</span>
                <small id="helpId" class="form-text text-muted">Fecha inicio</small>
            </div>
            <div class="col-12 col-md-2 form-group">
                <label for="fec_limite">Fecha límite</label>
                <input type="date" class="form-control form-control-sm" name="fec_limite" min="{{date('Y-m-d')}}" value="{{date('Y-m-d')}}" id="fec_limite">
                <small id="helpId" class="form-text text-muted">Fecha límite</small>
            </div>
            <div class="col-12 col-md-3 form-group">
                <label for="responsable_id">Responsable de la tarea</label>
                <select class="form-control form-control-sm" name="responsable_id" id="responsable_id" aria-describedby="helpId" required>
                    <option value="">Seleccione un responsable</option>
                    @foreach ($componente->proyecto->empresa->empleados as $empleado)
                    <option value="{{$empleado->id}}">{{$empleado->usuario->nombres.' '.$empleado->usuario->apellidos}}</option>
                    @endforeach
                </select>
                <small id="helpId" class="form-text text-muted">Responsable de la tarea</small>
            </div>
            <div class="col-12 col-md-4 form-group">
                <label for="titulo">Titulo de la tarea</label>
                <input type="text" class="form-control form-control-sm" name="titulo" id="titulo" required>
                <small id="helpId" class="form-text text-muted">Titulo de la tarea</small>
            </div>
            <div class="col-12 col-md-2 form-group">
                <label for="impacto">Impacto de la tarea</label>
                <select class="form-control form-control-sm" name="impacto" id="impacto" aria-describedby="helpId" required>
                    <option value="">Selec. impacto</option>
                    <option value="Alto">Alto</option>
                    <option value="Medio-alto">Medio-alto</option>
                    <option value="Medio">Medio</option>
                    <option value="Medio-bajo">Medio-bajo</option>
                    <option value="Bajo">Bajo</option>
                </select>
                <small id="helpId" class="form-text text-muted">Impacto de la tarea</small>
            </div>
            <div class="col-12 col-md-6 form-group">
                <label for="objetivo">Objetivo de la tarea</label>
                <textarea class="form-control form-control-sm" name="objetivo" id="objetivo" cols="30" rows="3" style="resize: none;" required></textarea>
                <small id="helpId" class="form-text text-muted">Objetivo de la tarea</small>
            </div>
            <div class="col-12 mt-3 mb-3 ml-5">
                <button type="submit" class="btn btn-primary btn-xs pl-5 pr-5">Crear Tarea</button>
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
