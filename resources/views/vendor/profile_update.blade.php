@extends('layouts.master')

@section('content')

<!-- profile section start -->
<section class="earning_section">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="vendor-information-head">
                <h1>Profile</h1>
            </div>
            <div class="card profile-update-wrap">
                <div class="card-body">
                    <form action="{{ url('vendor/profile/update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="facebook_email">Facebook Email</label>
                                    <input type="hidden" class="form-control" id="image_exit" name="image_exit" value="{{ $vendor->image }}">
                                    <input type="email" class="form-control" id="facebook_email" name="facebook_email" value="{{ $vendor->facebook_email ? $vendor->facebook_email: old('facebook_email')  }}">
                                    @if($errors->has('facebook_email'))
                                    <div class="error-msg">{{ $errors->first('facebook_email') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="facebook_profile_link">Facebook Profile Link</label>
                                    <input type="text" class="form-control" id="facebook_profile_link" name="facebook_profile_link" value="{{ $vendor->facebook_profile_link ? $vendor->facebook_profile_link: old('facebook_profile_link') }}">
                                    @if($errors->has('facebook_profile_link'))
                                    <div class="error-msg">{{ $errors->first('facebook_profile_link') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="paypal_email">Paypal Email</label>
                                    <input type="email" class="form-control" id="paypal_email" name="paypal_email" value="{{ $vendor->paypal_email ? $vendor->paypal_email:old('paypal_email') }}">
                                    @if($errors->has('paypal_email'))
                                    <div class="error-msg">{{ $errors->first('paypal_email') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="email">Instagram Profile Link</label>
                                    <input type="text" class="form-control" id="instagram_profile_link" name="instagram_profile_link" value="{{ $vendor->instagram_profile_link ? $vendor->instagram_profile_link:old('instagram_profile_link') }}">
                                    @if($errors->has('instagram_profile_link'))
                                    <div class="error-msg">{{ $errors->first('instagram_profile_link') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="email">Post Price</label>
                                    <input type="text" class="form-control" id="post_price" name="post_price" value="{{ $vendor->post_price ? $vendor->post_price:old('post_price') }}">
                                    @if($errors->has('post_price'))
                                    <div class="error-msg">{{ $errors->first('post_price') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="email">Image</label>
                                    <input type="file" class="form-control" id="image" name="image" >
                                    @if($errors->has('image'))
                                    <div class="error-msg">{{ $errors->first('image') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-submit">Update</button>
                                </div>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- profile section end -->

@endsection