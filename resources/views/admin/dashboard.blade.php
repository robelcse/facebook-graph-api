@extends('layouts.master')

@section('content')

<!-- admin section start -->
<section class="vendor-section"> 
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="vendor-information-head">
                <h1>Number of all instagram account</h1>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="vendor-info-box">   
                        <h5>Total Sell: <span>{{ isset($total_sell) ? $total_sell : 0 }}$</span></h5> 
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="vendor-info-box">   
                        <h5>Total Earning: <span>{{ isset($total_earning) ? $total_earning : 0 }}$</span></h5> 
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="vendor-info-box">   
                        <h5>Withdrawl amount: <span>{{ isset($withdraw_amount) ? $withdraw_amount:0 }}$</span></h5> 
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="vendor-info-box">   
                        <h5>Pending Amount: <span>{{ $pending_amount }}$</span></h5> 
                    </div>
                </div>
            </div>
            <div class="earning_table earning_table_admin mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="5%">SL</th>
                            <th width="12%">Profile Image</th>
                            <th>Instagram Account</th>
                            <th>Paypal</th>
                            <th>Post Price</th>
                            <th>Status</th> 
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($vendors as $vendor)
                            <tr>
                                <td valign="middle">01</td>
                                <td valign="middle"><img src="{{ $vendor->ig_profile_image }}"></td>
                                <td valign="middle">{{ $vendor->ig_account }}</td>
                                <td valign="middle">{{ $vendor->paypal_email }}</td>
                                <td valign="middle">{{ $vendor->post_price }}$</td>
                                <td valign="middle">
                                    @if($vendor->status == 0)
                                    <span class="badge text-bg-warning">Pending</span>
                                    @elseif($vendor->status == 2)
                                    <span class="badge text-bg-success">Active</span>
                                    @endif
                                </td> 
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- admin section end --> 

@endsection