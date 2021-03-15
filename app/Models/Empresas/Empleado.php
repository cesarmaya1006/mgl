<?php

namespace App\Models\Empresas;

use App\Models\Admin\Usuario;
use App\Models\Proyectos\Proyecto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Empleado extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'empleados';
    protected $guarded = [];

    //----------------------------------------------------------------------------------
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function cargo()
    {
        return $this->belongsTo(HvCargo::class, 'hv_cargo_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'id');
    }
    //----------------------------------------------------------------------------------
    public function opciones()
    {
        return $this->belongsToMany(Opciones::class, 'empleadoarchivo');
    }
    //----------------------------------------------------------------------------------
    public function edu_basica()
    {
        return $this->hasMany(HvEduBasica::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function edu_superior()
    {
        return $this->hasMany(HvEduSuperior::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function edu_otra()
    {
        return $this->hasMany(HvEduOtra::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function publicaciones()
    {
        return $this->hasMany(Publicacion::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function idiomas()
    {
        return $this->hasMany(Idioma::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function experienciaslab()
    {
        return $this->hasMany(ExperienciaLab::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function experienciasIndp()
    {
        return $this->hasMany(ExperienciaIndp::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function documentos()
    {
        return $this->hasMany(HvDocumento::class, 'empleado_id', 'id');
    }

    //----------------------------------------------------------------------------------
    public function procesos()
    {
        return $this->hasMany(ProcDisciplinario::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function solicitudes()
    {
        return $this->hasMany(SolicitudGestion::class, 'empleado_id', 'id');
    }

    //----------------------------------------------------------------------------------
    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'proyectoempleados');
    }
    //----------------------------------------------------------------------------------

}
