<?php

namespace App\Models\Juzgados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Tipo_Proceso extends Model
{
    use HasFactory, Notifiable;
    protected $table = "tipo_proceso";
    protected $guarded = ['id'];
    public function procesos()
    {
        return $this->hasMany(Procesos::class, 'tipo_proceso_id', 'id');
    }
}
