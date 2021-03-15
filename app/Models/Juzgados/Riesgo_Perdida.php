<?php

namespace App\Models\Juzgados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Riesgo_Perdida extends Model
{
    use HasFactory, Notifiable;
    protected $table = "riesgo_perdida";
    protected $guarded = ['id'];
    public function procesos()
    {
        return $this->hasMany(Procesos::class, 'riesgo_perdida_id', 'id');
    }
}
