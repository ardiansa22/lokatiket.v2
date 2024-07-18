@extends('vendor.layouts.app')

@section('content')
@if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Destinasi Wisata</h5>

              <!-- General Form Elements -->
              <form action="{{ route('vendor.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control"  name="name" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Deskripsi</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" name = "description" required style="height: 100px"></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Harga</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="price" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Fasilitas</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" name = "facilities" required style="height: 100px"></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Gambar</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" name="images[]" multiple required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Kategori</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="kategori" required>
                      <option selected>Open this select menu</option>
                      <option value="1">Gunung</option>
                      <option value="2">Kawah</option>
                      <option value="3">Pantai</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Submit Button</label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>

        
      </div>
    
@endsection
