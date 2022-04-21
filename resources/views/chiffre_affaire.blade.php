@extends('layout.app')

@section('title')
Rentauto | Chiffre d'affaire
@endsection

@section('content')
@include('partials.header')
<div class="container">
    <div class="row my-5">
        <form action="{{ route('chiffre_affaire') }}" method="POST" class="search d-flex  col-12 ">
            @include('partials.periode')
        </form>
    </div>
    <div class="row">
        <h1>
            Chiffre d'affaire @isset($_POST['debut_periode'])
            de {{ $_POST['debut_periode'] }} à {{ $_POST['fin_periode'] }}
            @endisset
        </h1>
        <div class="col-10 py-1 px-3">
            <div class="d-flex alert alert-affaire">
                <h3 class="" style="color: blue;font-family:cursive;">
                    @foreach ($chiffre_affaire as $profit )
                        {{$profit->profit}}
                    @endforeach
                <span style="color:red; font-family:Georgia, 'Times New Roman', Times, serif">XOF</span> </h3>
            </div>
        </div>
    </div>

</div>


@endsection