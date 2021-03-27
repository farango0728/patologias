<?php

declare(strict_types = 1);

namespace App\Models;


class Order extends Model
{
    protected $table = "orden";
    protected $fillable = ['id_orden', 'id_eps', 'autorizacion', 'active'];

    protected $appends = ['paciente', 'estudio'];

    public function paciente()
    {
        return $this->hasMany(Paciente::class, 'id_orden', 'id_orden');
    }

    public function getPacienteAttribute()
    {   
        $patients = $this->paciente()->get();

        return $patients;
    }

     public function estudio()
    {
        return $this->hasMany(Estudio::class, 'id_orden', 'id_orden');
    }

    public function getEstudioAttribute()
    {   
        $estudio = $this->estudio()->get();

        return $estudio;
    } 

}