<?php

declare(strict_types = 1);

namespace App\Models;


class Preguntas extends Model
{
    protected $table = "pregunta";
    protected $fillable = ['id_pregunta', 'descripcion', 'tipo'];
}