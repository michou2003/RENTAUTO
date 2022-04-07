<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\LocationsController;

class DashboardUserController extends Controller
{
    public function dashboard()
    {
        if (Auth::user()->permissions === "Admin") {
            $users = User::orderBy('name')->where('permissions', 'User')->get();
            return view('user_management', compact('users'));
        } else {
            $locations = Location::all();
            return view('rent_a_car', compact('locations'));
        }
    }

    public function desactive($id)
    {
        if (Auth::user()->permissions === "Admin") {
            $user = User::findOrFail($id);
            if ($user->status === "Enabled") {
                $user->update([
                    'status' => 'Disabled'
                ]);
            } else {
                $user->update([
                    'status' => 'Enabled'
                ]);
            }
        }

        return $this->dashboard();
    }

    public function delete($id)
    {
        if (Auth::user()->permissions === "Admin") {
            $user = User::findOrFail($id);
            $user->delete();
            if ($user->all()->count() === 0) {
                return route('index');
            }
            return $this->dashboard();
        }
    }

    public function search(Request $user)
    {
        if (Auth::user()->permissions === "Admin") {
            $name = $user->nom;
            $users = User::where('name', 'like', $name . '%')->get();
            return view('user_management', compact('users'));
        }
    }

    public function filterBy(Request $filter)
    {
        if (Auth::user()->permissions === "Admin") {
            if ($filter->filter === "All") {
                return $this->dashboard();
            } else {
                $users = User::where('status', $filter->filter)
                    ->orderBy('name')
                    ->get();
                return view('user_management', compact('users'));
            }
        }
    }

    public function new()
    {
        return view('new_user');
    }

    public function store(Request $request)
    {
        if (Auth::user()->permissions === "Admin") {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'permissions' => "User",
                'status' => "Enabled",
                'password' => Hash::make($request->password),
            ]);

            event(new Registered($user));
            return $this->dashboard();
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->permissions === "Admin") {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            $user = User::findOrFail($id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return $this->dashboard();
        }
    }

    public function to_update($id)
    {
        $user = User::findOrFail($id);
        return view('new_user', compact('user'));
    }
}
