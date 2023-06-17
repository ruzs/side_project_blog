@extends('layouts.app')

@include('posts.post_form')

{{-- @section('modal')
@yield('post-form-modal')
@yield('reminder-form-modal')
@yield('reminder-view-modal')
@yield('task-form-modal')
@endsection --}}

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center text-primary" >{{ Auth::user()->name }}</h1>
                    <h1 class="text-center" > Welcom to BLOG </h1>
                </div>
                <div class="card-body">
                    {{ __('Dashboard') }}<br>
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    {{ __('You are logged in!') }}
                </div>
            </div>
            <div class="card my-2">
                <div class="card-header">
                    <h1 class="text-center font-weight-bold">功能區</h1>
                </div>
                <div class="card-body row">
                    <button class="btn btn-success p-2 col-sm-3 col-12" data-toggle="modal" data-target="#modal-post-form">New Post</button>
                </div>
            </div>
                {{-- @dd(session()) --}}
        </div>
    </div>
</div>
@endsection
