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

<!-- Recent Sales -->
<div class="col-12">
  <div class="card recent-sales overflow-auto">
    <div class="card-body">
      <h5 class="card-title">Wisata Anda</h5>

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
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($wisatas as $wisata)
          <tr>
            <th scope="row">{{ ++$i }}</th>
            <td><img src="{{ asset('storage/images/' . json_decode($wisata->images)[0]) }}" alt="Image" class="thumbnail"/></td>
            <td>{{ $wisata->name }}</td>
            <td style="max-width: 300px; word-wrap: break-word;">{{ $wisata->description }}</td>
            <td>{{ number_format($wisata->price, 0, ',', '.') }}</td>
            <td>
              @php
                $facilities = json_decode($wisata->facilities, true);
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
            <td>{{ $wisata->kategori }}</td>
            <td>
            <button class="btn btn-warning editBtn" 
                    data-id="{{ $wisata->id }}" 
                    data-name="{{ $wisata->name }}" 
                    data-description="{{ $wisata->description }}" 
                    data-price="{{ $wisata->price }}"
                    data-facilities="{{ json_encode($wisata->facilities) }}"
                    data-images="{{ json_encode($wisata->images) }}"
                    data-kategori="{{ $wisata->kategori }}">
                <i class="bi bi-pencil-square"></i>
            </button>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- End Recent Sales -->

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Wisata</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editForm" action="{{ route('vendor.update', '') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <input type="hidden" name="id" id="wisataId">
          
          <div class="mb-3">
            <label for="name" class="form-label">Nama Wisata</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          
          <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
          </div>

          <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" class="form-control" id="price" name="price" required>
          </div>

          <div class="mb-3">
            <label for="facilities" class="form-label">Fasilitas</label>
            <div id="facilities-container">
              <!-- Checkboxes will be dynamically inserted here -->
            </div>
            <div id="edit-fasilitas-lainnya-group">
              <label for="edit_fasilitas_lainnya">Fasilitas Lainnya:</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" id="edit_fasilitas_lainnya" name="fasilitas_lainnya[]">
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="button" id="edit-add-fasilitas-lainnya">+</button>
                </div>
              </div>
            </div>
            <div id="edit-additional-fasilitas-lainnya"></div>
          </div>

          <div class="mb-3">
            <label for="images" class="form-label">Gambar</label>
            <input class="form-control" id="edit-fileInput" type="file" name="images[]" multiple>
            <div id="edit-filePreview" style="margin-top: 10px;"></div>
          </div>

          <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select class="form-select" id="kategori" name="kategori" required>
              <option value="" selected>Pilih kategori</option>
              <option value="1">Alam</option>
              <option value="2">Gunung</option>
              <option value="3">Kawah</option>
              <option value="4">Pantai</option>
            </select>
          </div>
          
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  $('.editBtn').on('click', function() {
    var id = $(this).data('id');
    var name = $(this).data('name');
    var description = $(this).data('description');
    var price = $(this).data('price');
    var facilities = JSON.parse($(this).data('facilities'));
    var images = $(this).data('images');
    var kategori = $(this).data('kategori');

    $('#wisataId').val(id);
    $('#name').val(name);
    $('#description').val(description);
    $('#price').val(price);
    $('#kategori').val(kategori);

    // Fill facilities checkboxes
    var facilitiesContainer = $('#facilities-container');
    facilitiesContainer.empty();

    var allFacilities = ['toilet', 'mushola', 'mesjid'];
    allFacilities.forEach(function(facility) {
      var isChecked = facilities.includes(facility) ? 'checked' : '';
      facilitiesContainer.append(`
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="facilities[]" value="${facility}" id="${facility}" ${isChecked}>
          <label class="form-check-label" for="${facility}">${facility.charAt(0).toUpperCase() + facility.slice(1)}</label>
        </div>
      `);
    });

    $('#edit-additional-fasilitas-lainnya').empty(); // Clear additional facilities input

    $('#editForm').attr('action', '{{ route('vendor.update', '') }}/' + id);

    $('#editModal').modal('show');
  });

  $('#edit-add-fasilitas-lainnya').on('click', function() {
    const container = $('#edit-additional-fasilitas-lainnya');
    const newInput = `
      <div class="input-group mb-3">
        <input type="text" class="form-control" name="fasilitas_lainnya[]">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary remove-fasilitas-lainnya" type="button">-</button>
        </div>
      </div>`;
    container.append(newInput);
  });

  $('#edit-additional-fasilitas-lainnya').on('click', '.remove-fasilitas-lainnya', function() {
    $(this).closest('.input-group').remove();
  });

  // Image preview on file input change (edit)
  $('#edit-fileInput').on('change', function(event) {
    const files = event.target.files;
    const previewContainer = $('#edit-filePreview');
    previewContainer.empty();
    
    if (files) {
      Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(e) {
          const img = $('<img>').attr('src', e.target.result).css({
            'max-width': '150px',
            'margin-right': '10px'
          });
          previewContainer.append(img);
        };
        reader.readAsDataURL(file);
      });
    }
  });
});
</script>
@endsection
