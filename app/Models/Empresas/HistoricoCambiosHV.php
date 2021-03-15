<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class HistoricoCambiosHV extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'histcambhvempleado';
    protected $guarded = ['id'];

    public function hist_empleados()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id ', 'id');
    }

    public function hist_usuarios()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id ', 'id');
    }
}
