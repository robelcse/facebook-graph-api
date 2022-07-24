@extends('layouts.app')

@section('content')

<!-- home layout start -->
<section class="home_layout">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12 order-2 order-lg-1">
                <div class="home-hero-text-wrap">
                    <h1><span>Subscribe Now </span> to Our Newsletter</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                        minim veniam, quis nostrud exercitation ullamco laboris. </p>

                    <!-- <div class="hero-bttn">
                        <a href="{{ url('register') }}">Register</a>
                        <a href="{{ url('login') }}">Login</a>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12 ps-md-0 order-1 order-lg-2">
                <div class="hero-img-wrap">
                    <img src="{{asset('public/assets/images/home-hero.png')}}" alt="Hero" class="img-fluid">
                    <div class="hero-absoult">
                        <img src="{{asset('public/assets/images/chat-icon.png')}}" alt="Hero" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="arrw-down">
                    <a href="#second_section">
                        <i class="fas fa-angle-down"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- home layout end -->


<!-- account list start -->
<section class="account_list_sec" id="second_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="account-list-head">
                    <h2>All <span>Instagram</span> Account</h2>
                    <p>Choice a specific account to post</p>
                </div>
            </div>
        </div>
        <div class="row">

            @foreach($vendors as $vendor)
            <!-- instgram page single item start -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <a href="{{ url('post/create/'.$vendor->unique_id) }}" class="d-block">
                    <div class="instagram-page-wrap">
                        @if(is_null($vendor->image))
                        <img src="{{ $vendor->ig_profile_image }}" alt="List" class="img-fluid">
                        @elseif(!is_null($vendor->image))
                        <img src="{{ asset('public/uploads/vendorprofile/'.$vendor->image) }}" alt="List" class="img-fluid">
                        @endif
                        <div class="insta-page-text-wrap">
                            <h5>{{ $vendor->username }}</h5>
                            <div class="d-flex">
                                <p>Price <span>${{ $vendor->post_price }}</span></p>
                                <a href="{{ url('post/create/'.$vendor->unique_id) }}">Post here <i class="fas fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- instgram page single item end -->
            @endforeach
        </div>
        <div class="row">
            <div class="col-12">
                <div class="browse_more">
                    <a href="#">
                        Browse More <i class="fas fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- account list end -->
@endsection