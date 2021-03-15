<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Opciones extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'opcionarchivo';
    protected $guarded = [];

    //----------------------------------------------------------------------------------
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function empleados()
    {
        return $this->belongsToMany(Empleado::class, 'empleadoarchivo');
    }
}
