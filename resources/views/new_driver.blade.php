@extends('layout.app')

@section('title')
Rentauto | Sign in
@endsection

@section('content')
@include('partials.header')
<div class="container mt-5 " style="z-index: 1;">
    <h3 class="text-black text-left ">@php
        if(isset($driver))
        {
        echo "Modifier un chauffeur";
        }else
        {
        echo 'Ajouter un chauffeur';
        }@endphp
    </h3>
    <div class="row p-5  d-flex justify-content-lg-start justify-content-center  position-relative">

        <div class="col-10 col-lg-6 ">

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form action="@php if(isset($driver)){ @endphp {{ route('driver.update', ['id'=>$driver->id]) }} @php }else{ @endphp {{ route('driver.store') }} @php } @endphp" method="POST">
                @csrf
                <div class="mb-4">
                    <input id="name" type="text" name="name" value="@php if(isset($driver)){ echo " $driver->name";}@endphp"
                    class="form-control py-lg-2" placeholder="Nom" required autofocus>
                </div>

                <div class="mb-4">
                    <input id="name" type="text" name="prenoms" value="@php if(isset($driver)){ echo " $driver->prenoms";} @endphp"
                    class="form-control py-lg-2" placeholder="Prenoms" required autofocus>
                </div>

                <div class="mb-4">
                    <input id="email" type="email" name="email" value="
                            @php
                                if(isset($driver))
                                {
                                    echo " $driver->email";
                    }
                    @endphp" class=" form-control py-lg-2" placeholder="Email" required>
                </div>
                <div class="d-flex justify-content-between">
                    <!-- <a href="{{ route('drivers') }}" class="form-control btn submit">< Retour</a> -->
                    <button type="submit" class="form-control btn submit"> @php
                        if(isset($driver))
                        {
                        echo 'Modifier';
                        }
                        else
                        {
                        echo 'Enregistrer';
                        }
                        @endphp
                    </button>
                </div>
            </form>
        </div>
        <div class="col-6 "></div>
    </div>
</div>
@endsection