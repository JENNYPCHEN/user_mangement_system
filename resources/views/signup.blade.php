@extends('layout')
@section('title','créer un compte')
@section('section')
<section="edit" class="d-flex row justify-content-center m-5">
    <form id="user_form" name="user_form"class="text-center col-md-4" action="" method="POST">
        @csrf

        <h1 class="h3 mb-3 fw-normal">Créer un compte</h1>
        <div class="form-floating m-2">
            <input name="name" type="text" class="@error('name') is-invalid @enderror form-control" id="name" value="{{old('name')}}" required="required">
            <label for="name">Nom d'utilisateur</label>
            @error('name')
              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-floating m-2">
            <input name="email" type="email" class="form-control" id="email" value="{{old('email')}}" required="required">
            <label for="email">Adresse email</label>
            @error('email')
            <span class="text-danger error-text">{{$message}}</span>
            @enderror
        </div>
        <div class="form-floating m-2">
            <input name="password" type="password" class="form-control" id="password" value="{{old('password')}}" required="required">
            <label for="password">Mot de passe</label>
            @error('password')
            <span class="text-danger error-text ">{{$message}}</span>
            @enderror
        </div>
        <div class="form-floating m-2">
            <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" value="{{old('password_confirmation')}}" required="required">
            <label for="password_confirmation">Confirmer Votre Mot de passe</label>
            @error('password_confirmation')
            <span class="text-danger error-text ">{{$message}}</span>
            @enderror
        </div>
        <button class="w-80 btn btn-lg btn-primary m-2" type="submit">Sauvegarder</button>
    </form>
</section>

@endsection