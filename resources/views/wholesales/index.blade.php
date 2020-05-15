@extends('layouts.app')

@section('content')
    <h1 class="h1 ml-2 my-3 inline-block" style="color: #364F6B;">Hurtownie</h1>
    <a href="{{ route('addWholesale') }}" class="btn btn-success text-light mb-3 ml-2 lg:ml-12 mt-1 inline-block">Dodaj nową hurtownię</a>
    <hr class="color-bg">

    <div class="row mt-5 mx-5">
        @foreach($wholesales as $wholesale)
            <div class="col-md-4 col-xl-3 mb-4">
                <div class="text-center py-4 layout-shadow" style="background-color: #F0F0F0; border-radius: 3rem">
                    <h3 class="h3 color-txt mb-2">{{ $wholesale->name }}</h3>
                    <span class="color-txt text-5xl font-bold mb-3">{{ $wholesale->products->count() + $wholesale->accessories->count() }}</span>
                    <p class="mb-4 color-txt">produktów/akcesoriów</p>
                    <a href="{{ route('wholesaleShow', ['id' => $wholesale->id, 'name' => $wholesale->name]) }}" class="btn color-bg text-light">Pokaż</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
