<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable =[
        'noms',
        'prenoms',
        'email',
        'telephone'
    ];

    public function location()
    {
        return $this->hasOne(Location::class);
    }
}
