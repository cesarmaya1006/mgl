<?php

namespace App\Http\Controllers\Intranet\Empresas;

use App\Http\Controllers\Controller;
use App\Models\Empresas\Empleado;
use App\Models\Empresas\Empresa;
use App\Models\Empresas\HvArea;
use App\Models\Empresas\HvCargo;
use App\Models\Empresas\HvNivel;
use Illuminate\Http\Request;

class ParametrosHVController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleado = Empleado::findOrFail(session('id_usuario'));
        return view('intranet.empresa.parametros.index', compact('empleado'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear_nivel($id)
    {
        return view('intranet.empresa.parametros.crear_nivel', compact('id'));
    }
    public function crear_area($id)
    {
        $niveles = HvNivel::where('empresa_id', $id)->get();
        return view('intranet.empresa.parametros.crear_area', compact('id', 'niveles'));
    }
    public function crear_cargo($id)
    {
        $niveles = HvNivel::where('empresa_id', $id)->get();
        return view('intranet.empresa.parametros.crear_cargo', compact('id', 'niveles'));
    }
    public function guardar_nivel(Request $request, $id)
    {
        HvNivel::create($request->all());
        return redirect('admin/param_hojas_de_vida-index')->with('mensaje', 'Nivel creado con exito');
    }
    public function guardar_area(Request $request, $id)
    {
        HvArea::create($request->all());
        return redirect('admin/param_hojas_de_vida-index')->with('mensaje', 'Area creado con exito');
    }
    public function guardar_cargo(Request $request, $id)
    {
        HvCargo::create($request->all());
        return redirect('admin/param_hojas_de_vida-index')->with('mensaje', 'Cargo creado con exito');
    }

    public function cargar_areas(Request $request)
    {
        return HvArea::where('nivel_id', $request['nivel_id'])->get();
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
