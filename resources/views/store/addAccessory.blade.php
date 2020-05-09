@extends('layouts.app')

@section('content')
    <h1 class="h1 ml-2 my-3 inline-block mr-auto" style="color: #364F6B;">Akcesoria - @isset($accessory->id) edytuj @else dodaj nowe @endif</h1>
    <hr class="color-bg">
    <div class="row mt-5 justify-center">
        <div class="col-md-6 layout-shadow px-5 py-3 mb-4" style="background-color: #F0F0F0; border-radius: 3rem;">
            <h3 class="h3 color-txt">
                @isset($accessory->id) edytuj @else dodaj nowe @endif
            </h3>
            <hr class="color-bg mb-2">
            <div class="col-sm-10 font-bold justify-center">
                <div class="col-sm-12 offset-sm-1">
                    <form action="@isset($accessory->id) {{ route('updateAccessory', ['id' => $accessory->id]) }} @else {{ route('createAccessory') }} @endif" method="post">
                        <label class="color-txt mt-2">Nazwa:</label>
                        <input type="text" name="name" class="@error('name') is-invalid @enderror rounded-full form-control" placeholder="nazwa" @isset($accessory->id) value="{{ $accessory->name }}"@else value="{{ old('name') }}"@endif>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror

                        <label class="color-txt mt-2">Id hurtowni:</label>
                        <input type="text" name="id_wholesale" class="@error('id_wholesale') is-invalid @enderror rounded-full form-control" placeholder="id hurtowni" @isset($accessory->id) value="{{ $accessory->id_wholesale }}"@else value="{{ old('id_wholesale') }}"@endif>

                        @error('id_wholesale')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror

                        <label class="color-txt mt-2">Ilość:</label>
                        <input type="text" name="quantity" class="@error('quantity') is-invalid @enderror rounded-full form-control" placeholder="ilość" @isset($accessory->id) value="{{ $accessory->quantity }}"@else value="{{ old('quantity') }}"@endif>

                        @error('quantity')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror

                        <label class="color-txt mt-2">Cena netto:</label>
                        <input type="text" name="netto_price" class="@error('netto_price') is-invalid @enderror rounded-full form-control" placeholder="cena netto" @isset($accessory->id) value="{{ $accessory->netto_price}}"@else value="{{ old('quantity') }}"@endif>

                        @error('netto_price')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror

                        <label class="color-txt mt-2">W magazynie:</label>
                        <input type="text" name="in_store" class="@error('in_store') is-invalid @enderror rounded-full form-control" placeholder="w magazynie" @isset($accessory->id) value="{{ $accessory->in_store}}"@else value="{{ old('quantity') }}"@endif>

                        @error('in_store')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror

                        <label class="color-txt mt-2">Hurtownia:</label>
                        <select name="wholesale_id" class="@error('wholesale_id') is-invalid @enderror rounded-full form-control" placeholder="nazwa" @isset($accessory->id) value="{{ $accessory->wholesale_id }}"@else value="{{ old('quantity') }}"@endif>
                            @foreach($wholesales as $wholesale)
                                <option value="{{ $wholesale->id }}" @isset($accessory->id) @if($wholesale->id == $accessory->wholesale_id) selected @endif @endif>{{ $wholesale->name }}</option>
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
