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
    <div class="row">
        <div class="col-12">
            @include('includes.error-form')
            @include('includes.mensaje')
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 mb-3 pl-4">
            <h5>Nueva noticia</h5>
        </div>
    </div>
    <hr>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-11">
            <form action="{{ route('noticias-guardar') }}"
                class="row form-horizontal mt-3 mb-5 d-flex justify-content-around" method="POST" autocomplete="off"
                enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="col-11 col-md-5 col-lg-5 form-group">
                    <label for="titulo" class="requerido">Titulo noticia</label>
                    <input type="text" class="form-control form-control-sm" name="titulo" id="titulo" required>
                    <small id="helpId" class="form-text text-muted">Titulo Noticia</small>
                </div>
                <div class="col-11 col-md-5 col-lg-5 form-group">
                    <label for="descripcion" class="requerido">Descripci&oacute;n</label>
                    <input type="text" class="form-control form-control-sm" name="descripcion" id="descripcion" required>
                    <small id="helpId" class="form-text text-muted">Descripci&oacute;n</small>
                </div>
                <div class="col-11 col-md-2 col-lg-2 form-group">
                    <label for="fecha_vencimiento" class="requerido">Fecha de Vencimiento</label>
                    <input type="date" class="form-control form-control-sm" name="fecha_vencimiento" id="fecha_vencimiento"
                        min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" required>
                    <small id="helpId" class="form-text text-muted">Fecha de Vencimiento</small>
                </div>
                <div class="col-11 col-md-5 form-group">
                    <label for="img_noticia" class="requerido">Imagen Noticia</label>
                    <img class="img-fluid" id="img_noticia" src="" style="width: 90%;height: auto;margin: auto;">
                    <input type="file" name="foto" id="foto" accept="image/x-png,image/gif,image/jpeg"
                        onchange="document.getElementById('img_noticia').src = window.URL.createObjectURL(this.files[0])"
                        required>
                    <small id="helpId" class="form-text text-muted">Imagen Noticia formato 900px * 400px a
                        72dpi</small>
                </div>
                <div class="col-11 col-md-5 form-group">
                    <label for="descripcion">Documento</label>
                    <iframe id="imagen_doc" src="" width="90%" height="auto" frameborder="2" style="margin: auto;"></iframe>
                    <input type="text" class="form-control form-control-sm" name="nombre_doc" id="nombre_doc"
                        placeholder="Nombre del documento">
                    <input class="form-control form-control-sm" type="file" name="documento" id="documento"
                        accept="application/pdf"
                        onchange="document.getElementById('imagen_doc').src = window.URL.createObjectURL(this.files[0])">
                    <small id="helpId" class="form-text text-muted">Documento en formato Pdf</small>
                </div>
                <div class="col-11 form-group mt-5 pt-3">
                    <button type="submit" class="btn btn-primary btn-sm" style="min-width: 200px;">Guardar</button>
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
    <script src="{{ asset('js/intranet/noticias/index.js') }}"></script>
@endsection
<!-- ************************************************************* -->
