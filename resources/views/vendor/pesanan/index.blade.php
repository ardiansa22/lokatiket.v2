@extends('vendor.layouts.app')


@section('content')
<!-- Recent Sales -->
<div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">Wisata Anda</h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Wisata</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    @foreach ($paidOrders as $order)
                    <tbody>
                      <tr>
                      <th scope="row">{{++$i}}</th>
                      <td>{{$order->wisata->name}}</td>
                      <td>{{$order->quantity}}</td>
                      <td>{{$order->total_price}}</td>
                      <td><span class="badge {{ $order->status === 'unpaid' ? 'bg-danger' : 'bg-success' }}">
                                                    {{ $order->status }}
                                                </span></td>
                      </tr>
                    </tbody>
                    @endforeach
                  </table>
                </div>
              </div>
            </div><!-- End Recent Sales -->

@endsection