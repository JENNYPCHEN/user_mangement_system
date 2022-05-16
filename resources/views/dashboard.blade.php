@extends('layout')
@section('title','tableau de bord')
@section('section')
<section="dashboard" class="d-flex row justify-content-center m-2">
  <h2 class="my-3">Gestion de comptes</h2>
  @auth <h4 class="my-3 mb-5">Bienvenue {{auth()->user()->name }}</h4>@endauth
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nom d'utilisateur</th>
        <th scope="col">Adresse Email</th>
        <th scope="col">Gestion</th>
      </tr>
    </thead>
    <tbody>
      @if(auth()->user()->is_admin===1)
      @foreach($profiles as $profile)
      <tr>
        <th scope="row">{{$profile->id}}</th>
        <td>{{$profile->name}}</td>
        <td>{{$profile->email}}</td>
        <td>
          <button href="" type="button" class="btn btn-primary" title="midifier"><i class='bx bxs-edit-alt '></i></button>
          <button href="" type="button" class="btn btn-danger" title="supprimer" onclick="return confirm('Vous êtes sûr de vouloir supprimer le compte?')"><i class='bx bx-message-square-x'></i></button>
          <button href="" type="button" class="btn btn-danger" title="supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer définitivement le compte ?(vous ne pourrez pas restaurer les données) ')"><i class='bx bxs-message-square-x'></i></button>
        </td>
      </tr>
      @endforeach
      @else
      <tr>
        <th scope="row">{{$profiles->id}}</th>
        <td>{{$profiles->name}}</td>
        <td>{{$profiles->email}}</td>
        <td>
          <button href="" type="button" class="btn btn-primary" title="midifier"><i class='bx bxs-edit-alt '></i></button>
          <button href="" type="button" class="btn btn-danger" title="supprimer" onclick="return confirm('Vous êtes sûr de vouloir supprimer le compte?')"><i class='bx bx-message-square-x'></i></button>

        </td>
        @endif
    </tbody>
  </table>
  </section>

  @endsection