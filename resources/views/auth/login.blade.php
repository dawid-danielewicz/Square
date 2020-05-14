<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ secure_asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ secure_asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="h-screen">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="layout-shadow" style="margin-top: 10rem; background-color: #E4E4E4; border-radius: 54px">
                    <h1 class="h1 my-5 inline-block col-sm-8 offset-sm-2 offset-md-2 text-center color-txt">Logowanie</h1>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group col-sm-8 offset-sm-2 col-md-8 offset-md-2">
                                <label for="email" class=" col-form-label text-md-right">Email</label>

                                <div class="">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror rounded-full layout-shadow" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col-sm-8 offset-sm-2 col-md-8 offset-md-2">
                                <label for="password" class="col-form-label text-md-right">Hasło</label>

                                <div class="">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror rounded-full layout-shadow" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12 col-sm-12 col-md-8 offset-sm-2 offset-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Zapamiętaj mnie') }}
                                        </label>
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link ml-5 pr-0" href="{{ route('password.request') }}">
                                                {{ __('Resetruj hasło') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 offset-md-2 text-center">
                                    <button type="submit" class="btn color-bg text-light btn-lg mb-5 mt-4">
                                        Zaloguj się
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
