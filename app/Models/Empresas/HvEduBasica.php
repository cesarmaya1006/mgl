<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class HvEduBasica extends Model
{
    use HasFactory, Notifiable;
    protected $table = "edu_basica";
    protected $guarded = ['id'];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id');
    }
}
