@extends('layout.app')

@section('title')
    Rentauto | Sign in
@endsection

@section('content')
    <div class="container my-5">
        <div class="row mx-2 d-flex justify-content-end form-contain">
            <div class="col-md-9 bg-dark py-md-4 px-md-5 form-contain-2">
                <div class="d-flex justify-content-between pt-2 ">
                    <h5 class="nom_app ">Rentauto</h5>
                    <h5><a class="text-decoration-none sign" href="">Sign up</a></h5>
                </div>
                <div class="row py-md-5 py-4">
                    <div class="col-12 col-lg-6 mt-3">
                        <h5>Welcome</h5>
                        <p class="d-lg-none d-flex">Please enter your informations</p>
                        <p class="fill d-none d-lg-flex">Fill the form <br> to become <br> part of <br> team</p>
                    </div>
                    <div class="col-12 col-lg-6 mt-5">
                        <form action="">
                            <div class="mb-4">
                                <input type="email" class="form-control py-lg-2" id="" placeholder="Email">
                            </div>
                            <div class="mb-4">
                                <input type="password" class="form-control py-lg-2" id="" placeholder="Password">
                            </div>
                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="remember">
                                     <span style="color : rgb(251, 185, 34);">Remember</span>  me</label>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('user_gest') }}" class="btn submit">Go -></a>
                                <a href="" class="forgot text-decoration-none" >Forgot your password ?</a>
                            </div>
                            <br>
                            <hr class=" mt-5">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection