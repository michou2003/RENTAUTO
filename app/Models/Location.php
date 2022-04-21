<?php

namespace App\Models;

use App\Models\Car;
use App\Models\Client;
use App\Models\Driver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_heure_debut',
        'date_heure_retour',
        'car_immatriculation',
        'client_id',
        'driver_id',
        'status',
        'avance',
        'net_a_payer'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_immatriculation', 'immatriculation');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
