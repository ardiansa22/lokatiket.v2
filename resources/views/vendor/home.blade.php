@extends('vendor.layouts.app')


@section('content')
<div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Pesanan</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$totalOrder}}</h6>
                    </div>
                  </div>

                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Penhasilan</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                    <h6>Rp. {{ number_format($totalPrice, 0, ',', '.') }}</h6>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->
           <!-- Recent Sales -->
           <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Pembelian Tekini <span>| Today</span></h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Wisata</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tanggal Kunjungan</th>
                        <th scope="col">Tanggal Pesanan</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($orders as $order)
                      <tr>
                        <th scope="row">{{++$i}}</th>
                        <td>{{$order->wisata->name}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$order->total_price}}</td>
                        <td> <span class="badge {{ $order->status === 'unpaid' ? 'bg-danger' : 'bg-success' }}">
                                                    {{ $order->status }}
                                                </span></td>
                        <td>{{$order->visit_date}}</td>
                        <td>{{$order->created_at}}</td>
                      </tr>
                    </tbody>
                    @endforeach
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->


            
          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
       
         
      </div>
    
@endsection