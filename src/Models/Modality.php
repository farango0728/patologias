<?php

declare(strict_types = 1);

namespace App\Models;


class Modality extends Model
{
    protected $table = "modality";
    protected $fillable = ['id', 'name', 'active'];
    protected $primaryKey = 'id';
    
}