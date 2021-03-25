<?php

declare(strict_types = 1);

namespace App\Models;


class User extends Model
{
    protected $table = "users";
    protected $fillable = ['id', 'name', 'lastName', 'email', 'userName', 'password', 'phone', 'active'];
    protected $primaryKey = 'id';

    public function data()
    {
        return User::select(['id', 'name', 'lastName', 'email', 'userName', 'active', 'phone'])->get();
    }
    
}