<?php

namespace App\Models\Juzgados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Juzgado extends Model
{
    use HasFactory, Notifiable;
    protected $table = "juzgados";
    protected $guarded = ['id'];

    public function jurisdiccion_juzgados()
    {
        return $this->belongsTo(JurisdiccionJuzgado::class, 'jurisdiccion_juzgado_id', 'id');
    }
    public function municipios()
    {
        return $this->belongsTo(JuzgMunicipio::class, 'municipio_id', 'id');
    }
}
