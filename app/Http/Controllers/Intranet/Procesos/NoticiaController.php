<?php

namespace App\Http\Controllers\Intranet\Procesos;

use App\Http\Controllers\Controller;
use App\Models\Noticias\Noticia;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as InterventionImage;

use Illuminate\Support\Facades\Config;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noticias = Noticia::orderBy('fecha_vencimiento', 'asc')->get();
        return view('intranet.noticias.index', compact('noticias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        return view('intranet.noticias.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        $ruta = Config::get('constantes.folder_imagenes_noticias');
        $ruta = trim($ruta);
        //imagen
        //----------------------------
        $imagen_nueva = $request->foto;
        $imagen_nueva_archivo = InterventionImage::make($imagen_nueva);
        $imagen_nueva_bd = time() . $imagen_nueva->getClientOriginalName();
        $imagen_nueva_archivo->resize(900, 400);
        $imagen_nueva_archivo->save($ruta . $imagen_nueva_bd, 100);
        //imagen
        //----------------------------
        if ($request->hasFile('documento')) {
            $ruta = Config::get('constantes.folder_noticias');
            $ruta = trim($ruta);
            $doc_subido = $request->documento;
            $nombre_doc = time() . '-' . utf8_encode(utf8_decode($request['nombre_doc'])) . '.' . $doc_subido->getClientOriginalExtension();
            $doc_subido->move($ruta, $nombre_doc);
            $nueva_noticia['nombre_doc'] = utf8_encode(utf8_decode($request['nombre_doc']));
            $nueva_noticia['documento'] = $nombre_doc;
        }
        //----------------------------
        $nueva_noticia['titulo'] = utf8_encode(utf8_decode($request['titulo']));
        $nueva_noticia['descripcion'] = utf8_encode(utf8_decode($request['descripcion']));
        $nueva_noticia['foto'] = $imagen_nueva_bd;
        $nueva_noticia['fecha_vencimiento'] = $request['fecha_vencimiento'];
        $nueva_noticia['estado'] = 1;
        Noticia::create($nueva_noticia);
        return redirect('admin/noticias-index')->with('mensaje', 'Noticia creada con exito');
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
        $noticia = Noticia::findOrFail($id);
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
        $noticia_eliminar = Noticia::findOrFail($id);
        //imagen
        //----------------------------
        $ruta = Config::get('constantes.folder_imagenes_noticias');
        $ruta = trim($ruta);
        unlink($ruta . $noticia_eliminar->foto);
        //----------------------------
        //Documento
        //----------------------------
        if ($noticia_eliminar->documento != NULL) {
            $ruta = Config::get('constantes.folder_noticias');
            $ruta = trim($ruta);
            unlink($ruta . $noticia_eliminar->documento);
        }
        //----------------------------

        Noticia::destroy($id);
        return redirect('admin/noticias-index')->with('mensaje', 'Noticia eliminada con exito');
    }

    public function desactivar($id)
    {
        $noticia  = Noticia::findOrFail($id);
        if ($noticia->estado == 1) {
            $actualizar['estado'] = 0;
        } else {
            $actualizar['estado'] = 1;
        }
        Noticia::findorFail($id)->update($actualizar);
        return redirect('admin/noticias-index')->with('mensaje', 'Estado del anoticia actualizado con exito');
    }
}
