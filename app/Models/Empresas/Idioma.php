<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Idioma extends Model
{
    use HasFactory, Notifiable;
    protected $table = "idiomas";
    protected $guarded = ['id'];

    public function hv_empleados()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id');
    }
}
