@extends('layouts.app')
@section('content')
    <div class="flex-center position-ref full-height">
            <!-- Main Content-->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    @foreach ($rows as $row)
                    <!-- Post preview-->
                    <div class="post-preview">
                        <a href="{{route('home.show',$row->id)}}">
                            <h2 class="post-title">{{$row->title}}</h2>
                            <h3 class="post-subtitle">{{$row->subtitle}}</h3>
                        </a>
                        <p class="post-meta">
                            Posted by 
                            <a href="#!" class="font-weight-bold"> {{$row->creator->name}} </a> 
                            {{date('M d, Y',strtotime($row->created_at))}}
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4">
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Footer-->
        <footer class="border-top">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://github.com/ruzs">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="small text-center text-muted fst-italic">Copyright &copy; Your Website {{date('Y')}}</div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection

