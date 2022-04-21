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
    <h1 class="text-center">@php
        if(isset($location))
        {
        echo 'Retour de location';
        }else
        {
        echo "Ajouter une nouvelle location";
        }@endphp</h1>
    <div class="row justify-content-center">
        <div class="col-8 py-4 px-4 ">
            @if ($errors->any())
            <ul class="">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
            <form action="@php if(isset($location)){ @endphp {{ route('location.update', ['id'=>$location->id]) }} @php }else{ @endphp {{ route('location.store') }} @php } @endphp" method="POST" class="position-relative d-flex flex-column">
                @php
                if(isset($location))
                {
                @endphp
                <div class="px-5 py-2">
                    <h5 class="py-2">Date de retour</h5>
                    <input type="datetime-local" name="date_heure_retour" style="color:black;" class="form-control mb-4" value="{{ old('date_heure_retour') }}" id="date_retour" autofocus>
                </div>
                @php
                }
                @endphp

                <div class="px-5 py-3 ">
                    <h5 class="py-2">Choisir une voiture </h5>
                    <input type="text" name="car_immatriculation" style="color:black;" class="form-control data " list="cars" id="car_name" @php if(isset($location)){ @endphp value="{{ $location->car_immatriculation }}" Disabled @php }else { @endphp value="{{ old('car_immatriculation') }}" @php }@endphp placeholder="Cliquez pour choisir" @isset($cars) @if ($cars->count() === 0 ) Disabled
                    @endif @endisset required autofocus >
                    @isset($cars)
                    <datalist id='cars'>
                        @forelse ($cars as $car)
                        <option value="{{ $car->immatriculation }}">{{$car->marque}} - {{$car->model}} : {{ $car->tarifLocation }} XOF </option>
                        @endforeach
                    </datalist>
                    @if ($cars->count() === 0)
                    <div class="alert alert-danger">Aucune voiture disponible pour l'instant</div>
                    @endif
                    @endisset
                </div>

                @csrf
                <div class=" px-5 pb-2 ">
                    <h5 class="py-2">Enregistrer un client</h5>
                    <input type="text" name="nom" style="color:black;" id="" class="form-control mb-4" @php if(isset($location)){ @endphp value="{{ $location->client->noms }}" Disabled @php }else { @endphp value="{{ old('nom') }}" @php }@endphp placeholder="Nom du client">
                    <input type="text" name="prenoms" style="color:black;" id="" class="form-control mb-4" @php if(isset($location)){ @endphp value="{{ $location->client->prenoms }}" Disabled @php }else { @endphp value="{{ old('prenoms') }}" @php }@endphp placeholder="Prenoms du client">
                    <input type="email" name="email" style="color:black;" class="form-control mb-4" @php if(isset($location)){ @endphp value="{{ $location->client->email }}" Disabled @php }else { @endphp value="{{ old('email') }}" @php }@endphp placeholder="Email du client">
                    <input type="tel" name="telephone" style="color:black;" id="" class="form-control mb-4" @php if(isset($location)){ @endphp value="{{ $location->client->telephone }}" Disabled @php }else { @endphp value="{{ old('telephone') }}" @php }@endphp placeholder="N° de telephone">
                </div>

                <div class="px-5 pb-2 ">
                    <h5 class="py-2">Choisir un chauffeur</h5>
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
                    <input list="drivers" name="driver" id="radioBox" class="form-control mt-3 data" @php if(isset($location)){ @endphp value="{{ $location->driver_id }}" Disabled @php }else { @endphp value="{{ old('driver') }}" @php }@endphp @isset($drivers) @if ($drivers->count() === 0 ) Disabled
                    @endif @endisset placeholder="Cliquez pour choisir un chauffeur">
                    @isset($drivers)
                    <datalist id="drivers">


                        @foreach ($drivers as $driver)
                        <option value="{{ $driver->id }}">{{ $driver->name }} {{ $driver->prenoms }}</option>
                        @endforeach
                    </datalist>
                    @if ($drivers->count() === 0)
                    <div class="alert alert-danger" id="driver_status">Aucun chauffeur disponible pour l'instant</div>
                    @endif
                    @endisset
                </div>



                <div class="px-5 pb-2 ">
                    <h5 class="py-2">Date de début</h5>
                    <input type="datetime-local" name="date_heure_debut" class="form-control mb-4" @php if(isset($location)){ @endphp value="{{ $location->date_heure_debut }}" Disabled @php }else { @endphp value="{{ old('date_debut') }}" @php }@endphp id="date_debut">
                </div>




                <div class="px-5 pb-2 ">
                    <h5 class="py-2">Payer une avance</h5>
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
                <hr class="">
                <div class="px-5 pb-3 ">
                    <button type="submit" class="form-control border-0" style="background-color: blueviolet; color:white" id='submit'>@php
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