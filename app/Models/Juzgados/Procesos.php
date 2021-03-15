<?php

namespace App\Models\Juzgados;

use App\Models\Empresas\Empresa;
use App\Models\Mgl\Apoderado;
use App\Models\Mgl\Asistente;
use App\Models\Procesos\Anotacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Procesos extends Model
{
    use HasFactory, Notifiable;
    protected $table = "procesos";
    protected $guarded = ['id'];
    //--------------------------------------------------------------
    public function empresas()
    {
        return $this->belongsToMany(Empresa::class, 'empresas_procesos');
    }
    //--------------------------------------------------------------
    public function juzgados()
    {
        return $this->belongsTo(Juzgado::class, 'juzgado_id', 'id');
    }
    //--------------------------------------------------------------
    public function tipos_proceso()
    {
        return $this->belongsTo(Tipo_Proceso::class, 'tipo_proceso_id', 'id');
    }
    //--------------------------------------------------------------
    public function estados_proceso()
    {
        return $this->belongsTo(Estado_Proceso::class, 'estado_proceso_id', 'id');
    }
    //--------------------------------------------------------------
    public function etapas_proceso()
    {
        return $this->belongsTo(Etapa_Proceso::class, 'etapa_proceso_id', 'id');
    }
    //--------------------------------------------------------------
    public function riesgos_perdida()
    {
        return $this->belongsTo(Riesgo_Perdida::class, 'riesgo_perdida_id', 'id');
    }
    //--------------------------------------------------------------
    public function terminaciones_anormales()
    {
        return $this->belongsTo(Terminacion_Anormal::class, 'terminacion_anormal', 'id');
    }
    //--------------------------------------------------------------
    public function apoderados_proceso()
    {
        return $this->belongsToMany(Apoderado::class, 'apoderados_proceso');
    }
    //--------------------------------------------------------------
    public function asistentes_proceso()
    {
        return $this->belongsToMany(Asistente::class, 'asistente_proceso');
    }
    //--------------------------------------------------------------
    public function papel_clientes()
    {
        return $this->belongsToMany(Papel::class, 'empresas_procesos');
    }
    //--------------------------------------------------------------
    public function demandantes()
    {
        return $this->hasMany(Demandante::class, 'proceso_id', 'id');
    }
    //--------------------------------------------------------------
    public function demandados()
    {
        return $this->hasMany(Demandados::class, 'proceso_id', 'id');
    }
    //--------------------------------------------------------------
    public function actuaciones()
    {
        return $this->hasMany(Actuacion::class, 'proceso_id', 'id');
    }
    //--------------------------------------------------------------
    public function documentos_proceso()
    {
        return $this->hasMany(Documentos_Procesos::class, 'procesos_id', 'id');
    }
    //--------------------------------------------------------------
    public function anotaciones()
    {
        return $this->hasMany(Anotacion::class, 'procesos_id', 'id');
    }
    //--------------------------------------------------------------

}
