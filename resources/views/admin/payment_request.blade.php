@extends('layouts.master')

@section('content')

<!-- payment request section start -->
<section class="earning_section">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="vendor-information-head">
                <h1>Payment Request Info</h1>

            </div>
            <div class="earning_table">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th>Custom Paypal</th>
                            <th>Ig Account Owner Paypal</th>
                            <th>Transanction ID</th>
                            <th>Amount</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vender_requests as $v_request)
                        <tr>
                            <td>{{ $v_request->id }}</td>
                            <td>{{ $v_request->user_paypal }}</td>
                            <td>{{ $v_request->ig_account_owner_paypal }}</td>
                            <td>{{ $v_request->transanction_id }}</td>
                            <td>{{ $v_request->amount - $v_request->amount*0.1 }}</td>
                            <td><a class="btn btn-primary" href="{{ url('admin/payment/request/'.$v_request->id) }}">Mark as paid</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- payment request section end --> 

@endsection