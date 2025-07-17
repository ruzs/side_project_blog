@extends('layouts.app')

@include('posts.post_form')
@include('categories.category_form')
@include('users.user_form')

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
            <div class="card shadow-sm">
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
            <div class="card my-2 shadow-sm">
                <div class="card-header">
                    <h1 class="text-center font-weight-bold">Feature</h1>
                </div>
                <div class="card-body row">
                    <div class="col-sm-3 col-12">
                        <button id='create_post' class="btn btn-success p-2  col-12 m-1" data-toggle="modal" data-target="#modal-new-post-form"><i class="fa-solid fa-file"></i> New Post</button>
                    </div>
                    <div class="col-sm-3 col-12">
                        <button id='edit_post' class="btn btn-primary p-2 col-12 m-1" data-toggle="modal" data-target="#modal-all-post-form"><i class="fa-solid fa-pen-to-square"></i> Edit Post</button>
                    </div>
                    <div class="col-sm-3 col-12">
                        <button id='create_category' class="btn btn-success p-2 col-12 m-1" data-toggle="modal" data-target="#modal-new-category-form"><i class="fa-solid fa-file"></i> New Category</button>
                    </div>
                    <div class="col-sm-3 col-12">
                        <button id='edit_category' class="btn btn-primary p-2 col-12 m-1" data-toggle="modal" data-target="#modal-all-category-form"><i class="fa-solid fa-pen-to-square"></i> Edit Category</button>
                    </div>
                    @if(auth()->user()->id == 1)
                    <div class="col-sm-3 col-12">
                        <button id='create_user' class="btn btn-success p-2 col-12 m-1" data-toggle="modal" data-target="#modal-new-user-form"><i class="fa-solid fa-file"></i> New User</button>
                    </div>
                    @endif
                    <div class="col-sm-3 col-12">
                        <button id='edit_user' class="btn btn-primary p-2 col-12 m-1" data-toggle="modal" data-target="#modal-all-user-form"><i class="fa-solid fa-pen-to-square"></i> Edit User</button>
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
    // Post Edit
    $(document).on('click','table tbody tr td .post_edit_btn',function () {
        // 表單網址
        $('#modal-edit-post-form form').attr('action',$(this).data('url'));
        post_edit_data($(this).attr('data-id'))
    });
    // reset 分類select
    $('#edit_post_close , #edit_post_close_top').on('click',function(){
        $('#select_edit_category').empty()
    })
    // 刪除鍵
    $('#edit_post_delete').on('click',function () {
        $('input[name=title]').after(`<input name="delete" type="hidden" class="form-control" placeholder="Title" type="int" value="1">`);
    });
    $('input[value=Submit]').on('click',function () {
        $('input[name=delete]').remove();
    });

    // Category Edit
    $(document).on('click','table tbody tr td .category_edit_btn',function () {
        // 表單網址
        $('#modal-edit-category-form form').attr('action',$(this).data('url'));
        category_edit_data($(this).attr('data-id'))
    });
    // 刪除鍵
    $('#edit_post_delete').on('click',function () {
        $('input[name=title]').after(`<input name="delete" type="hidden" class="form-control" placeholder="Title" type="int" value="1">`);
    });

    $('input[value=Submit]').on('click',function () {
        $('input[name=delete]').remove();
    });

    // User Edit
    $(document).on('click','table tbody tr td .user_edit_btn',function () {
        // 表單網址
        $('#modal-edit-user-form form').attr('action',$(this).data('url'));
        user_edit_data($(this).attr('data-id'))
    });

    function post_edit_data(id=null) {
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
                $('#modal-edit-post-form input[name=title]').val(res.row.title);
                $('#modal-edit-post-form input[name=subtitle]').val(res.row.subtitle);
                $('#modal-edit-post-form select[name=category_id]').append(`<option value="0">無分類</option>`);
                $.each(res.categories,function (index,value) {
                    $('#modal-edit-post-form select[name=category_id]').append(`<option value="${value.id}">${value.title}</option>`);
                })
                if (res.row.category_id) {
                    $(`#modal-edit-post-form select[name=category_id] option[value=${res.row.category_id}]`).attr('selected',1)
                }else{
                    console.log('無分類');
                }
                $('#modal-edit-post-form textarea[name=content]').val(res.row.content);
            },
            error: function (err) {
                console.log('err',err);
            }
        })
    };
    
    function category_edit_data(id=null) {
        $.ajax({
            url: `{{ route('category.data') }}`,
            type: "POST",
            dataType : 'json',
            data:{
                _token: "{{ csrf_token() }}",
                id: id,
            },
            success: function (res) {
                console.log('res',res);
                $('#modal-edit-category-form input[name=title]').val(res.title);
            },
            error: function (err) {
                console.log('err',err);
            }
        })
    };
    function user_edit_data(id=null) {
        $('#modal-edit-user-form input[name=name]').val("");
        $('#modal-edit-user-form input[name=account]').val("");
        $('#modal-edit-user-form input[name=password]').val("");
        $('#modal-edit-user-form input[name=password_confirmation]').val("");
        $.ajax({
            url: `{{ route('user.data') }}`,
            type: "POST",
            dataType : 'json',
            data:{
                _token: "{{ csrf_token() }}",
                id: id,
            },
            success: function (res) {
                console.log('res',res);
                $('#modal-edit-user-form input[name=name]').val(res.name);
                $('#modal-edit-user-form input[name=account]').val(res.account);
            },
            error: function (err) {
                console.log('err',err);
            }
        })
    };
</script>
@endsection
