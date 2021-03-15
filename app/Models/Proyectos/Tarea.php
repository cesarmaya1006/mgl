<?php

namespace App\Models\Proyectos;

use App\Models\Empresas\Empleado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Tarea extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'tareas';
    protected $guarded = ['id'];

    public function componente()
    {
        return $this->belongsTo(Componente::class, 'componente_id', 'id');
    }
    public function responsable()
    {
        return $this->belongsTo(Empleado::class, 'responsable_id', 'id');
    }
    public function historiales()
    {
        return $this->hasMany(Historial::class, 'tarea_id', 'id');
    }
}
