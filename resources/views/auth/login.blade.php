@extends('layout.app')

@section('title')
Rentauto | Se connecter
@endsection

@section('content')
<div class="container mt-5 ">
    <div class="row m-5 p-5  d-flex justify-content-lg-start justify-content-center  position-relative">
        <div class="col-12 col-lg-6 " style="z-index: 1;">
            <div class="d-flex justify-content-between  ">
                <h3 class="nom_app">Rentauto</h3>
            </div>

            <h3 class="text-black my-3">Bienvenue cher utilisateur </h3>
            <x-auth-session-status class="" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="" :errors="$errors" />
            <form action="{{ route('login') }}" method="POST" class="mt-3">
                @csrf
                <div class="mb-4">
                    <input id="email" type="email" name="email" class="form-control py-lg-2" id="" placeholder="Email" required autofocus>
                </div>
                <div class="mb-4">
                    <input type="password" name="password" id="password" class="form-control py-lg-2" id="" placeholder="Password" required autocomplete="current-password">
                </div>
                <div class="my-4">
                    <input type="submit" value="Se connecter" class="py-2 form-control">
                </div>



            </form>
        </div>
        <div class="d-none d-lg-flex justify-content-center part-left col-lg-6 ">
            <img src="{{ asset('img/undraw_Login_re_4vu2.png') }}" alt="" width="500">
        </div>

    </div>
</div>
@endsection