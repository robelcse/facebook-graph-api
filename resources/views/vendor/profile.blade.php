@extends('layouts.master')

@section('content')

<!-- profile section start -->
<section class="earning_section">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="vendor-information-head">
                <h1>Profile Information</h1>
            </div>
            <div class="card profile-view-wrap">
                <div class="card-header">
                    <a class="badge rounded-pill text-bg-success" href="{{ url('vendor/profile/update') }}">Update profile <i class="fas fa-user-plus"></i></a>

                    @if($vendor_profile_info->status == 2)
                    @if(is_null($instagram_account_info->ig_account) && is_null($instagram_account_info->access_token))
                    <a class="badge rounded-pill text-bg-primary" href="{{ $login_url }}">Connect with facebook <i class="fab fa-facebook"></i></a>
                    @elseif(!is_null($instagram_account_info->ig_account) && !is_null($instagram_account_info->access_token))
                    <a class="badge rounded-pill text-bg-success" href="{{ $login_url }}">Refresh connection <i class="fab fa-facebook"></i></a>
                    @endif
                    @endif
                </div>
                <div class="card-body">
                    <table class="table">

                        @if(!is_null($vendor_profile_info->ig_username) && !is_null($vendor_profile_info->ig_profile_image))
                        <tr>
                            <td width="50%">
                                <span>Instagram Username:</span> {{ $vendor_profile_info->ig_username }}
                            </td>
                            <td width="50%">
                                <span>Instagram Profile Image:</span> <img src="{{ $vendor_profile_info->ig_profile_image }}" height="100px" width="100px" />
                            </td>
                        </tr>
                        @endif

                        @if(!is_null($vendor_profile_info->image))
                        <tr> 
                            <td width="50%">
                                <span>Profile Picture:</span> <img src="{{ asset('public/uploads/vendorprofile/'.$vendor_profile_info->image) }}" height="100px" width="100px" />
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <td width="50%">
                                <span>Name:</span> {{ Auth::user()->user_name }}
                            </td>
                            <td width="50%">
                                <span>Facebook Email:</span> {{ $vendor_profile_info->facebook_email }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Facebook Profile Link: </span> <a href="{{ $vendor_profile_info->facebook_profile_link }}">{{ $vendor_profile_info->facebook_profile_link }}</a>
                            </td>
                            <td>
                                <span>Paypal Account:</span> {{ $vendor_profile_info->paypal_email }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Instagram Account:</span> {{ $vendor_profile_info->ig_account }}
                            </td>
                            <td>
                                <span>Instagram Profile Link: </span> <a href="{{ $vendor_profile_info->instagram_profile_link }}">{{ $vendor_profile_info->instagram_profile_link }}</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- profile section end -->

@endsection