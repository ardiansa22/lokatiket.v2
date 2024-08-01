@extends('customer.layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Ulasan</h1>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('customer.ulasanstore') }}" method="POST">
        @csrf
        <input type="hidden" name="wisata_id" value="{{ $wisataId }}">
        <input type="hidden" name="order_id" value="{{ $orderId }}">
        <input type="hidden" name="rating" id="rating" value="">

        <div class="form-group">
            <label for="rating">Rating</label>
            <input type="number" name="rating">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection


