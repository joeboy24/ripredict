@extends('layouts.app')

@section('content')

    <div class="col-sm-8 col-sm-offset-2 logCol">
            
        {{-- @include('inc.messages') --}}
        <div class="login_section">
            <p class="p1">RIPREDICT</p>
            <p class="p2">Login Here<i class="fa fa-unlock-alt pull-right"></i></p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <input id="email" placeholder="Username" type="email" class="login_tf @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input id="password" placeholder="Password" type="password" class="login_tf @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            {{-- <p>&nbsp;</p> --}}
            
            <button type="submit" class="login_submit">
                {{ __('Login') }}
            </button>
            
            <label class="checkbox1_lable" for="remember">
                <input class="checkbox1" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>&nbsp;&nbsp;{{ __('Remember Me') }}
            </label>

            {{-- @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif --}}
            
        </form>
        
    </div> 

@endsection
