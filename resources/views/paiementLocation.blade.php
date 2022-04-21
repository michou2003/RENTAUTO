@extends('layout.app')

@section('title')
Rentauto | Facture de Location
@endsection
@section('content')
@include('partials.header')
<div class="container">
    <h2 class="text-center my-4">Paiement de la location N° {{ $location->id }}</h2>
    <div class="row d-flex justify-content-center">
        <div class="col-lg-8 col-12 ">
            <form action="" class="">
                <div class="mb-4">
                    <label class="py-3 p_label">Client :</label>
                    <input type="text" class="border-0 form-control" name="" value="{{ $location->client->noms }} {{ $location->client->prenoms }}" id="" readonly>
                </div>

                <div class="mb-4">
                    <label class="pb-3 p_label">Voiture :</label>
                    <input type="text" class="border-0 form-control" name="" value="{{ $location->car->marque }} {{ $location->car->model }} : {{ $location->car->tarifLocation }}" id="" readonly>
                </div>

                <div class="mb-4">
                    <label class="pb-3 p_label">Chauffeur :</label>
                    @php
                    if($location->driver_id != null)
                    {
                    @endphp
                    <input type="text" class="border-0 form-control" name="" value="{{ $location->driver->name }} {{ $location->driver->prenoms }} : {{ $location->driver->tarifChauf }}" id="" readonly>
                    @php
                    }
                    else
                    {
                    echo '<p>'.'Pas de chauffeur'.'</p>';
                    }
                    @endphp
                </div>

                <div class="mb-4">
                    <label class="pb-3 p_label">Avance : </label>
                    <input type="text" class="border-0 form-control" name="" value="{{ $location->avance }} XOF" id="" readonly>
                </div>

                <div class="mb-4">
                    <label class="pb-3 p_label">Net à payer : </label>
                    <input type="text" class="border-0 form-control" name="" value="{{ $location->net_a_payer }}" id="" readonly>
                </div>

                <a href=" {{ route('location.valider_paiement', ['id' => $location->id]) }} " class="mb-4 btn form-control" style="background-color: blueviolet; color:white">Valider le paiement</a>
            </form>
        </div>
    </div>

</div>
@endsection