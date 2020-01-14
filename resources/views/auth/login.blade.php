@extends('layouts.auth.main')

@section('content')
    <!--/ Begin content -->
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
                        <span>Let's change the world</span><br />
                        <span class="ft-14"> <a href="{{ route('register') }}"><u >Registreer hier</u>  </a> als je geen account hebt.</span>
                    </div>

                    <div class="login-wrap box-shadow my-5">
                        <!-- Login form -->
                        <div class="login-header ">
                            <span class="login-icon "><i class="far fa-building"></i></span>
                        </div>
                        <form class="login-form " method="POST" action="{{ route('login') }}">
                            <div class="login-content pt-0">
                            @csrf
                            <!-- Email -->
                                <div class="form-group">
                                    <label for="email">
                                        E-mail:
                                    </label>
                                    <input id="email" type="email" placeholder="s1234567@student.windesheim.nl"
                                           class="form-control login-input mb-4 {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <!-- password -->
                                <div class="form-group">
                                    <label for="password">
                                        Wachtwoord:
                                    </label>
                                    <input id="password" type="password" placeholder="Wachtwoord"
                                           class="form-control login-input mb-4 {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required
                                           autocomplete="new-password">

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>
                            <div class="text-right d-flex justify-content-between w-100 login-btn-wrap align-items-center">
                                @if (Route::has('password.request'))
                                    <a class="forgot-password" href="{{ route('password.request') }}" >
                                        {{ __('Wachtwoord vergeten') }}
                                    </a>
                                @endif
                                <button class="btn bg-color-purple-blue m-0 py-3 text-white no-box-shadow no-radius" type="submit">Inloggen</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2 col-sm-12"></div>
            </div>
        </div>
    </div>

@endsection
