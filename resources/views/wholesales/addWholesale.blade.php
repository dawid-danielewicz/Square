@extends('layouts.app')

@section('content')
    <h1 class="h1 ml-2 mt-3 inline-block mr-auto" style="color: #364F6B;">Hurtownie - @isset($wholesale->id) edytuj @else dodaj nową @endif</h1>
    <hr class="color-bg">
    <div class="row mt-5 justify-center">
        <div class="col-md-6 layout-shadow px-5 py-3" style="background-color: #F0F0F0; border-radius: 3rem;">
            <h3 class="h3 color-txt">
                @isset($wholesale->id) edytuj @else dodaj nową @endif
            </h3>
            <hr class="color-bg mb-2">
            <div class="col-sm-10 font-bold justify-center">
                <div class="col-sm-12 offset-sm-1">
                    <form action="@isset($wholesale->id) {{ route('updateWholesale', ['id' => $wholesale->id]) }} @else {{ route('createWholesale') }} @endif" method="post">
                        <label class="color-txt mt-2">Nazwa:</label>
                        <input type="text" name="name" class="@error('name') is-invalid @enderror rounded-full form-control" placeholder="nazwa" @isset($wholesale->id) value="{{ $wholesale->name }}"@else value="{{ old('name') }}"@endif>

                        @error('name')
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
