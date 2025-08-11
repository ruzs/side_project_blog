<body>
  <div id="app">
      <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
          <div class="container px-4 px-lg-5">
              <a class="navbar-brand" href="{{ url('/') }}">BLOG</a>
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
                      <li class="nav-item"><a class="nav-link  px-lg-3 py-3 py-lg-4" href="{{ route('index') }}">Home</a></li>
                      <li class="nav-item"><a class="nav-link  px-lg-3 py-3 py-lg-4" href="{{ route('index') }}">About</a></li>
                      <li class="nav-item"><a class="nav-link  px-lg-3 py-3 py-lg-4" href="{{ route('index') }}">Sample Post</a></li>
                      <li class="nav-item"><a class="nav-link  px-lg-3 py-3 py-lg-4" href="{{ route('index') }}">Contact</a></li>
                      @guest
                          @if (!request()->route()->getName() =='login')
                          <li class="nav-item">
                              <a class="nav-link  px-lg-3 py-3 py-lg-4" href="{{ route('login') }}">登入</a>
                          </li>
                          @endif
                          {{-- @if (Route::has('register'))
                              <li class="nav-item">
                                  <a class="nav-link" href="{{ route('register') }}">註冊</a>
                              </li>
                          @endif --}}
                      @else
                      <li class="nav-item">
                          <a class="nav-link  px-lg-3 py-3 py-lg-4" href="{{ route('logout') }}">{{ __('Logout') }}</a>
                          {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form> --}}
                      </li>
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

      <header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
          <div class="row gx-4 gx-lg-5 justify-content-center">
              <div class="col-md-10 col-lg-8 col-xl-7">
                  <div class="site-heading">
                      <h1>Eddie's BLOG</h1>
                      <span><a href="{{route('home')}}" class="subheading">Welcome To Here</a></span>
                  </div>
              </div>
          </div>
      </header>
          <main class="py-4">
              @yield('content')
          </main>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('js/scripts.js')}}"></script>
</body>