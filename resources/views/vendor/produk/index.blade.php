@extends('vendor.layouts.app')


@section('content')
<!-- Recent Sales -->
<div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">Wisata Anda</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Wisata</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Fasilitas</th>
                      </tr>
                    </thead>
                    @foreach ($wisatas as $wisata)
                    <tbody>
                      <tr>
                      <th scope="row">{{++$i}}</th>
                      <td>{{$wisata->name}}</td>
                      <td>{{$wisata->description}}</td>
                      <td>{{$wisata->price}}</td>
                      <td>{{$wisata->facilities}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->

@endsection