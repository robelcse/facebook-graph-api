@extends('layouts.master')

@section('content')

<div class="container">
    <h3>Dashboard</h3>
    <table class="table">
        <thead>
            <tr>
                <th>SL</th>
                <th>Instagram Profile Link</th>
                <th>Instagram Account Id</th>
                <th>Post Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            @php $x=0 @endphp
            @foreach($vendors as $vendor)
            @php $x++ @endphp
            <tr>
                <td>{{ $x }}</td>
                <td><a href="{{ $vendor->instagram_profile_link }}" target="_blank">{{ $vendor->instagram_profile_link }}</td>
                <td>{{ $vendor->ig_account }}</td>
                <td>{{ $vendor->post_price }} $</td>
                <td>
                    <a href="{{ url('post/create/'.$vendor->unique_id) }}">post now</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection