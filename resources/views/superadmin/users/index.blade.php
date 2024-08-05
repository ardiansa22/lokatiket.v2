@extends('layouts.app')

@section('style')
<style>
    .thumbnail {
        width: 100px;
        height: auto;
    }
</style>
@endsection

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif

<div class="row">
    <!-- Left side columns -->
    <div class="col-lg-12">
        <div class="row">
            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Pesanan <span>| Paid</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-cart"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $totalOrder }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Pengguna</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-person"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $totalUsers }}</h6>
                                <span class="text-success small pt-1 fw-bold">{{ $vendorCount }}</span> <span class="text-muted small pt-2 ps-1">Pengelola,</span>
                                <span class="text-success small pt-1 fw-bold">{{ $customerCount }}</span> <span class="text-muted small pt-2 ps-1">Customer,</span>
                                <span class="text-success small pt-1 fw-bold">{{ $adminCount }}</span> <span class="text-muted small pt-2 ps-1">Superadmin</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Revenue Card -->

            <!-- Wisata Card -->
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Wisata</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-tree"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $totalWisata }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Wisata Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Revenue <span>| Paid</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ number_format($totalOrderPaid, 0, ',', '.') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Revenue Card -->

            <!-- Recent Sales -->
            <div class="col-12">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">Transaksi Terkini</h5>
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
                                @foreach ($order as $item)
                                <tr>
                                    <th scope="row">{{ ++$i }}</th>
                                    <td>{{ $item->wisata->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge {{ $item->status === 'unpaid' ? 'bg-danger' : 'bg-success' }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td>{{ $item->visit_date }}</td>
                                    <td>{{ $item->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- End Recent Sales -->

            <!-- Daftar Wisata -->
            <div class="col-12">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Wisata</h5>
                        <table class="table table-striped datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Poto</th>
                                    <th scope="col">Wisata</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Fasilitas</th>
                                    <th scope="col">Kategori</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wisata as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td><img src="{{ asset('storage/images/' . json_decode($item->images)[0]) }}" alt="Image" class="thumbnail" /></td>
                                    <td>{{ $item->name }}</td>
                                    <td style="max-width: 300px; word-wrap: break-word;">{{ $item->description }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>
                                        @php
                                            $facilities = json_decode($item->facilities, true);
                                        @endphp
                                        @if (is_array($facilities))
                                            <ul>
                                                @foreach($facilities as $facility)
                                                    <li>{{ $facility }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span>No facilities available</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->kategori }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- End Daftar Wisata -->

            <!-- Pengguna -->
            <div class="col-12">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">Pengguna</h5>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th width="280px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $v)
                                                {{ $v }}
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('superadmin.users.edit', $user->id) }}">Edit</a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['superadmin.users.destroy', $user->id], 'style' => 'display:inline']) !!}
                                            @csrf
                                            @method('DELETE')
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- End Pengguna -->
        </div><!-- End Left side columns -->
    </div>
</div>

@endsection
