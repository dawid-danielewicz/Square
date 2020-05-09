@extends('layouts.app')

@section('content')
    <h1 class="h1 ml-2 my-3" style="color: #364F6B;">Sprzedaż</h1>
    <hr class="color-bg">
    <div class="row mt-5 mx-5">
        <div class="col-md-4 mb-4">
            <div class="text-center py-4 layout-shadow" style="background-color: #F0F0F0; border-radius: 3rem">
                <h3 class="h3 color-txt mb-2">Zestawy</h3>
                <span class="color-txt text-5xl font-bold mb-3">{{ $count[0]->count() }}</span>
                <p class="mb-4 color-txt">@if($count[0]->count() == 1) sprzedawany @elseif($count[0]->count() >= 2 && $count[0]->count() <= 4) sprzedawane @else sprzedawanych @endif</p>
                <a href="{{ route('sellSets') }}" class="btn color-bg text-light">Pokaż</a>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="text-center py-4 layout-shadow" style="background-color: #F0F0F0; border-radius: 3rem">
                <h3 class="h3 color-txt mb-2">Produkty</h3>
                <span class="color-txt text-5xl font-bold mb-3">{{ $count[1]->count() }}</span>
                <p class="mb-4 color-txt">@if($count[1]->count() == 1) sprzedawany @elseif($count[1]->count() >= 2 && $count[1]->count() <= 4) sprzedawane @else sprzedawanych @endif</p>
                <a href="{{ route('sellProducts') }}" class="btn color-bg text-light">Pokaż</a>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="text-center py-4 layout-shadow" style="background-color: #F0F0F0; border-radius: 3rem">
                <h3 class="h3 color-txt mb-2">Akcesoria</h3>
                <span class="color-txt text-5xl font-bold mb-3">{{ $count[2]->count() }}</span>
                <p class="mb-4 color-txt">@if($count[2]->count() == 1) sprzedawane @elseif($count[2]->count() >= 2 && $count[2]->count() <= 4) sprzedawane @else sprzedawanych @endif</p>
                <a href="{{ route('sellAccessories') }}" class="btn color-bg text-light">Pokaż</a>
            </div>
        </div>
    </div>
@endsection

