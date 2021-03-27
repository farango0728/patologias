<?php
namespace App\Models;

use Carbon\Carbon;

class Resultados extends Model
{
    protected $table = "resultados";

    protected $fillable = ['id_orden', 'intensidad', 'volumen_agua', 'volumen_total', 'hallazgos', 'usuario', 'fecha_creacion'];
    protected $appends = ['paciente'];

    public $timestamps = false;

    public function paciente()
    {
        return $this->hasMany(Paciente::class, 'id_orden', 'id_orden');
    }

    public function getPacienteAttribute()
    {   
        $patients = $this->paciente()->get();

        return $patients;
    }

    
}