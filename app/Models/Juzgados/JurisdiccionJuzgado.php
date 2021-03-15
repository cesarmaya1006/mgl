<?php

namespace App\Models\Juzgados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class JurisdiccionJuzgado extends Model
{
    use HasFactory, Notifiable;
    protected $table = "jurisdiccion_juzgado";
    protected $guarded = ['id'];

    public function juzgados()
    {
        return $this->hasMany(Juzgado::class, 'jurisdiccion_juzgado_id', 'id');
    }
}
