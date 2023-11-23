@extends('layouts.app')

@section('content')
    <style>
        .loginpic {
            margin-left: 4em;
            margin-top: 2em;

        }

        .card {
            /* Rectangle 1 */
            border-color: orange;
            border-radius: 34px;
        }

        .name {
            margin-top: 9em;
            text-align: center;
        }

        .title {
            color: #FE8900;
            text-align: center;
            /* font-family: Poppins; */
            font-size: 30px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            letter-spacing: 3.5px;
        }

        .login_label {
            color: #003057;
            text-align: center;
            /* font-family: Poppins; */
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            margin-top: 15px;
        }

        hr {
            background: #445563;
            height: 2px;
            margin-top: auto;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid rgba(0, 0, 0, 0.46);
        }

        .loginBtn {
            /* background: #135083; */
            text-align: center;
            letter-spacing: 3.6px;
            width: 7em;
            border-radius: 10px;
        }
    </style>

    <div class="container mt-5">
        <div class="row justify-content-center name">
            <div class="title"><strong> {{ __('J & E RENTALS AND PROPERTY') }} <br>
                    {{ __('MANAGEMENT') }} </strong>
            </div>
        </div>
        <div class="row lg ">
            <div class="col-md-6 mt-5">
                <div class="card mt-4">



                    <div class="card-body">
                        <div class="login_label">{{ __(' Login to your account') }}</div> <br>
                        <hr>
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6 email_input">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus
                                        placeholder="name@example.com">


                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password" placeholder="atleast 8 characters">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0 justify-content-center">
                                <div class="col-md-7 ">
                                    <button type="submit" class="btn btn-outline-dark loginBtn p-2">
                                        <strong> {{ __('Login') }} </strong>
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-10">
                <img src="{{ asset('image/login_pic.png') }}" alt="" class="loginpic">

            </div>
        </div>
    </div>
@endsection
