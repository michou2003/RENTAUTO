@extends('layout.app')

@section('title')
Rentauto | Ajouter un nouvelle voiture
@endsection

@section('content')
@include('partials.header')
<div class="container  my-5" style="z-index: 1;">
    <div class="row mx-2 d-flex">
        <h3>Modifier une voiture</h3>
        <div class="col-lg-8 col-10  px-md-5 form-contain-2" style="z-index: 1;">
                <!-- Validation Errors -->
                <x-auth-validation-errors class="" :errors="$errors" />
                <form action="{{ route('car.update', ['immatriculation'=>$car->immatriculation]) }}" method="POST">

                    @csrf
                    <div class="mb-4">
                        <input type="text" name="immatriculation" value="{{ $car->immatriculation }}" class="form-control py-lg-2" placeholder="Immatriculation" required autofocus>
                    </div>

                    <div class="mb-4">
                        <input type="text" name="marque" value="{{ $car->marque }}" class="form-control py-lg-2" placeholder="Marque" required>
                    </div>

                    <div class="mb-4">
                        <input type="text" name="model" value="{{ $car->model }}" class="form-control py-lg-2" placeholder="Modèle" required>
                    </div>

                    <div class="mb-4">
                        <input type="text" name="yearF" value="{{ $car->yearFabrication }}" class="form-control py-lg-2" placeholder="Année de fabrication" required>
                    </div>

                    <div class="mb-4">
                        <input type="number" name="tarifL" value="{{ $car->tarifLocation }}" id="tarif" class="form-control py-lg-2" placeholder="Tarif de location" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn submit"> Modifier </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection