<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Departamento extends Model
{
    use HasFactory, Notifiable;
    protected $table = "departamento";
    protected $guarded = ['id'];
    public function municipios()
    {
        return $this->hasMany(Municipio::class, 'departamento_id', 'id');
    }
}
