@extends('layout.app')

@section('title')
Rentauto | Rent a Car
@endsection

@section('content')
@include('partials.header')

<div class="container-fluid">
    <div class="row my-5 d-flex justify-content-evenly">
        <form action="{{ route('location.search') }}" method="POST" class="search d-flex col-4 ">

            @csrf
            <div>
                <input type="search" class="bg-transparent form-control" style=" border:none; border-bottom:2px solid blueviolet;" name="nom" value="@php if(isset($_POST['nom'])){echo $_POST['nom'];}@endphp" required id="" placeholder="Rechercher par locataire">
            </div>
            <button type="submit" class="border-0 bg-transparent" style="width:40px; height:36px;">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30 30" width="25px" height="30px">
                    <g id="surface8234173">
                        <path style=" stroke:none;fill-rule:nonzero;fill:blueviolet;fill-opacity:1;" d="M 13 3 C 7.488281 3 3 7.488281 3 13 C 3 18.511719 7.488281 23 13 23 C 15.398438 23 17.597656 22.148438 19.324219 20.734375 L 25.292969 26.707031 C 25.542969 26.96875 25.917969 27.074219 26.265625 26.980469 C 26.617188 26.890625 26.890625 26.617188 26.980469 26.265625 C 27.074219 25.917969 26.96875 25.542969 26.707031 25.292969 L 20.734375 19.320312 C 22.148438 17.597656 23 15.398438 23 13 C 23 7.488281 18.511719 3 13 3 Z M 13 5 C 17.429688 5 21 8.570312 21 13 C 21 17.429688 17.429688 21 13 21 C 8.570312 21 5 17.429688 5 13 C 5 8.570312 8.570312 5 13 5 Z M 13 5 " />
                    </g>
                </svg>
            </button>
        </form>
        <form action="{{ route('location.filter') }}" method="POST" class="col-4 d-flex ">
            @csrf
            <label for="filter" class=" form-label me-3 mt-1 text-black">Filter par</label>
            <div>
                <select class="form-select bg-transparent" style=" border:none; border-bottom:2px solid blueviolet;" name="filter" id="">
                    <option value="@php if(isset($_POST['filter'])){echo $_POST['filter'];}@endphp">@php if(isset($_POST['filter'])){echo $_POST['filter'];}else{echo 'Filtre...';}@endphp</option>
                    <option value="All">All</option>
                    <option value="En cours">En cours</option>
                    <option value="Ferme">Payé</option>
                </select>
            </div>
            <button type="submit" class="border-0 bg-transparent" style="width:40px; height:36px;">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30 30" width="25px" height="30px">
                    <g id="surface8234173">
                        <path style=" stroke:none;fill-rule:nonzero;fill:blueviolet;fill-opacity:1;" d="M 13 3 C 7.488281 3 3 7.488281 3 13 C 3 18.511719 7.488281 23 13 23 C 15.398438 23 17.597656 22.148438 19.324219 20.734375 L 25.292969 26.707031 C 25.542969 26.96875 25.917969 27.074219 26.265625 26.980469 C 26.617188 26.890625 26.890625 26.617188 26.980469 26.265625 C 27.074219 25.917969 26.96875 25.542969 26.707031 25.292969 L 20.734375 19.320312 C 22.148438 17.597656 23 15.398438 23 13 C 23 7.488281 18.511719 3 13 3 Z M 13 5 C 17.429688 5 21 8.570312 21 13 C 21 17.429688 17.429688 21 13 21 C 8.570312 21 5 17.429688 5 13 C 5 8.570312 8.570312 5 13 5 Z M 13 5 " />
                    </g>
                </svg>
            </button>
        </form>
        <a href="{{ route('location.new') }}" class="new btn col-2"> +Location</a>
    </div>
    <div class="row ">
        <h2 class="my-2 text-black">Toutes les locations</h2>
        <div class="col-12 py-1 px-3 rounded bg-transparent table-responsive">
            @isset($bool)
            @if ($bool)
            <div class="alert alert-success">
                La location a été ajoutée avec succès
            </div>
            @endif
            @endisset
            <table class="table table-hover table-striped table-borderless rounded">
                <tbody>
                    <tr class="text-white">
                        <th>Client</th>
                        <th>Immatriculation</th>
                        <th>Voiture</th>
                        <th>Date et Heure début</th>
                        <th>Date et Heure de retour</th>
                        <th>Chauffeur</th>
                        <th>Status</th>
                    </tr>
                    @forelse ($locations as $location)
                    <tr class="">
                        <td scope="row"> {{ $location->client->noms }} {{ $location->client->prenoms }}</td>
                        <td>{{ $location->car->immatriculation }}</td>
                        <td>{{ $location->car->marque }}-{{ $location->car->model }}</td>
                        <td>{{ $location->date_heure_debut }} </td>
                        <td>
                            @if ($location->date_heure_retour == null || $location->status == 1)
                            <a href="{{ route('location.to_update', ['id' => $location->id]) }}" class="btn btn-primary text-decoration-none">Retour de Voiture</a>
                            @else
                            {{ $location->date_heure_retour }}
                            @endif
                        </td>

                        <td>
                            @if ($location->driver_id == null)
                            Néant
                            @else
                            {{ $location->driver->name }} {{ $location->driver->prenoms }}
                            @endif
                        </td>

                        <td>
                            @if ($location->status === 1)
                            <span href="" class="p-1 rounded btn-green">En cours</span>
                            @else
                            <span href="" class="p-1 rounded btn-red"> Payé </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <div class="alert alert-danger">
                        Nothing Here
                    </div>

                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection