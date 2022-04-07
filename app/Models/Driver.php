<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'prenoms',
        'email',
        'tarifChauf',
        'status'
    ];

    public function location()
    {
        return $this->hasOne(Location::class);
    }
}
