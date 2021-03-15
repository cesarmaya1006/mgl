<?php

namespace App\Models\Proyectos;

use App\Models\Empresas\Empleado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Historial extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'historiales';
    protected $guarded = ['id'];

    public function tarea()
    {
        return $this->belongsTo(Tarea::class, 'tarea_id', 'id');
    }
    public function usuhistorial()
    {
        return $this->belongsTo(Empleado::class, 'usuariohistorial_id', 'id');
    }
    public function asignado()
    {
        return $this->belongsTo(Empleado::class, 'usuarioasignado_id', 'id');
    }
    public function documentos()
    {
        return $this->hasMany(HistorialDoc::class, 'historial_id', 'id');
    }
}
