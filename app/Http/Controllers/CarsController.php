<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarsController extends Controller
{
    public function cars()
    {
        if (Auth::user()->permissions === "User") {
            $cars = Car::orderBy('marque')->get();
            return view('cars', compact('cars'));
        }
    }


    public function delete($immatriculation)
    {
        if (Auth::user()->permissions === "User") {

            $car = Car::where('immatriculation', $immatriculation)->first();
            if ($car->status === 'Indisponible') {
                $issu = 'echec';
            } else {
                $car = Car::where('immatriculation', $immatriculation)->delete();
                $issu = 'success';
            }
        }
        $cars = Car::orderBy('marque')->get();
        return view('cars', compact('cars', 'issu'));
    }

    public function search(Request $car)
    {
        $car->car_name = htmlspecialchars($car->car_name);
        if (Auth::user()->permissions === "User") {
            $cars = Car::where('marque', 'like', $car->car_name . '%')->get();
            return view('cars', compact('cars'));
        }
    }

    public function filterBy(Request $filter)
    {
        if (Auth::user()->permissions === "User") {
            if ($filter->filter === "All") {
                return $this->cars();
            } else {
                $cars = Car::where('status', $filter->filter)
                    ->orderBy('marque')
                    ->get();
                return view('cars', compact('cars'));
            }
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->permissions === "User") {
            $request->validate([
                'immatriculation' => ['required', 'string', 'max:7', 'unique:cars'],
                'marque' => ['required', 'string', 'max:255'],
                'model' => ['required', 'string', 'max:255'],
                'yearF' => ['required', 'string', 'max:4'],
            ]);

            $car = Car::create([
                'immatriculation' => $request->immatriculation,
                'marque' => $request->marque,
                'model' => $request->model,
                'yearFabrication' => $request->yearF,
                'tarifLocation' => $request->tarifL,
            ]);
            return $this->cars();
        }
    }

    public function update(Request $request, $immatriculation)
    {
        if (Auth::user()->permissions === "User") {
            // $request->validate([
            //     'immatriculation' => ['required', 'string', 'max:7', 'unique:cars'],
            //     'marque' => ['required', 'string', 'max:255'],
            //     'model' => ['required', 'string', 'max:255'],
            //     'yearF' => ['required', 'string', 'max:4'],
            // ]);
            $request->immatriculation = htmlspecialchars($request->immatriculation);
            $request->marque = htmlspecialchars($request->marque);
            $request->model = htmlspecialchars($request->model);
            $request->yearF = htmlspecialchars($request->yearF);
            $request->tarifL = htmlspecialchars($request->tarifL);
            $car = Car::where('immatriculation', $immatriculation);
            //dd($car);
            $car->update([
                'immatriculation' => $request->immatriculation,
                'marque' => $request->marque,
                'model' => $request->model,
                'yearFabrication' => $request->yearF,
                'tarifLocation' => $request->tarifL,
            ]);
            return $this->cars();
        }
    }

    public function to_update($immatriculation)
    {
        $car = Car::where('immatriculation', $immatriculation)->first();
        //dd($car);
        return view('edit', compact('car'));
    }
}
