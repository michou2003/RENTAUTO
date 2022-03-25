<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriversController extends Controller
{
    public function drivers()
    {
        if (Auth::user()->permissions === "User") {
            $drivers = Driver::orderBy('name')->get();
            return view('drivers', compact('drivers'));
        }
    }

    public function search(Request $driver)
    {
        if (Auth::user()->permissions === "User") {
            $drivers = Driver::where('name', 'like', $driver->name . '%')->get();
            return view('drivers', compact('drivers'));
        }
    }

    public function delete($id)
    {
        if (Auth::user()->permissions === "User") {
            $driver = Driver::findOrFail($id);
            $driver->delete();
            return $this->drivers();
        }
    }

    public function filterBy(Request $driver)
    {
        if (Auth::user()->permissions === "User") {
            if ($driver->filter === "All") {
                return $this->drivers();
            } else {
                $drivers = Driver::where('status', $driver->filter)
                    ->orderBy('name')
                    ->get();
                return view('drivers', compact('drivers'));
            }
        }
    }

    public function new()
    {
        return view('new_driver');
    }

    public function store(Request $request)
    {
        if (Auth::user()->permissions === "User") {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'prenoms' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'max:255', 'unique:drivers'],
            ]);

            $driver = Driver::create([
                'name' => $request->name,
                'prenoms' => $request->prenoms,
                'email' => $request->email,
                'tarifChauf' => 5000,
                'status' => 'Disponible',
            ]);

            return $this->drivers();
        }
    }

    public function to_update($id)
    {
        $driver = Driver::findOrFail($id);
        return view('new_driver', compact('driver'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->permissions === "User") {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'prenoms' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'max:255',],
            ]);
            $driver = Driver::findOrFail($id);
            $driver->update([
                'name' => $request->name,
                'prenoms' => $request->prenoms,
                'email' => $request->email,
            ]);

            return $this->drivers();
        }
    }
}
