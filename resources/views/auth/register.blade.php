@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">註冊</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"><span class="required">*</span>{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Name" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right"><span class="required">*</span>{{ __('E-Mail Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-mail" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="form-group row">
                                <label for="account" class="col-md-4 col-form-label text-md-right"><span class="required">*</span>Account</label>
                                <div class="col-md-6">
                                    <input id="account" type="text" class="form-control @error('account') is-invalid @enderror" name="account" placeholder="Account" required autocomplete="new-account">
                                    @error('account')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right"><span class="required">*</span>{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <input type="checkbox" class="col-md-2" style="max-width:20px" onclick="showPassword()">
                            </div>
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right"><span class="required">*</span>{{ __('Confirm Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                                </div>
                                <input type="checkbox" class="col-md-2" style="max-width:20px" onclick="showPasswordConfirmation()">
                            </div>
                            <div class="form-group row">
                                <label for="role"class="col-md-4 col-form-label text-md-right"><span class="required">*</span>Role</label>
                                <div class="col-md-6">
                                    <select id="role" class="form-control" name="role">
                                        @foreach ($user_roles as$key => $role)
                                        <option value="{{$role->id}}" >{{$role->name}}-{{$role->guard_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <label for="friend_code" class="col-md-4 col-form-label text-md-right">Friend code</label>
                                <div class="col-md-6">
                                    <input id="friend_code" type="text" class="form-control @error('friend_code') is-invalid @enderror" name="friend_code" placeholder="Friend code" autocomplete="friend_code">
                                    @error('friend_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        註冊
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // 顯示密碼
        $("#role").val(3)
    function showPassword() {
        let type = $("input[name='password']").attr('type');
        
        if (type ==='password') {
            $("input[name='password']").attr('type', 'text');
        } else {
            $("input[name='password']").attr('type', 'password');
        }
    }
// 顯示確認密碼
    function showPasswordConfirmation() {
        let type2 = $("input[name='password_confirmation']").attr('type');

        if (type2 ==='password') {
            $("input[name='password_confirmation']").attr('type', 'text');
        } else {
            $("input[name='password_confirmation']").attr('type', 'password');
        }
    }
    </script>
@endsection
