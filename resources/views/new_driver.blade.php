@extends('layout.app')

@section('title')
Rentauto | Sign in
@endsection

@section('content')
<div class="container  my-5" style="z-index: 1;">
    <div class="row mx-2 d-flex justify-content-center form-contain position-relative">
        <div class="col-md-9 col-10 bg-dark py-md-4 px-md-5 form-contain-2" style="z-index: 1;">
            <div class="d-flex justify-content-between pt-2 ">
                <h5 class="nom_app ">Rentauto</h5>
            </div>
            <div class="row py-5">
                <h3>Ajouter un chauffeur</h3>
                <div class="col-12  mt-3">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form action="@php if(isset($driver)){ @endphp {{ route('driver.update', ['id'=>$driver->id]) }} @php }else{ @endphp {{ route('driver.store') }} @php } @endphp" method="POST">
                        @csrf
                        <div class="mb-4">
                            <input id="name" type="text" name="name" value="@php if(isset($driver)){ echo "$driver->name";}@endphp"
                            class="form-control py-lg-2" placeholder="Nom" required autofocus>
                        </div>

                        <div class="mb-4">
                            <input id="name" type="text" name="prenoms" value="@php if(isset($driver)){ echo "$driver->prenoms";} @endphp"
                            class="form-control py-lg-2" placeholder="Prenoms" required autofocus>
                        </div>

                        <div class="mb-4">
                            <input id="email" type="email" name="email" value="
                            @php
                                if(isset($driver))
                                {
                                    echo "$driver->email";
                            }
                            @endphp" class=" form-control py-lg-2" placeholder="Email" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn submit"> @php
                                if(isset($driver))
                                {
                                echo 'Modifier';
                                }
                                else
                                {
                                echo 'Enregistrer';
                                }
                                @endphp</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection