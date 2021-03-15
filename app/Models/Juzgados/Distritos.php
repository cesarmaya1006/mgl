<?php

namespace App\Models\Juzgados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Distritos extends Model
{
    use HasFactory, Notifiable;
    protected $table = "distritos";
    protected $guarded = ['id'];
    public function circuitos()
    {
        return $this->hasMany(Circuito::class, 'distrito_id', 'id');
    }
    public function departamentos()
    {
        return $this->belongsTo(JuzgDepartamento::class, 'departamento_id', 'id');
    }
}
