@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-8 col-xl-9">
            <h1 class="h1 ml-2 mr-5 mt-3 inline-block" style="color: #364F6B;">Notatki</h1>
            <a href="{{ route('addNote') }}" class="btn btn-success text-light mb-3 ml-2 mt-1 inline-block">Dodaj nową notatkę</a>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 col-xl-3">
            <form class="inline-block relative mt-4 mb-2 ml-2 lg:ml-12 lg:pl-8" action="{{ route('noteResult') }}" method="POST">
                @csrf
                <input type="text" class="p-2 rounded-l-full color-txt autoNote" name="name" placeholder="szukaj..." style="background-color: #F0F0F0; border: 2px #364F6B solid; outline: none;">
                <button type="submit" class="btn rounded-r-full absolute z-50 color-bg text-gray-100 pr-3 hover:bg-gray-300 hover:text-blue-900" style="padding-top: 10px; padding-bottom: 11px;  border-top: solid 2px #364F6B; border-bottom: solid 2px #364F6B; border-right: solid 2px #364F6B;">
                    <svg class="fill-current" height="20px" width="18px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/></svg>
                </button>
            </form>
        </div>
    </div>
    <hr class="color-bg">

    @if(session('no_notes'))
        <div class="alert alert-danger my-3 alert-dismissible fade show" role="alert">
            {{session('no_notes')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row mt-3 justify-center">
        @foreach($notes as $note)
            <div class="col-sm-6 col-md-4">
                <div class="card mb-3">
                    <div class="card-header color-bg text-white">
                        <div class="row">
                            <div class="col-md-9 col-xl-10">
                                {{ $note->name }}
                            </div>
                            <div class="col-md-3 col-xl-2 p-0">
                               <a href="{{ route('editNote', ['id' => $note->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" class="fill-current text-gray-100 hover:text-gray-300 inline-block ml-3 mr-2" height="20px" width="20px"viewBox="0 0 20 20"><path d="M12.3 3.7l4 4L4 20H0v-4L12.3 3.7zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z"/></svg></a>
                               <a href="{{ route('deleteNote', ['id' => $note->id]) }}" onclick="return confirm('Czy napewno chcesz usunać notatkę?')"><svg class="fill-current text-gray-100 hover:text-gray-300 inline-block" height="20px" width="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z"/></svg></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-gray-100 color-txt">
                        <p class="card-text">{{ $note->content }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row justify-center">
        <div class="col-sm-4 offset-sm-2 my-4">
            {{ $notes->links() }}
        </div>
    </div>
@endsection
