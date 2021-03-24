<?php

declare(strict_types = 1);

namespace App\Models;


class Patients extends Model
{
    protected $table = "patients";
    protected $fillable = ['id', 'name', 'lastName', 'email', 'phone', 'dateBirth', 'active'];
    protected $primaryKey = 'id';
    
}