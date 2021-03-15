<?php

namespace App\Models\Juzgados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Documentos_Actuaciones extends Model
{
    use HasFactory, Notifiable;
    protected $table = "documentos_actuaciones";
    protected $guarded = ['id'];
    public function actuaciones()
    {
        return $this->belongsTo(Actuacion::class, 'actuaciones_id', 'id');
    }
}
