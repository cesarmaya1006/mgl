<?php

namespace App\Models\Empresas;

use App\Models\Admin\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SolicitudGestion extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'solicitudgestion';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'solicitud_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function documentos()
    {
        return $this->hasMany(SolicitudDoc::class, 'solicitudgestion_id', 'id');
    }
}
