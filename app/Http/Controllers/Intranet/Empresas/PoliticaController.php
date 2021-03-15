<?php

namespace App\Http\Controllers\Intranet\Empresas;

use App\Http\Controllers\Controller;
use App\Models\Empresas\HvDocumento;
use App\Models\Empresas\HvPolitica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class PoliticaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $politicas = HvPolitica::where('empresa_id', $id)->get();
        return view('intranet.empresa.archivo.politicas.index', compact('id', 'politicas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear($id)
    {
        return view('intranet.empresa.archivo.politicas.crear', compact('id'));
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
        $nuevo_soporte['empresa_id'] = $request['empresa_id'];
        $nuevo_soporte['tipo'] = $request['tipo'];
        $nuevo_soporte['nom_documento'] = $request['nom_documento'];
        $nuevo_soporte['documento'] = $nombre_doc;
        $doc_subido->move($ruta, $nombre_doc);
        HvPolitica::create($nuevo_soporte);
        return redirect('admin/archivo-politica-index/'.$id)->with('mensaje', 'Documento creado con exito');
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
    public function eliminar(Request $request, $id)
    {
        if ($request->ajax()) {
            $soporte_eliminar = HvPolitica::findOrFail($id);
            $ruta = Config::get('constantes.folder_doc_empleados');
            $ruta = trim($ruta);
            if (HvPolitica::destroy($id)) {
                unlink($ruta . $soporte_eliminar->documento);
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
}
