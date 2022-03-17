@extends('layout.app')

@section('title')
Rentauto | Sign in
@endsection

@section('content')
<div class="container  my-5" style="z-index: 1;">
    <div class="row mx-2 d-flex justify-content-center justify-content-lg-end form-contain position-relative" >
        <div class="col-md-9 col-10 bg-dark py-md-4 px-md-5 form-contain-2" style="z-index: 1;">
            <div class="d-flex justify-content-between pt-2 ">
                <h5 class="nom_app ">Rentauto</h5>
                <h5><a class="text-decoration-none sign" href="">Sign up</a></h5>
            </div>
            <div class="row py-md-5 py-4">
                <div class="col-10 col-lg-6 mt-3">
                    <h5>Welcome</h5>
                    <p class="d-lg-none d-flex">Please enter your informations</p>
                    <p class="fill d-none d-lg-flex">Fill the form <br> to become <br> part of <br> team</p>
                </div>
                <div class="col-12 col-lg-6 mt-5">
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form action="{{ route('login') }}" method="POST">

                        @csrf
                        <div class="mb-4">
                            <input id="email" type="email" name="email" class="form-control py-lg-2" id="" placeholder="Email" required autofocus>
                        </div>
                        <div class="mb-4">
                            <input type="password" name="password" id="password" class="form-control py-lg-2" id="" placeholder="Password" required autocomplete="current-password">
                        </div>
                        <div class="mb-4 form-check">
                            <input id="remember_me" name="remember" type="checkbox" class="form-check-input">
                            <label class="form-check-label" for="remember">
                                <span style="color : rgb(251, 185, 34);">Remember</span> me</label>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn submit ">Log In</button>
                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot text-decoration-none">Forgot your password ?</a>
                            @endif
                        </div>
                        <br>
                        <hr class=" mt-5">
                    </form>
                </div>
            </div>
        </div>
        <div class="position-absolute d-none d-lg-flex top-0 back-img-2">
            <img class="back-img-form" src="{{ asset('img/samuele-errico-piccarini-MyjVReZ5GLQ-unsplash.jpg') }}" alt="" width="700" height="535">
        </div>
    </div>
</div>
@endsection