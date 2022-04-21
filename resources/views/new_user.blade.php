@extends('layout.app')

@section('title')
Rentauto | Sign in
@endsection

@section('content')
@include('partials.header')
<div class="container ">
    <div class="row d-flex justify-content-lg-start justify-content-center">
        <h1 class="text-black my-3 py-3">Ajouter un nouvel utilisateur </h1>
        <div class="col-10 col-lg-6 " style="z-index: 1;">


            <x-auth-validation-errors class="" :errors="$errors" />
            <form action="
            @php
            if(isset($user)){ @endphp
                {{ route('user.update', ['id'=>$user->id]) }}
                @php
                        }else
                        {
                        @endphp
                        {{ route('user.store') }}
                        @php
                    }
                    @endphp" method="POST">
                @csrf
                <div class="mb-4">
                    <input id="email" type="email" name="email" class="form-control py-lg-2" id="" value="@php if(isset($user)){ echo " $user->name";} @endphp" placeholder="Email" required autofocus>
                </div>
                <div class="mb-4">
                    <input type="password" name="password" id="password" class="form-control py-lg-2" id="" placeholder="Password" required autocomplete="current-password">
                </div>
                <div class="mb-4">
                    <input type="password" name="password_confirmation" id="password" class="form-control py-lg-2" id="password_confirmation" placeholder="Confirm Password" required autocomplete="current-password">
                </div>
                <div class="my-4">
                    <input type="submit" value="Ajouter" class="py-2 form-control">
                </div>



            </form>
        </div>
        <div class="d-none d-lg-flex  col-lg-6  ">

        </div>

    </div>
</div>

@endsection