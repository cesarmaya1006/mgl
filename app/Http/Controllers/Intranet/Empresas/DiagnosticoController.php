<?php

namespace App\Http\Controllers\Intranet\Empresas;

use App\Http\Controllers\Controller;
use App\Models\Empresas\Diagnostico;
use App\Models\Empresas\Empleado;
use App\Models\Empresas\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class DiagnosticoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session('rol_id')>4){
            $empleado = Empleado::findOrFail(session('id_usuario'));
            $diagnosticos = Diagnostico::where('empresa_id',$empleado->empresa_id)->get();
        }else{
            $diagnosticos = Diagnostico::orderBy('empresa_id')->get();
        }
        return view('intranet.diagnosticos.index',compact('diagnosticos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        $empresas= Empresa::get();
        return view('intranet.diagnosticos.crear',compact('empresas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        $ruta = Config::get('constantes.folder_doc_solicitudes');
        $ruta = trim($ruta);
        $doc_subido = $request->documento;
        $nombre_doc = time() . '-' . utf8_encode(utf8_decode($doc_subido->getClientOriginalName()));
        $nuevo_soporte['empresa_id'] =  $request['empresa_id'];
        $nuevo_soporte['titulo'] =  $request['titulo'];
        $nuevo_soporte['fec_creacion'] =  $request['fec_creacion'];
        $nuevo_soporte['nombre'] = $request['nombre'];
        $nuevo_soporte['documento'] = $nombre_doc;
        $doc_subido->move($ruta, $nombre_doc);
        Diagnostico::create($nuevo_soporte);
        return redirect('admin/diagnosticos-index')->with('mensaje', 'Diagnostico judicial creado con exito');
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
}
