<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Client;
use App\Models\Driver;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\Auth;

class LocationsController extends Controller
{
    public function locations()
    {
        $locations = Location::all();
        return view('rent_a_car', compact('locations'));
    }

    public function search(Request $request)
    {
        if (Auth::user()->permissions === "User") {
            $client = Client::where('noms', 'like', $request->nom . '%')->get();
            dd($client);
            $locations = Location::where('client_id', $client->id);
            dd($locations);
            return view('locations', compact('locations'));
        }
    }

    public function filterBy(Request $request)
    {
        if (Auth::user()->permissions === "User") {
            if ($request->filter === "All") {
                return $this->locations();
            } else if ($request->filter === "En cours") {
                $locations = Location::where('status', 1)
                    ->orderBy('date_heure_debut')
                    ->get();
            } else {
                $locations = Location::where('status', 0)
                    ->orderBy('date_heure_debut')
                    ->get();
            }
            return view('rent_a_car', compact('locations'));
        }
    }
    
    public function new()
    {
        $cars = Car::where('status', 'Disponible')->get();
        $drivers = Driver::where('status', 'Disponible')->get();
        return view('new_location', compact('cars', 'drivers'));
    }
    
    public function store(Request $request)
    {
        $cars = Car::where('immatriculation', $request->car_immatriculation)->where('status', 'Indisponible')->get();
        //dd($cars->count());
        if ($cars->count() === 0) {
            
            
            $request->validate([
                'nom' => ['required', 'string', 'max:255'],
                'prenoms' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'max:255'],
                'telephone' => ['required', 'numeric'],
            ]);

            if ($request->boolchauf == 'oui') {
                $driver = $request->driver;
                $chauffeur = Driver::find($request->driver);
                $chauffeur->update([
                    'status' => 'Indisponible'
                ]);
            } else {
                $driver = null;
            }
            
            $request->validate([
                'date_heure_debut' => ['required'],
            ]);
            $client = Client::where('email', $request->email)->get();
            if ($client->count() == 0) {
                $client = Client::create([
                    'noms' => $request->nom,
                    'prenoms' => $request->prenoms,
                    'email' => $request->email,
                    'telephone' => $request->telephone,
                ]);
            } else {
                $client = Client::where('email', $request->email);
                $client->update([
                    'telephone' => $request->telephone
                ]);
            }
            if ($request->boolavance == "oui") {
                $request->validate([
                    'avance' => ['required', 'numeric']
                ]);
                $avance = $request->avance;
            } else {
                $avance = null;
            }
            // 
            $date_heure_debut = new DateTime($request->date_heure_debut);
            $date_heure_debut = $date_heure_debut->format('Y-m-d H');
            // dd($date_heure_debut);
            $client = Client::where('email', $request->email)->first();
            $location = Location::create([
                'client_id' => $client->id,
                'driver_id' => $driver,
                'car_immatriculation' => $request->car_immatriculation,
                'status' => 1,
                'avance' => $avance,
                'date_heure_debut' => $date_heure_debut,
            ]);
            if ($location) {
                $bool = true;
            } else {
                $bool = false;
            }
            $car = Car::where('immatriculation', $request->car_immatriculation);
            $car->update([
                'status' => 'Indisponible',
            ]);
            
            $locations = Location::all();
            return view('rent_a_car', compact('locations', 'bool'));
        } else {
            return redirect()->route('locations')->with('echec', 'Cette voiture est deja en cours de location');
        }
    }
    
    public function to_update($id)
    {
        $location = Location::findOrFail($id);
        return view('new_location', compact('location'));
    }

    public function update(Request $request, $id)
    {
        $location = Location::find($id);
        $location->update([
            'date_heure_retour' => $request->date_heure_retour
        ]);

        $i = 1;
        if (isset($request->driver)) {
            $montantChauffeur = $location->driver->tarifChauf;
        } else {
            $montantChauffeur = 0;
        }
        $montantCar = $location->car->tarifLocation;
        $montant = 0;
        $date_debut = new DateTime($request->date_heure_debut);
        $date_retour = new DateTime($request->date_heure_retour);
        while ($date_debut < $date_retour) {
            $date_debut->add(new DateInterval('PT' . $i . 'H'));
            if ((int)$date_debut->format('H') <= 18) {
                $montant += ($montantChauffeur + $montantCar);
            } else {
                $montant += (2 * $montantChauffeur + $montantCar);
            }
        }

        if ((int)$date_retour->format('i') != 0) {
            if ((int)$date_retour->format('H') < 18) {
                $montant += ($montantChauffeur + $montantCar);
            } else {
                $montant += (2 * $montantChauffeur + $montantCar);
            }
        }

        $net_a_payer = $montant - $location->avance;

        $location->update([
            'net_a_payer' => $net_a_payer
        ]);

        return view('paiementLocation', compact('location'));
    }

    public function validerPaiement($id)
    {
        $location = Location::findOrFail($id);
        $location->update([
            'status' => 0
        ]);
        $car = Car::where('immatriculation', $location->car_immatriculation);
        // dd($car);
        $car->update([
            'status' => 'Disponible'
        ]);

        if ($location->driver_id !== null) {
            $driver = Driver::find($location->driver_id);
            $driver->update([
                'status' => 'Disponible'
            ]);
        }

        return $this->locations();
    }
}
