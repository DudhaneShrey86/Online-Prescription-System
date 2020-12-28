<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/css/materialize.min.css">
    <link rel="stylesheet" href="/css/login-master-providers.css">

</head>
<body>
  <header>
    <ul class="sidenav" id="side-menu">
      @yield('sidenavoptions')
    </ul>
    <div class="navbar">
      <ul class="dropdown-content" id="userdropdown">
        <li><a href="#">Logout</a></li>
      </ul>
      <nav class="blue darken-2">
        <div class="container nav-wrapper">
          <a href="{{ route('home') }}" class="brand-logo">Logo</a>
          <a href="#!" data-target="side-menu" class="sidenav-trigger"><i class="material-icons">menu</i></a>
          <ul class="right hide-on-med-and-down">
            @yield('topnavoptions')
          </ul>
        </div>
      </nav>
    </div>
  </header>
  <main>
    @yield('content')
  </main>
  <footer></footer>
  <script src="/js/jquery.js" charset="utf-8"></script>
  <script src="/js/materialize.min.js" charset="utf-8"></script>
  <script src="/js/index.js" charset="utf-8"></script>
  <script type="text/javascript">
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  </script>
  @yield('scripts')
</body>
</html>
