<?php

namespace App\Http\Controllers\Intranet\Empresas;

use App\Http\Controllers\Controller;
use App\Mail\CambioSolicitud;
use App\Models\Admin\Usuario;
use App\Models\Empresas\Empleado;
use App\Models\Empresas\Solicitud;
use App\Models\Empresas\SolicitudDoc;
use App\Models\Empresas\SolicitudGestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\Foreach_;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = session('id_usuario');
        if (session('rol_id') < 3) {
            $solicitudes = Solicitud::all();
        } else {
            $solicitudes = Solicitud::whereHas('usuarios', function ($q) use ($id) {
                $q->where('usuario_id', $id);
            })->orderBy('id')->get();
        }

        return view('intranet.empresa.solicitud.index', compact('solicitudes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        $empleado = Empleado::findOrfail(session('id_usuario'));
        return view('intranet.empresa.solicitud.crear', compact('empleado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request, $id)
    {
        $solicitudusuarios[] = $id;
        $solicitud = Solicitud::create($request->all());
        $solicitud->usuarios()->sync($solicitudusuarios);
        //=================================================================
        // **************************************************************************************************************
        $solicitudId = $solicitud->id;
        $datosTitulo = $solicitud->titulo;
        $datosCambio = 'Se creo un nueva solicitud o consulta';
        $evento = 'guardar_solicitud';
        $this->enviarNotificacion($solicitudId, $datosTitulo, $datosCambio, $evento);
        //=================================================================
        return redirect('admin/consultas_solicitudes-index')->with('mensaje', 'Solicitud creada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function gestionar($id)
    {
        $responsables = Usuario::with('roles')->whereHas('roles', function ($q) {
            $q->where('rol_id', 3)->orWhere('rol_id', 4)->orderBy('rol_id');
        })->get();
        $solicitud = Solicitud::findOrfail($id);
        return view('intranet.empresa.solicitud.gestionar', compact('solicitud', 'responsables'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function historial($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        return view('intranet.empresa.solicitud.historial', compact('solicitud', 'id'));
    }
    public function historial_guardar(Request $request, $id)
    {
        $gestionSolicitud = SolicitudGestion::create($request->all());
        $solicitud_act['estado'] = 'En gestión';
        $solicitud = Solicitud::findOrFail($gestionSolicitud->solicitud->id)->update($solicitud_act);
        //=================================================================
        // **************************************************************************************************************
        $solicitudId = $id;
        $datosTitulo = $gestionSolicitud->solicitud->titulo;
        $datosCambio = 'Se realizo una nueva gestion al la solicitud';
        $evento = 'Nueva Gestión';
        $this->enviarNotificacion($solicitudId, $datosTitulo, $datosCambio, $evento);
        //=================================================================
        return redirect('admin/consultas_solicitudes/' . $id . '/gestionar')->with('mensaje', 'Gesión creada con exito');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function doc_historial_guardar(Request $request, $id)
    {
        if ($request->ajax()) {
            $ruta = Config::get('constantes.folder_documentos_solicitudes');
            $ruta = trim($ruta);

            if ($request->hasFile('archivo')) {
                $doc_subido = $request->archivo;
                $nombre_doc = time() . '-' . utf8_encode(utf8_decode($request['titulo'])) . '.' . $doc_subido->getClientOriginalExtension();
                $nuevodocu['titulo'] = utf8_encode(utf8_decode($request['titulo']));
                $nuevodocu['archivo'] = $nombre_doc;
            }
            $nuevodocu['solicitudgestion_id'] = $id;
            if (SolicitudDoc::create($nuevodocu)) {
                $doc_subido->move($ruta, $nombre_doc);
                $documentos = SolicitudDoc::where('solicitudgestion_id', $id)->get();
                //=================================================================
                // **************************************************************************************************************
                $gestion = SolicitudGestion::findOrFail($id);
                $solicitudId = $gestion->solicitud->id;
                $datosTitulo = $gestion->solicitud->titulo;
                $datosCambio = 'Se realizo una nueva gestion al la solicitud';
                $evento = 'Nueva Gestión';
                $this->enviarNotificacion($solicitudId, $datosTitulo, $datosCambio, $evento);
                //=================================================================
                return response()->json(['mensaje' => 'ok', 'documentos' => $documentos]);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
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
    public function enviarNotificacion($solicitudId, $datosTitulo, $datosCambio, $evento)
    {
        $administradores = Usuario::with('roles')->whereHas('roles', function ($q) {
            $q->where('rol_id', 2)->orderBy('rol_id');
        })->get();
        $solicitud = Solicitud::findOrFail($solicitudId);
        foreach ($solicitud->usuarios as $usuario) {
            $datosCambio = $datosCambio . ' - correo empleado: ' . $usuario->email;
            Mail::to('cesarmaya99@hotmail.com')->send(new CambioSolicitud($solicitudId, $datosTitulo, $datosCambio));
        }
    }
}
