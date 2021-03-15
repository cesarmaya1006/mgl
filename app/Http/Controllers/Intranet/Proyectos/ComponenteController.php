<?php

namespace App\Http\Controllers\Intranet\Proyectos;

use App\Http\Controllers\Controller;
use App\Models\Proyectos\Componente;
use App\Models\Proyectos\Proyecto;
use Illuminate\Http\Request;

class ComponenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        return view('intranet.proyectos.componente.crear', compact('proyecto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request, $id)
    {
        Componente::create($request->all());
        //-------------------------------------------
        $proyecto = Proyecto::findOrFail($id);
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
        return redirect('admin/proyectos/' . $id . '/gestion')->with('mensaje', 'Componente creado con exito, gestione tareas e incolucrados editando el proyecto.');
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
    public function editar($id)
    {
        $componente = Componente::findOrFail($id);
        return view('intranet.proyectos.componente.editar', compact('componente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(Request $request, $id)

    {
        Componente::findOrFail($id)->update($request->all());
        $componente = Componente::findOrfail($id);
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
        return redirect('admin/proyectos/' . $componente->proyecto->id . '/gestion')->with('mensaje', 'Componente actualizado con exito, gestione tareas e incolucrados editando el proyecto.');
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
}
