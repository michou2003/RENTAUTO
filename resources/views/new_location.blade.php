@extends('layout.app')

@section('title')
@if (isset($location))
Rentauto | Retour de location
@else
Rentauto | Ajouter une nouvelle location
@endif

@endsection

@section('content')
@include('partials.header')
<div class="container  mt-5">
    <h3 class="text-center">@php
        if(isset($location))
        {
        echo 'Retour de location';
        }else
        {
        echo "Ajouter une nouvelle location";
        }@endphp</h3>
    <div class="row justify-content-center">
        <div class="col-8 py-4 px-4 ">
            @if ($errors->any())
            <ul class="">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
            <form action="@php if(isset($location)){ @endphp {{ route('location.update', ['id'=>$location->id]) }} @php }else{ @endphp {{ route('location.store') }} @php } @endphp" method="POST" class="position-relative rounded">
                @php
                if(isset($location))
                {
                @endphp
                <label for="date_retour"> Date et Heure de retour </label>
                <input type="datetime-local" name="date_heure_retour" style="color:black;" class="form-control mb-4" value="{{ old('date_heure_retour') }}" id="date_retour">
                @php
                }
                @endphp
                <h5>Choisir une voiture </h5>
                <div class="bg-white p-5">
                    <input name="car_immatriculation" style="color:black;" class="form-control data" list="cars" id="car_name" @php if(isset($location)){ @endphp value="{{ $location->car_immatriculation }}" Disabled @php }else { @endphp value="{{ old('car_immatriculation') }}" @php }@endphp placeholder="Cliquez pour choisir" @isset($cars) @if ($cars->count() === 0 ) Disabled
                    @endif @endisset required >
                    @isset($cars)
                    <datalist id='cars'>
                        @forelse ($cars as $car)
                        <option value="{{ $car->immatriculation }}">{{$car->marque}} - {{$car->model}} : {{ $car->tarifLocation }} XOF
                            @endforeach
                    </datalist>
                    @if ($cars->count() === 0)
                    <div class="alert alert-danger">Aucune voiture disponible pour l'instant</div>
                    @endif
                    @endisset

                </div>
                <h5>Enregistrer un client</h5>
                @csrf
                <div class="bg-white p-5">
                    <input type="text" name="nom" style="color:black;" id="" class="form-control mb-4" @php if(isset($location)){ @endphp value="{{ $location->client->noms }}" Disabled @php }else { @endphp value="{{ old('nom') }}" @php }@endphp placeholder="Nom du client" autofocus>
                    <input type="text" name="prenoms" style="color:black;" id="" class="form-control mb-4" @php if(isset($location)){ @endphp value="{{ $location->client->prenoms }}" Disabled @php }else { @endphp value="{{ old('prenoms') }}" @php }@endphp placeholder="Prenoms du client">
                    <input type="email" name="email" style="color:black;" class="form-control mb-4" @php if(isset($location)){ @endphp value="{{ $location->client->email }}" Disabled @php }else { @endphp value="{{ old('email') }}" @php }@endphp placeholder="Email du client">
                    <input type="tel" name="telephone" style="color:black;" id="" class="form-control mb-4" @php if(isset($location)){ @endphp value="{{ $location->client->telephone }}" Disabled @php }else { @endphp value="{{ old('telephone') }}" @php }@endphp placeholder="N° de telephone">
                </div>

                <h5>Choisir un chauffeur</h5>
                <div class="bg-white d-flex flex-column p-3">
                    <div class=" d-flex justify-content-evenly">
                        <div>
                            <input type="radio" name="boolchauf" @php if(isset($location) && ($location->driver_id !== null) ){ @endphp checked @php }@endphp id="boolchauftrue" value="oui">
                            <label for="chauffeur">Oui</label>
                        </div>
                        <div>
                            <input type="radio" name="boolchauf" @php if(isset($location) && ($location->driver_id == null) ){ @endphp checked @php }@endphp id="boolchauffalse" value="non">
                            <label for="chauffeur">Non</label>
                        </div>
                    </div>
                    <input list="drivers" name="driver" id="radioBox" class="form-control mt-3 data" @php if(isset($location)){ @endphp value="{{ $location->driver_id }}" Disabled @php }else { @endphp value="{{ old('driver') }}" @php }@endphp placeholder="Cliquez pour choisir un chauffeur">
                    @isset($drivers)
                    <datalist id="drivers">


                        @foreach ($drivers as $driver)
                        <option value="{{ $driver->id }}">{{ $driver->name }} {{ $driver->prenoms }}</option>
                        @endforeach
                    </datalist>
                    @endisset
                </div>


                <h5>Procéder aux derniers détails</h5>
                <div class="bg-white p-5">
                    <label for="date_debut">Date de début</label>
                    <input type="datetime-local" name="date_heure_debut" class="form-control mb-4" @php if(isset($location)){ @endphp value="{{ $location->date_heure_debut }}" Disabled @php }else { @endphp value="{{ old('date_debut') }}" @php }@endphp id="date_debut">
                </div>



                <h5>Payer une avance</h5>
                <div class="bg-white d-flex flex-column p-3">
                    <div class=" d-flex justify-content-evenly">
                        <div>
                            <input type="radio" name="boolavance" @php if(isset($location) && ($location->avance !== null) ){ @endphp checked @php }@endphp id="boolavancetrue" value="oui">
                            <label for="avance">Oui</label>
                        </div>
                        <div>
                            <input type="radio" name="boolavance" @php if(isset($location) && ($location->avance == null) ){ @endphp checked @php }@endphp id="boolavancefalse" value="non">
                            <label for="avance">Non</label>
                        </div>
                    </div>
                    <input type="number" name="avance" id="avanceBox" class="form-control mt-3" @php if(isset($location)){ @endphp value="{{ $location->avance }}" Disabled @php }else { @endphp value="{{ old('avance') }}" @php }@endphp placeholder="Entrer une avance">
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn px-5 py-2 mb-2" style="background-color: rgb(251, 185, 34); color:white" id='submit'>@php
                        if(isset($location))
                        {
                        echo 'Procéder au paiement';
                        }else
                        {
                        echo "Ajouter la location";
                        }@endphp</button>
                </div>

            </form>

        </div>
    </div>
    <script src="{{ asset('js/rentauto.js') }}"></script>
    @endsection