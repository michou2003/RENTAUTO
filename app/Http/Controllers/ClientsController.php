<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function store(Request $request = null)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenoms' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:clients'],
            'telephone' => ['required', 'numeric', 'max:8', 'min:8'],
        ]);

        $client = Client::create([
            'noms' => $request->nom,
            'prenoms' => $request->prenoms,
            'email' => $request->email,
            'telephone' => $request->telephone,
        ]);
    }

    
}
