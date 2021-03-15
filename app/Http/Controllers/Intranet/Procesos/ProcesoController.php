<?php

namespace App\Http\Controllers\Intranet\Procesos;

use App\Http\Controllers\Controller;
use App\Models\Admin\Tipo_Docu;
use App\Models\Admin\Usuario;
use App\Models\Empresas\Empleado;
use App\Models\Empresas\Empresa;
use App\Models\Juzgados\Estado_Proceso;
use App\Models\Juzgados\Etapa_Proceso;
use App\Models\Juzgados\JurisdiccionJuzgado;
use App\Models\Juzgados\Papel;
use App\Models\Juzgados\Procesos;
use App\Models\Juzgados\Riesgo_Perdida;
use App\Models\Juzgados\Sentidos_Fallo;
use App\Models\Juzgados\Terminacion_Anormal;
use App\Models\Juzgados\Tipo_Proceso;
use App\Models\Mgl\Apoderado;
use App\Models\Mgl\Asistente;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class ProcesoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session('rol_id') > 4) {
            $empleado = Empleado::findOrFail(session('id_usuario'));
            $procesos = Procesos::with('empresas')->whereHas('empresas', function ($q) use ($empleado) {
                $q->where('empresa_id', $empleado->empresa->id);
            })->orderBy('id')->get();
            return view('intranet.procesos.procesos.index', compact('procesos', 'empleado'));
        } else {
            $usuario = Usuario::findOrFail(session('id_usuario'));
            if (session('rol_id') == 4) {
                $procesos = Procesos::with('asistentes_proceso')->whereHas('asistentes_proceso', function ($q) use ($usuario) {
                    $q->where('asistente_id', $usuario->id);
                })->orderBy('id')->get();
            } elseif (session('rol_id') == 3) {
                $procesos = Procesos::with('apoderados_proceso')->whereHas('apoderados_proceso', function ($q) use ($usuario) {
                    $q->where('apoderado_id', $usuario->id);
                })->orderBy('id')->get();
            } else {
                $procesos = Procesos::orderBy('id')->get();
            }
            return view('intranet.procesos.procesos.index', compact('procesos'));
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        //
    }
    public function detalle($id)
    {
        $proceso = Procesos::findOrFail($id);
        return view('intranet.procesos.procesos.detalle', compact('proceso'));
    }

    public function exportar($id)
    {
        $proceso = Procesos::findOrFail($id);
        $data = compact('proceso');
        $pdf = PDF::loadView('intranet.procesos.procesos.pdf', $data);
        return $pdf->download('Resumen Proceso.pdf');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //-------------------------------------------------------
        $sentidos_fallo = Sentidos_Fallo::get();
        $terminaciones_anormal = Terminacion_Anormal::get();
        $clientes = Empresa::get();
        $apoderados = Apoderado::get();
        $asistentes = Asistente::get();
        $papel_clientes = Papel::orderBy('id')->get();
        $tipos_identificacion = Tipo_Docu::all();
        $tipos_procesos = Tipo_Proceso::orderBy('tipo_proceso')->get();
        $riegos_perdida = Riesgo_Perdida::orderBy('riesgo_perdida')->get();
        $etapas_procesos = Etapa_Proceso::orderBy('etapa_proceso')->get();
        $jurisdicciones = JurisdiccionJuzgado::orderBy('jurisdiccion')->get();
        $estados_procesos = Estado_Proceso::get();

        //-------------------------------------------------------
        $proceso = Procesos::findOrFail($id);
        return view('intranet.procesos.procesos.editar', compact('proceso', 'sentidos_fallo', 'terminaciones_anormal', 'clientes', 'apoderados', 'asistentes', 'papel_clientes', 'tipos_identificacion', 'tipos_procesos', 'riegos_perdida', 'etapas_procesos', 'jurisdicciones', 'estados_procesos'));
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
