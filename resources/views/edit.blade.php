@extends('layout.app')

@section('title')
Rentauto | Ajouter un nouvelle voiture
@endsection

@section('content')
@include('partials.header')
<div class="container  my-5">
    <h3>Modifier une voiture </h3>
    <div class="col-12 py-4 px-4 bg-white">
        <form action="{{ route('car.update', ['immatriculation'=>$car->immatriculation]) }}" method="POST" class="position-relative rounded">
            @csrf
            <input type="text" name="immatriculation" value="{{ $car->immatriculation }}" class="form-control my-3" placeholder="Immatriculation" required>
            <input type="text" name="marque" value="{{ $car->marque }}" class="form-control my-3" placeholder="Marque" required>
            <input type="text" name="model" value="{{ $car->model }}" class="form-control my-3" placeholder="Modèle" required>
            <input type="text" name="yearF" value="{{ $car->yearFabrication }}" class="form-control my-3" placeholder="Année de fabrication" required>
            <input type="number" name="tarifL" value="{{ $car->tarifLocation }}" id="tarif" class="form-control my-3" placeholder="Tarif de location" required>
            <button type="submit" class="btn position-absolute end-0" style="background-color : rgb(251, 185, 34);" id='submit'>Modifier</button>
        </form>
    </div>
</div>
@endsection