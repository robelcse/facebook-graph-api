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
                    <form action="{{ url('vendor/appsetting') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="facebook_email">Facebook App Id</label>
                                    <input type="text" class="form-control" id="app_id" name="app_id" value="{{ $vendor->app_id }}">
                                    @if($errors->has('app_id'))
                                    <div class="error-msg">{{ $errors->first('app_id') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="facebook_profile_link">Facebook App Secret</label>
                                    <input type="text" class="form-control" id="app_secret" name="app_secret" value="{{ $vendor->app_secret }}">
                                    @if($errors->has('app_secret'))
                                    <div class="error-msg">{{ $errors->first('app_secret') }}</div>
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