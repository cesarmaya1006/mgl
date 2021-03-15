<?php

namespace App\Models\Juzgados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Actuacion extends Model
{
    use HasFactory, Notifiable;
    protected $table = "actuaciones";
    protected $guarded = ['id'];

    public function procesos()
    {
        return $this->belongsTo(Procesos::class, 'proceso_id', 'id');
    }
    public function documentos()
    {
        return $this->hasMany(Documentos_Actuaciones::class, 'actuaciones_id', 'id');
    }
}
