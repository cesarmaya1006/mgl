<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class HvNivel extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'hv_nivel';
    protected $guarded = [];

    //----------------------------------------------------------------------------------
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function areas()
    {
        return $this->hasMany(HvArea::class, 'nivel_id', 'id');
    }
}
