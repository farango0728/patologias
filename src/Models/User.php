<?php

declare(strict_types = 1);

namespace App\Models;


class User extends Model
{
    protected $table = "usuarios";
    protected $fillable = ['id', 'nombre', 'apellido', 'email', 'usuario', 'password', 'telefono', 'active'];
    protected $primaryKey = 'id';

    public function data()
    {
        return User::select(['id', 'nombre', 'apellido', 'email', 'usuario', 'active', 'telefono'])->get();
    }
    
}