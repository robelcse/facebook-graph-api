@extends('layouts.master')
@section('content')

<div class="container">
    <div class="row">
        <div class="com-md-8 col-md-offset-2">
            <form action="{{ url('post') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <input type="hidden" name="ig_account" value="{{ $ig_account }}" />
                    <input type="hidden" name="ig_account_owner_unique_id" value="{{ $ig_account_owner_unique_id }}" />
                    <input type="hidden" name="access_token" value="{{ $access_token }}" />
                    <input type="hidden" name="post_price" value="{{ $post_price }}" />
                </div>
                <div class="form-group">
                    <label for="file">Images</label>
                    <input type="file" id="images" name="images[]" multiple class="form-control">
                    @if($errors->has('images'))
                    <div class="invalid-feedback">{{ $errors->first('images') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="pwd">Content:</label>
                    <textarea id="content" name="content" rows="4" cols="50" class="form-control"></textarea>
                    @if($errors->has('content'))
                    <div class="invalid-feedback">{{ $errors->first('content') }}</div>
                    @endif
                </div>
                <button type="submit" class="btn btn-default">Post Publish</button>
            </form>
        </div>
    </div>
</div>


@endsection