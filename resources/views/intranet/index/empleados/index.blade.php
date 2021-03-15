<div class="row d-flex justify-content-around">
    <div class="col-10">
        <div class="row d-flex justify-content-around">
            <?php $cantOpc = $empleado->opciones->count(); ?>
            @if ($cantOpc > 0)
                <div class="col-6 col-md-2 col-lg-2 pl-2 pr-2">
                    <div class="row">
                        <div class="col-12 text-center pl-4 pr-4"><a href="{{ route('archivo-index') }}"><img
                                    class="img-fluid" src="{{ asset('imagenes/sistema/ICONO1.png') }}"></a></div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <h6><strong>Archivo</strong></h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center pl-2 pr-2">
                            <p>Archive y gestione sus procesos de recursos humanos y contratación</p>
                        </div>
                    </div>
                </div>
            @endif
            @foreach ($empleado->opciones as $opcion)
                @if ($opcion->titulo == 'Procesos Judiciales')
                    <div class="col-6 col-md-2 col-lg-2 pl-2 pr-2">
                        <div class="row">
                            <div class="col-12 text-center pl-4 pr-4"><a href="{{ route('procesos_listado') }}"><img
                                        class="img-fluid" src="{{ asset('imagenes/sistema/ICONO3.png') }}"></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <h6><strong>Procesos Judiciales</strong></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center pl-2 pr-2">
                                <p>consulte y gestione sus procesos judiciales y administrativos</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            <div class="col-6 col-md-2 col-lg-2 pl-2 pr-2">
                <div class="row">
                    <div class="col-12 text-center pl-4 pr-4"><a
                            href="{{ route('consultas_solicitudes-index') }}"><img class="img-fluid"
                                src="{{ asset('imagenes/sistema/ICONO2.png') }}"></a></div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <h6><strong>Consultas y Solicitudes</strong></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center pl-2 pr-2">
                        <p>Consulte y tenga el apoyo de nuestro equipo de abogados</p>
                    </div>
                </div>
            </div>
            @foreach ($empleado->opciones as $opcion)
                @if ($opcion->titulo == 'Diagnósticos Legales')
                    <div class="col-6 col-md-2 col-lg-2 pl-2 pr-2">
                        <div class="row">
                            <div class="col-12 text-center pl-4 pr-4"><a href="#"><img class="img-fluid"
                                        src="{{ asset('imagenes/sistema/ICONO4.png') }}"></a></div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <h6><strong>Diagnósticos Legales</strong></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center pl-2 pr-2">
                                <p>Haga seguimiento al estado legal de su empresa u organización</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            <div class="col-6 col-md-2 col-lg-2 pl-2 pr-2">
                <div class="row">
                    <div class="col-12 text-center pl-4 pr-4"><a href="{{ route('boletines-index') }}"><img
                                class="img-fluid" src="{{ asset('imagenes/sistema/ICONO6.png') }}"></a></div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <h6><strong>Boletines de Actualización</strong></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center pl-2 pr-2">
                        <p>Consulte cambios normativos y las implicaciones para su empresa u organización</p>
                    </div>
                </div>
            </div>
            <!-- <div class="col-6 col-md-2 col-lg-2 pl-2 pr-2">
                <div class="row">
                    <div class="col-12 text-center pl-4 pr-4"><a href="#"><img class="img-fluid" src="{{ asset('imagenes/sistema/ICONO7.png') }}"></a></div>
                </div>
                <div class="row">
                    <div class="col-12 text-center"><h6><strong>Publicaciones</strong></h6></div>
                </div>
                <div class="row">
                    <div class="col-12 text-center pl-2 pr-2">
                        <p>Publique anuncios para sus trabajadores y/o colaboradores</p>
                    </div>
                </div>
            -->
        </div>
    </div>
</div>
</div>
<hr>
