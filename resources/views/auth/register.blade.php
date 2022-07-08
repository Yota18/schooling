@extends('layouts.main')

@section('content')
	

<body style="overflow: hidden">
	<div class="wrapper wrapper-login" style="background: linear-gradient(270deg, #007bff, #6610f2);">
        <div class="row d-flex justify-content-center align-items-center" style="min-height:100vh !important">
            <div class="col-md-4">
                <div class="container container-login animated fadeIn" style="height:auto; box-shadow: 2px 2px 10px #999; border-radius:5px; padding:2rem; background:#fff">
                    <h3 class="text-center mt-2">Register</h3>
                    <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="login-form">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control mb-0" id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Your name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input class="form-control mb-0" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Your email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input class="form-control mb-0" id="password" type="password" name="password" required autocomplete="new-password" placeholder="Your password">
                                </div>
                                <div class="form-group">
                                    <label for="password">Re - Password</label>
                                    <input class="form-control mb-0" id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Retype your password">
                                </div>
                                <div class="form-group form-action-d-flex mb-3">
                                    <button type="submit" class="btn btn-primary col-md-5 float-right mt-0 mt-sm-0 fw-bold">Sign Up</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection