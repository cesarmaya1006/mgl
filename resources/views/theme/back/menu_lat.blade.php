<aside class="main-sidebar sidebar-dark-warning elevation-4" style="background-image: url('{{Storage::url('public/imagenes/sistema/fondo-menu-1.jpg')}}'); background-size:auto 100%;background-repeat:no-repeat;background-attachment:fixed;">
    <div class="pantallaMenuLat" style="width: 100%;height: 100%;background-color: rgba(0, 0, 0, 0.6)">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link" style="background-color: rgba(120, 200, 245, 0.8);">
            <img src="{{ asset('imagenes/sistema/mgl_logo.png') }}" alt="Sistema Prueba" class="brand-image img-circle elevation-3" style="opacity: .9;max-width: 80px;">
            <div class="row">
                <div class="col-12">
                    <span class="brand-text font-weight-light" style="color: white;text-shadow: 1px 1px black;font-size: 0.9em;font-weight: bold;">MGL Y ASOCIADOS</span>
                </div>
            </div>
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <!-- <div class="image">
                    <img src="{{ asset('imagenes/usuarios/'.session('foto')) }}" class="img-circle elevation-2" alt="User Image">
                </div> -->
                <div class="info">
                    <a href="#" class="d-block">{{ ucwords(session('nombres')) }}<br>{{ucwords(session('apellidos')) }} <br>{{ session('rol_nombre') }}</a>
                </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2" style="color: white;">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-header">MEN&Uacute; PRINCIPAL</li>
                    @foreach ($menusComposer as $key => $item)
                        @if ($item["menu_id"] != 0)
                            @break
                        @endif
                        @include("theme.back.menu-item", ["item" => $item])
                    @endforeach
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </div>
</aside>
