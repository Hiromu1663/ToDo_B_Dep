{{-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head> --}}

{{-- welcomeページから引用 --}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <div id="app">
      <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
          <div class="container">
              <a class="navbar-brand" href="{{ url('/') }}">
                  {{-- {{ config('app.name', 'Laravel') }} --}}
                  ToDoXpress
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                  <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <!-- Left Side Of Navbar -->
                  <ul class="navbar-nav me-auto">
                  </ul>

                  <!-- Right Side Of Navbar -->
                  <ul class="navbar-nav ms-auto">
                      <!-- Authentication Links -->
                      {{-- @if (Route::has('login'))
                      <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                          @auth
                              <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline" style="text-decoration: none;">Home</a>
                          @else
                              <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline" style="text-decoration: none;">Log in</a>
      
                              @if (Route::has('register'))
                                  <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline" style="text-decoration: none;">Register</a>
                              @endif
                          @endauth
                      @else
                          <li class="nav-item dropdown">
                              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  {{ Auth::user()->name }}
                              </a>
                          </div>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                                  {{ __('Logout') }}
                                  </a>
                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                      @csrf
                                  </form>
                              </div>
                          </li>
                      @endguest --}}
                      <div class="header-right">
                        <div class="dropdown nav">
                          <div class="profile-icon">
                            <a href="{{ route('showProfile', Auth::user()->id )}}"><img src="{{ asset('storage/images/'.Auth::user()->avatar) }}" alt=""></a>
                          </div>
                          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none; color: black;">
                          {{ Auth::user()->name }}
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('welcome', ['user_id' => Auth::user()->id]) }}" onclick="event.preventDefault();
                              document.getElementById('go-welcome').submit();">{{ __('Top Page') }}</a></li>
                            <form id="go-welcome" action="{{ route('welcome', ['user_id' => Auth::user()->id]) }}" method="GET" class="d-none">
                              @csrf
                            </form>      
                            <li><a class="dropdown-item" href="{{ route('tasks.index', Auth::user()->id )}}" onclick="event.preventDefault();
                              document.getElementById('go-index').submit();">{{ __('My Tasks') }}</a></li>
                            <form id="go-index" action="{{ route('tasks.index', Auth::user()->id )}}" method="GET" class="d-none">
                              @csrf
                            </form>
                            <li><a class="dropdown-item" href="{{ route('indexBookmark', Auth::user()->id )}}" onclick="event.preventDefault();
                              document.getElementById('go-bookmark').submit();">{{ __('Bookmarks') }}</a></li>
                            <form id="go-bookmark" action="{{ route('indexBookmark', Auth::user()->id )}}" method="GET" class="d-none">
                              @csrf
                            </form>
                            <li><a class="dropdown-item" href="{{ route('showProfile', Auth::user()->id )}}" onclick="event.preventDefault();
                              document.getElementById('go-profile').submit();">{{ __('My Page') }}</a></li>
                            <form id="go-profile" action="{{ route('showProfile', Auth::user()->id )}}" method="GET" class="d-none">
                              @csrf
                            </form>
                            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">{{ __('Log out') }}</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                            </form>
                          </ul>
                        </div>
                        </div>
                  </ul>
              </div>
          </div>
      </nav>

      <main class="py-4">
          @yield('content')
      </main>
      <footer class="navbar navbar-expand-md navbar-light bg-white shadow-sm2" >
        <span style="display: inline-block; padding:8px 0; ">Copyright &copy; Bteam Inc.</span>
      </footer>      
  </div>
</body>
</html>


{{-- 以下コメントアウトのfooterを引用すると、headerメニューに干渉する為一旦なし --}}


{{-- <body>
  <header>
    <div class="header-left">
      <h1>ToDo</h1>
    </div>
    <div class="header-right">
    <div class="dropdown nav">
      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
      {{ Auth::user()->name }}
      </a>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <li><a class="dropdown-item" href="{{ route('welcome', ['user_id' => Auth::user()->id]) }}" onclick="event.preventDefault();
          document.getElementById('go-welcome').submit();">{{ __('トップページ') }}</a></li>
        <form id="go-welcome" action="{{ route('welcome', ['user_id' => Auth::user()->id]) }}" method="GET" class="d-none">
          @csrf
        </form>      
        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
        <li><a class="dropdown-item" href="{{ route('tasks.index', Auth::user()->id )}}" onclick="event.preventDefault();
          document.getElementById('go-index').submit();">{{ __('タスク一覧') }}</a></li>
        <form id="go-index" action="{{ route('tasks.index', Auth::user()->id )}}" method="GET" class="d-none">
          @csrf
        </form>
        <li><a class="dropdown-item" href="{{ route('indexBookmark', Auth::user()->id )}}" onclick="event.preventDefault();
          document.getElementById('go-bookmark').submit();">{{ __('ブックマーク') }}</a></li>
        <form id="go-bookmark" action="{{ route('indexBookmark', Auth::user()->id )}}" method="GET" class="d-none">
          @csrf
        </form>
        <li><a class="dropdown-item" href="{{ route('showProfile', Auth::user()->id )}}" onclick="event.preventDefault();
          document.getElementById('go-profile').submit();">{{ __('マイページ') }}</a></li>
        <form id="go-profile" action="{{ route('showProfile', Auth::user()->id )}}" method="GET" class="d-none">
          @csrf
        </form>
      </ul>
    </div>
    </div>
  </header>
  @yield('content')
  <footer>
    Copyright &copy; Bteam Inc.
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
</body>
</html> --}}
