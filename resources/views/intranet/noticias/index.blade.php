@extends("theme.back.plantilla")
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
    @include('includes.funciones_php')
@endsection
<!-- titulo hoja -->
@section('estilosHojas')
    <!-- Pagina CSS -->
    <link rel="stylesheet" href="{{ asset('css/intranet/noticias/index.css') }}">
@endsection
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('tituloHoja')
    Modulo Noticias
@endsection
<!-- ************************************************************* -->
<!-- ************************************************************* -->
<!-- Cuerpo hoja -->
@section('cuerpo_pagina')
    <hr>
    <div class="row w-100">
        <div class="col-12 col-md-6 mb-3 pl-4">
            <h5>Listado de Noticias</h5>
        </div>
        <div class="col-12 col-md-6 mb-3 pl-4">
            <a href="{{ route('noticias-crear') }}" class="btn btn-info btn-xs btn-sombra pl-4 pr-4 mr-3 float-right"><i
                    class="fa fa-plus-circle mr-3" aria-hidden="true"></i>Nueva Noticia</a>
        </div>
    </div>
    <hr>
    <div class="row d-flex justify-content-center">
        <div class="col-10">
            @include('includes.error-form')
            @include('includes.mensaje')
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-11 table-responsive">
            <table class="table table-sm display" id="tabla-data">
                <tbody>
                    @foreach ($noticias as $noticia)
                        <tr>
                            <td>
                                <div class="card card-widget">
                                    <div class="card-header">
                                        <div class="user-block">
                                            <span class="title"><strong>{{ $noticia->titulo }}</strong></span>
                                        </div>
                                        <a href="{{ route('noticias-eliminar', ['id' => $noticia->id]) }}"
                                            class="btn-accion-tabla  text-danger mr-2 float-right eliminar_reg"
                                            title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                        <a href="{{ route('noticias-desactivar', ['id' => $noticia->id]) }}"
                                            class="btn-accion-tabla  text-warning mr-2 float-right" title="Desactivar"><i
                                                class="{{ $noticia->estado == 1 ? 'far fa-check-circle' : 'far fa-times-circle' }}"></i></a>

                                        <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <img class="img-fluid pad"
                                                    src="{{ asset('imagenes/noticias/' . $noticia->foto) }}" alt="Photo">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <p><strong>Fecha de Vencimiento:
                                                    </strong>{{ $noticia->fecha_vencimiento }}</p>
                                                <p><strong>Descripción: </strong>{{ $noticia->descripcion }}</p>
                                                @if ($noticia->documento)
                                                    <p><strong>Documento: </strong><a
                                                            href="{{ asset('documentos/noticias/' . $noticia->documento) }}"
                                                            target="_blank" rel="noopener noreferrer"
                                                            class="text-uppercase">{{ $noticia->nombre_doc }}</a></p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
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
    <script src="{{ asset('js/intranet/noticias/index.js') }}"></script>
@endsection
<!-- ************************************************************* -->
