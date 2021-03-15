<?php

namespace App\Models\Empresas;

use App\Models\Admin\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SolicitudDoc extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'solicitudgestiondoc';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function gestion()
    {
        return $this->belongsTo(SolicitudGestion::class, 'solicitudgestion_id', 'id');
    }
}
