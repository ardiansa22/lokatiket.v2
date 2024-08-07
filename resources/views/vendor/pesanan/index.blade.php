@extends('vendor.layouts.app')

@section('style')
<style>
    .thumbnail {
        width: 100px;
        height: auto;
    }
</style>
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('sona-master/css/font-awesome.min.css') }}" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Laporan Penjualan Tiket</h4>
                        
                        <!-- Form Filter -->
                        <div class="container">
                            <form method="GET" action="{{ route('vendor.report') }}" class="form-inline mt-3">
                                <div class="form-group mb-2">
                                    <label for="month" class="mr-2">Pilih Bulan:</label>
                                    <select name="month" id="month" class="form-control">
                                        @foreach(range(1, 12) as $month)
                                            <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-2 ml-3">
                                    <label for="year" class="mr-2">Pilih Tahun:</label>
                                    <select name="year" id="year" class="form-control">
                                        @foreach(range(now()->year, now()->year - 10) as $year)
                                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                               
                                <button type="submit" class="btn btn-primary ml-3 mb-2 mr-2">Filter</button>
                                <!-- Pastikan untuk menyesuaikan URL dan parameter sesuai dengan kebutuhan -->
                               
                            </form>
                            <div class="container-fluid text-end mt-3 text-success">
                            <h5>Total Pemasukan: Rp. {{ number_format($totalPrice, 0, ',', '.') }}</h5>
                        </div>
                        </div>
                        
                        
                        <!-- Data Table -->
                        <div class="table-responsive mt-4">
                            <table class="table table-striped datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Vendor</th>
                                        <th>Wisata</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                     
                                        <th>Tanggal Pesanan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $item)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $item->wisata->user->name }}</td>
                                            <td>{{ $item->wisata->name }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ number_format($item->total_price, 0, ',', '.') }}</td>
                                            <td>
                                                <span class="badge {{ $item->status === 'unpaid' ? 'bg-danger' : 'bg-success' }}">
                                                    {{ $item->status }}
                                                </span>
                                            </td>
                                 
                                            <td>{{ $item->created_at }}</td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- End Recent Sales -->
        </div>
    </div>
</div>
@endsection
