<?php

namespace App\Models\Juzgados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class JuzgMunicipio extends Model
{
    use HasFactory, Notifiable;
    protected $table = "juzgmunicipios";
    protected $guarded = ['id'];
    public function juzgados()
    {
        return $this->hasMany(Juzgado::class, 'municipio_id', 'id');
    }
    public function circuitos()
    {
        return $this->belongsTo(Circuito::class, 'circuito_id', 'id');
    }
}
