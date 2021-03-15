<?php

namespace App\Models\Empresas;

use App\Models\Admin\Tipo_Docu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Empresa extends Model
{
    use HasFactory, Notifiable;
    protected $remember_token = false;
    protected $table = 'empresas';
    protected $guarded = [];
    //==================================================================================
    public function tipos_docu()
    {
        return $this->belongsTo(Tipo_Docu::class, 'docutipos_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function niveles()
    {
        return $this->hasMany(HvNivel::class, 'empresa_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'empresa_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'empresa_id', 'id');
    }
    //==================================================================================
}
