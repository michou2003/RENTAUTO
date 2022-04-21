@extends('layout.app')

@section('title')
Rentauto | 10 meilleurs clients
@endsection

@section('content')
@include('partials.header')
<div class="container">
    <div class="row my-5">
        <form action="{{ route('best_customers') }}" method="POST" class="search d-flex  col-12 ">
            @include('partials.periode')
        </form>
    </div>
    @isset($error)
    {{ $error }}
    @endisset
    <div class="row">
        <h1>
            10 meilleurs clients @isset($_POST['debut_periode'])
            de {{ $_POST['debut_periode'] }} à {{ $_POST['fin_periode'] }}
            @endisset
        </h1>
        <div class="col-12 py-1 px-3  rounded table-responsive">
            <table class="table table-striped table-borderless rounded">
                <tbody>
                    <tr class="">
                        <th class="text-center">N° </th>
                        <th class="text-center">Client</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Nombre de locations effectuées</th>

                    </tr>
                    @php
                    $i=1;
                    @endphp
                    @forelse ($bests_customers as $best_customer)
                    <tr class="">
                        <td class="text-center" scope="row">{{ $i }}</td>
                        <td class="text-center" scope="row"> {{ $best_customer->noms }} {{ $best_customer->prenoms }} </td>
                        <td class="text-center">{{ $best_customer->email }}</td>
                        <td class="text-center"> {{ $best_customer->nbre }} </td>
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