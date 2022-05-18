@extends('layout')
@section('title','Se connecter')
@section('section')
<section id="login" class="d-flex row justify-content-center m-2">
        <form class="text-center col-md-4" action="{{route('loginAction')}}" method='POST'>
        @csrf
          <img class="mb-4" src="{{asset('images/logo.png')}}" alt="" width="50" height="auto">
          <h1 class="h3 mb-3 fw-normal">Connectez-Vous</h1>
          <div class="form-floating m-2">
            <input name="name" type="text" class="form-control" id="name" value="{{old('name')}}" oninvalid="this.setCustomValidity('veuillez entrer votre nom et votre mot de passe.')" onchange="this.setCustomValidity('')" required>
            <label for="name">Nom d'utilisateur</label>
            @error('error')
            <span class="text-danger error-text error">{{$message}}</span>
            @enderror
          </div>
          <div class="form-floating m-2">
            <input name="password" type="password" class="form-control" id="password" oninvalid="this.setCustomValidity('veuillez entrer votre nom et votre mot de passe.')" onchange="this.setCustomValidity('')" required >
            <label for="password">Mot de passe</label>
            @error('error')
            <span class="text-danger error-text error">{{$message}}</span>
            @enderror
          </div>
          <button class="w-80 btn btn-lg btn-primary m-2" type="submit">Se Connecter</button>
        </form>
        <a class="text-center"href="{{route('signUp')}}">Nouvel utilisateur ?</a>
      </section>
@endsection