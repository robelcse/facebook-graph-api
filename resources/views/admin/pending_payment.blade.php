@extends('layouts.master')

@section('content')

<!-- payment pending section start -->
<section class="earning_section">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="vendor-information-head">
                <h1>Payment Pending Info</h1>

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
                        @foreach($pening_payments as $p_payment)
                        <tr>
                            <td>{{ $p_payment->id }}</td>
                            <td>{{ $p_payment->user_paypal }}</td>
                            <td>{{ $p_payment->ig_account_owner_paypal }}</td>
                            <td>{{ $p_payment->transanction_id }}</td>
                            <td>{{ $p_payment->amount - $p_payment->amount*0.1 }}</td>
                            <td><a class="btn btn-primary" href="{{ url('admin/payment/request/'.$p_payment->id) }}">Mark as paid</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- payment pending section end -->

@endsection