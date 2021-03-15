<?php

namespace App\Models\Juzgados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Estado_Proceso extends Model
{
    use HasFactory, Notifiable;
    protected $table = "estado_proceso";
    protected $guarded = ['id'];
    public function procesos()
    {
        return $this->hasMany(Usuario::class, 'estado_proceso_id', 'id');
    }
}
