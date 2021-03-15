<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ExperienciaIndp extends Model
{
    use HasFactory, Notifiable;
    protected $table = "experiencia_ind";
    protected $guarded = ['id'];

    public function empleados()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id');
    }
}
