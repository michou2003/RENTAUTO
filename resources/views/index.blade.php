@extends('layout.app')

@section('title')
    Accueil | Rentauto
@endsection

@section('content')
    <div class="container-fluid contain ">
        <div class="row d-flex justify-content-md-center">
            <div class="col-12 col-md-6" >
                <h2 class="text-center welcome">Bienvenue sur RENTAUTO</h2>
                <p class="text-center para-descript"> Votre plateforme de gestion de location de voitures</p>
                <div class="d-flex justify-content-md-around justify-content-evenly">
                    <a href="{{ route('sign-in') }}" class="btn signin px-4"> Sign in</a>
                    <a href="#" class="btn signup px-4"> Sign up</a>
                </div>
            </div>
        </div>
    </div>
@endsection
