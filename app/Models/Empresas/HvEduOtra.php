<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class HvEduOtra extends Model
{
    use HasFactory, Notifiable;
    protected $table = "edu_otros";
    protected $guarded = ['id'];

    public function empelados()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id');
    }
}
