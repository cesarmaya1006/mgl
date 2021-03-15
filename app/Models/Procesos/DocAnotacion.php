<?php

namespace App\Models\Procesos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DocAnotacion extends Model
{
    use HasFactory, Notifiable;
    protected $table = "documento_anotacion";
    protected $guarded = ['id'];
    public function anotaciones()
    {
        return $this->belongsTo(Anotacion::class, 'anotacion_id', 'id');
    }
}
