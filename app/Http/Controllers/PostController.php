<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function login ()
    {
        return view('sign_in');
    }

    public function user_managment()
    {
        return view('user_management');
    }
}
