@extends('layouts.app')
@section('content')

<!-- create post section start -->
<section class="create_post_wrap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="create_post_frm">
                    <h1>Cretae a New Post!</h1>
                    <!-- <form action="{{ url('post') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <input type="hidden" name="ig_account" value="{{ $ig_account }}" />
                            <input type="hidden" name="ig_account_owner_unique_id" value="{{ $ig_account_owner_unique_id }}" />
                            <input type="hidden" name="access_token" value="{{ $access_token }}" />
                            <input type="hidden" name="post_price" value="{{ $post_price }}" />
                        </div>
                        <div class="drop-zone">
                            <span class="drop-zone__prompt"><i class="fas fa-cloud-upload-alt"></i> Drag &amp; Drop the file here or click to upload</span>
                            <input type="file" name="images[]" multiple class="drop-zone__input">
                        </div>
                        @if($errors->has('images'))
                        <div class="error-msg">{{ $errors->first('images') }}</div>
                        @endif

                        <div class="form-group">
                            <label for="pwd">Content:</label>
                            <textarea id="content" name="content" rows="4" cols="50" class="form-control"></textarea>
                            @if($errors->has('content'))
                            <div class="error-msg">{{ $errors->first('content') }}</div>
                            @endif
                        </div>
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-submit">Post Publish</button>
                        </div>
                    </form> -->

                    <form action="{{ url('post') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <input type="hidden" name="ig_account" value="{{ $ig_account }}" />
                            <input type="hidden" name="ig_account_owner_unique_id" value="{{ $ig_account_owner_unique_id }}" />
                            <input type="hidden" name="access_token" value="{{ $access_token }}" />
                            <input type="hidden" name="post_price" value="{{ $post_price }}" />
                        </div>
                        <div class="form-group">
                            <div class="input-field">
                                <label class="active" style="font-weight: bold; color:Black; font-size: 18px;">Upload Photo(s)</label><br>
                                <div class="input-images" style="padding-top: .5rem;"></div>
                                @if ($errors->has('images'))
                                <span id="erro_msg">
                                    {{ $errors->first('images') }}
                                </span>
                                @endif
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label for="bio">Bio:</label>
                            <textarea class="form-control" rows="5" name="content" id="bio">{{ old('content') }}</textarea>
                            @if($errors->has('content'))
                            <span id="erro_msg">
                                {{ $errors->first('content') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group pay-btn">

                            <input type="submit" style="font-weight: bold; font-size: 22px;" class="btn btn-outline-primary" value="SUBMIT">
                           
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- create post section end -->
@endsection