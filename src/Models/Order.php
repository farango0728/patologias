<?php

declare(strict_types = 1);

namespace App\Models;


class Order extends Model
{
    protected $table = "orders";
    protected $fillable = ['idPatient', 'idOrder', 'idEps', 'numberAuthorization', 'idModality'];

    protected $appends = ['patients', 'eps', 'modality'];

    public function patients()
    {
        return $this->hasMany(Patients::class, 'id', 'idPatient');
    }

    public function getPatientsAttribute()
    {   
        $patients = $this->patients()->select('name', 'lastName')->get();

        return $patients[0]['name'].' '.$patients[0]['lastName'];
    }

    public function eps()
    {
        return $this->hasMany(Eps::class, 'id', 'idEps');
    }

    public function getEpsAttribute()
    {   
        $eps = $this->eps()->select('name')->get();

        return $eps[0]['name'];
    }

    public function modality()
    {
        return $this->hasMany(Modality::class, 'id', 'idEps');
    }

    public function getModalityAttribute()
    {   
        $modality = $this->modality()->select('name')->get();

        return $modality[0]['name'];
    }
}