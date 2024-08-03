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
                    <i class="bi bi-cart"></i>
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
                  <h5 class="card-title">Penghasilan</h5>

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
            
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Wisata</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-tree"></i>
                    </div>
                    <div class="ps-3">
                    <h6>1</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Revenue Card -->

            <div class="col-12">
               <div class="card recent-sales overflow-auto">
                 <div class="card-body">
                   <h5 class="card-title">Kunjungan Hari ini <span>| {{$visitDate}}</span></h5>
                 <!-- Form untuk memilih tanggal -->
                 <form method="GET" action="{{ route('vendor.index') }}" id="dateForm">
                     <label for="visit_date">Tanggal Kunjungan:</label>
                     <input type="date" id="visit_date" name="visit_date" onchange="submitForm()">
                 </form>
                 <!-- Tabel pesanan berdasarkan tanggal -->
                 <table class="table table-striped datatable">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th>Nomor Pesanan</th>
                             <th>Nama Wisata</th>
                             <th>Total Harga</th>
                             <th>Status</th>
                             <th>Tanggal Kunjungan</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($filteredOrders as $order)
                         <tr>
                             <th scope="row">{{ ++$i }}</th>
                             <th scope="row">220102{{ $order->id }}LKTKT</th>
                             <td>{{ $order->wisata->name }}</td>
                             <td>{{ number_format($order->total_price, 0, ',', '.') }}</td>
                             <td>{{ $order->status }}</td>
                             <td>{{ $order->visit_date }}</td>
                         </tr>
                         @endforeach
                     </tbody>
                 </table>
                 </div>
               </div>
             </div>
           <!-- Recent Sales -->
           <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">Transaksi Tekini</h5>

                  <table class="table table-striped datatable">
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
                        <td>{{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td> <span class="badge {{ $order->status === 'unpaid' ? 'bg-danger' : 'bg-success' }}">
                                                    {{ $order->status }}
                                                </span></td>
                        <td>{{$order->visit_date}}</td>
                        <td>{{$order->created_at}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div><!-- End Recent Sales -->
            <!-- End Recent Sales -->
            </div>
        </div><!-- End Left side columns -->
      </div>
    
@endsection
@section('script')
<script>
    function submitForm() {
        document.getElementById('dateForm').submit();
    }
</script>
@endsection

