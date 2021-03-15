<?php

namespace App\Http\Controllers\Intranet\Empresas;

use App\Http\Controllers\Controller;
use App\Models\Empresas\Empleado;
use App\Models\Empresas\Opciones;
use Illuminate\Http\Request;

class PermisoEmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $empleados = Empleado::where('empresa_id', $id)->with('opciones')->get();
        return view('intranet.empresa.archivo.permisos.index', compact('empleados', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        $empleado = Empleado::findOrFail($id);
        $opciones = Opciones::get();
        return view('intranet.empresa.archivo.permisos.editar', compact('empleado', 'id', 'opciones'));
    }

    public function crear()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        if ($request->ajax()) {
            $menus = new Opciones();
            if ($request->input('estado') == 1) {
                $menus->find($request->input('opcionarchivo_id'))->empleados()->attach($request->input('hv_empleado_id'));
                return response()->json(['respuesta' => 'El permiso se asigno correctamente']);
            } else {
                $menus->find($request->input('opcionarchivo_id'))->empleados()->detach($request->input('hv_empleado_id'));
                return response()->json(['respuesta' => 'El permiso se elimino correctamente']);
            }
        } else {
            abort(404);
        }
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


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar($id)
    {
        //
    }
}
