@extends('layouts.app')

@section('content')
    <h1 class="h1 ml-2 my-3" style="color: #364F6B;">Home</h1>
    <hr class="color-bg">

    <div class="row">
        <div class="col-md-12 text-center" style="margin-top: 15rem;">
            @guest
                <h2 class="h2 color-txt">Zaloguj się aby korzystać z systemu.</h2>
            @endguest
            @auth()
                <h2 class="h2 color-txt">Witaj w systemie Square.</h2>
            @endauth
        </div>
    </div>
@endsection
