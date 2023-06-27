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
                    <h1 class="text-center font-weight-bold">Feature</h1>
                </div>
                <div class="card-body row">
                    <button id='create_post' class="btn btn-success p-2 col-sm-3 col-12 m-1" data-toggle="modal" data-target="#modal-new-post-form"><i class="fa-solid fa-file"></i> New Post</button>
                    <button id='edit_post' class="btn btn-primary p-2 col-sm-3 col-12 m-1" data-toggle="modal" data-target="#modal-edit-post-form"><i class="fa-solid fa-pen-to-square"></i> Edit Post</button>
                    <button id='delete_post' class="btn-delete-event btn btn-outline-secondary p-2 col-sm-3 col-12 m-1"><i class="fa fa-solid fa-trash"></i> Delete</button>
                    <div class="col-12 table-responsive">
                        <table id='edit_table' class="table text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" style="width:10%">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Subtitle</th>
                                    <th scope="col" style="width:10%">Active</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rows as $key => $row)
                                <tr>
                                    <td scope="row">{{$key+1}}</td>
                                    <td>{{$row->title}}</td>
                                    <td>{{$row->subtitle}}</td>
                                    <td><button id='{{$key+1}}' class="btn btn-outline-primary btn-sm m-1 p-2" data-toggle="modal" data-target="#modal-edit-post-form"><i class="fa-solid fa-pen-to-square"></i></button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
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
                        <a href="https://github.com/ruzs" target='_blank'>
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
<script>
    $(document).on('click','#edit_table  tbody tr td button',function () {
        id=$(this).attr('id');
        edit_data()
    });
    function edit_data() {
        $.ajax({
            url: `{{ route('post.data') }}`,
            type: "POST",
            dataType : 'json',
            data:{
                _token: "{{ csrf_token() }}",
                id: id,
            },
            success: function (res) {
                console.log('res',res);
                $('#modal-edit-post-form input[name=title]').val(res.title);
                $('#modal-edit-post-form input[name=subtitle]').val(res.subtitle);
                $('#modal-edit-post-form select[name=category_id]').append(`<option value="${res.category_id}">無分類</option>`);
                // $('#modal-edit-post-form select[name=category_id]').val(res.category_id);
                $('#modal-edit-post-form textarea[name=content]').val(res.content);
            },
            error: function (err) {
                console.log('err',err);
            }
        })
    };
</script>
@endsection
