@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-xl-8">
            <h1 class="h1 ml-2 mt-3 inline-block mr-auto" style="color: #364F6B;">Zestawy</h1>
            <a href="{{ route('addSet') }}" class="btn btn-success text-light mb-3 ml-5 mt-1 inline-block">Dodaj nowy zestaw</a>
        </div>
        <div class="col-sm-6 col-xl-3">
            <form class="inline-block relative mt-4 pl-5 ml-5" action="{{ route('setsResults') }}" method="POST">
                @csrf
                <input type="text" class="p-2 rounded-l-full color-txt autoSet" name="name" placeholder="szukaj..." style="background-color: #F0F0F0; border: 2px #364F6B solid; outline: none;">
                <button type="submit" class="btn rounded-r-full absolute z-50 color-bg text-gray-100 pr-3 hover:bg-gray-300 hover:text-blue-900" style="padding-top: 10px; padding-bottom: 11px;  border-top: solid 2px #364F6B; border-bottom: solid 2px #364F6B; border-right: solid 2px #364F6B;">
                    <svg class="fill-current" height="20px" width="18px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/></svg>
                </button>
            </form>
        </div>
    </div>
    <hr class="color-bg">

    @if(session('deleted_set'))
        <div class="alert alert-success my-3 alert-dismissible fade show" role="alert">
            {{session('deleted_set')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('no_sets'))
        <div class="alert alert-danger my-3 alert-dismissible fade show" role="alert">
            {{session('no_sets')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row mt-5 mx-5">
        @foreach($sets as $set)
            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-4">
                <div class="text-center py-4 layout-shadow" style="background-color: #F0F0F0; border-radius: 3rem">
                    <h3 class="h3 color-txt mb-2">{{ $set->name }}</h3>
                    <span class="text-5xl font-bold mb-3 @if($set->in_store == 0) text-red-600 @elseif($set->in_store > 0 && $set->in_store <=20) text-yellow-500 @else color-txt @endif">{{ $set->in_store }}</span>
                    <p class="mb-4 color-txt">@if($set->in_store == 1) sztuka @elseif($set->in_store >= 2 && $set->in_store <= 4) sztuki @else sztuk @endif</p>
                    <a href="{{ route('showSet',['id' => $set->id]) }}" class="btn color-bg text-light">Pokaż</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
