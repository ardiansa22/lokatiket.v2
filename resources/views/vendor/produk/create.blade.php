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
                <form id="uploadForm" action="{{ route('vendor.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- Nama Wisata --}}
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" required>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="description" required style="height: 100px"></textarea>
                        </div>
                    </div>

                    {{-- Harga --}}
                    <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="price" required>
                        </div>
                    </div>

                    {{-- Fasilitas --}}
                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Fasilitas</label>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="fasilitas[]" value="toilet" id="toilet">
                                <label class="form-check-label" for="toilet">Toilet</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="fasilitas[]" value="mushola" id="mushola">
                                <label class="form-check-label" for="mushola">Mushola</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="fasilitas[]" value="mesjid" id="mesjid">
                                <label class="form-check-label" for="mesjid">Mesjid</label>
                            </div>
                            <div id="fasilitas-lainnya-group">
                                <label for="fasilitas_lainnya">Fasilitas Lainnya:</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="fasilitas_lainnya" name="fasilitas_lainnya[]">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="add-fasilitas-lainnya">+</button>
                                    </div>
                                </div>
                            </div>
                            <div id="additional-fasilitas-lainnya"></div>
                        </div>
                    </div>

                    {{-- Gambar --}}
                    <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Gambar</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="fileInput" type="file" name="images[]" multiple required>
                            <div id="filePreview" style="margin-top: 10px;"></div>
                            <span style="font-size: 12px; color: #0046BF;"><i>*Maximal size 2Mb</i></span>
                        </div>
                    </div>

                    {{-- Kategori --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="kategori" required>
                                <option selected disabled>Pilih kategori wisata</option>
                                <option value="Gunung">Gunung</option>
                                <option value="Pantai">Pantai</option>
                                <option value="Kawah">Kawah</option>
                            </select>
                        </div>
                    </div>

                    {{-- 🆕 Latitude --}}
                    <div class="row mb-3">
                        <label for="latitude" class="col-sm-2 col-form-label">Latitude</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="latitude" name="latitude" placeholder="-7.1234567">
                        </div>
                    </div>

                    {{-- 🆕 Longitude --}}
                    <div class="row mb-3">
                        <label for="longitude" class="col-sm-2 col-form-label">Longitude</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="longitude" name="longitude" placeholder="108.1234567">
                        </div>
                    </div>

                    {{-- 🆕 Google Maps Link --}}
                    <div class="row mb-3">
                        <label for="google_maps_link" class="col-sm-2 col-form-label">Link Google Maps</label>
                        <div class="col-sm-10">
                            <input type="url" class="form-control" id="google_maps_link" name="google_maps_link" placeholder="https://maps.google.com/?q=-7.1234567,108.1234567">
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="row mb-3">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary">Tambahkan</button>
                        </div>
                    </div>
                </form><!-- End General Form Elements -->
            </div>
        </div>
    </div>
</div>
@endsection
