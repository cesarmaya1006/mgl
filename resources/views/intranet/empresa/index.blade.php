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
    Modulo Empresas
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
            <h5>Listado de empresas</h5>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <a href="{{ route('admin-empresa-crear') }}"
                class="btn btn-info btn-sombra btn-xs pl-4 pr-4 float-right mr-4">
                <i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>
                Agregar Empresa
            </a>
        </div>
    </div>
    <hr>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-11 table-responsive">
            <table class="table table-striped table-hover table-sm display">
                <thead>
                    <tr>
                        <th class="text-center">Id</th>
                        <th>Identificación</th>
                        <th>Empresa</th>
                        <th>Correo Electrónico</th>
                        <th>Teléfono</th>
                        <th>Contacto</th>
                        <th>Cargo Contacto</th>
                        <th>Estado</th>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empresas as $empresa)
                        <tr>
                            <td class="text-nowrap text-center">{{ $empresa->id }}</td>
                            <td class="text-nowrap">{{ $empresa->tipos_docu->abreb_id . ' ' . $empresa->identificacion }}
                            </td>
                            <td class="text-nowrap">{{ $empresa->nombre }}</td>
                            <td class="text-nowrap">{{ $empresa->email }}</td>
                            <td class="text-nowrap">{{ $empresa->telefono }}</td>
                            <td class="text-nowrap">{{ $empresa->contacto }}</td>
                            <td class="text-nowrap">{{ $empresa->cargo }}</td>
                            <td><span
                                    class="btn-info btn-xs pl-3 pr-3 d-flex flex-row align-items-center bg-{{ $empresa->estado == 1 ? 'success' : 'gray' }} rounded">{{ $empresa->estado == 1 ? 'Activo' : 'Inactivo' }}</span>
                            </td>
                            <td>
                                <a href="{{ route('admin-empresa-editar', ['id' => $empresa->id]) }}"
                                    class="btn btn-info btn-xs pl-3 pr-3 d-flex flex-row align-items-center">
                                    <i class="fas fa-edit mr-3"></i>Editar

                                </a>
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
