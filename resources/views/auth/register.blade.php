@extends('layouts.app')

@section('content')


    <div class="col-sm-8 col-sm-offset-2 logCol">

        <div class="login_section">
            <p class="p1">RIPREDICT</p>
            <p class="p2">Register Here<i class="fa fa-user pull-right"></i></p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <select name="title" class="login_tf">
                <option selected>Mr.</option>
                <option>Mrs.</option>
                <option>Miss</option>
            </select>

            <input id="name" placeholder="Fullname" max="24" type="text" class="login_tf @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
            <input id="email" placeholder="Email" type="email" class="login_tf @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input id="password" placeholder="Password" type="password" class="login_tf @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input id="password-confirm" placeholder="Confirm Password" type="password" class="login_tf" name="password_confirmation" required autocomplete="new-password">
            
            <button type="submit" class="login_submit">
                {{ __('Register') }}
            </button>
            
        </form>
    </div>

@endsection
