<?php

namespace App\Http\Controllers\Intranet\Empresas;

use App\Http\Controllers\Controller;
use App\Models\Empresas\Empleado;
use App\Models\Empresas\ProcDisciplinario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ProcesoDisciplinarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $empleados = Empleado::where('empresa_id', $id)->get();

        return view('intranet.empresa.archivo.proceso_discip.index', compact('empleados', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('intranet.empresa.archivo.proceso_discip.crear', compact('empleado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request, $id)
    {

        $nuevo_proceso['empleado_id'] = $request['empleado_id'];
        $nuevo_proceso['fecha'] = $request['fecha'];
        $nuevo_proceso['descripcion'] = $request['descripcion'];
        $ruta = Config::get('constantes.folder_doc_empleados');
        $ruta = trim($ruta);
        $doc_subido = $request->documento;
        $nombre_doc = time() . '-' . utf8_encode(utf8_decode($doc_subido->getClientOriginalName()));
        $doc_subido->move($ruta, $nombre_doc);
        $nuevo_proceso['inicio'] = $nombre_doc;
        ProcDisciplinario::create($nuevo_proceso);
        $empleado = Empleado::findOrFail($id);
        $procesos = ProcDisciplinario::where('empleado_id', $id)->get();

        return redirect('admin/archivo-proceso_discip/' . $id . '/editar')->with('mensaje', 'Proceso Disciplinario creado con exito')->with('empleado')->with('procesos');
    }

    public function guardar_e(Request $request, $id, $id_p)
    {
        $ruta = Config::get('constantes.folder_doc_empleados');
        $ruta = trim($ruta);
        $doc_subido = $request->documento;
        $nombre_doc = time() . '-' . utf8_encode(utf8_decode($doc_subido->getClientOriginalName()));
        $doc_subido->move($ruta, $nombre_doc);
        $n_documento[$request['doc']] = $nombre_doc;
        ProcDisciplinario::findOrfail($request['id_p'])->update($n_documento);
        $empleado = Empleado::findOrFail($id);
        $proceso = ProcDisciplinario::findOrFail($id_p);
        return redirect('admin/archivo-proceso_discip/' . $id . '/' . $id_p . '/n_archivo')->with('mensaje', 'Documento creado con exito')->with('empleado')->with('proceso');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function n_archivo($id, $id_p)
    {
        $empleado = Empleado::findOrFail($id);
        $proceso = ProcDisciplinario::findOrFail($id_p);
        return view('intranet.empresa.archivo.proceso_discip.n_archivo', compact('empleado', 'proceso'));
    }
    public function e_archivo($id, $id_p, $doc)
    {
        $empleado = Empleado::findOrFail($id);
        $proceso = ProcDisciplinario::findOrFail($id_p);
        return view('intranet.empresa.archivo.proceso_discip.e_archivo', compact('empleado', 'proceso', 'doc'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        $empleado = Empleado::findOrFail($id);
        $procesos = ProcDisciplinario::where('empleado_id', $id)->get();
        return view('intranet.empresa.archivo.proceso_discip.editar', compact('empleado', 'procesos'));
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
    public function eliminar(Request $request, $id)
    {
        if ($request->ajax()) {
            $soporte_eliminar = ProcDisciplinario::findOrFail($id);
            $ruta = Config::get('constantes.folder_doc_empleados');
            $ruta = trim($ruta);
            if (ProcDisciplinario::destroy($id)) {

                unlink($ruta . $soporte_eliminar->inicio);
                if ($soporte_eliminar->descargos != null) {
                    unlink($ruta . $soporte_eliminar->descargos);
                }
                if ($soporte_eliminar->cierre != null) {
                    unlink($ruta . $soporte_eliminar->cierre);
                }
                if ($soporte_eliminar->recurso != null) {
                    unlink($ruta . $soporte_eliminar->recurso);
                }
                if ($soporte_eliminar->segunda != null) {
                    unlink($ruta . $soporte_eliminar->segunda);
                }
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
}
