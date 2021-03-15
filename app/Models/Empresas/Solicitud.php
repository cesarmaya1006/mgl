<?php

namespace App\Models\Empresas;

use App\Models\Admin\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Solicitud extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'solicitudes';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'solicitudusuarios');
    }
    //----------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function gestiones()
    {
        return $this->hasMany(SolicitudGestion::class, 'solicitud_id', 'id');
    }
}
