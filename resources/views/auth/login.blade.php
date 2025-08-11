@extends('layouts.app')

@section('content')
<style>
    
    .form-group.row input::placeholder {
        color: #aaa;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">登入</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="account" class="col-md-4 col-form-label text-md-right"><span class="required">*</span>Account</label>
                            <div class="col-md-6">
                                <input id="account" type="text" class="form-control @error('account') is-invalid @enderror" name="account" value="{{ old('account') }}" placeholder="Account" required autocomplete="account" autofocus>
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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input type="checkbox" class="col-md-2" style="max-width:20px" onclick="showPassword()">
                        </div>

                        @if (count($errors))
                        <div class="form-group row justify-content-end">
                            <div class="col-md-9">
                                <span class="m-auto required" style="font-size: 16px">{{$errors? $errors:''}}</span>
                            </div>
                        </div>
                        @endif

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary p-2 col-auto">登入</button>

                                {{-- @if (Route::has('password.request'))
                                    <a id=fpf class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}
                                @if (Route::has('register'))
                                    <a class="btn btn-success btn-sm float-right mt-2" href="{{ route('register') }}">註冊</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showPassword() {
        let type = $("input[name='password']").attr('type');
        
        if (type ==='password') {
            $("input[name='password']").attr('type', 'text');
        } else {
            $("input[name='password']").attr('type', 'password');
        }
    }
    fpfHTML = $('#fpf').attr('href');
    $('#fpf').attr('href',fpfHTML+'?token='+$("input[name='_token']").val())
</script>
@endsection