<?php

namespace App\Models\Juzgados;

use App\Models\Admin\Tipo_Docu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Demandados extends Model
{
    use HasFactory, Notifiable;
    protected $table = "demandados";
    protected $guarded = ['id'];
    public function procesos()
    {
        return $this->belongsTo(Procesos::class, 'proceso_id', 'id');
    }
    public function tipos_docu()
    {
        return $this->belongsTo(Tipo_Docu::class, 'tipo_docu_id', 'id');
    }
}
