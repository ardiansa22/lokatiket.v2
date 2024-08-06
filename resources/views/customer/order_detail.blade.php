@extends('customer.layouts.app')

@section('content')

<div class="container p-3 cart">
        <div class="row no-gutters">
         <div class="col-md-4">
        <div class="card mb-4">
          <div class="card-body">
            <img src="../../assets/images/logolk.png" alt="">
          <h6 class="card-subtitle py-4 text-muted" style="font-size :14px; font-weigth:bold;">Hai {{ Auth::user()->name }},</h6>
          <h5  style="font-size :18px;"><b>Selamat, Pembelian tiket wisata kamu berhasil !</b></h5>
          <p class="text-muted">Terimakasih telah mempercayakan Lokatiket untuk memenuhi kebutuhanmu. Berikut detail transaksimu:</p>
          <h5  style="font-size :18px;"><b>Detail transaksimu</b></h5>
          <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                Nomor Pesanan
                <span>220102{{$order->id}}LKTKT</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                Waktu
                <span>{{$order->created_at}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                Jumlah Tiket
                <span>{{$order->quantity}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                Harga
                <span>Rp. {{ number_format($order->total_price, 0, ',', '.') }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                Status
                <span>{{$order->status}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                <h5  style="font-size :18px;"><b>Tiket Anda</b></h5>
              </li>
            </ul>
            
            <img src="../../assets/images/barcode.png" alt="" >
          </div>
        </div>
      </div>
        </div>
    </div>
@endsection

