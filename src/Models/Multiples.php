<?php

declare(strict_types = 1);

namespace App\Models;


class Multiples extends Model
{
    protected $table = "pregunta_opciones_mult";
    protected $fillable = ['id_pregunta', 'id_opcion', 'descripcion'];
}