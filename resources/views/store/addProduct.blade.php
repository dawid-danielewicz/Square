@extends('layouts.app')

@section('content')
    <h1 class="h1 ml-2 my-3 inline-block mr-auto" style="color: #364F6B;">Produkty - @isset($product->id) edytuj @else dodaj nowy @endif</h1>
    <hr class="color-bg">
    <div class="row mt-5 justify-center">
        <div class="col-md-6 layout-shadow px-5 py-3 mb-4" style="background-color: #F0F0F0; border-radius: 3rem;">
            <h3 class="h3 color-txt">
                @isset($product->id) edytuj @else dodaj nowy @endif
            </h3>
            <hr class="color-bg mb-2">
            <div class="col-sm-10 font-bold justify-center">
                <div class="col-sm-12 offset-sm-1">
                    <form action="@isset($product->id) {{ route('updateProduct', ['id' => $product->id]) }} @else {{ route('createProduct') }} @endif" method="post">
                        <label class="color-txt mt-2">Nazwa:</label>
                        <input type="text" name="name" class="@error('name') is-invalid @enderror rounded-full form-control" placeholder="nazwa" @isset($product->id) value="{{ $product->name }}"@else value="{{ old('name') }}"@endif>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror

                        <label class="color-txt mt-2">Id hurtowni:</label>
                        <input type="text" name="id_wholesale" class="@error('id_wholesale') is-invalid @enderror rounded-full form-control" placeholder="id hurtowni" @isset($product->id) value="{{ $product->id_wholesale }}"@else value="{{ old('id_wholesale') }}"@endif>

                        @error('id_wholesale')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror


                        <label class="color-txt mt-2">Kategoria:</label>
                        <select name="category_id" class="@error('category_id') is-invalid @enderror rounded-full form-control" placeholder="kategoria" @isset($product->id) value="{{ $product->category_id }}"@else value="{{ old('category_id') }}"@endif>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @isset($product->category_id) @if($category->id == $product->category_id) selected @endif @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>

                        @error('category_id')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror

                        <label class="color-txt mt-2">Kolor:</label>
                        <input type="text" name="color" class="@error('color') is-invalid @enderror rounded-full form-control" placeholder="kolor" @isset($product->id) value="{{ $product->color }}"@else value="{{ old('color') }}"@endif>

                        @error('color')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror

                        <label class="color-txt mt-2">Wzór:</label>
                        <input type="text" name="pattern" class="@error('pattern') is-invalid @enderror rounded-full form-control" placeholder="wzór" @isset($product->id) value="{{ $product->pattern }}"@else value="{{ old('pattern') }}"@endif>

                        @error('pattern')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror

                        <label class="color-txt mt-2">Ilość:</label>
                        <input type="text" name="quantity" class="@error('quantity') is-invalid @enderror rounded-full form-control" placeholder="ilość" @isset($product->id) value="{{ $product->quantity }}"@else value="{{ old('quantity') }}"@endif>

                        @error('quantity')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror

                        <label class="color-txt mt-2">Cena netto:</label>
                        <input type="text" name="netto_price" class="@error('netto_price') is-invalid @enderror rounded-full form-control" placeholder="cena netto" @isset($product->id) value="{{ $product->netto_price}}"@else value="{{ old('netto_price') }}"@endif>

                        @error('netto_price')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror

                        <label class="color-txt mt-2">W magazynie:</label>
                        <input type="text" name="in_store" class="@error('in_store') is-invalid @enderror rounded-full form-control" placeholder="w magazynie" @isset($product->id) value="{{ $product->in_store}}"@else value="{{ old('in_store') }}"@endif>

                        @error('in_store')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror

                        <label class="color-txt mt-2">Hurtownia:</label>
                        <select name="wholesale_id" class="@error('wholesale_id') is-invalid @enderror rounded-full form-control" placeholder="nazwa" @isset($product->id) value="{{ $product->wholesale_id }}"@else value="{{ old('wholesale_id') }}"@endif>
                            @foreach($wholesales as $wholesale)
                                <option value="{{ $wholesale->id }}" @isset($product->wholesale_id) @if($wholesale->id == $product->wholesale_id) selected @endif @endif>{{ $wholesale->name }}</option>
                            @endforeach
                        </select>

                        @error('wholesale_id')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror

                        @csrf
                        <input type="submit" value="Zapisz" class="btn color-bg text-white my-2">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
