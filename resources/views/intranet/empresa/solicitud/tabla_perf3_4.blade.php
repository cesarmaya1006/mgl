<div class="row d-flex justify-content-around pt-3 mb-3" style="font-size: 0.8em;">
    <div class="col-12 col-md-10 table-responsive">
        <table class="table table-striped table-bordered table-hover table-sm display">
            <thead>
                <tr>
                    <th scope="col" colspan="8">Solicitudes de clientes</th>
                </tr>
                <tr>
                    <th scope="col">Fecha Solicitud</th>
                    <th scope="col">Dias Gestión</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Empresa</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($solicitudes_cli as $solicitud)
                <tr class="{{$solicitud->estado=='En gestión'?'table-primary':'table-success'}}">
                    <td>{{$solicitud->fecha_solicitud}}</td>
                    <?php $date1 = new DateTime($solicitud->fecha_solicitud);$date2 = new DateTime(Date('Y-m-d')); $diff = date_diff($date1,$date2);$differenceFormat = '%a'; ?>
                    <td>{{$diff->format($differenceFormat)}}</td>
                    <td>{{$solicitud->tipo}}</td>
                    <td>{{$solicitud->titulo}}</td>
                    <td>{{$solicitud->empresas->nombres.' '.$solicitud->empresas->apellidos}}</td>
                    <td>{{$solicitud->estado}}</td>
                    <td>
                        <a href="{{route('consultas_solicitudes-gestionar',  ['id' => $solicitud->id,'tipo' => 'cliente'])}}" class="btn-accion-tabla eliminar tooltipsC text-info" title="Gestionar"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<hr>
<div class="row d-flex justify-content-around pt-3 mb-3" style="font-size: 0.8em;">
    <div class="col-12 col-md-10 table-responsive mt-5">
        <table class="table table-striped table-bordered table-hover table-sm display">
            <thead>
                <tr>
                    <th scope="col" colspan="9">Solicitudes asociadas por empleados</th>
                </tr>
                <tr>
                    <th scope="col">Fecha Solicitud</th>
                    <th scope="col">Dias Gestión</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Empresa</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($solicitudes_emp as $solicitud)
                <tr class="{{$solicitud->estado=='En gestión'?'table-primary':'table-success'}}">
                    <td>{{$solicitud->fecha_solicitud}}</td>
                    <?php $date1 = new DateTime($solicitud->fecha_solicitud);$date2 = new DateTime(Date('Y-m-d')); $diff = date_diff($date1,$date2);$differenceFormat = '%a'; ?>
                    <td>{{$diff->format($differenceFormat)}}</td>
                    <td>{{$solicitud->tipo}}</td>
                    <td>{{$solicitud->titulo}}</td>
                    <td>{{$solicitud->empleados->empresas->nombres .' '. $solicitud->empleados->empresas->apellidos}}</td>
                    <td>{{$solicitud->empleados->primer_nombre.' '. $solicitud->empleados->primer_apellido}}</td>
                    <td>{{$solicitud->estado}}</td>
                    <td>
                        <a href="{{route('consultas_solicitudes-gestionar',  ['id' => $solicitud->id,'tipo' => 'empleado'])}}" class="btn-accion-tabla eliminar tooltipsC text-info" title="Gestionar"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<hr>
<div class="row mt-5">
    <div class="col-12 text-center">
        <h5><strong>Historial de solicitudes</strong></h5>
    </div>
</div>
<div class="row d-flex justify-content-around mb-3" style="font-size: 0.8em;">
    <div class="col-12 col-md-10 table-responsive mt-5">
        <table class="table table-striped table-bordered table-hover table-sm display">
            <thead>
                <tr>
                    <th scope="col" colspan="7">Solicitudes Cerradas</th>
                </tr>
                <tr>
                    <th scope="col">Fecha Solicitud</th>
                    <th scope="col">Fecha Cierre</th>
                    <th scope="col">Dias Gestión</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Empresa</th>
                    <th scope="col">Usuario</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($solicitudes_cli_cerradas as $solicitud)
                <tr class="table-danger">
                    <td>{{$solicitud->fecha_solicitud}}</td>
                    <td>{{$solicitud->fecha_cierre}}</td>
                    <?php $date1 = new DateTime($solicitud->fecha_solicitud);$date2 = new DateTime($solicitud->fecha_cierre); $diff = date_diff($date1,$date2);$differenceFormat = '%a'; ?>
                    <td>{{$diff->format($differenceFormat)}}</td>
                    <td>{{$solicitud->tipo}}</td>
                    <td>{{$solicitud->titulo}}</td>
                    <td>{{$solicitud->empresas->nombres.' '.$solicitud->empresas->apellidos}}</td>
                    <td>{{$solicitud->empresas->nombres.' '.$solicitud->empresas->apellidos}}</td>
                    <td>
                        <a href="{{route('consultas_solicitudes-ver',  ['id' => $solicitud->id,'tipo' => 'cliente'])}}" class="btn-accion-tabla eliminar tooltipsC text-primary" title="Gestionar"><i class="fas fa-eye"></i></a>
                    </td>

                </tr>
                @endforeach
                @foreach ($solicitudes_emp_cerradas as $solicitud)
                <tr class="table-danger">
                    <td>{{$solicitud->fecha_solicitud}}</td>
                    <td>{{$solicitud->fecha_cierre}}</td>
                    <?php $date1 = new DateTime($solicitud->fecha_solicitud);$date2 = new DateTime($solicitud->fecha_cierre); $diff = date_diff($date1,$date2);$differenceFormat = '%a'; ?>
                    <td>{{$diff->format($differenceFormat)}}</td>
                    <td>{{$solicitud->tipo}}</td>
                    <td>{{$solicitud->titulo}}</td>
                    <td>{{$solicitud->empleados->empresas->nombres .' '. $solicitud->empleados->empresas->apellidos}}</td>
                    <td>{{$solicitud->empleados->primer_nombre.' '. $solicitud->empleados->primer_apellido}}</td>
                    <td>
                        <a href="{{route('consultas_solicitudes-ver',  ['id' => $solicitud->id,'tipo' => 'empleado'])}}" class="btn-accion-tabla eliminar tooltipsC text-primary" title="Gestionar"><i class="fas fa-eye"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
