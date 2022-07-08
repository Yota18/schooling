@extends('layouts.main')

@section('content')
	

<body style="overflow: hidden" id="verify">
	<div class="container" >
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-blue">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">

                    <img src="{{ asset('assets/img/email.svg') }}" alt="">

                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary p-2 mt-3 align-baseline">{{ __('Resend verification') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection