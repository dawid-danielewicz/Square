@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-7 col-xl-8">
            <h1 class="h1 ml-2 my-3 inline-block mr-auto" style="color: #364F6B;">{{ $wholesale->name }} - przegląd</h1>
            <a href="{{ route('editWholesale', ['id' => $wholesale->id]) }}" class="btn color-bg text-light mb-3 ml-2 lg:ml-12 mt-1 inline-block">Edytuj hurtownię</a>
            <a href="{{ route('deleteWholesale', ['id' => $wholesale->id]) }}" class="btn btn-danger text-light mb-3 ml-2 mt-1 inline-block" onclick="return confirm('Czy napewno chcesz usunąć hurtownię?')">Usuń hurtownię</a>
        </div>
        <div class="col-xs-12 col-md-3 offset-md-1 col-xl-3">
            <form class="inline-block relative mt-4 mb-2 ml-2 lg:ml-12 lg:pl-12">
            <input type="text" class="p-2 rounded-l-full color-txt" placeholder="szukaj..." style="background-color: #F0F0F0; border: 2px #364F6B solid; outline: none;">
            <button type="submit" class="btn rounded-r-full absolute z-50 color-bg text-gray-100 pr-3 hover:bg-gray-300 hover:text-blue-900" style="padding-top: 10px; padding-bottom: 11px;  border-top: solid 2px #364F6B; border-bottom: solid 2px #364F6B; border-right: solid 2px #364F6B;">
                <svg class="fill-current" height="20px" width="18px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/></svg>
            </button>
            </form>
        </div>
    </div>

    <hr class="color-bg">

    <div class="row">
        <div class="col-sm-12 mt-3">
            <h4 class="color-txt h4 mb-3">Produkty: {{ $wholesale->products->count() }}</h4>
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                    <tr class="color-bg text-light">
                        <th scope="col">id.</th>
                        <th scope="col">nazwa</th>
                        <th scope="col">id_hurtowni</th>
                        <th scope="col">typ</th>
                        <th scope="col">kolor</th>
                        <th scope="col">wzór</th>
                        <th scope="col">ilość w paczce</th>
                        <th scope="col">cena brutto</th>
                        <th scope="col">cena netto</th>
                        <th scope="col">cena za sztukę</th>
                        <th scope="col">w magazynie</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($wholesale->products as $product)
                        <tr class="color-txt @if($product->in_store <= 20 && $product->in_store > 0) bg-yellow-300 @elseif($product->in_store == 0) bg-red-300 @else bg-gray-100 @endif">
                            <th scope="row">{{ $product->id }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->id_wholesale}}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->color }}</td>
                            <td>{{ $product->pattern }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->brutto_price }} zł</td>
                            <td>{{ $product->netto_price }} zł</td>
                            <td>{{ $product->price_per_piece }} zł</td>
                            <td>{{ $product->in_store }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-sm-12 mt-3">
            <h4 class="color-txt h4 mb-3">Akcesoria: {{ $wholesale->accessories->count() }}</h4>
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                    <tr class="color-bg text-light">
                        <th scope="col">id.</th>
                        <th scope="col">nazwa</th>
                        <th scope="col">id hurtowni</th>
                        <th scope="col">ilość w paczce</th>
                        <th scope="col">cena brutto</th>
                        <th scope="col">cena netto</th>
                        <th scope="col">cena za sztukę</th>
                        <th scope="col">w magazynie</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($wholesale->accessories as $accessory)
                        <tr class="color-txt @if($accessory->in_store <= 20 && $accessory->in_store > 0) bg-yellow-300 @elseif($accessory->in_store == 0) bg-red-300 @else bg-gray-100 @endif">
                            <th scope="row">{{ $accessory->id }}</th>
                            <td>{{ $accessory->name }}</td>
                            <td>{{ $accessory->id_wholesale }}</td>
                            <td>{{ $accessory->quantity }}</td>
                            <td>{{ $accessory->brutto_price }} zł</td>
                            <td>{{ $accessory->netto_price }} zł</td>
                            <td>{{ $accessory->price_per_piece }} zł</td>
                            <td>{{ $accessory->in_store }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
