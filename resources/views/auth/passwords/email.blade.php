<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="h-screen">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="layout-shadow" style="margin-top: 10rem; background-color: #E4E4E4; border-radius: 54px">
                <h1 class="h1 my-5 inline-block col-md-8 offset-md-2 text-center color-txt">Resetowanie hasła</h1>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group col-md-8 offset-md-2">
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

                        <div class="form-group">
                            <div class="col-md-8 offset-md-2 text-center">
                                <button type="submit" class="btn color-bg text-light btn-lg mb-5 mt-4">
                                    Wyślij link reserujący
                                </button>
                    </form>
            </div>
        </div>
    </div>
</div>
</div>
</body>

