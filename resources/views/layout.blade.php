<html lang="fr">

<head>
  <title>la gestion de comptes: @yield('title')</title>
  <link rel="icon" href="{{asset('images/logo.png')}}" type="image/png" class="rounded" />
  <meta name="description" content="la gestion de comptes" />
  <meta name="robots" content="all,follow" />
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap cdn -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <!-- Boxicon cdn -->
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
  <!-- main css -->

</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="/"><img class="img-fluid rounded" width="50" height="auto" src="{{asset('images/logo.png')}}" /></a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <!--public user nav-->
            <li class="nav-item">
              <a class="nav-link" href="/">Accueil</a>
            </li>
            @guest
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="{{route('login')}}">Se Connecter</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('signUp')}}">Inscription</a>
            </li>
            @endguest
            @auth
            <!--admin-->
            @if(auth()->user()->is_admin===1)
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="{{route('dashboard')}}">gérer les comptes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="{{route('signUp')}}">créer un compte</a>
            </li>
            <li class="nav-item">
              <form id="logout" class="nav-link" method="POST" action="{{route('logout')}}">
                @csrf
                <button class="btn btn-primary btn-sm" type="submit">
                  se déconnecter
                </button>
              </form>
            </li>
            @else
            <!--user-->
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="{{route('dashboard')}}">votre compte</a>
            </li>
            <li class="nav-item">
              <form id="logout" class="nav-link" method="POST" action="{{route('logout')}}">
                @csrf
                <button class="btn btn-primary btn-sm" type="submit">
                  se déconnecter
                </button>
              </form>
            </li>
            @endif
            @endauth
          </ul>
        </div>
      </div>
    </nav>
    @if(session()->has('message'))
    <!--flash message-->
    <div class="alert alert-primary alert-dismissible fade show container" role="alert">
      {{session('message')}}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
  </header>
  <main class="container">

    @yield('section')
  </main>
</body>
<!--jquery cdn-->
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script> <!-- main js-->

  <!-- bootstrap cdn -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script> <!-- main js-->

<!-- main js-->
<script src="{{route('index')}}/js/all.js"></script>

</html>