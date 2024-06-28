@extends('customer.layouts.app')

@section('content')
<div class="container py-2">
    <div class="row mb-5">
        @foreach($wisatas as $wisata)
        <div class="col-md-4">
            <div class="card">
            <img src="../../assets/images/background1.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3 class="card-title" style="font-size:20px;">{{$wisata->name}}</h3>
                    <p class="card-text" style="font-size: 14px;">{{$wisata->kategori}}</p>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="rating">
                            <span class="badge bg-warning text-dark" style="font-size: 12px;"><i class="fa fa-star" style="color: orange;"></i> 5.0</span>
                            <span>{{$wisata->rating_text}}</span>
                        </div>
                        <a href="{{ route('customer.show', $wisata) }}" class="btn" style="background-color: #5D71C9;">View Detail</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
