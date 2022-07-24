@extends('layouts.master')

@section('content')

<!-- admin earning section start -->
<section class="vendor-section">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="vendor-information-head">
                <h1>Overview of total sell and total earning</h1>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="vendor-info-box">
                        <h5>Total Sell: <span>{{ $total_sell }}$</span></h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="vendor-info-box">
                        <h5>Total Earning: <span>{{ $total_earning }}$</span></h5>
                    </div>
                </div> 
            </div>
            <div class="earning_table earning_table_admin mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th>Ig Account Id</th>
                            <th>Post Id</th>
                            <th>Customer Paypal</th>
                            <th>Ig Account Owner Paypal</th>
                            <th>Sell</th>
                            <th>Transanction ID</th>
                            <th>Earning</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transanctions as $transanction)
                        <tr>
                            <td>{{ $transanction->id }}</td>
                            <td>{{ $transanction->ig_account }}</td>
                            <td>{{ $transanction->post_id }}</td>
                            <td>{{ $transanction->user_paypal }}</td>
                            <td>{{ $transanction->ig_account_owner_paypal }}</td>
                            <td>{{ $transanction->amount }}$</td>
                            <td>{{ $transanction->transanction_id }}</td>
                            <td>{{ $transanction->amount*0.1 }}$</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- admin earning section end -->

@endsection