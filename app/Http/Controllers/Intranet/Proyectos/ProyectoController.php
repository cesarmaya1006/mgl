<?php

namespace App\Http\Controllers\Intranet\Proyectos;

use Acaronlex\LaravelCalendar\Facades\Calendar;
use App\Http\Controllers\Controller;
use App\Models\Empresas\Empleado;
use App\Models\Proyectos\Cliente;
use App\Models\Proyectos\Proveedor;
use App\Models\Proyectos\Proyecto;
use App\Models\Proyectos\ProyectoClienteProy;
use App\Models\Proyectos\ProyectoProveedorProy;
use App\Models\Proyectos\Tarea;
use DateTime;
use Event;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function interfaz()
    {
        $proyectos = Proyecto::with('empleados')->whereHas('empleados', function ($q) {
            $q->where('empleado_id', session('id_usuario'));
        })->get();
        $empleado = Empleado::findOrFail(session('id_usuario'));
        //===========================================================================
        $events = [];
        foreach ($proyectos as $proyecto) {
            foreach ($proyecto->componentes as $componente) {
                foreach ($componente->tareas as $tarea) {
                    if ($tarea->progreso < 100) {
                        if ($empleado->lider) {
                            if ($tarea->fec_limite < date('Y-m-d')) {
                                $color = '#FF0000';
                                $textColor = '#FFFFFF';
                            } else {
                                switch ($tarea->impacto) {
                                    case 'Alto':
                                        $color = 'darkred';
                                        break;
                                    case 'Medio-alto':
                                        $color = 'lightsalmon';
                                        break;
                                    case 'Medio':
                                        $color = 'orange';
                                        break;
                                    case 'Medio-bajo':
                                        $color = 'yellowgreen';
                                        break;
                                    default:
                                        $color = 'green';
                                        break;
                                }
                                $textColor = '#FFFFFF';
                            }

                            $events[] = Calendar::event(
                                $tarea->titulo . ' - Responsable: ' . $tarea->responsable->usuario->nombres . ' ' . $tarea->responsable->usuario->apellidos,
                                true,
                                new DateTime($tarea->fec_creacion),
                                new DateTime($tarea->fec_limite),
                                null,
                                [
                                    'url' =>  route('proyecto-tareas-index', ['id' => $tarea->id]) ,
                                    'color' => $color,
                                    'textColor' => $textColor,
                                ],

                            );
                        } else {
                            if ($tarea->responsable_id == session('id_usuario')) {
                                if ($tarea->fec_limite < date('Y-m-d')) {
                                    $color = '#FF0000';
                                    $textColor = '#FFFFFF';
                                } else {
                                    switch ($tarea->impacto) {
                                        case 'Alto':
                                            $color = 'darkred';
                                            break;
                                        case 'Medio-alto':
                                            $color = 'lightsalmon';
                                            break;
                                        case 'Medio':
                                            $color = 'orange';
                                            break;
                                        case 'Medio-bajo':
                                            $color = 'yellowgreen';
                                            break;
                                        default:
                                            $color = 'green';
                                            break;
                                    }
                                    $textColor = '#FFFFFF';
                                }

                                $events[] = Calendar::event(
                                    $tarea->titulo,
                                    true,
                                    new DateTime($tarea->fec_creacion),
                                    new DateTime($tarea->fec_limite),
                                    null,
                                    [

                                        'color' => $color,
                                        'textColor' => $textColor,
                                    ],

                                );
                            }
                        }
                    }
                }
            }
        }
        $calendar = Calendar::addEvents($events)->setOptions([
            'locale' => 'es',
            'firstDay' => 0,
            'displayEventTime' => true,
            'selectable' => true,
            'initialView' => 'dayGridMonth',
            'headerToolbar' => [
                'end' => 'today prev,next dayGridMonth timeGridWeek timeGridDay'
            ]
        ]);;
        //===========================================================================
        return view('intranet.proyectos.proyecto.index', compact('proyectos', 'empleado', 'calendar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        $empleado = Empleado::findOrFail(session('id_usuario'));
        return view('intranet.proyectos.proyecto.crear', compact('empleado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        $proyecto = Proyecto::create($request->all());
        $proyectoUsuarios[] = $request['lider_id'];
        $proyecto->empleados()->sync($proyectoUsuarios);
        return Redirect('admin/proyectos-index')->with('mensaje', 'Proyecto creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function gestion_inter($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $clientes = Cliente::Where('empresa_id', $proyecto->empresa_id)->get();
        $proveedores = Proveedor::Where('empresa_id', $proyecto->empresa_id)->get();
        $dataPoints = [];
        foreach ($proyecto->componentes as $componente) {
            $dataPoints[] = ["y" => $componente->progreso, "label" => $componente->titulo];
        }
        $empleado = Empleado::findOrFail(session('id_usuario'));
        return view('intranet.proyectos.proyecto.gestion_inter', compact('proyecto', 'clientes', 'proveedores', 'dataPoints', 'empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function gestion($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $clientes = Cliente::Where('empresa_id', $proyecto->empresa_id)->get();
        $proveedores = Proveedor::Where('empresa_id', $proyecto->empresa_id)->get();
        //-------------------------------------------------------------------------------------------
        $dataPoints = [];
        foreach ($proyecto->componentes as $componente) {
            $dataPoints[] = ["y" => $componente->progreso, "label" => $componente->titulo];
        }
        //-------------------------------------------------------------------------------------------
        return view('intranet.proyectos.proyecto.gestion', compact('proyecto', 'clientes', 'proveedores', 'dataPoints'));
    }

    //====================================================================================================================
    public function gestion_cliente_nuevo(Request $request, $id)
    {
        if ($request->ajax()) {
            $nuevoClienteProyecto['cliente_id'] = $request['proyecto_cliente_id'];
            $nuevoClienteProyecto['proyecto_id'] = $id;
            if (ProyectoClienteProy::create($nuevoClienteProyecto)) {
                $cliente = Cliente::findOrFail($request['proyecto_cliente_id']);
                return response()->json(['mensaje' => 'ok', 'proyecto_id' => $id, 'cliente' => $cliente]);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
    public function gestion_cliente_borrar(Request $request, $id_cli, $id_pro)
    {
        if ($request->ajax()) {
            $proyecto_cliente_id = $id_cli;
            $proyecto_id = $id_pro;
            $proyectocliente_f = ProyectoClienteProy::where('cliente_id', $proyecto_cliente_id)->where('proyecto_id', $proyecto_id)->get();
            foreach ($proyectocliente_f as $item) {
                $id = $item->id;
            }
            if (ProyectoClienteProy::destroy($id)) {
                $cliente = Cliente::findOrFail($id_cli);
                return response()->json(['mensaje' => 'ok', 'proyecto_id' => $id, 'cliente' => $cliente]);
            } else {
                return response()->json(['mensaje' => 'ng', 'proyecto_id' => $id, 'proyecto_cliente_id' => $proyecto_cliente_id,]);
            }
        } else {
            abort(404);
        }
    }
    //----------------------------------------------------------------------
    public function gestion_proveedor_nuevo(Request $request, $id)
    {
        if ($request->ajax()) {
            $nuevoProveedorProyecto['proveedor_id'] = $request['proyecto_proveedor_id'];
            $nuevoProveedorProyecto['proyecto_id'] = $id;
            if (ProyectoProveedorProy::create($nuevoProveedorProyecto)) {
                $proveedor = Proveedor::findOrFail($request['proyecto_proveedor_id']);
                return response()->json(['mensaje' => 'ok', 'proyecto_id' => $id, 'proveedor' => $proveedor]);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
    public function gestion_proveedor_borrar(Request $request, $id_prov, $id_pro)
    {
        if ($request->ajax()) {
            $proyecto_proveedor_id = $id_prov;
            $proyecto_id = $id_pro;
            $proyectoproveedor_f = ProyectoProveedorProy::where('proveedor_id', $proyecto_proveedor_id)->where('proyecto_id', $proyecto_id)->get();
            foreach ($proyectoproveedor_f as $item) {
                $id = $item->id;
            }
            if (ProyectoProveedorProy::destroy($id)) {
                $proveedor = Proveedor::findOrFail($id_prov);
                return response()->json(['mensaje' => 'ok', 'proyecto_id' => $id, 'proveedor' => $proveedor]);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
    //----------------------------------------------------------------------
    //====================================================================================================================
    public function listado_proy($id)
    {
        $proyectos = Proyecto::with('empleados')->whereHas('empleados', function ($q) {
            $q->where('empleado_id', session('id_usuario'));
        })->get();
        $empleado = Empleado::findOrFail(session('id_usuario'));
        //===========================================================================
        $events = [];
        foreach ($proyectos as $proyecto) {
            foreach ($proyecto->componentes as $componente) {
                foreach ($componente->tareas as $tarea) {
                    if ($tarea->progreso < 100) {
                        if ($empleado->lider) {
                            if ($tarea->fec_limite < date('Y-m-d')) {
                                $color = '#FF0000';
                                $textColor = '#FFFFFF';
                            } else {
                                switch ($tarea->impacto) {
                                    case 'Alto':
                                        $color = 'darkred';
                                        break;
                                    case 'Medio-alto':
                                        $color = 'lightsalmon';
                                        break;
                                    case 'Medio':
                                        $color = 'orange';
                                        break;
                                    case 'Medio-bajo':
                                        $color = 'yellowgreen';
                                        break;
                                    default:
                                        $color = 'green';
                                        break;
                                }
                                $textColor = '#FFFFFF';
                            }

                            $events[] = Calendar::event(
                                $tarea->titulo . ' - Responsable: ' . $tarea->responsable->usuario->nombres . ' ' . $tarea->responsable->usuario->apellidos,
                                true,
                                new DateTime($tarea->fec_creacion),
                                new DateTime($tarea->fec_limite),
                                null,
                                [

                                    'color' => $color,
                                    'textColor' => $textColor,
                                ],

                            );
                        } else {
                            if ($tarea->responsable_id == session('id_usuario')) {
                                if ($tarea->fec_limite < date('Y-m-d')) {
                                    $color = '#FF0000';
                                    $textColor = '#FFFFFF';
                                } else {
                                    switch ($tarea->impacto) {
                                        case 'Alto':
                                            $color = 'darkred';
                                            break;
                                        case 'Medio-alto':
                                            $color = 'lightsalmon';
                                            break;
                                        case 'Medio':
                                            $color = 'orange';
                                            break;
                                        case 'Medio-bajo':
                                            $color = 'yellowgreen';
                                            break;
                                        default:
                                            $color = 'green';
                                            break;
                                    }
                                    $textColor = '#FFFFFF';
                                }

                                $events[] = Calendar::event(
                                    $tarea->titulo,
                                    true,
                                    new DateTime($tarea->fec_creacion),
                                    new DateTime($tarea->fec_limite),
                                    null,
                                    [

                                        'color' => $color,
                                        'textColor' => $textColor,
                                    ],

                                );
                            }
                        }
                    }
                }
            }
        }
        $calendar = Calendar::addEvents($events)->setOptions([
            'locale' => 'es',
            'firstDay' => 0,
            'displayEventTime' => true,
            'selectable' => true,
            'initialView' => 'dayGridMonth',
            'headerToolbar' => [
                'end' => 'today prev,next dayGridMonth timeGridWeek timeGridDay'
            ]
        ]);;
        //===========================================================================
        $valoresTareas = $this->valoresTareas($empleado->id);
        $data = [$valoresTareas['tareasVige'], $valoresTareas['tareasProx'], $valoresTareas['tareasVenc']];
        $backgroundColor = ['#00a65a',  '#f39c12', '#f56954'];
        $datasets = [[$data, $backgroundColor]];
        $labels = [
            'Vigentes',
            'Prox A Vencer',
            'Vencidas'
        ];
        $dataTareas = [];
        $dataTareas = [$labels, $datasets];
        //===========================================================================
        return view('intranet.proyectos.proyecto.proyectos', compact('proyectos', 'empleado', 'calendar', 'valoresTareas', 'dataTareas'));
    }

    public function listado_tareas($id)
    {
        $proyectos = Proyecto::with('empleados')->whereHas('empleados', function ($q) {
            $q->where('empleado_id', session('id_usuario'));
        })->get();
        $empleado = Empleado::findOrFail(session('id_usuario'));
        //===========================================================================
        $events = [];
        foreach ($proyectos as $proyecto) {
            foreach ($proyecto->componentes as $componente) {
                foreach ($componente->tareas as $tarea) {
                    if ($tarea->progreso < 100) {
                        if ($empleado->lider) {
                            if ($tarea->fec_limite < date('Y-m-d')) {
                                $color = '#FF0000';
                                $textColor = '#FFFFFF';
                            } else {
                                switch ($tarea->impacto) {
                                    case 'Alto':
                                        $color = 'darkred';
                                        break;
                                    case 'Medio-alto':
                                        $color = 'lightsalmon';
                                        break;
                                    case 'Medio':
                                        $color = 'orange';
                                        break;
                                    case 'Medio-bajo':
                                        $color = 'yellowgreen';
                                        break;
                                    default:
                                        $color = 'green';
                                        break;
                                }
                                $textColor = '#FFFFFF';
                            }

                            $events[] = Calendar::event(
                                $tarea->titulo . ' - Responsable: ' . $tarea->responsable->usuario->nombres . ' ' . $tarea->responsable->usuario->apellidos,
                                true,
                                new DateTime($tarea->fec_creacion),
                                new DateTime($tarea->fec_limite),
                                null,
                                [

                                    'color' => $color,
                                    'textColor' => $textColor,
                                ],

                            );
                        } else {
                            if ($tarea->responsable_id == session('id_usuario')) {
                                if ($tarea->fec_limite < date('Y-m-d')) {
                                    $color = '#FF0000';
                                    $textColor = '#FFFFFF';
                                } else {
                                    switch ($tarea->impacto) {
                                        case 'Alto':
                                            $color = 'darkred';
                                            break;
                                        case 'Medio-alto':
                                            $color = 'lightsalmon';
                                            break;
                                        case 'Medio':
                                            $color = 'orange';
                                            break;
                                        case 'Medio-bajo':
                                            $color = 'yellowgreen';
                                            break;
                                        default:
                                            $color = 'green';
                                            break;
                                    }
                                    $textColor = '#FFFFFF';
                                }

                                $events[] = Calendar::event(
                                    $tarea->titulo,
                                    true,
                                    new DateTime($tarea->fec_creacion),
                                    new DateTime($tarea->fec_limite),
                                    null,
                                    [

                                        'color' => $color,
                                        'textColor' => $textColor,
                                    ],

                                );
                            }
                        }
                    }
                }
            }
        }
        $calendar = Calendar::addEvents($events)->setOptions([
            'locale' => 'es',
            'firstDay' => 0,
            'displayEventTime' => true,
            'selectable' => true,
            'initialView' => 'dayGridMonth',
            'headerToolbar' => [
                'end' => 'today prev,next dayGridMonth timeGridWeek timeGridDay'
            ]
        ]);;
        //===========================================================================
        $valoresTareas = $this->valoresTareas($empleado->id);
        //===========================================================================
        return view('intranet.proyectos.proyecto.tareas', compact('proyectos', 'empleado', 'calendar', 'valoresTareas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function valoresTareas($id)
    {
        $tareasVige = 0;
        $tareasProx = 0;
        $tareasVenc = 0;
        $empleado = Empleado::findOrFail($id);
        $proyectos = Proyecto::with('empleados')->whereHas('empleados', function ($q) use ($empleado) {
            $q->where('empleado_id', $empleado->id);
        })->get();
        foreach ($proyectos as $proyecto) {
            foreach ($proyecto->componentes as $componente) {
                foreach ($componente->tareas as $tarea) {
                    //-------------------------------------------------
                    $date1 = new DateTime($tarea->fec_creacion);
                    $date2 = new DateTime($tarea->fec_limite);
                    $diff = date_diff($date1, $date2);
                    $differenceFormat = '%a';
                    $diasTotalTarea = $diff->format($differenceFormat);
                    if ($diasTotalTarea == 0) {
                        $diasTotalTarea = 1;
                    }
                    //-------------------------------------------------
                    $date1 = new DateTime($tarea->fec_creacion);
                    $date2 = new DateTime(date('Y-m-d'));
                    $diff = date_diff($date1, $date2);
                    $differenceFormat = '%a';
                    $diasGestionTarea = $diff->format($differenceFormat);
                    //---------------------------------------------------
                    if ($empleado->lider) {
                        if ($tarea->fec_limite < date('Y-m-d')) {
                            $tareasVenc++;
                        } else {
                            $porcVenc = ($diasGestionTarea * 100) / $diasTotalTarea;
                            if ($porcVenc > 80 || $diasTotalTarea - $diasGestionTarea < 3) {
                                $tareasProx++;
                            } else {
                                $tareasVige++;
                            }
                        }
                    } else {
                        if ($tarea->responsable_id == $id) {
                            if ($tarea->fec_limite < date('Y-m-d')) {
                                $tareasVenc++;
                            } else {
                                $porcVenc = ($diasGestionTarea * 100) / $diasTotalTarea;
                                if ($porcVenc > 80 || $diasTotalTarea - $diasGestionTarea < 3) {
                                    $tareasProx++;
                                } else {
                                    $tareasVige++;
                                }
                            }
                        }
                    }
                }
            }
        }
        $tareas_estado['tareasVige'] = $tareasVige;
        $tareas_estado['tareasProx'] = $tareasProx;
        $tareas_estado['tareasVenc'] = $tareasVenc;
        return $tareas_estado;
    }
    //------------------------------------
}
