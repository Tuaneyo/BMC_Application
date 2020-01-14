@extends('layouts.auth.main')

@section('content')
    <div class="content  home-shadow"
         style="background: url({{asset('img/login/building-city2.jpg')}}) center no-repeat ;">
        <div class="overview"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-2 col-sm-12"></div>
                <div class="col-lg-6 col-md-8 col-sm-12 mt-4">
                    <div class="brand w-100 text-center">
                        <img src="{{asset('img/login/windesheim.png')}}" class="img-fluid" alt="Responsive image" >
                    </div>
                    <div class="welcome-text">
                        <span>Bijna klaar</span><br />

                        <small>Verifieer via je email address en klik op de link om account te activeren </small>

                    </div>

                    <div class="login-wrap box-shadow my-5">
                        <!-- Login form -->
                        <div class="login-header">
                            <span class="login-icon "><i class="far fa-building"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-column justify-content-center align-items-center">
                            <div class="text-center w-100 mt-2">
                                <i class="far fa-envelope mr-2" style="color: #9ac43c;font-size: 50px;"></i>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <span class="text-black-50">{{Auth::user()->email}}</span>
                            </div>
                            <h4 class="px-2 py-3 text-center">Opportunities don't happen. You create them.</h4>
                            <hr class="w-100 mb-0"/>
                            <small class="my-3 text-center">Check ook in je spam mail. Heb je nog geen email ontvangen? Klik dan op <b>opnieuw verzenden</b></small>
                            <div class="text-right d-flex justify-content-between w-100 login-btn-wrap align-items-center">
                                <a class="forgot-password" href="{{ route('logofff') }}" >
                                    {{ __('Uitloggen') }}
                                </a>
                                <a href="{{ route('verification.resend') }}" class="btn bg-color-purple-blue m-0 py-3 text-white no-box-shadow no-radius" >Opnieuw verzenden</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2 col-sm-12"></div>
            </div>
        </div>
    </div>

@endsection
