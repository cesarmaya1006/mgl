<?php

namespace App\Models\Juzgados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Circuito extends Model
{
    use HasFactory, Notifiable;
    protected $table = "circuitos";
    protected $guarded = ['id'];
    public function municipios()
    {
        return $this->hasMany(JuzgMunicipio::class, 'circuito_id', 'id');
    }
    public function distritos()
    {
        return $this->belongsTo(Distritos::class, 'distrito_id', 'id');
    }
}
