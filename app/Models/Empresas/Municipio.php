<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Municipio extends Model
{
    use HasFactory, Notifiable;
    protected $table = "municipio";
    protected $guarded = ['id'];
    public function departamentos()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id', 'id');
    }
}
