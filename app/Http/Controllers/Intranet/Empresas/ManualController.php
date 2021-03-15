<?php

namespace App\Http\Controllers\Intranet\Empresas;

use App\Http\Controllers\Controller;
use App\Models\Empresas\HvCargo;
use App\Models\Empresas\HvNivel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ManualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $niveles = HvNivel::where('empresa_id', $id)->get();
        return view('intranet.empresa.archivo.manuales.index', compact('niveles', 'id'));
    }
    public function elim_manual(Request $request, $id)
    {
        if ($request->ajax()) {
            $ruta = Config::get('constantes.folder_manuales');
            $ruta = trim($ruta);
            $cargo = HvCargo::findOrFail($id);
            if (unlink($ruta . $cargo->manual)) {
                $act_cargo['manual'] = NULL;
                HvCargo::findOrFail($id)->update($act_cargo);
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
    public function nuev_manual($id)
    {
        $cargo = HvCargo::findOrFail($id);
        return view('intranet.empresa.archivo.manuales.crear', compact('cargo', 'id'));
    }
    public function guardar_nuev_manual(Request $request, $id)
    {
        $cargo = HvCargo::findOrFail($id);
        $ruta = Config::get('constantes.folder_manuales');
        $ruta = trim($ruta);
        $doc_subido = $request->manual;
        $nombre_doc = time() . '-' . utf8_encode(utf8_decode($doc_subido->getClientOriginalName()));
        $doc_subido->move($ruta, $nombre_doc);
        $nuevo_cargo['manual'] = $nombre_doc;
        HvCargo::findOrFail($id)->update($nuevo_cargo);
        $cargos = HvCargo::get();
        return redirect('admin/archivo-manuales-index/' . $cargo->area->nivel->empresa->id)->with('cargos');
    }
}
