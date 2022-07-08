@extends('layouts.main');

@section('content');
	

<body style="overflow: hidden">
	<div class="wrapper wrapper-login" style="background: linear-gradient(270deg, #007bff, #6610f2);">
        <div class="row d-flex justify-content-center align-items-center" style="min-height:100vh !important">
            <div class="col-md-4">
                <div class="container container-login animated fadeIn" style="height:auto; box-shadow: 2px 2px 10px #999; border-radius:5px; padding:2rem; background:#fff">
                    <h3 class="text-center mt-2">Login Web Portofolio</h3>
                    <form action="">
                    <div class="login-form">

                        <div class="form-group">
                            <label for="username" class="placeholder">Username</label>
                            <input type="text" name="_username_" class="form-control mb-0" placeholder="Your Username"  required>
                        </div>
                        <div class="form-group">
                            <label for="_email_">Email Address</label>
                            <input type="email" name="_email_" class="form-control mb-0" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="_password_" class="form-control mb-0" placeholder="Password" required>
                        </div>
                        <div class="form-group form-action-d-flex mb-3">
                            <button class="btn btn-primary col-md-5 float-right mt-0 mt-sm-0 fw-bold">Sign In</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
	@endsection