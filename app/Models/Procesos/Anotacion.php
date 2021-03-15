<?php

namespace App\Models\Procesos;

use App\Models\Juzgados\Procesos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Anotacion extends Model
{
    use HasFactory, Notifiable;
    protected $table = "anotacion";
    protected $guarded = ['id'];
    public function procesos()
    {
        return $this->belongsTo(Procesos::class, 'procesos_id', 'id');
    }
    public function documentos_anotaciones()
    {
        return $this->hasMany(DocAnotacion::class, 'anotacion_id', 'id');
    }
}
