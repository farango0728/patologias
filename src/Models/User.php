<?php

declare(strict_types = 1);

namespace App\Models;


class User extends Model
{
    protected $table = "users";
    protected $fillable = ['id', 'name', 'lastName', 'email', 'userName', 'password', 'active'];
    protected $primaryKey = 'id';
    
}