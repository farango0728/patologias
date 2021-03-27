<?php

declare(strict_types = 1);

namespace App\Models;


class Estudio extends Model
{
    protected $table = "estudio";
    protected $fillable = ['id', 'modalidad', 'nombre', 'id_imagen', 'id_orden'];
    protected $primaryKey = 'id';

    
}