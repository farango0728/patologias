<?php

declare(strict_types = 1);

namespace App\Models;


class Paciente extends Model
{
    protected $table = "paciente";
    protected $fillable = ['id_paciente', 'nombre', 'apellido', 'fecha_nacimiento', 'id_orden'];

    
}