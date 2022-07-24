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
                            <th>Customer Paypal</th>
                            <th>Amount</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vendor_pending_payment as $payment)
                            <tr>
                                <td>{{ $payment->id }}</td>
                                <td>{{ $payment->user_paypal }}</td>
                                <td>{{ $payment->amount-$payment->amount*0.1 }}$</td>
                                <td>
                                    @if($payment->pay_request == 0)
                                    <a class="btn btn-primary" href="{{ url('/vendor/payment/reques/'.$payment->id) }}">Pay Request</a>
                                    @elseif($payment->pay_request == 1)
                                    <span class="badge text-bg-success">Request Sent</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                        @endforeach 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- payment request section end -->


@endsection