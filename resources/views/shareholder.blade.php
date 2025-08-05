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
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <style>
        header.masthead{
            height: 100px;!important
            
            padding-top: 50px;!important
            padding-bottom: 50px;!important
        }
    </style>
</head>
{{-- @dd("shareholders",$shareholders) --}}
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="{{ url('/') }}">Shareholder</a>
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
                        <li class="nav-item"><a class="nav-link  px-lg-3 py-3 py-lg-4" href="{{ route('shareholder.index') }}">Chat</a></li>
                        {{-- <li class="nav-item"><a class="nav-link  px-lg-3 py-3 py-lg-4" href="{{ route('index') }}">Sample Post</a></li>
                        <li class="nav-item"><a class="nav-link  px-lg-3 py-3 py-lg-4" href="{{ route('index') }}">Contact</a></li> --}}
                        {{-- @dd(request()->route()->getName()) --}}
                        @guest
                            <li class="nav-item">
                                <a class="nav-link  px-lg-3 py-3 py-lg-4" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                        {{-- <li class="nav-item">
                            <a class="nav-link  px-lg-3 py-3 py-lg-4" href="{{ route('logout') }}">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </li> --}}
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle px-lg-3 py-3 py-lg-4" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="after:unset">
                                {{ auth()->user()->name }}
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
                            Shareholder
                        </h1>
                    </div>
                </div>
            {{-- </div> --}}
        </header>
        <main class="py-4">
            @yield('content')
            <div class="flex-center position-ref full-height">
            <!-- Main Content-->
                <div class="container px-4 px-lg-5">
                    <div class="row gx-4 gx-lg-5 justify-content-center">
                        <div class="col-12 table-responsive">
                            <h1 class="col-12 text-center fz-5">中雀電動麻將桌股東大會</h1>
                            <h1 class="col-12 text-center">本月積分</h1>
                            <table id='user_edit_table' class="table text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" style="width:10%">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Point</th>
                                        <th scope="col">Money</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (@$shareholders)
                                    @php
                                        $rank_number = 0
                                    @endphp
                                    @foreach ($shareholders->sortByDesc('month_point') as $key => $shareholder)
                                    @if (count($shareholder->hasRoles) != 0)
                                    <tr>
                                        <td scope="row" class="font-weight-bold">{{$rank_number+=1}}</td>
                                        <td class="">{{$shareholder->name}}</td>
                                        <td class="">{{$shareholder->month_point}}</td>
                                        <td class="">{{$shareholder->month_point*5}}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    
                                    @else
                                    <tr>
                                        <td colspan='4'>
                                            <a href="javascript:void(0)" class="nav-link disabled">Your point not found</a>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>

                            <h1 class="col-12 text-center text-primary">目前總積分</h1>
                            <table id='user_edit_table' class="table text-center">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th scope="col" style="width:10%">#</th>
                                        <th scope="col fw-bold">Name</th>
                                        <th scope="col">Point</th>
                                        <th scope="col">Money</th>
                                    </tr>
                                </thead>
                                <tbody class="text-primary">
                                    @if (@$shareholders)
                                    @php
                                        $rank_number = 0
                                    @endphp
                                    @foreach ($shareholders->sortByDesc('total_point')  as $key => $shareholder)
                                    @if (count($shareholder->hasRoles) != 0)
                                    <tr>
                                        <td scope="row" class="font-weight-bold">{{$rank_number+=1}}</td>
                                        <td class="">{{$shareholder->name}}</td>
                                        <td class="">{{$shareholder->total_point}}</td>
                                        <td class="">{{$shareholder->total_point*5}}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    
                                    @else
                                    <tr>
                                        <td colspan='4'>
                                            <a href="javascript:void(0)" class="nav-link disabled">Your point not found</a>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            <h1 class="col-12 text-center text-success">上月積分</h1>
                            <table id='user_edit_table' class="table text-center">
                                <thead class="bg-success text-white">
                                    <tr>
                                        <th scope="col" style="width:10%">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Point</th>
                                        <th scope="col">Money</th>
                                    </tr>
                                </thead>
                                <tbody class="text-success">
                                    @if (@$shareholders)
                                    @php
                                        $rank_number = 0
                                    @endphp
                                    @foreach ($shareholders->sortByDesc('last_month_point')  as $key => $shareholder)
                                    @if (count($shareholder->hasRoles) != 0)
                                    <tr>
                                        <td scope="row" class="font-weight-bold">{{$rank_number+=1}}</td>
                                        <td class="">{{$shareholder->name}}</td>
                                        <td class="">{{$shareholder->last_month_point}}</td>
                                        <td class="">{{$shareholder->last_month_point*5}}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    
                                    @else
                                    <tr>
                                        <td colspan='4'>
                                            <a href="javascript:void(0)" class="nav-link disabled">Your point not found</a>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        @if(auth()->user())
                        <hr>
                        <div class="col-12 row justify-content-center">
                            <h1 class="col-12 text-center text-danger">此次積分</h1>
                            <h2 class="col-12 text-center text-secondary">底:2點 台:1點</h2>
                            {{-- <button id="add_guest"class="btn btn-lg btn-primary col-6 col-sm-3 fs-1">+</button> --}}
                            <form id="point" action="{{route('shareholder.store')}}" method="post" class="flex-wrap py-4 text-danger">
                                @csrf
                                @foreach ($shareholders as $key=> $shareholder)
                                <div class="input-group col-12 row player flex-wrap my-2">
                                    <div class="col-12 row">
                                        <label for="point{{$shareholder->id}}" class="col-6 text-right">{{$shareholder->name}} :</label>
                                        <input type="number" name="point{{$shareholder->id}}" id="point{{$shareholder->id}}" class="col-6">
                                    </div>
                                    <hr class="mt-2">
                                </div>
                                @endforeach
                                {{-- <div class="row col-12 guest">
                                    <div class="input-group col-12 row flex-wrap my-2">
                                        <div class="col-12 row">
                                            <label for="guest0" class="col-6 text-right">名 :</label>
                                            <input type="text" name="guest0" id="guest0" class="col-6">
                                        </div>
                                    </div>
                                    <div class="input-group col-12 row flex-wrap my-2">
                                        <div class="col-12 row mt-2">
                                            <label for="guest_point0" class="col-6 text-right">分 :</label>
                                            <input type="number" name="guest_point0" id="guest_point0" class="col-6">
                                        </div>
                                    </div>
                                    <hr class="mt-2">
                                </div> --}}
                                <div class="row justify-content-between">
                                    <input type="text" name="count" class="h-50 my-auto col-4">
                                    <button class="btn btn-primary col-6">Submit ( 提交 )</button>
                                </div>
                            </form>
                        </div>
                        @else
                        <h2 class="col-12 text-center">登記積分，請先右上角登入</h2>
                        @endif
                        <a href="http://atawmj.org.tw/mjking.htm" target="black" class="btn btn-lg btn-success">台數算法</a>
                        @if (session('error'))
                            <h1 class="text-danger">登記失敗，原因：{{ session('error') }}</h1>
                        @endif
                    </div>
                </div>
                <!-- Footer-->
                <footer class="border-top">
                    <div class="container px-4 px-lg-5">
                        <div class="row gx-4 gx-lg-5 justify-content-center">
                            <div class="col-md-10 col-lg-8 col-xl-7">
                                <div class="small text-center text-muted fst-italic">Copyright &copy; Your Shareholder Website {{date('Y')}}</div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </main>
    </div>

    {{-- @if (session('success-message'))
        <script>
            toastr.success("{{ session('success-message') }}");
        </script>
    @elseif (session('success'))
        <script>
            toastr.success("{{ config('messages.SuccessSaving') }}");
        </script>
    @endif

    @if (session('error-message'))
        <script>
            toastr.error("{{ session('error-message') }}");
            console.log(20);
        </script>
    @elseif ($errors->any())
        <script>
            toastr.error("{{ config('messages.FieldInputError') }}");
            console.log(30);
        </script>
    @elseif (session('error'))
        <script>
            toastr.error("{{ config('messages.Error') }}");
            console.log(40);
        </script>
    @endif --}}
    <script>
        let guestCount = 0
        $("#add_guest").on("click",function () {
            // $(".player").last().clone().insertAfter($(".player").last()).find("input").val('')
            guestCount++;
            let $last = $(".guest").last();
            let $clone = $last.clone();

            // 更新 input 的 id 和清空值
            $clone.find('input[type="text"]').attr('id', 'guest' + guestCount).val('').attr('name', 'guest' + guestCount).val('');
            $clone.find('input[type="number"]').attr('id', 'point' + guestCount).val('').attr('name', 'point' + guestCount).val('');

            // 更新 label 的 for 屬性
            $clone.find('label[for^="guest"]').attr('for', 'guest' + guestCount);
            $clone.find('label[for^="point"]').attr('for', 'point' + guestCount);

            $clone.insertAfter($last);
        })
    </script>
</body>

</html>
