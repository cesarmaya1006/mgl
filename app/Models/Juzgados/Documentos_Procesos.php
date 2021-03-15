<?php

namespace App\Models\Juzgados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Documentos_Procesos extends Model
{
    use HasFactory, Notifiable;
    protected $table = "documentos_procesos";
    protected $guarded = ['id'];
    public function procesos()
    {
        return $this->belongsTo(Procesos::class, 'procesos_id', 'id');
    }
}
