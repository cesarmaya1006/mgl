<?php

namespace App\Models\Noticias;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Noticia extends Model
{
    use HasFactory, Notifiable;
    protected $table = "noticias";
    protected $guarded = ['id'];
}
