@extends('layout.app')

@section('title')
Rentauto | Sign in
@endsection

@section('content')
@include('partials.bg-vector')
<div class="container  my-5" style="z-index: 1;">
    <div class="row mx-2 d-flex justify-content-center justify-content-lg-end form-contain position-relative">
        <div class="col-md-9 col-10 bg-dark py-md-4 px-md-5 form-contain-2" style="z-index: 1;">
            <div class="d-flex justify-content-between pt-2 ">
                <h5 class="nom_app ">Rentauto</h5>
            </div>
            <div class="row py-5">
                <h3>Ajouter un nouvel utilisateur</h3>
                <div class="col-12  mt-3">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

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
                            <input id="name" type="text" name="name" value="@php if(isset($user)){ echo " $user->name";} @endphp"
                            class="form-control py-lg-2" placeholder="Fullname" required autofocus>
                        </div>

                        <div class="mb-4">
                            <input id="email" type="email" name="email" value="
                            @php
                                if(isset($user))
                                {
                                    echo " $user->email";
                            }
                            @endphp" class=" form-control py-lg-2" placeholder="Email" required>
                        </div>
                        <div class="mb-4">
                            <input type="password" name="password" id="password" class="form-control py-lg-2" id="password" placeholder="Password" required autocomplete="current-password">
                        </div>
                        <div class="mb-4">
                            <input type="password" name="password_confirmation" id="password" class="form-control py-lg-2" id="password_confirmation" placeholder="Confirm Password" required autocomplete="current-password">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn submit"> @php
                                if(isset($user))
                                {
                                echo 'Modifier';
                                }
                                else
                                {
                                echo 'Register';
                                }
                                @endphp</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="position-absolute d-none d-lg-flex top-0 back-img-2">
            <img class="back-img-form" src="{{ asset('img/samuele-errico-piccarini-MyjVReZ5GLQ-unsplash.jpg') }}" alt="" width="700" height="535">
        </div>
    </div>
</div>
@endsection