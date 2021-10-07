<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <title>PivoApps</title>
    <link href="/maindir/css/bootstrap.min.css" rel="stylesheet">
    <link href="/maindir/css/main.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="//db.onlinewebfonts.com/c/f5727dd66415af47582ddb87de6e9f81?family=Quebec-Serial+DB" rel="stylesheet" type="text/css"/>

</head>
<body>

    <div class="shape1">
    </div>

    <div class="shape2">
    </div>

    <div class="col-sm-7 col-sm-offset-2 logCol">
        
        {{-- @include('inc.messages') --}}
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

</body>
</html>