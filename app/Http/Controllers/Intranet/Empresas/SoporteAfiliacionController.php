<?php

namespace App\Http\Controllers\Intranet\Empresas;

use App\Http\Controllers\Controller;
use App\Models\Empresas\Empleado;
use App\Models\Empresas\HvDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class SoporteAfiliacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $empleados = Empleado::where('empresa_id', $id)->get();
        return view('intranet.empresa.archivo.soportes.index', compact('empleados', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('intranet.empresa.archivo.soportes.crear', compact('empleado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request, $id)
    {
        $ruta = Config::get('constantes.folder_doc_empleados');
        $ruta = trim($ruta);
        $doc_subido = $request->documento;
        $nombre_doc = time() . '-' . utf8_encode(utf8_decode($doc_subido->getClientOriginalName()));
        $nuevo_soporte['empleado_id'] =  $id;
        $nuevo_soporte['tipo'] = 'soporte_afiliacion';
        $nuevo_soporte['nom_documento'] = $request['nom_documento'];
        $nuevo_soporte['documento'] = $nombre_doc;
        $doc_subido->move($ruta, $nombre_doc);
        HvDocumento::create($nuevo_soporte);
        $empleado = Empleado::findOrFail($id);
        $soportes = HvDocumento::where('tipo', 'soporte_afiliacion')->where('empleado_id', $id)->get();
        return redirect('admin/archivo-soportes_afiliacion/' . $id . '/editar')->with('mensaje', 'Soporte creado con exito')->with('empleado')->with('soportes');
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
        $empleado = Empleado::findOrFail($id);
        $soportes = HvDocumento::where('tipo', 'soporte_afiliacion')->where('empleado_id', $id)->get();
        return view('intranet.empresa.archivo.soportes.editar', compact('empleado', 'soportes'));
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
            $soporte_eliminar = HvDocumento::findOrFail($id);
            $ruta = Config::get('constantes.folder_doc_empleados');
            $ruta = trim($ruta);
            if (HvDocumento::destroy($id)) {
                unlink($ruta . $soporte_eliminar->documento);
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
    public function filtar(Request $request)
    {
        return Empleado::where('primer_apellido', 'like', '%' .  $request->apellido . '%')->orwhere('segundo_apellido', 'like', '%' .  $request->apellido . '%')->get();
    }
}
