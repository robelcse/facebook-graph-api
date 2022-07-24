@extends('layouts.master')

@section('content')

<!-- earning section start -->
<section class="earning_section">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="vendor-information-head">
                <h1>Earning Info</h1>

            </div>
            <div class="earning_table">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="50%">Customer Paypal</th>
                            <th>Amount</th>
                            <th width="10%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vendor_earning_info as $earning)
                            <tr>
                                <td>{{ $earning->id }}</td>
                                <td>{{ $earning->user_paypal }}</td>
                                <td>{{ $earning->amount - $earning->amount*0.1 }}$</td>
                                <td>
                                    @if($earning->status == 1)
                                    <span class="badge text-bg-success">Completed</span>
                                    @elseif($earning->status == 0)
                                    <span class="badge text-bg-warning">Pending</span>
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
<!-- earning section end -->

@endsection