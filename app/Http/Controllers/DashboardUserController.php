<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

class DashboardUserController extends Controller
{
    public function dashboard()
    {
        if (Auth::user()->permissions === "Admin") {
            $users = User::orderBy('name')->get();
            return view('user_management', compact('users'));
        } else {
            return view('rent_a_car');
        }
    }

    public function desactive($id)
    {
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

        return $this->dashboard();
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        if ($user->all()->count() === 0) {
            return route('index');
        }
        return $this->dashboard();
    }

    public function search(Request $user)
    {
        $name = $user->nom;
        $users = User::where('name', $name)->get();
        return view('user_management', compact('users'));
    }

    public function filterBy(Request $filter)
    {
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
