<?php

namespace App\Models\Proyectos;

use App\Models\Empresas\Empleado;
use App\Models\Empresas\Empresa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Proyecto extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'proyectos';
    protected $guarded = [];

    //----------------------------------------------------------------------------------
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function lider()
    {
        return $this->belongsTo(Empleado::class, 'lider_id', 'id');
    }

    //----------------------------------------------------------------------------------
    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'proyectocliente');
    }
    //----------------------------------------------------------------------------------
    public function proveedores()
    {
        return $this->belongsToMany(Proveedor::class, 'proyectoproveedor');
    }
    //----------------------------------------------------------------------------------
    public function empleados()
    {
        return $this->belongsToMany(Empleado::class, 'proyectoempleados');
    }
    //----------------------------------------------------------------------------------
    public function componentes()
    {
        return $this->hasMany(Componente::class, 'proyecto_id', 'id');
    }
    //----------------------------------------------------------------------------------

}
