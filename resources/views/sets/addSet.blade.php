@extends('layouts.app')

@section('content')
    <h1 class="h1 ml-2 my-3 inline-block mr-auto" style="color: #364F6B;">Zestawy - @isset($set->id) edytuj @else dodaj nowy @endif</h1>
    <hr class="color-bg">
    <div class="row mt-5 justify-center">
        <div class="col-md-6 layout-shadow px-5 py-3" style="background-color: #F0F0F0; border-radius: 3rem;">
            <h3 class="h3 color-txt">
                @isset($set->id) edytuj @else dodaj nowy @endif
            </h3>
            <hr class="color-bg mb-2">
            <div class="col-sm-10 font-bold justify-center">
                <div class="col-sm-12 offset-sm-1">
                    <form action="@isset($set->id) {{ route('updateSet', ['id' => $set->id]) }} @else {{ route('createSet') }} @endif" method="post">
                        <label class="color-txt mt-2">Nazwa:</label>
                        <input type="text" name="name" class="@error('name') is-invalid @enderror rounded-full form-control" placeholder="nazwa" @isset($set->id) value="{{ $set->name }}"@else value="{{ old('name') }}"@endif>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror

                        <label class="color-txt mt-2">Cena netto:</label>
                        <input type="text" name="netto_price" class="@error('netto_price') is-invalid @enderror rounded-full form-control" placeholder="cena netto" @isset($set->id) value="{{ $set->netto_price }}"@else value="{{ old('netto_price') }}"@endif>

                        @error('netto_price')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror

                        <label class="color-txt mt-2">W magazynie:</label>
                        <input type="text" name="in_store" class="@error('in_store') is-invalid @enderror rounded-full form-control" placeholder="w magazynie" @isset($set->id) value="{{ $set->in_store }}"@else value="{{ old('in_store') }}"@endif>

                        @error('in_store')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror

                        <label class="color-txt mt-2">Zawartość:</label>
                        <textarea name="content" class="@error('content') is-invalid @enderror rounded-lg form-control">@isset($set->id) {{ $set->content }} @else{{ old('content') }}@endif</textarea>

                        @error('content')
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
