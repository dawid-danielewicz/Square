@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="h1 ml-2 mt-3 inline-block mr-auto color-txt">{{ $set->name }} - Szczegóły</h1>
            <a href="{{ route('editSet', ['id' => $set->id]) }}" class="btn color-bg text-light mb-3 ml-2 lg:ml-12 mt-1 inline-block">Edytuj zestaw</a>
            <a href="{{ route('deleteSet', ['id' => $set->id]) }}" class="btn btn-danger text-light mb-3 ml-2 mt-1 inline-block" onclick="return confirm('Czy napewno chcesz usunąć zestaw?')">Usuń zestaw</a>
        </div>
    </div>
    <hr class="color-bg">

    @if(session('updated_sets'))
        <div class="alert alert-success my-3 alert-dismissible fade show">
            {{session('updated_sets')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row mt-5 justify-center">
        <div class="col-md-6 offset-md-1">
            <div class="col-md-10 layout-shadow px-5 py-3" style="background-color: #F0F0F0; border-radius: 3rem;">
                <h3 class="h3 color-txt">
                    Dane
                </h3>
                <hr class="color-bg mb-2">
                <div class="col-sm-12 font-bold">
                    <table class="table table-borderless color-txt">
                        <tr>
                            <td>Nazwa:</td>
                            <td>{{ $set->name }}</td>
                        </tr>
                        <tr>
                            <td>Cena brutto:</td>
                            <td>{{ $set->brutto_price }}zł</td>
                        </tr>
                        <tr>
                            <td>Cena netto:</td>
                            <td>{{ $set->netto_price }}zł</td>
                        </tr>
                        <tr>
                            <td>Zawartość:</td>
                            <td>{{ $set->content }}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-sm-12 text-center">
                    <h3 class="color-txt h5 mb-3">Ilość w magazynie:</h3>
                        <form action="{{ route('updateSetStore', ['id' => $set->id]) }}" method="post">
                            @csrf
                            <div class="mb-3 inline-block">
                                <button class="btn btn-danger text-light py-0 px-3 mb-2 mr-2" id="dec">-</button>
                            <input type="text" name="in_store" class="rounded-full color-bg text-light text-center text-lg" id="store" value="{{ $set->in_store }}" style="width: 4rem; padding: 1.1rem 0 1.1rem 0;">
                        <button class="btn color-bg text-light py-0 px-3 mb-2 ml-2" id="inc">+</button>
                    </div>
                    <br>
                    <hr class="color-bg mb-3">
                    <input type="submit" class="btn btn-success text-light" value="Zatwierdź">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
