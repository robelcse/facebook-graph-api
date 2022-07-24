@extends('layouts.app')
@section('content')

<!-- register section start -->
<section class="register_section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12 col-12">
                <div class="register-form-wrap">
                    <h1>Register to get <span>start!</span></h1>
                    <form action="{{ url('register') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">User Name:</label>
                            <input type="hidden" class="form-control" id="role" name="role" value="2">
                            <input type="text" class="form-control" id="name" name="user_name">
                            @if($errors->has('user_name'))
                            <div class="invalid-feedback">{{ $errors->first('user_name') }}</div>
                            @endif
                        </div>
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

                        <!-- <div class="form-group">
                            <label for="pwd">Role:</label>
                            <select class="form-control" id="sel1" name="role">
                                <option selected value="0">Select Role</option>
                                <option value="1">Admin</option>
                                <option value="2">Vendor</option>
                            </select>
                            @if($errors->has('role'))
                            <div class="invalid-feedback">{{ $errors->first('role') }}</div>
                            @endif
                        </div> -->
                        <div class="d-flex">
                        <p>Laready have an account ? <a href="{{ url('login') }}">Login</a></p>
                         <button type="submit" class="btn btn-submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12 d-none d-lg-block">
                <div class="register-img-wrap">
                    <img src="{{asset('public/assets/images/home-hero.png')}}" alt="Register" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- register section end -->
@endsection