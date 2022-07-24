@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="panel-body">
    <div class="row">
      <div class="col-xs-12">

        <div id="message"> </div>

      </div>
      <div class="col-xs-12">
        @if(Session::has('error'))
        <p class="alert alert-danger">
          {{ Session::get('error') }}
        </p>
        @endif
      </div>
    </div>
    <div class="row ">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row ">
            <div class="col-md-6 col-sm-6 col-lg-6">
              <p>Content : {{ $post->content }}</p><br>

              <h4>Please Pay: ${{ $post_price }}</h4>
            </div>

          </div>

        </div>
      </div>
      <!--  <P><strong>Pay $4</strong></P>  -->

      <div class="form-group pay-btn">
        <div id="paypal-button-container"></div>
      </div>

    </div>
  </div>

</div>
<!-- Sample PayPal credentials (client-id) are included -->
<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&currency=USD&intent=capture&enable-funding=venmo"></script>
<script>
  const fundingSources = [
    paypal.FUNDING.VENMO,
    paypal.FUNDING.PAYPAL,
    paypal.FUNDING.CARD
  ]

  for (const fundingSource of fundingSources) {
    const paypalButtonsComponent = paypal.Buttons({
      fundingSource: fundingSource,

      // optional styling for buttons
      // https://developer.paypal.com/docs/checkout/standard/customize/buttons-style-guide/
      style: {
        shape: 'rect',
        height: 40,
      },

      // set up the transaction
      createOrder: (data, actions) => {
        // pass in any options from the v2 orders create call:
        // https://developer.paypal.com/api/orders/v2/#orders-create-request-body
        const createOrderPayload = {
          purchase_units: [{
            amount: {
              value: "{{ $post_price }}",
            },
          }, ],
        }

        return actions.order.create(createOrderPayload)
      },

      // finalize the transaction
      onApprove: (data, actions) => {
        const captureOrderHandler = (details) => {
          $('#message').html('<h3 class="alert alert-success">Please wait while processing Payment..</h3>');
          $('#paypal-button-container').remove();
          // alert('Transaction completed!');
          if (details.status == "COMPLETED") {
            $.ajax({
              url: "{{route('payment.success')}}",
              method: 'POST',
              data: {
                "_token": "{{ csrf_token() }}",
                "details": details,
                "post_id": "{{$post->id}}"
              },
              success: function(data) {

                console.log(data);

                if (data.status == 200) {
                  console.log(data.message)
                  window.location.href = "{{ route("home") }}";
                }
              }
            });
          }

        }

        return actions.order.capture().then(captureOrderHandler)
      },

      // handle unrecoverable errors
      onError: (err) => {

        alert('Transaction Cancelled!  ' + err);
      },
    })

    if (paypalButtonsComponent.isEligible()) {
      paypalButtonsComponent
        .render('#paypal-button-container')
        .catch((err) => {
          console.error('PayPal Buttons failed to render')
        })
    } else {
      console.log('The funding source is ineligible')
    }
  }
</script>
@endsection