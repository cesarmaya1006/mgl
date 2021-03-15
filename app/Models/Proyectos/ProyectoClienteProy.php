<?php

namespace App\Models\Proyectos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProyectoClienteProy extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'proyectocliente';
    protected $guarded = ['id'];
}
