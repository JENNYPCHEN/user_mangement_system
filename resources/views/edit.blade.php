@extends('layout')
@section('title','modifier le compte')
@section('section')
<section="edit" class="d-flex row justify-content-center m-5">
    <form id="user_form" name="user_form"class="text-start col-md-4" action="{{route('editAction', $user->id)}}" method="POST">
        @csrf
        @method('PUT')
        <h1 class="h3 mb-3 fw-normal">Modifier le Compte #{{$user->id}}</h1>
        
        <div class="form-group">
            <label for="name">Nom d'utilisateur</label>
            <input name="name" type="text" class="form-control " id="name" value="{{$user->name}}" required="required">
            <label id="name-error" class="text-danger error" for="name"></label>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>   
        <div class="form-group">
            <label for="email">Adresse email</label>
            <input name="email" type="email" class="form-control" id="email" value="{{$user->email}}" required="required">
            <label id="email-error" class="text-danger error" for="email"></label>
            @error('email')
            <span class="text-danger error-text">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input name="password" type="password" class="form-control" id="password" value="" required="required">
            <label id="password-error" class="text-danger error" for="password"></label>
            @error('password')
            <span class="text-danger error-text ">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirmer Votre Mot de passe</label>
            <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" value="" required="required">
            <label id="password_confirmation-error" class="text-danger error" for="password_confirmation"></label>
            @error('password_confirmation')
            <span class="text-danger error-text ">{{$message}}</span>
            @enderror
        </div>
        <button class="w-80 btn btn-lg btn-primary m-2" type="submit">Sauvegarder</button>
    </form>
</section>

@endsection