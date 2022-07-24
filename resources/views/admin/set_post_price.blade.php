@extends('layouts.master')

@section('content')

<!-- profile section start -->
<section class="earning_section">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="vendor-information-head">
                <h1>Set maximum amount of post</h1>
            </div>
            <div class="card profile-update-wrap">
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="facebook_email">Set maximum amount of post</label>
                                    <input type="number" class="form-control" id="post_price" name="post_price" value="{{ $post_price }}" >
                                    @if($errors->has('post_price'))
                                    <div class="error-msg">{{ $errors->first('post_price') }}</div>
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