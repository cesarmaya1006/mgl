<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class HvArea extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'hv_area';
    protected $guarded = [];

    //----------------------------------------------------------------------------------
    public function nivel()
    {
        return $this->belongsTo(HvNivel::class, 'nivel_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function cargos()
    {
        return $this->hasMany(HvCargo::class, 'area_id', 'id');
    }
}
