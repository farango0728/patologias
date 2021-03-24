<?php

declare(strict_types = 1);

namespace App\Models;


class Eps extends Model
{
    protected $table = "eps";
    protected $fillable = ['id', 'name', 'active'];
    protected $primaryKey = 'id';
    
}