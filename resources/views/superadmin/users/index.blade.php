@extends('layouts.app')

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
                  <h5 class="card-title">Jumlah Pesanan</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6></h6>
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
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                    <h6>Rp.</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Revenue Card -->
            
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Jumlah Wisata</h5>

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
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Jumlah Wisata</h5>

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

           
           <!-- Recent Sales -->
           <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">Transaksi Tekini</h5>

                  <table class="table table-striped">
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
                     
                    </tbody>
          
                  </table>
                </div>
              </div>
            </div><!-- End Recent Sales -->
            <!-- End Recent Sales -->
            </div>
        </div><!-- End Left side columns -->
      </div>

<!-- information -->
<div class="col-12">
  <div class="card recent-sales overflow-auto">
    <div class="card-body">
      <h5 class="card-title">Pengguna</h5>
      <table class="table table-borderless datatable">
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
          @foreach ($data as $key => $user)
            <tr>
              <td>{{ ++$i }}</td>
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
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

{!! $data->render() !!}

@endsection
