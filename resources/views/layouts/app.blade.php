<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://unpkg.com/simplebar@latest/dist/simplebar.css"
    />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://unpkg.com/simplebar@latest/dist/simplebar.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script>

        setInterval(() => {
            var time = new Date();
            var aa = 'asdasdasd';
            currentTime = time.toLocaleTimeString();
            var clock = document.getElementById('clock').innerText = currentTime;
        },1000)
    </script>

    <script>
        var base_url = '{{ url('/') }}';
        @if(isset($category))
            var id = '{{ $category->id }}';
        @else
            var id = null;
        @endif
    </script>
</head>
<body class="h-screen">
        <div class="container-fluid my-0 py-0">
            <div class="row h-screen">
                <div class="col-md-1 col-xl-1 border-r-2 border-white" style="background-color: #364F6B;">
                    <div class="">
                        <a class="navbar-brand ml-4 my-5">
                            <img src="{{ asset('images/logo.png') }}" class="">
                        </a>
                    </div>
                    <nav class="">
                        <ul class="text-light">
                            <li class="lg:mb-2"><a href="{{ route('home') }}" class="nav-link hover:text-green-400 text-sm">Home</a></li>

                            <li class="lg:mb-2"><a href="{{ route('store') }}" class="nav-link hover:text-green-400 text-sm">Magazyn</a></li>
                            <li class="lg:mb-2"><a href="{{ route('sets') }}" class="nav-link hover:text-green-400 text-sm">Zestawy</a></li>
                            <li class="lg:mb-2"><a href="{{ route('wholesales') }}" class="nav-link hover:text-green-400 text-sm">Hurtownie</a></li>
                            <li class="lg:mb-2"><a href="{{ route('sell') }}" class="nav-link hover:text-green-400 text-sm">Sprzedaż</a></li>
                            <li class=><a href="{{ route('notes') }}" class="nav-link hover:text-green-400 text-sm">Notatki</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-11 col-xl-11">
                    <div class="row">
                        <div class="col-sm-12 col-md-11 rounded-lg xl:ml-16 mt-5 navbar layout-shadow" style="background-color: #E4E4E4; height: 6rem;">
                            <ul class="navbar-nav mr-auto">
                                <span class="font-bold color-txt">Dziś jest: @if(date('D') == 'Mon') Pn {{ date('d.m.Y') }} @elseif(date('D') == 'Tue') Wt {{ date('d.m.Y') }} @elseif(date('D') == 'Wed') Śr {{ date('d.m.Y') }} @elseif(date('D') == 'Thu') Cz {{ date('d.m.Y') }} @elseif(date('D') == 'Fri') Pt {{ date('d.m.Y') }} @elseif(date('D') == 'Sat') So {{ date('d.m.Y') }} @elseif(date('D') == 'Sun') {{ date('d.m.Y') }} @endif<span id="clock">{{ date('H:i:s') }}</span></span>
                            </ul>
                            @auth()
                                <div class="navbar-nav  font-bold color-txt">Zalogowany jako: {{ Auth::user()->name }} {{ Auth::user()->surname }}</div>
                                <a href="{{ route('editUser') }}" class="ml-2 font-bold color-txt"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="fill-current color-txt hover:text-blue-800" height="20px" width="20px"><path d="M3.94 6.5L2.22 3.64l1.42-1.42L6.5 3.94c.52-.3 1.1-.54 1.7-.7L9 0h2l.8 3.24c.6.16 1.18.4 1.7.7l2.86-1.72 1.42 1.42-1.72 2.86c.3.52.54 1.1.7 1.7L20 9v2l-3.24.8c-.16.6-.4 1.18-.7 1.7l1.72 2.86-1.42 1.42-2.86-1.72c-.52.3-1.1.54-1.7.7L11 20H9l-.8-3.24c-.6-.16-1.18-.4-1.7-.7l-2.86 1.72-1.42-1.42 1.72-2.86c-.3-.52-.54-1.1-.7-1.7L0 11V9l3.24-.8c.16-.6.4-1.18.7-1.7zM10 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg></a>
                            @endauth
                            <ul class="navbar-nav">
                                @guest
                                    <li class="nav-item ml-2 lg:ml-12">
                                        <a class="btn px-3 py-2 nav-link text-light color-bg" href="{{ route('login') }}">Zaloguj się</a>
                                    </li>
                                <!-- @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li> -->
                                    @endif
                                @else
                                    <li class="nav-item lg:ml-12">
                                            <a class="btn color-bg text-white" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                Wyloguj się
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-11 xl:ml-16 mt-5 rounded-lg layout-shadow" id="scroll" data-simplebar style="background-color: #E4E4E4; height: 47rem; overflow-x: hidden; overflow-y: auto;">
                            @yield('content')
                        </div>
                    </div>
                    </div>
                </div>
        </div>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>

        <script>
            $(document).ready(function() {
                var $dec = $('#dec');
                var $inc = $('#inc');

                $dec.on('click', function(event) {
                    event.preventDefault();
                    var $value = $('#store').val();
                    var $store = $('#store').val(--$value);
                    if($value <= 0) {
                        $('#dec').attr("disabled", true);
                    }
                });

                $inc.on('click', function(event) {
                    event.preventDefault();
                    var $value = $('#store').val();
                    var $store = $('#store').val(++$value);
                    if($value > 0) {
                        $('#dec').attr("disabled", false);
                    }
                });
            });

        </script>
</body>
</html>
