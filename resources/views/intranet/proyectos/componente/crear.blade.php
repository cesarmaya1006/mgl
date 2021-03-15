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
                <h4>Componentes - crear</h4>
            </div>
            <div class="col-12 col-md-6 col-lg-6 text-md-right text-lg-right pl-2 pr-md-5 pr-lg-5">
                <a href="{{route('proyecto-gestion',['id'=>$proyecto->id])}}" class="btn btn-info btn-xs text-center pl-5 pr-5"><i class="fas fa-undo-alt mr-2"></i>Volver</a>
            </div>
        </div>
        <hr>
        <form class="row d-flex justify-content-between" action="{{route('proyecto-componente-guardar',  ['id' => $proyecto->id])}}" method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf
            @method('post')
            <input type="hidden" name="proyecto_id" value="{{$proyecto->id}}">
            <input type="hidden" name="fec_creacion" value="{{date('Y-m-d')}}">
            <div class="col-12 col-md-2 form-group">
                <label for="fecha">Fecha</label>
                <span class="form-control form-control-sm text-center">{{date('Y-m-d')}}</span>
                <small id="helpId" class="form-text text-muted">Fecha</small>
            </div>
            <div class="col-12 col-md-3 form-group">
                <label for="responsable_id">Responsable del componente</label>
                <select class="form-control form-control-sm" name="responsable_id" id="responsable_id" aria-describedby="helpId" required>
                    <option value="">Seleccione un responsable</option>
                    @foreach ($proyecto->empresa->empleados as $empleado)
                    <option value="{{$empleado->id}}">{{$empleado->usuario->nombres.' '.$empleado->usuario->apellidos}}</option>
                    @endforeach
                </select>
                <small id="helpId" class="form-text text-muted">Responsable del componente</small>
            </div>
            <div class="col-12 col-md-4 form-group">
                <label for="titulo">Titulo del componente</label>
                <input type="text" class="form-control form-control-sm" name="titulo" id="titulo" required>
                <small id="helpId" class="form-text text-muted">Titulo del componente</small>
            </div>
            <div class="col-12 col-md-2 form-group">
                <label for="impacto">Impacto del componente</label>
                <select class="form-control form-control-sm" name="impacto" id="impacto" aria-describedby="helpId" required>
                    <option value="">Selec. impacto</option>
                    <option value="Alto">Alto</option>
                    <option value="Medio-alto">Medio-alto</option>
                    <option value="Medio">Medio</option>
                    <option value="Medio-bajo">Medio-bajo</option>
                    <option value="Bajo">Bajo</option>
                </select>
                <small id="helpId" class="form-text text-muted">Impacto del componente</small>
            </div>
            <div class="col-12 col-md-6 form-group">
                <label for="objetivo">Objetivo del componente</label>
                <textarea class="form-control form-control-sm" name="objetivo" id="objetivo" cols="30" rows="3" style="resize: none;" required></textarea>
                <small id="helpId" class="form-text text-muted">Objetivo del componente</small>
            </div>
            <div class="col-12 mt-3 mb-3 ml-5">
                <button type="submit" class="btn btn-primary btn-xs pl-5 pr-5">Crear Componente</button>
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
