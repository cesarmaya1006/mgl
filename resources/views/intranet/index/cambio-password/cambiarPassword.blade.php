<hr>
<div class="card" style="border-top: 8px solid rgb(38, 160, 241);">
    <div class="card-header">
        <h3 class="card-title"><font style="vertical-align: inherit;">Restablecimiento de Contraseña</font></h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <div class="row">
        <div class="col-12">
            <div class="row d-flex justify-content-aroun">
                <form class="col-10 form-horizontal" action="{{ route('admin-usuario-restablecer_password', ['id' => session('id_usuario')])}}" method="POST" autocomplete="off">
                    @csrf
                    @method('put')
                    <div class="row form-group d-flex justify-content-around">
                        <div class="col-5 col-md-3 col-lg-3">
                            <label for="password" class="requerido">Contrase&ntilde;a</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="col-5 col-md-3 col-lg-3">
                            <label for="re_password" class="requerido">Confirmaci&oacute;n Contrase&ntilde;a</label>
                            <input type="password" class="form-control" id="re_password" name="re_password" required>
                        </div>
                    </div>
                    <div class="col-11 col-md-5 col-lg-5 form-group mt-5 pt-3 pl-5">
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-sm" style="min-width: 200px;">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<hr>
