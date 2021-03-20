<?php

namespace App\Http\Controllers\Intranet\Empresas;

use App\Exports\EmpleadosExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Empresa\ValidacionEmpleado;
use App\Models\Admin\Tipo_Docu;
use App\Models\Admin\Usuario;
use App\Models\Empresas\Departamento;
use App\Models\Empresas\Empleado;
use App\Models\Empresas\Empresa;
use App\Models\Empresas\HistoricoCambiosHV;
use App\Models\Empresas\HvArea;
use App\Models\Empresas\HvCargo;
use App\Models\Empresas\HvEduBasica;
use App\Models\Empresas\HvEduOtra;
use App\Models\Empresas\HvEduSuperior;
use App\Models\Empresas\HvNivel;
use App\Models\Empresas\Idioma;
use App\Models\Empresas\Municipio;
use App\Models\Empresas\Pais;
use App\Models\Empresas\Publicacion;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Facades\Image as InterventionImage;

use Maatwebsite\Excel\Facades\Excel;

class HojaVidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $empresa = Empresa::findOrFail($id);
        $empleado = Empleado::findOrFail(session('id_usuario'));
        return view('intranet.empresa.archivo.hojas_de_vida.index', compact('empresa', 'empleado'));
    }

    public function exportarExcel($id)
    {
        return Excel::download(new EmpleadosExport($id), 'Empleados.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear($id)
    {
        $tipos_doc = Tipo_Docu::get();
        $niveles = HvNivel::where('empresa_id', $id)->get();
        return view('intranet.empresa.archivo.hojas_de_vida.crear', compact('tipos_doc', 'niveles', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(ValidacionEmpleado $request, $id)
    {
        $nuevoUsuario['docutipos_id'] = $request['tipo_docu_id'];
        $nuevoUsuario['identificacion'] = $request['identificacion'];
        $nuevoUsuario['nombres'] = $request['nombres'];
        $nuevoUsuario['apellidos'] = $request['apellidos'];
        $nuevoUsuario['email'] = $request['email'];
        $nuevoUsuario['telefono'] = $request['telefono'];
        $nuevoUsuario['password'] = bcrypt(utf8_encode($request['password']));
        $nuevoUsuario['camb_password'] = 1;
        $usuario = Usuario::create($nuevoUsuario);
        $roles['rol_id'] = 6;
        $usuario->roles()->sync($roles);
        $usuarios_t = Usuario::orderBy('id')->get();
        foreach ($usuarios_t as $item) {
            $usuario_f = $item;
        }
        //-------------------------------------------
        $nuevoEmpleado['id'] = $usuario->id;
        $nuevoEmpleado['empresa_id'] = $id;
        $nuevoEmpleado['hv_cargo_id'] = $request['hv_cargo_id'];
        $nuevoEmpleado['sexo'] = $request['sexo'];
        $nuevoEmpleado['vinculacion'] = date('Y-m-d');
        $nuevoEmpleado['estado'] = 1;
        if (isset($request['lider'])) {
            $nuevoEmpleado['lider'] = 1;
        } else {
            $nuevoEmpleado['lider'] = 0;
        }
        Empleado::create($nuevoEmpleado);
        return Redirect('admin/archivo-hojas_de_vida-index/' . $id)->with('mensaje', 'Empleado creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detalles($id)
    {
        $empleado = Empleado::findOrFail($id);
        $respuesta = $this->calcularTiempoLaboral($empleado->id);
        $edad = Carbon::parse($empleado->fecha_nacimiento)->age;
        return view('intranet.empresa.archivo.hojas_de_vida.detalles', compact('empleado', 'id', 'edad', 'respuesta'));
    }
    public function documentacion($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('intranet.empresa.archivo.hojas_de_vida.documentacion', compact('empleado', 'id'));
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
        $cargos = HvCargo::where('area_id', $empleado->cargo->area->id)->get();
        $areas = HvArea::where('nivel_id', $empleado->cargo->area->nivel->id)->get();
        $niveles = HvNivel::where('empresa_id', $empleado->empresa->id)->get();
        $tipos_doc = Tipo_Docu::get();
        $paises  = Pais::get();
        $departamentos = Departamento::get();
        $respuesta = $this->calcularTiempoLaboral($empleado->id);
        return view('intranet.empresa.archivo.hojas_de_vida.editar', compact('empleado', 'id', 'niveles', 'areas', 'cargos', 'tipos_doc', 'paises', 'departamentos', 'respuesta'));
    }
    public function hv_cargar_municipios(Request $request)
    {
        if ($request->ajax()) {
            $id = $_GET['id'];
            //$departamentos = Departamento::findOrFail($id);
            $departamentos = Departamento::where('departamento', $id)->get();
            foreach ($departamentos as $departamento) {
                $departamento_id = $departamento->id;
            }
            return Municipio::where('departamento_id', $departamento_id)->orderBy('municipio')->get();
            //return $departamento->municipios;
        }
    }
    public function guardar_info_empleado(Request $request, $id)
    {
        $empleado_actual = Empleado::findOrFail($id);
        $ruta = Config::get('constantes.folder_imagenes_hojas_de_vida');
        $ruta = trim($ruta);
        //--------------------------------------------------
        $usuario_edit['docutipos_id'] = $request['docutipos_id'];
        $usuario_edit['identificacion'] = $request['identificacion'];
        $usuario_edit['nombres'] = ucfirst(utf8_encode(utf8_decode($request['nombres'])));
        $usuario_edit['apellidos'] = ucfirst(utf8_encode(utf8_decode($request['apellidos'])));
        $usuario_edit['email'] = strtolower(utf8_encode(utf8_decode($request['email'])));
        $usuario_edit['telefono'] = $request['telefono'];
        //--------------------------------------------------
        $hv_empleado_edit['hv_cargo_id'] = $request['hv_cargo_id'];
        $hv_empleado_edit['sexo'] = $request['sexo'];
        if ($request['pais_nacionalidad'] == 'COLOMBIA') {
            if ($hv_empleado_edit['sexo'] == 'Masculino') {
                $hv_empleado_edit['nacionalidad'] = 'COLOMBIANO';
            } else {
                $hv_empleado_edit['nacionalidad'] = 'COLOMBIANA';
            }
        } else {
            $hv_empleado_edit['nacionalidad'] = $request['pais_nacionalidad'];
        }
        $hv_empleado_edit['tipo_libreta'] = $request['tipo_libreta'];
        $hv_empleado_edit['n_libreta'] = $request['n_libreta'];
        $hv_empleado_edit['pais_nacimiento'] = $request['pais_nacionalidad'];
        $hv_empleado_edit['lugar_nacimiento'] = $request['lugar_nacimiento'];
        $hv_empleado_edit['fecha_nacimiento'] = $request['fecha_nacimiento'];
        $hv_empleado_edit['direccion'] = ucfirst(utf8_encode(utf8_decode($request['direccion'])));
        $hv_empleado_edit['pais_residencia'] = $request['pais_residencia'];
        if ($request['pais_nacionalidad'] == 'COLOMBIA') {
            $hv_empleado_edit['departamento_residencia'] = $request['departamento_residencia'];
            $hv_empleado_edit['municipio_residencia'] = $request['municipio_residencia'];
        } else {
            $hv_empleado_edit['departamento_residencia'] = NULL;
            $hv_empleado_edit['municipio_residencia'] = NULL;
        }
        $hv_empleado_edit['telefono_fijo'] = $request['telefono_fijo'];
        $hv_empleado_edit['descripcion'] = ucfirst(utf8_encode(utf8_decode($request['descripcion'])));
        //--------------------------------------------------
        if ($request->hasFile('foto')) {
            $imagen_nueva = $request->foto;
            $imagen_nueva_archivo = InterventionImage::make($imagen_nueva);
            $imagen_nueva_empl = time() . $imagen_nueva->getClientOriginalName();
            $imagen_nueva_archivo->resize(600, 800);
            if ($empleado_actual->foto != null) {
                if ($empleado_actual->foto != 'usuario-inicial.jpg') {
                    unlink($ruta . $empleado_actual->foto);
                }
            }
            $imagen_nueva_archivo->save($ruta . $imagen_nueva_empl, 72);
            $hv_empleado_edit['foto'] = $imagen_nueva_empl;
        }
        //--------------------------------------------------
        Usuario::findOrFail($id)->update($usuario_edit);
        Empleado::findOrFail($id)->update($hv_empleado_edit);
        //--------------------------------------------------
        $cambio = 'Actualizacion información empleado';
        $this->controlCambios($id, $cambio);
        //--------------------------------------------------
        return redirect()->back()->with('mensaje', 'Informacion de empleado actualizada de manera correcta');
    }
    //+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-
    public function edubasica($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('intranet.empresa.archivo.hojas_de_vida.documentacion.educacionbasica', compact('empleado'));
    }

    public function edubasica_guardar(Request $request, $id)
    {
        $ruta = Config::get('constantes.folder_documentos_doc_hv');
        $ruta = trim($ruta);
        $nuevo_soporte = $request->all();
        if ($request->hasFile('soporte')) {
            $doc_subido = $request->soporte;
            $nombre_doc = time() . '-' . $doc_subido->getClientOriginalName();
            $nuevo_soporte['soporte'] = $nombre_doc;
            $doc_subido->move($ruta, $nombre_doc);
        }

        HvEduBasica::create($nuevo_soporte);
        $cambio = 'Guardar de informacion educación básica';
        $this->controlCambios($id, $cambio);
        $empleado = Empleado::findOrFail($id);
        return redirect('admin/archivo-hojas_de_vida/' . $id . '/editar')
            ->with('mensaje', 'Informacion guardada con exito');
    }

    public function eliminarEduBas(Request $request, $id)
    {
        if ($request->ajax()) {
            $edu_basica = HvEduBasica::findOrFail($id);
            if (HvEduBasica::destroy($id)) {
                if ($edu_basica->soporte != NULL) {
                    $ruta = Config::get('constantes.folder_documentos_doc_hv');
                    $ruta = trim($ruta);
                    unlink($ruta . $edu_basica->soporte);
                }
                $cambio = 'Eliminación de informacion educación básica';
                $this->controlCambios($edu_basica->empleado->id, $cambio);

                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
    //+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-
    public function edusuperior($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('intranet.empresa.archivo.hojas_de_vida.documentacion.educacionsuperior', compact('empleado'));
    }

    public function edusuperior_guardar(Request $request, $id)
    {
        $ruta = Config::get('constantes.folder_documentos_doc_hv');
        $ruta = trim($ruta);
        $nuevo_soporte = $request->all();
        if ($request->hasFile('soporte')) {
            $doc_subido = $request->soporte;
            $nombre_doc = time() . '-' . $doc_subido->getClientOriginalName();
            $nuevo_soporte['soporte'] = $nombre_doc;
            $doc_subido->move($ruta, $nombre_doc);
        }

        HvEduSuperior::create($nuevo_soporte);

        $cambio = 'Guardar informacion educación superior';
        $this->controlCambios($id, $cambio);
        return redirect('admin/archivo-hojas_de_vida/' . $id . '/editar')
            ->with('mensaje', 'Informacion guardada con exito');
    }

    public function eliminarEduSup(Request $request, $id)
    {
        if ($request->ajax()) {
            $edu_superior = HvEduSuperior::findOrFail($id);
            if (HvEduSuperior::destroy($id)) {
                if ($edu_superior->soporte != NULL) {
                    $ruta = Config::get('constantes.folder_documentos_doc_hv');
                    $ruta = trim($ruta);
                    unlink($ruta . $edu_superior->soporte);
                }
                $cambio = 'Eliminación de informacion educación superior';
                $this->controlCambios($edu_superior->empleado->id, $cambio);
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
    //+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-
    public function eduotra($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('intranet.empresa.archivo.hojas_de_vida.documentacion.educacionotra', compact('empleado'));
    }

    public function eduotra_guardar(Request $request, $id)
    {
        $ruta = Config::get('constantes.folder_documentos_doc_hv');
        $ruta = trim($ruta);
        $nuevo_soporte = $request->all();
        if ($request->hasFile('soporte')) {
            $doc_subido = $request->soporte;
            $nombre_doc = time() . '-' . $doc_subido->getClientOriginalName();
            $nuevo_soporte['soporte'] = $nombre_doc;
            $doc_subido->move($ruta, $nombre_doc);
        }

        HvEduOtra::create($nuevo_soporte);

        $cambio = 'Guardar informacion educació otra';
        $this->controlCambios($id, $cambio);

        return redirect('admin/archivo-hojas_de_vida/' . $id . '/editar')
            ->with('mensaje', 'Informacion guardada con exito');
    }

    public function eliminarEduOtra(Request $request, $id)
    {
        if ($request->ajax()) {
            $edu_otra = HvEduOtra::findOrFail($id);
            if (HvEduOtra::destroy($id)) {
                if ($edu_otra->soporte != NULL) {
                    $ruta = Config::get('constantes.folder_documentos_doc_hv');
                    $ruta = trim($ruta);
                    unlink($ruta . $edu_otra->soporte);
                }
                $cambio = 'Eliminación de informacion educació otra';
                $this->controlCambios($edu_otra->empleado->id, $cambio);
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
    //+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-
    public function publicaciones($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('intranet.empresa.archivo.hojas_de_vida.documentacion.publicaciones', compact('empleado'));
    }

    public function publicaciones_guardar(Request $request, $id)
    {
        $ruta = Config::get('constantes.folder_documentos_doc_hv');
        $ruta = trim($ruta);
        $nuevo_soporte = $request->all();
        if ($request->hasFile('soporte')) {
            $doc_subido = $request->soporte;
            $nombre_doc = time() . '-' . $doc_subido->getClientOriginalName();
            $nuevo_soporte['soporte'] = $nombre_doc;
            $doc_subido->move($ruta, $nombre_doc);
        }

        $cambio = 'Guardar informacion sobre publicaiones';
        $this->controlCambios($id, $cambio);
        Publicacion::create($nuevo_soporte);
        return redirect('admin/archivo-hojas_de_vida/' . $id . '/editar')
            ->with('mensaje', 'Informacion guardada con exito');
    }

    public function eliminarpublicaciones(Request $request, $id)
    {
        if ($request->ajax()) {
            $publicacion = Publicacion::findOrFail($id);
            if (Publicacion::destroy($id)) {
                if ($publicacion->soporte != NULL) {
                    $ruta = Config::get('constantes.folder_documentos_doc_hv');
                    $ruta = trim($ruta);
                    unlink($ruta . $publicacion->soporte);
                }
                $cambio = 'Eliminación de informacion sobre publicaiones';
                $this->controlCambios($publicacion->empleado->id, $cambio);
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
    //+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-
    public function idiomas($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('intranet.empresa.archivo.hojas_de_vida.documentacion.idiomas', compact('empleado'));
    }

    public function idiomas_guardar(Request $request, $id)
    {
        $ruta = Config::get('constantes.folder_documentos_doc_hv');
        $ruta = trim($ruta);
        $nuevo_soporte = $request->all();
        if ($request->hasFile('soporte')) {
            $doc_subido = $request->soporte;
            $nombre_doc = time() . '-' . $doc_subido->getClientOriginalName();
            $nuevo_soporte['soporte'] = $nombre_doc;
            $doc_subido->move($ruta, $nombre_doc);
        }

        Idioma::create($nuevo_soporte);

        $cambio = 'Guardar informacion idiomas';
        $this->controlCambios($id, $cambio);
        return redirect('admin/archivo-hojas_de_vida/' . $id . '/editar')
            ->with('mensaje', 'Informacion guardada con exito');
    }

    public function eliminaridiomas(Request $request, $id)
    {
        if ($request->ajax()) {
            $idioma = Idioma::findOrFail($id);
            if (Idioma::destroy($id)) {
                if ($idioma->soporte != NULL) {
                    $ruta = Config::get('constantes.folder_documentos_doc_hv');
                    $ruta = trim($ruta);
                    unlink($ruta . $idioma->soporte);
                }
                $cambio = 'Eliminación de informacion idiomas';
                $this->controlCambios($idioma->empleado->id, $cambio);
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }

    public function generatePDF($id)
    {
        $empleado = Empleado::findOrFail($id);
        $respuesta = $this->calcularTiempoLaboral($empleado->id);
        $edad = Carbon::parse($empleado->fecha_nacimiento)->age;

        $data = [
            'empleado' => $empleado,
            'respuesta' => $respuesta,
            'edad' => $edad,
        ];

        $pdf = PDF::loadView('intranet.empresa.archivo.hojas_de_vida.exportar_pdf', $data);

        return $pdf->download('Hoha de' . $empleado->usuario->nombres . '.pdf');
    }
    //+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-

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
    public function cargar_cargos(Request $request)
    {
        return HvCargo::where('area_id', $request['area_id'])->get();
    }

    public function calcularTiempoLaboral($id)
    {
        $empleado = Empleado::findOrFail($id);
        $secPubTotal = null;
        $secPubAnnos = 0;
        $secPubMeses = 0;
        $secPubDias = 0;
        $secPrivAnnos = 0;
        $secPrivMeses = 0;
        $secPrivDias = 0;
        $secIndAnnos = 0;
        $secIndMeses = 0;
        $secIndDias = 0;
        $secIndpAnnos = 0;
        $secIndpMeses = 0;
        $secIndpDias = 0;
        $diferenciaPub = null;
        $diferenciaPriv = null;
        // +-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+
        foreach ($empleado->experienciaslab as $item) {
            $fecha_ini = Carbon::parse($item->fecha_ingreso);
            if ($item->actual == 'Si') {
                $fecha_fin = Carbon::now();
            } else {
                $fecha_fin = Carbon::createFromDate($item->fecha_termino);
            }
            if ($item->tipo_entidad == 'Pública') {
                $diferenciaPub = $fecha_ini->diff($fecha_fin);
                $secPubAnnos = $secPubAnnos + $diferenciaPub->y;
                $secPubMeses = $secPubMeses + $diferenciaPub->m;
                $secPubDias = $secPubDias + $diferenciaPub->d;
            } else {
                $diferenciaPriv = $fecha_ini->diff($fecha_fin);
                $secPrivAnnos = $secPrivAnnos + $diferenciaPriv->y;
                $secPrivMeses = $secPrivMeses + $diferenciaPriv->m;
                $secPrivDias = $secPrivDias + $diferenciaPriv->d;
            }
        }
        // ================================================================
        if ($secPrivDias > 30) {
            $secPrivDias_f = $secPrivDias % 30;
            $secPrivMeses = $secPrivMeses + (($secPrivDias - $secPrivDias_f) / 30);
        } else {
            $secPrivDias_f = $secPrivDias;
        }
        if ($secPrivMeses > 12) {
            $secPrivMeses_f = $secPrivMeses % 12;
            $secPrivAnnos_f = $secPrivAnnos + (($secPrivMeses - $secPrivMeses_f) / 12);
        } else {
            $secPrivMeses_f = $secPrivMeses;
            $secPrivAnnos_f = $secPrivAnnos;
        }
        // ================================================================
        if ($secPubDias > 30) {
            $secPubDias_f = $secPubDias % 30;
            $secPubMeses = $secPubMeses + (($secPubDias - $secPubDias_f) / 30);
        } else {
            $secPubDias_f = $secPubDias;
        }
        if ($secPubMeses > 12) {
            $secPubMeses_f = $secPubMeses % 12;
            $secPubAnnos_f = $secPubAnnos + (($secPubMeses - $secPubMeses_f) / 12);
        } else {
            $secPubMeses_f = $secPubMeses;
            $secPubAnnos_f = $secPubAnnos;
        }
        // ================================================================
        // +-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+
        foreach ($empleado->experienciasIndp as $item) {
            $fecha_ini = Carbon::parse($item->fecha_ingreso);
            $fecha_fin = Carbon::createFromDate($item->fecha_termino);
            $diferenciaIndp = $fecha_ini->diff($fecha_fin);
            $secIndpAnnos = $secIndpAnnos + $diferenciaIndp->y;
            $secIndpMeses = $secIndpMeses + $diferenciaIndp->m;
            $secIndpDias = $secIndpDias + $diferenciaIndp->d;
        }
        // +-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+
        // ================================================================
        if ($secIndpDias > 30) {
            $secIndpDias_f = $secIndpDias % 30;
            $secIndpMeses = $secIndpMeses + (($secIndpDias - $secIndpDias_f) / 30);
        } else {
            $secIndpDias_f = $secIndpDias;
        }
        if ($secIndpMeses > 12) {
            $secIndpMeses_f = $secIndpMeses % 12;
            $secIndpAnnos_f = $secIndpAnnos + (($secIndpMeses - $secIndpMeses_f) / 12);
        } else {
            $secIndpMeses_f = $secIndpMeses;
            $secIndpAnnos_f = $secIndpAnnos;
        }
        // ================================================================
        $dias_total = $secPubDias_f + $secPrivDias_f + $secIndpDias_f;
        $meses_total = $secPubMeses_f + $secPrivMeses_f + $secIndpMeses_f;
        $annos_total = $secPubAnnos_f + $secPrivAnnos_f + $secIndpAnnos_f;
        if ($dias_total > 30) {
            $dias_total_f = $dias_total % 30;
            $meses_total = $meses_total + (($dias_total - $dias_total_f) / 30);
        } else {
            $dias_total_f = $dias_total;
        }
        if ($meses_total > 12) {
            $meses_total_f = $meses_total % 12;
            $annos_total_f = $annos_total + (($meses_total - $meses_total_f) / 12);
        } else {
            $meses_total_f = $meses_total;
            $annos_total_f = $annos_total;
        }
        $respuesta['secPubAnnos_f'] = $secPubAnnos_f;
        $respuesta['secPubMeses_f'] = $secPubMeses_f;
        $respuesta['secPubDias_f'] = $secPubDias_f;
        $respuesta['secPrivDias_f'] = $secPrivDias_f;
        $respuesta['secPrivMeses_f'] = $secPrivMeses_f;
        $respuesta['secPrivAnnos_f'] = $secPrivAnnos_f;
        $respuesta['secIndpDias_f'] = $secIndpDias_f;
        $respuesta['secIndpMeses_f'] = $secIndpMeses_f;
        $respuesta['secIndpAnnos_f'] = $secIndpAnnos_f;
        $respuesta['dias_total_f'] = $dias_total_f;
        $respuesta['meses_total_f'] = $meses_total_f;
        $respuesta['annos_total_f'] = $annos_total_f;
        return $respuesta;
    }
    public function controlCambios($empleado_id, $cambio)
    {
        $nuevoHistorico['empleado_id'] = $empleado_id;
        $nuevoHistorico['cambio'] = $cambio;
        $nuevoHistorico['usuario_id'] = session('id_usuario');
        HistoricoCambiosHV::create($nuevoHistorico);
    }
}
