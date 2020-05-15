@extends('layouts.app')

@section('content')
    <h1 class="h1 ml-2 my-3 inline-block mr-auto" style="color: #364F6B;">Edytuj konto</h1>
    <hr class="color-bg">
    <div class="row mt-5 justify-center">
        <div class="col-md-6 layout-shadow px-5 py-3" style="background-color: #F0F0F0; border-radius: 3rem;">
            <h3 class="h3 color-txt">
                edytuj
            </h3>
            <hr class="color-bg mb-2">
            <div class="col-sm-10 font-bold justify-center">
                <div class="col-sm-12 offset-sm-1">
                    <form action="{{ route('updateUser') }}" method="post">
                        <label class="color-txt mt-2">Imię:</label>
                        <input type="text" name="name" class="@error('name') is-invalid @enderror rounded-full form-control" placeholder="nazwa" value="{{ $user->name }}">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror

                        <label class="color-txt mt-2">Nazwisko:</label>
                        <input type="text" name="surname" class="@error('surname') is-invalid @enderror rounded-full form-control" placeholder="surnazwa" value="{{ $user->surname }}">

                        @error('surname')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror

                        <label class="color-txt mt-2">Email:</label>
                        <input type="email" name="email" class="@error('email') is-invalid @enderror rounded-full form-control" placeholder="email" value="{{ $user->email }}">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror

                        <label class="color-txt mt-2">Hasło:</label>
                        <input type="password" name="password" class="@error('password') is-invalid @enderror rounded-full form-control">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror

                        <label for="password-confirm" class="color-txt mt-2">Potwierdź hasło:</label>
                        <input id="password-confirm" type="password" class="rounded-full form-control" name="password_confirmation" autocomplete="new-password">


                        @csrf
                        <input type="submit" value="Potwierdź" class="btn color-bg text-white my-2">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
