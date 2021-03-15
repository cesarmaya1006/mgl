<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class HvCargo extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'hv_cargo';
    protected $guarded = [];

    //----------------------------------------------------------------------------------
    public function area()
    {
        return $this->belongsTo(HvArea::class, 'area_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'hv_cargo_id', 'id');
    }
}
