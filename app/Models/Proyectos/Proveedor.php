<?php

namespace App\Models\Proyectos;

use App\Models\Admin\Tipo_Docu;
use App\Models\Empresas\Empresa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Proveedor extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'empresaproveedores';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function tipos_docu()
    {
        return $this->belongsTo(Tipo_Docu::class, 'docutipos_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'proyectoproveedor');
    }
}
