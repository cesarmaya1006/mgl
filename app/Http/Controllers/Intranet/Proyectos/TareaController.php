<?php

namespace App\Http\Controllers\Intranet\Proyectos;

use App\Http\Controllers\Controller;
use App\Models\Proyectos\Componente;
use App\Models\Proyectos\Proyecto;
use App\Models\Proyectos\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $tarea = Tarea::findOrFail($id);
        return view('intranet.proyectos.tarea.index', compact('id', 'tarea'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear($id)
    {
        $componente = Componente::findOrFail($id);
        $camb_proy['estado'] = 'En gestión';
        Proyecto::findOrFail($componente->proyecto->id)->update($camb_proy);
        return view('intranet.proyectos.tarea.crear', compact('componente'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request, $id)
    {
        $componente = Componente::findOrFail($id);
        Tarea::create($request->all());
        //-------------------------------------------
        $this->progresoComponentes($componente->proyecto->id);
        //-------------------------------------------
        $proyecto = $componente->proyecto;
        $proyectoUsuarios[] = $proyecto->lider_id;
        foreach ($proyecto->componentes as $componente) {
            $proyectoUsuarios[] = $componente->responsable_id;
            foreach ($componente->tareas as $tarea) {
                $proyectoUsuarios[] = $tarea->responsable_id;
                foreach ($tarea->historiales as $historial) {
                    $proyectoUsuarios[] = $historial->usuariohistorial_id;
                    $proyectoUsuarios[] = $historial->usuarioasignado_id;
                }
            }
        }
        $usuario_proyecto = array_unique($proyectoUsuarios);
        $proyecto->empleados()->sync($usuario_proyecto);
        //-------------------------------------------
        return redirect('admin/proyectos/' . $componente->proyecto->id . '/gestion')->with('mensaje', 'Tarea creada con exito, gestione los historiales.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function progresoComponentes($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $sum_impactos_componentes = 0;
        $sumaporcentajesComponentes = 0;
        foreach ($proyecto->componentes as $componente) {
            switch ($componente->impacto) {
                case 'Alto':
                    $impacto = 5;
                    break;
                case 'Medio-alto':
                    $impacto = 4;
                    break;
                case 'Medio':
                    $impacto = 3;
                    break;
                case 'Medio-bajo':
                    $impacto = 2;
                    break;
                default:
                    $impacto = 1;
                    break;
            }
            $sum_impactos_componentes += $impacto;
        }
        foreach ($proyecto->componentes as $componente) {
            $sum_impactos_tareas = 0;
            $sum_tareas = 0;
            $avance_tareas = [];
            $porc_componente = 0;
            foreach ($componente->tareas as $tarea) {
                switch ($tarea->impacto) {
                    case 'Alto':
                        $impacto = 5;
                        break;
                    case 'Medio-alto':
                        $impacto = 4;
                        break;
                    case 'Medio':
                        $impacto = 3;
                        break;
                    case 'Medio-bajo':
                        $impacto = 2;
                        break;
                    default:
                        $impacto = 1;
                        break;
                }
                $sum_impactos_tareas += $impacto;
                $sum_tareas++;
                $avance_tareas[] = ['impacto' => $impacto, 'progreso' => $tarea->progreso, 'valor_en_componente' => 0];
            }
            $valor = 0;
            foreach ($avance_tareas as $tarea) {
                if ($sum_tareas > 0) {
                    $avance_tareas[$valor]['impacto'] = ($avance_tareas[$valor]['impacto'] * 100) / $sum_impactos_tareas;
                    $avance_tareas[$valor]['valor_en_componente'] = $avance_tareas[$valor]['impacto'] * ($avance_tareas[$valor]['progreso'] / 100);
                    $porc_componente += $avance_tareas[$valor]['impacto'] * ($avance_tareas[$valor]['progreso'] / 100);
                } else {
                    $avance_tareas[$valor]['impacto'] = 0;
                    $avance_tareas[$valor]['valor_en_componente'] = 0;
                    $porc_componente += $avance_tareas[$valor]['impacto'] * ($avance_tareas[$valor]['progreso'] / 100);
                }
                $valor++;
            }
            $componenteActual['progreso'] = $porc_componente;
            Componente::findOrFail($componente->id)->update($componenteActual);
            switch ($componente->impacto) {
                case 'Alto':
                    $impacto = 5;
                    break;
                case 'Medio-alto':
                    $impacto = 4;
                    break;
                case 'Medio':
                    $impacto = 3;
                    break;
                case 'Medio-bajo':
                    $impacto = 2;
                    break;
                default:
                    $impacto = 1;
                    break;
            }
            $impactoEnProyecto = ($impacto * 100) / $sum_impactos_componentes;
            $valor_proyecto =  ($impactoEnProyecto * $porc_componente) / 100;
            $sumaporcentajesComponentes += $valor_proyecto;
        }
        $proyectoActualizar['progreso'] = $sumaporcentajesComponentes;
        Proyecto::findOrFail($id)->update($proyectoActualizar);
    }
    //--------------------------------------------------------------
    public function porcentaje_Componente($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $porc_proyecto = [];
        $avance_tareas = [];
        foreach ($proyecto->componentes as $componente) {
            $sum_impactos = 0;
            $porc_componente = 0;
            foreach ($componente->tareas as $tarea) {
                switch ($tarea->impacto) {
                    case 'Alto':
                        $impacto = 5;
                        break;
                    case 'Medio-alto':
                        $impacto = 4;
                        break;
                    case 'Medio':
                        $impacto = 3;
                        break;
                    case 'Medio-bajo':
                        $impacto = 2;
                        break;
                    default:
                        $impacto = 1;
                        break;
                }
                $sum_impactos += $impacto;
                $avance_tareas[] = ['impacto' => $impacto, 'progreso' => $tarea->progreso, 'valor_en_componente' => 0];
            }
            $valor = 0;
            foreach ($avance_tareas as $item) {
                if ($sum_impactos > 0) {
                    $avance_tareas[$valor]['impacto'] = ($avance_tareas[$valor]['impacto'] * 100) / $sum_impactos;
                    $avance_tareas[$valor]['valor_en_componente'] = $avance_tareas[$valor]['impacto'] * ($avance_tareas[$valor]['progreso'] / 100);
                    $porc_componente += $avance_tareas[$valor]['impacto'] * ($avance_tareas[$valor]['progreso'] / 100);
                }
                $valor++;
            }
            switch ($componente->impacto) {
                case 'Alto':
                    $impacto = 5;
                    break;
                case 'Medio-alto':
                    $impacto = 4;
                    break;
                case 'Medio':
                    $impacto = 3;
                    break;
                case 'Medio-bajo':
                    $impacto = 2;
                    break;
                default:
                    $impacto = 1;
                    break;
            }
            $porc_proyecto[] = ['id' => $componente->id, 'impacto' => $impacto, 'progreso' => $porc_componente];
        }
        return $porc_proyecto;
    }
    public function porcentajesProyecto($porc_proyecto)
    {
        $cantComponentes = count($porc_proyecto);
        $sum_impactos = 0;
        $valor = 0;
        foreach ($porc_proyecto as $item) {
            $sum_impactos = $porc_proyecto[$valor]['impacto'];
            $valor++;
        }
        $porcentajeProyecto = 0;
        $valor = 0;
        foreach ($porc_proyecto as $item) {
            $porcentajeProyecto +=  (($porc_proyecto[$valor]['impacto'] * 100) / $sum_impactos) * ($porc_proyecto[$valor]['progreso'] / 100);
            $valor++;
        }

        return $porcentajeProyecto;
    }
}
