<?php

namespace App\Models\Proyectos;

use App\Models\Empresas\Empleado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Componente extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'componentes';
    protected $guarded = ['id'];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id', 'id');
    }
    public function responsable()
    {
        return $this->belongsTo(Empleado::class, 'responsable_id', 'id');
    }
    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'componente_id', 'id');
    }
}
