<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- FontAwesome 6.2.0 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap shadow px-3">
        <div class="container">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 ms-4 px-5 px-lg-3 fs-6 " href="#">Company name</a>
            <div class="nav-item dropdown text-white">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">{{__('Dashboard')}}</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-5 sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link ms_nav-link {{Route::currentRouteName() === 'admin.dashboard' ? 'ms_active' : ''}}" href="{{route('admin.dashboard')}}">
                                <span class="align-text-bottom"><i class="fa-solid fa-palette"></i></span>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ms_nav-link {{str_contains(Route::currentRouteName(),'admin.projects') ? 'ms_active' : ''}}" href="{{route('admin.projects.index')}}">
                                <span class="align-text-bottom"><i class="fa-solid fa-pencil"></i></span>
                                Projects
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ms_nav-link {{str_contains(Route::currentRouteName(),'admin.types') ? 'ms_active' : ''}}" href="{{route('admin.types.index')}}">
                                <i class="fa-solid fa-filter"></i></span>
                                Types
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
                    <h1>@yield('name')</h1>
                </div>
                @yield('content')
            </main>
        </div>
    </div>
</body>