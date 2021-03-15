<?php

namespace App\Models\Juzgados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class JuzgDepartamento extends Model
{
    use HasFactory, Notifiable;
    protected $table = "juzgdepartamentos";
    protected $guarded = ['id'];
    public function distritos()
    {
        return $this->hasMany(Distritos::class, 'departamento_id', 'id');
    }
}
