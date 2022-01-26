@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body wrap d-md-flex">
                    <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center">
                        <div class="text w-100">
                            <img src="img/logoApp.png">
                        </div>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="login-wrap p-4 p-lg-5">
                        @csrf

                        <div class="form-group mb-3">
                            <input id="usua_email" type="email" placeholder="Email Address" class="form-control @error('error') is-invalid @enderror" name="usua_email" value="{{ old('email') }}" required autocomplete="email" autofocus>                          
                        </div>

                        <div class="form-group mb-3">
                            <input id="usua_pasw" type="password" placeholder="Password" class="form-control @error('error') is-invalid @enderror" name="usua_pasw" required autocomplete="current-password">

                            @error('error')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <div >
                                <button type="submit" class="btn btn-outline-light px-3">
                                    {{ __('Login') }}
                                </button>

                                <!-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif -->
                            </div>
                        </div>
                        <div class="form-group mb-3 text-left">
                            <div class="w-100">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
