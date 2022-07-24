@extends('layouts.app')
@section('content')

<!-- login section start -->
<section class="register_section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-7 col-12 d-none d-lg-block">
                <div class="register-img-wrap">
                    <img src="{{asset('public/assets/images/home-hero.png')}}" alt="Register" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12">
                <div class="register-form-wrap">
                    <h1>Login &amp; <span>enjoy!</span></h1>
                    <form action="{{ url('login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email address:</label>
                            <input type="email" class="form-control" id="email" name="user_email">
                            @if($errors->has('user_email'))
                            <div class="invalid-feedback">{{ $errors->first('user_email') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" id="pwd" name="password">
                            @if($errors->has('password'))
                            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                        <div class="d-flex">
                        <p>Don't have an account! <a href="{{ url('register') }}">Register</a></p>
                         <button type="submit" class="btn btn-submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- login section end -->
@endsection