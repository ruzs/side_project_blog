<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
    <title>Blog</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    {{-- JS --}}
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/i18n/zh-TW.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="{{ url('/') }}">BLOG</a>
                <a class="navbar-brand" href="{{ route('shareholder.index') }}">Shareholder</a>
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="navbar-collapse collapse" id="navbarResponsive">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto"></ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item"><a class="nav-link  px-lg-3 py-3 py-lg-4" href="{{ route('home.index') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link  px-lg-3 py-3 py-lg-4" href="{{ route('shareholder.index') }}">Shareholder</a></li>
                        {{-- <li class="nav-item"><a class="nav-link  px-lg-3 py-3 py-lg-4" href="{{ route('index') }}">Sample Post</a></li>
                        <li class="nav-item"><a class="nav-link  px-lg-3 py-3 py-lg-4" href="{{ route('index') }}">Contact</a></li> --}}
                        
                        @guest
                            @if (!request()->route()->getName() =="login")
                            <li class="nav-item">
                                <a class="nav-link  px-lg-3 py-3 py-lg-4" href="{{ route('login') }}">登入/註冊</a>
                            </li>
                            @endif
                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">註冊</a>
                                </li>
                            @endif --}}
                        @else
                        {{-- <li class="nav-item">
                            <a class="nav-link  px-lg-3 py-3 py-lg-4" href="{{ route('logout') }}">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </li> --}}
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle px-lg-3 py-3 py-lg-4" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="after:unset">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item nav-link" href="{{ route('logout') }}" onclick="$('#logout-form').submit();">{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <header class="masthead" style="background-image: url({{@asset($bg)}})">
            {{-- <div class="row justify-content-center"> --}}
                <div class="col-md-10 col-lg-8 col-xl-7 m-auto">
                    <div class="site-heading">
                        <h1>
                            {{-- Eddie's <br> --}}
                            BLOG</h1>
                        <span>
                            <a href="{{route('home.index')}}" class="subheading">
                                Welcome To Here
                            </a>
                        </span>
                    </div>
                </div>
            {{-- </div> --}}
        </header>
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @if (session('success-message'))
        <script>
            toastr.success("{{ session('success-message') }}");
            console.log("1","{{ session('success-message') }}");
            
        </script>
    @elseif (session('success'))
        <script>
            toastr.success("{{ config('messages.SuccessSaving') }}");
            console.log("2","{{ config('messages.SuccessSaving') }}");
            
        </script>
    @endif

    @if (session('error-message'))
        <script>
            toastr.error("{{ session('error-message') }}");
            console.log("3","{{ session('error-message') }}");
            
        </script>
    @elseif ($errors->any())
        <script>
            toastr.error("{{ config('messages.FieldInputError') }}");
            console.log("4","{{ config('messages.FieldInputError') }}");
            
        </script>
    @elseif (session('error'))
        <script>
            toastr.error("{{ config('messages.Error') }}");
            console.log("5","{{ config('messages.Error') }}");
            
        </script>
    @endif
    <script>
    </script>
</body>

</html>
