<?php

namespace App\Models\Juzgados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Terminacion_Anormal extends Model
{
    use HasFactory, Notifiable;
    protected $table = "terminacion_anormal";
    protected $guarded = ['id'];
}
