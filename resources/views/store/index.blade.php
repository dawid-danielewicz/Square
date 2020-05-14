@extends('layouts.app')

@section('content')
    <h1 class="h1 ml-2 my-3 inline-block" style="color: #364F6B;">Magazyn</h1>
    <a href="{{ route('addCategory') }}" class="btn btn-success text-light mb-3 ml-5 mt-1 inline-block">Dodaj kategorię</a>
    <a href="{{ route('addProduct') }}" class="btn btn-success text-light mb-3 ml-2 mt-1 inline-block">Dodaj nowy produkt</a>
    <a href="{{ route('addAccessory') }}" class="btn btn-success text-light mb-3 ml-2 mt-1 inline-block">Dodaj nowe akcesoria</a>
    <hr class="color-bg">

    <div class="row mt-5 mx-5">
        @foreach($categories as $category)
            <div class="col-xs-12 col-md-4 col-xl-3 mb-4">
                <div class="text-center py-4 layout-shadow" style="background-color: #F0F0F0; border-radius: 3rem">
                    <h3 class="h3 color-txt mb-2">{{ $category->name }}</h3>
                    <span class="color-txt text-5xl font-bold mb-3">{{ $category->products->count() }}</span>
                    <p class="mb-4 color-txt">@if($category->products->count() == 1) produkt @elseif($category->products->count() > 1 && $category->products->count() < 5) produkty @else produktów @endif</p>
                    <a href="{{ route('showProducts', ['id' => $category->id , 'name' => $category->name]) }}" class="btn color-bg text-light">Pokaż</a>
                </div>
            </div>
        @endforeach

            <div class="col-xs-12 col-md-4 col-xl-3 mb-4">
                <div class="text-center py-4 layout-shadow" style="background-color: #F0F0F0; border-radius: 3rem">
                    <h3 class="h3 color-txt mb-2">akcesoria</h3>
                    <span class="color-txt text-5xl font-bold mb-3">{{ $accessories->count() }}</span>
                    <p class="mb-4 color-txt">@if($accessories->count() < 5) akcesoria @else akcesoriów @endif</p>
                    <a href="{{ route('showAccessories')}}" class="btn color-bg text-light">Pokaż</a>
                </div>
            </div>
    </div>
@endsection
