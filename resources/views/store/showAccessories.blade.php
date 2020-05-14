@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-md-8 col-xl-9">
            <h1 class="h1 ml-2 my-3 inline-block mr-auto" style="color: #364F6B;">Akcesoria - przegląd</h1>
        </div>
        <div class="col-sm-6 col-md-3 col-xl-3">
            <form class="inline-block relative mt-4 pl-5 ml-5" action="{{ route('accessoriesResults') }}" method="POST">
                @csrf
                <input type="text" class="p-2 rounded-l-full color-txt autoAccessory" name="name" placeholder="szukaj..." style="background-color: #F0F0F0; border: 2px #364F6B solid; outline: none;">
                <button type="submit" class="btn rounded-r-full absolute z-50 color-bg text-gray-100 pr-3 hover:bg-gray-300 hover:text-blue-900" style="padding-top: 10px; padding-bottom: 11px;  border-top: solid 2px #364F6B; border-bottom: solid 2px #364F6B; border-right: solid 2px #364F6B;">
                    <svg class="fill-current" height="20px" width="18px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/></svg>
                </button>
            </form>
        </div>
    </div>
    <hr class="color-bg">

    @if(session('deleted_accessory'))
        <div class="alert alert-success my-3 alert-dismissible fade show">
            {{session('deleted_accessory')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('no_accessories'))
        <div class="alert alert-danger my-3 alert-dismissible fade show" role="alert">
            {{session('no_accessories')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-12 mt-3">
            <h4 class="h4 color-txt mb-3">Ilość akcesoriów: {{ $accessories->count() }}</h4>
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
                        <th scope="col">hurtownia</th>
                        <th scope="col">edytuj</th>
                        <th scope="col">usuń</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($accessories as $accessory)
                    <tr class="color-txt @if($accessory->in_store <= 20 && $accessory->in_store > 0) bg-yellow-300 @elseif($accessory->in_store == 0) bg-red-300 @else bg-gray-100 @endif">
                        <th scope="row">{{ $accessory->id }}</th>
                        <td>{{ $accessory->name }}</td>
                        <td>{{ $accessory->id_wholesale }}</td>
                        <td>{{ $accessory->quantity }}</td>
                        <td>{{ $accessory->brutto_price }} zł</td>
                        <td>{{ $accessory->netto_price }} zł</td>
                        <td>{{ $accessory->price_per_piece }} zł</td>
                        <td>{{ $accessory->in_store }}</td>
                        <td><a href="{{ route('wholesaleShow', ['id' => $accessory->wholesale->id, 'name' => $accessory->wholesale->name]) }}" class="font-bold hover:text-blue-700" style="text-decoration: none">{{ $accessory->wholesale->name }}</a></td>
                        <td class="px-0"><a href="{{ route('editAccessory', ['id' => $accessory->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" class="fill-current text-blue-600 hover:text-blue-700 ml-5" height="20px" width="20px"viewBox="0 0 20 20"><path d="M12.3 3.7l4 4L4 20H0v-4L12.3 3.7zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z"/></svg></a></td>
                        <td class="px-0"><a href="{{ route('deleteAccessory', ['id' => $accessory->id]) }}"><svg class="fill-current text-red-600 hover:text-red-700 ml-5" height="20px" width="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z"/></svg></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
@endsection
