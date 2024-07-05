@extends('customer.layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{config('midtrans.client_key')}}">
    </script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    <title>Lokatiket</title>
    <link rel="stylesheet" href="../../../assets/css/summary.css">
</head>
<div class="container p-3 cart">
        <div class="row no-gutters">
            <div class="col-md-8">
                <div class="product-details mr-2">
                    <div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
                    <div class="d-flex flex-row">
                        <div class="ml-2">
                            <span class="font-weight-bold d-block" style="color: black;">{{ $order->wisata_id }}&nbsp;</span>
                            
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                        <span class="d-block" style="color: black;">{{$order->quantity}}</span>
                        <span class="d-block ml-5 font-weight-bold" style="color: black;">{{ $order->total_price}}</span>
                        <!-- <i class="fa fa-trash-o ml-3 text-white-50"></i> -->
                    </div>
                </div>

                </div>
            </div>
         <div class="col-md-4">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Customer Detail</h5>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <li
                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                Name
                <span>{{ Auth::user()->name }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                Email
                <span>{{ Auth::user()->email }}</span>
              </li>
            </ul>
          </div>
          <div class="card-header py-3">
            <h5 class="mb-0">Produk Detail</h5>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <li
                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                Products
                <span>{{ $order->total_price }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                Quantity
                <span>{{$order->quantity}}</span>
              </li>
              <li
                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                <div>
                  <strong>Total amount</strong>
                </div>
                <span><strong>{{ $order->total_price }}</strong></span>
              </li>
            </ul>
            <button type="btn btn-primary mt3" class="btn btn-primary" id="pay-button">Bayar Sekarang</button>
          </div>
        </div>
      </div>
        </div>
    </div>
@endsection
@section('script')
<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
      // Also, use the embedId that you defined in the div above, here.
      window.snap.pay('{{$snapToken}}', {
       
        onSuccess: function (result) {
          /* You may add your own implementation here */
          // alert("payment success!"); 
          window.location.href = '/customer/invoice/{{$order->id}}'
          console.log(result);
        },
        onPending: function (result) {
          /* You may add your own implementation here */
          alert("wating your payment!"); console.log(result);
        },
        onError: function (result) {
          /* You may add your own implementation here */
          alert("payment failed!"); console.log(result);
        },
        onClose: function () {
          /* You may add your own implementation here */
          alert('you closed the popup without finishing the payment');
        }
      });
    });
  </script>
@endsection
</html>
