@extends('layout.app')

@section('title')
Rentauto | Voitures les plus louées
@endsection

@section('content')
@include('partials.header')
<div class="container">
    <div class="row my-5">
        <form action="{{ route('bests_rentalcars') }}" method="POST" class="search d-flex  col-12 ">
            @include('partials.periode')
        </form>
    </div>
    <div class="row">
        <h1>
            Voitures les plus louées @isset($_POST['debut_periode'])
            de {{ $_POST['debut_periode'] }} à {{ $_POST['fin_periode'] }}
            @endisset
        </h1>
        <div class="col-12 py-1 px-3  rounded table-responsive">
            <table class="table table-striped table-borderless rounded">
                <tbody>
                    <tr class="">
                        <th class="text-center">N° </th>
                        <th class="text-center">Immatriculation</th>
                        <th class="text-center">Voiture</th>
                        <th class="text-center">Nombre de mise en location</th>

                    </tr>
                    @php
                    $i=1;
                    @endphp
                    @forelse ($bests_rentalcars as $best_rentalcar)
                    <tr class="">
                        <td class="text-center" scope="row">{{ $i }}</td>
                        <td class="text-center" scope="row"> {{ $best_rentalcar->immatriculation }}</td>
                        <td class="text-center">{{ $best_rentalcar->marque }} {{ $best_rentalcar->model }} {{ $best_rentalcar->yearFabrication }}</td>
                        <td class="text-center"> {{ $best_rentalcar->nbre }} </td>
                    </tr>
                    @php
                    $i++;
                    @endphp
                    @empty

                    <h6 class="text-center my-2" style="color: blueviolet;">
                        Oups!!! Aucune location n'a été efféctué lors de cette période <br> Veuillez changer les paramètres de recherche
                    </h6>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>


@endsection