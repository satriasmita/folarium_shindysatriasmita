@extends('layouts.app')

@section('content')
<div class="auth-main">
    <div class="auth_div vivify fadeIn">
        <div class="auth_brand">
            <a class="navbar-brand" href="#"><img src="assets/images/icon.svg" width="50" class="d-inline-block align-top mr-2" alt="">Folarium</a>
        </div>
        <div class="card">
            <div class="header">
                <p class="lead">Login to your account</p>
            </div>
            <div class="body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group c_form_group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email address">
                    </div>
                    <div class="form-group c_form_group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter your password">
                    </div>
                    <button type="submit" class="btn btn-dark btn-lg btn-block">LOGIN</button>
                </form>
            </div>
        </div>
    </div>
    <div class="animate_lines">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>
</div>
@endsection