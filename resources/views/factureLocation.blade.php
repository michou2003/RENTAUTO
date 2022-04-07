@extends('layout.app')

@section('title')
Rentauto | Facture de Location
@endsection
@section('content')
@include('partials.header')
<div class="container">
    <h2>Facture de la location</h2>
    <h3>Date de location : </h3>
    <p>Du {{ $location->date_heure_debut }} au {{ $location->date_heure_retour }}</p>
    <h3>Informations du client</h3>
    <h4>Nom du client :</h4>
    <p>{{ $location->client->noms }}</p>
    <h4>Prénoms du client :</h4>
    <p>{{ $location->client->prenoms }}</p>
    <h4>Email :</h4>
    <p>{{ $location->client->email }}</p>
    <h4>Numero de téléphone :</h4>
    <p>{{ $location->client->telephone }}</p>
    <h3>Informations du véhicule</h3>
    <h4>Marque :</h4>
    <p>{{ $location->car->marque }}</p>
    <h4>Modèle :</h4>
    <p>{{ $location->car->model }}</p>
    <h4>Tarif Horaire :</h4>
    <p>{{ $location->car->tarifLocation }}</p>
    <h3>Informations du chauffeur</h3>
    @php
    if($location->driver_id != null)
    {
    $chauf = "nullos";
    @endphp

    <h4>Nom(s) : </h4>
    <p>{{ $location->driver->noms }}</p>
    <h4>Prénom(s) : </h4>
    <p>{{ $location->driver->prenoms }}</p>
    <h4>Tarif Horaire :</h4>
    <p>{{ $location->driver->tarifChauf }}</p>
    @php
    }
    else
    {
    $chauf = $location->driver_id;
    echo '<p>'.'Pas de chauffeur'.'</p>';
    }
    @endphp
    <h4>Avance : </h4>

    <p>{{ $location->avance }}</p>
    <h4>Net à payer : </h4>
    <p>
        @php
        echo abs($net_a_payer - $location->avance);
        @endphp
    </p>
    <a href=" {{ route('location.valider_paiement', ['id' => $location->id]) }} " class="btn new">Valider le paiement</a>

</div>
@endsection