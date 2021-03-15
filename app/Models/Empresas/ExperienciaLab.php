<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ExperienciaLab extends Model
{
    use HasFactory, Notifiable;
    protected $table = "experiencia_lab";
    protected $guarded = ['id'];

    public function empleados()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id');
    }
}
