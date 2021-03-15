<?php

namespace App\Models\Juzgados;

use App\Models\Empresas\Empresa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Papel extends Model
{
    use HasFactory, Notifiable;
    protected $table = "papel";
    protected $guarded = ['id'];

    public function procesos()
    {
        return $this->hasMany(Procesos::class, 'empresas_procesos');
    }
}
