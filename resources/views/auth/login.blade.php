@extends('layouts.main')

@section('content')
	
<body style="overflow: hidden; height:100%">
	<div id="login" class="wrapper wrapper-login" style="background: linear-gradient(270deg, #007bff, #6610f2);">
        <div class="row d-flex justify-content-center align-items-center" style="min-height:100vh !important">
            <div class="container container-login animated fadeIn" style="height:auto; width:500px; box-shadow: 2px 2px 10px #999; border-radius:5px; padding:2rem 2rem 40px 2rem; background:#fff; margin:1rem 1rem 1rem 1rem">
                <h3 class="text-center mt-2" style="font-size: 32px; font-weight:600">Login</h3>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="login-form">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input id="email" type="email" name="email" class="form-control mb-0" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Your email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control mb-0" id="password" type="password" name="password" required autocomplete="current-password" placeholder="Your password">
                        </div>
                        <div class="form-group" style="position: relative">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="position: absolute; left:30px">
                            <label class="form-check-label" for="remember" style="position: absolute; left:30px">Remember Me</label>
                            </div>
                        <div class="form-group form-action-d-flex mb-3">
                            <button class="btn btn-primary col-md-5 float-right mt-0 mt-sm-0 fw-bold">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
	@endsection