@extends('vendor.layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('vendor.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>

        <div class="form-group">
            <label for="images">Images</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple>
        </div>

        <div class="form-group">
            <label for="facilities">Facilities</label>
            <textarea class="form-control" id="facilities" name="facilities" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="kategori">Category</label>
            <select class="form-control" id="kategori" name="kategori" required>
                <option value="Gunung">Gunung</option>
                <option value="Pantai">Pantai</option>
                <option value="Kawah">Kawah</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
