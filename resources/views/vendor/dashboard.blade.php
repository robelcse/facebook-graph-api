@extends('layouts.master')

@section('content')

<!-- vendor section start -->
<section class="vendor-section">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="vendor-information-head">
                <h1>Instagram account basic info</h1> 
                <h4>Profile Link: <a href="{{ $instagram_profile_link }}">{{ $instagram_profile_link }}</a></h4>
            </div>
            <div class="row"> 
                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="vendor-info-box">   
                        <h5>Acoount ID: <span>{{ $instagram_account_id_of_vendor }}</span></h5> 
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="vendor-info-box">    
                        <h5>Total post using this platform: <span>{{ $total_post_of_vendor }}</span></h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="vendor-info-box">     
                        <h5>Total earning: <span>{{ $total_earning }}$</span></h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="vendor-info-box">     
                        <h5>Pending payment: <span>{{ $pending_payment }}$</span></h5> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- vendor section end -->

@endsection