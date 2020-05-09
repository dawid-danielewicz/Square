@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-xl-8">
            <h1 class="h1 ml-2 my-3 inline-block mr-auto" style="color: #364F6B;">Sprzedane akcesoria</h1>
            <a href="{{ route('accessoriesStats') }}" class="btn color-bg text-light mb-3 ml-5 mt-1 inline-block">Statystyki</a>
        </div>
        <div class="col-sm-6 col-xl-3">
            <form class="inline-block relative mt-4 pl-5 ml-5" action="{{ route('sellAccessoriesResults') }}" method="POST">
                @csrf
                <input type="text" class="p-2 rounded-l-full color-txt autoSellAccessory" name="name" placeholder="szukaj..." style="background-color: #F0F0F0; border: 2px #364F6B solid; outline: none;">
                <button type="submit" class="btn rounded-r-full absolute z-50 color-bg text-gray-100 pr-3 hover:bg-gray-300 hover:text-blue-900" style="padding-top: 10px; padding-bottom: 11px;  border-top: solid 2px #364F6B; border-bottom: solid 2px #364F6B; border-right: solid 2px #364F6B;">
                    <svg class="fill-current" height="20px" width="18px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/></svg>
                </button>
            </form>
        </div>
    </div>
    <hr class="color-bg">

    @if(session('no_accessories'))
        <div class="alert alert-danger my-3 alert-dismissible fade show">
            {{session('no_accessories')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('sold_accessories'))
        <div class="alert alert-success my-3 alert-dismissible fade show">
            {{session('sold_accessories')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="@error('quantity') is-invalid @enderror">

    </div>

    @error('quantity')
    <span class="invalid-feedback alert alert-danger my-3 " role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror

    <h4 class="h4 color-txt my-3 ml-2">Ilość sprzedawanych akcesoriów: {{ $accessories->count() }}</h4>
    <div class="row mt-5 mx-5">
        @foreach($accessories as $accessory)
            <div class="col-md-3 mb-4">
                <div class="text-center py-4 layout-shadow" style="background-color: #F0F0F0; border-radius: 3rem">
                    <h3 class="h3 color-txt mb-2">{{ $accessory->saleable->name}}</h3>
                    <span class="color-txt text-5xl font-bold mb-3">{{ $accessory->quantity }}</span>
                    <p class="mb-4 color-txt">@if($accessory->quantity == 1) sztuka @elseif($accessory->quantity >= 2 && $accessory->quantity <= 4) sztuki @else sztuk @endif</p>
                    <div class="col-sm-12 text-center">
                        <h3 class="color-txt h5 mb-3">Ile chcesz sprzedać:</h3>
                        <form action="{{ route('sellAccessory', ['id' => $accessory->id]) }}" method="post">
                            @csrf
                            <div class="mb-3 inline-block">
                                <button class="btn btn-danger text-light py-0 px-3 mb-2 mr-2" id="dec{{$accessory->id}}">-</button>
                                <input type="text" name="quantity" class="rounded-full color-bg text-light text-center text-lg" id="store{{ $accessory->id }}" value="0" style="width: 4rem; padding: 1.1rem 0 1.1rem 0;">
                                <button class="btn color-bg text-light py-0 px-3 mb-2 ml-2" id="inc{{$accessory->id}}">+</button>
                            </div>
                            <br>
                            <hr class="color-bg mb-3">
                            <input type="submit" class="btn btn-danger text-light" value="Cofnij" name="return">
                            <input type="submit" class="btn btn-success text-light" value="Sprzedaj" name="sell">
                        </form>

                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        var $dec = $('#dec{{$accessory->id}}');
                        var $inc = $('#inc{{$accessory->id}}');

                        $dec.on('click', function(event) {
                            event.preventDefault();
                            var $value = $('#store{{$accessory->id}}').val();
                            var $store = $('#store{{$accessory->id}}').val(--$value);
                            if($value <= 0) {
                                $('#dec').attr("disabled", true);
                            }
                        });

                        $inc.on('click', function(event) {
                            event.preventDefault();
                            var $value = $('#store{{$accessory->id}}').val();
                            var $store = $('#store{{$accessory->id}}').val(++$value);
                            if($value > 0) {
                                $('#dec').attr("disabled", false);
                            }
                        });
                    });
                </script>
            </div>
        @endforeach
    </div>
@endsection
