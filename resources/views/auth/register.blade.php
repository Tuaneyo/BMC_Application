@extends('layouts.auth.main')
@include('layouts.scripts')
@section('content')
    <div class="content  home-shadow"
         style="background: url({{asset('img/login/building-city2.jpg')}}) center no-repeat ;">
        <div class="overview"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-2 col-sm-12"></div>
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <div class="brand w-100 text-center">
                        <img src="{{asset('img/login/windesheim.png')}}" class="img-fluid my-lg-5 my-md-4 my-3" alt="Responsive image" >
                    </div>
                    <div class="login-wrap box-shadow my-5">
                        <!-- Login form -->
                        <div class="login-header ">
                            <span class="login-icon "><i class="far fa-building"></i></span>

                        </div>
                        <form class="login-form " method="POST" action="{{ route('register') }}">
                            <div class="login-content pt-0">
                            @csrf
                                <div class="form-group">
                                    <input placeholder="voornaam" id="name" type="name"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                </div>
                                <div class="form-group">
                                    <input placeholder="achternaam" id="name" type="name"
                                           class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}"
                                           name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                                    <small class="text-danger">{{ $errors->first('lastname') }}</small>
                                </div>
                                <div class="form-group">
                                    <input placeholder="studentennummer" id="name" type="name"
                                           class="form-control{{ $errors->has('st_number') ? ' is-invalid' : '' }}"
                                           name="st_number" value="{{ old('st_number') }}" required autocomplete="st_number" autofocus>

                                    <small class="text-danger">{{ $errors->first('st_number') }}</small>
                                </div>
                                <div class="form-group">
                                    <input placeholder="Email" id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{ old('email') }}" required autocomplete="email">

                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                </div>
                                <div class="form-group">
                                    <input placeholder="Wachtwoord" id="password" type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" required autocomplete="new-password">
                                    <small class="text-danger">{{ $errors->first('password') }}</small>
                                </div>
                                <div class="form-group">
                                    <input placeholder="Herhaal wachtwoord" id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="text-right d-flex justify-content-between w-100 login-btn-wrap align-items-center">
                                @if (Route::has('login'))
                                    <a class="forgot-password" href="{{ route('login') }}" >
                                        {{ __('Inloggen') }}
                                    </a>
                                @endif
                                <button class="btn bg-color-purple-blue m-0 py-3 text-white no-box-shadow no-radius" type="submit">Registeren</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2 col-sm-12"></div>
            </div>
        </div>
    </div>

@endsection
