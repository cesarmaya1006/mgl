<?php

namespace App\Models\Juzgados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Sentidos_Fallo extends Model
{
    use HasFactory, Notifiable;
    protected $table = "sentidos_fallo";
    protected $guarded = ['id'];
}
