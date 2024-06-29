@extends('customer.layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lokatiket</title>
    <link rel="stylesheet" href="../../../assets/css/summary.css">
</head>

<div class="container p-3 cart">
        <div class="row no-gutters">
            <div class="col-md-8">
                <div class="product-details mr-2">
                    <div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
                    <div class="d-flex flex-row">
                        <img class="rounded" src="{{ asset('storage/images/' . json_decode($wisata->images)[0]) }}" alt="{{ $wisata->name }}" style="width: 50px;" width="10px">
                        <div class="ml-2">
                            <span class="font-weight-bold d-block" style="color: black;">{{ $wisata->name }}&nbsp;</span>
                            <span class="spec" style="color: black;">{{ $wisata->kategori }}</span>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                        <span class="d-block" style="color: black;">{{$quantity}}</span>
                        <span class="d-block ml-5 font-weight-bold" style="color: black;">{{ $quantity * $wisata->price }}</span>
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
                <span>{{ $quantity * $wisata->price }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                Quantity
                <span>{{$quantity}}</span>
              </li>
              <li
                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                <div>
                  <strong>Total amount</strong>
                </div>
                <span><strong>{{ $quantity * $wisata->price }}</strong></span>
              </li>
            </ul>
            <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block">
              Go to checkout
            </button>
          </div>
        </div>
      </div>
        </div>
    </div>
@endsection

</html>
