@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-xl-8">
            <h1 class="h1 ml-2 mt-3 inline-block mr-auto" style="color: #364F6B;">{{ $category->name }}- przegląd</h1>
            <a href="{{ route('editCategory', ['id' => $category->id]) }}" class="btn color-bg text-light mb-3 ml-5 mt-1 inline-block">Edytuj kategorię</a>
            <a href="{{ route('deleteCategory', ['id' => $category->id]) }}" class="btn btn-danger text-light mb-3 ml-2 mt-1 inline-block" onclick="return confirm('Czy napewno chcesz usunąć kategorię?')">Usuń kategorię</a>
        </div>
        <div class="col-sm-6 col-xl-3">
            <form class="inline-block relative pt-4 pl-5 ml-5" action="{{ route('productsResults', ['id' => $category->id]) }}" method="POST">
                @csrf
                <input type="text" class="p-2 rounded-l-full color-txt autoProduct" name="name" placeholder="szukaj..." style="background-color: #F0F0F0; border: 2px #364F6B solid; outline: none;">
                <button type="submit" class="btn rounded-r-full absolute z-50 color-bg text-gray-100 pr-3 hover:bg-gray-300 hover:text-blue-900" style="padding-top: 10px; padding-bottom: 11px;  border-top: solid 2px #364F6B; border-bottom: solid 2px #364F6B; border-right: solid 2px #364F6B;">
                    <svg class="fill-current" height="20px" width="18px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/></svg>
                </button>
            </form>
        </div>
    </div>
    <hr class="color-bg">

    @if(session('deleted_product'))
        <div class="alert alert-success my-3 alert-dismissible fade show">
            {{session('deleted_product')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('no_products'))
        <div class="alert alert-danger my-3 alert-dismissible fade show" role="alert">
            {{session('no_products')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-12 mt-3">
            <h4 class="h4 color-txt mb-3">Ilość produktów: {{ $products->count() }}</h4>
            <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                    <tr class="color-bg text-light">
                        <th scope="col">id.</th>
                        <th scope="col">nazwa</th>
                        <th scope="col">id hurtowni</th>
                        <th scope="col">kategoria</th>
                        <th scope="col">kolor</th>
                        <th scope="col">wzór</th>
                        <th scope="col">ilość w paczce</th>
                        <th scope="col">cena brutto</th>
                        <th scope="col">cena netto</th>
                        <th scope="col">cena za sztukę</th>
                        <th scope="col">w magazynie</th>
                        <th scope="col">hurtownia</th>
                        <th scope="col">edytuj</th>
                        <th scope="col">usuń</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr class="color-txt @if($product->in_store <= 20 && $product->in_store > 0) bg-yellow-300 @elseif($product->in_store == 0) bg-red-300 @else bg-gray-100 @endif">
                        <th scope="row">{{ $product->id }}</th>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->id_wholesale }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->color }}</td>
                        <td>{{ $product->pattern }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->brutto_price }} zł</td>
                        <td>{{ $product->netto_price }} zł</td>
                        <td>{{ $product->price_per_piece }} zł</td>
                        <td>{{ $product->in_store }}</td>
                        <td><a href="{{ route('wholesaleShow', ['id' => $product->wholesale->id, 'name' => $product->wholesale->name]) }}" class="font-bold hover:text-blue-700" style="text-decoration: none">{{ $product->wholesale->name }}</a></td>
                        <td class="px-0"><a href="{{ route('editProduct', ['id' => $product->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" class="fill-current text-blue-600 hover:text-blue-700 ml-8" height="20px" width="20px"viewBox="0 0 20 20"><path d="M12.3 3.7l4 4L4 20H0v-4L12.3 3.7zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z"/></svg></a></td>
                        <td class="px-0"><a href="{{ route('deleteProduct', ['id' => $product->id]) }}"><svg class="fill-current text-red-600 hover:text-red-700 ml-4" height="20px" width="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z"/></svg></a> </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
@endsection
