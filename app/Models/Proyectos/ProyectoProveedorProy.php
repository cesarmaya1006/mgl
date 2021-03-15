<?php

namespace App\Models\Proyectos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProyectoProveedorProy extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'proyectoproveedor';
    protected $guarded = ['id'];
}
