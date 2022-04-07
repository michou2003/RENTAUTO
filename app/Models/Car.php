<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'immatriculation',
        'marque',
        'model',
        'yearFabrication',
        'tarifLocation',
    ];

    public function location()
    {
        return $this->hasOne(Location::class, 'car_immatriculation');
    }

}
