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
<!-- Recent Sales -->
<div class="col-12">
  <div class="card recent-sales overflow-auto">
    <div class="card-body">
      <h5 class="card-title">Wisata Anda</h5>

      <table class="table table-borderless">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Wisata</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Harga</th>
            <th scope="col">Fasilitas</th>
            <th scope="col">Aksi</th>
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
            <td>
              <a href="javascript:void(0)" class="editBtn" 
                 data-id="{{$wisata->id}}" 
                 data-name="{{$wisata->name}}" 
                 data-description="{{$wisata->description}}" 
                 data-price="{{$wisata->price}}"
                 data-facilities="{{$wisata->facilities}}"
                 style="">Edit</a>
                 <form action="{{ route('vendor.destroy', $wisata->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger deleteBtn" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>

    </div>
  </div>
</div><!-- End Recent Sales -->

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Wisata</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      @foreach ($wisatas as $wisata)
      <form id="editForm{{ $wisata->id }}" action="{{ route('vendor.update', $wisata->id) }}" method="POST">
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
            <textarea class="form-control" id="facilities" name="facilities" rows="3" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        @endforeach
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
    var facilities = $(this).data('facilities');

    $('#wisataId').val(id);
    $('#name').val(name);
    $('#description').val(description);
    $('#price').val(price);
    $('#facilities').val(facilities);
    
    $('#editModal').modal('show');
  });
});
</script>
@endsection
