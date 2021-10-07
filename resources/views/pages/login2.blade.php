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
          <p class="p2">Login Here<i class="fa fa-unlock-alt pull-right"></i></p>
        </div>

        <!--form action="" method="POST">
          @csrf

            <input type="text" class="login_tf" name="dw" placeholder="Username" required/>
            <input type="password" class="login_tf" name="bias" placeholder="Password" required/>

            <button type="submit" name="store_action" value="compute" class="login_submit">Login</button>

        </form-->

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- <select name="title"  class="login_tf">
                <option selected>Mr.</option>
                <option>Mrs.</option>
                <option>Miss</option>
            </select> --}}

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

</body>
</html>