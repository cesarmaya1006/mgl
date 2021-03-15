<?php

namespace App\Models\Mgl;

use App\Models\Admin\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Asistente extends Model
{
    use HasFactory, Notifiable;
    protected $table = "asistentes";
    protected $guarded = ['id'];

    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'id');
    }
}
