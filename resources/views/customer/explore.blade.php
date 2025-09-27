@extends('customer.layouts.app')

@section('content')
<div class="container">
    <nav id="navbar2" class="navbar navbar-expand" style="background-color: white;">
        <ul class="navbar-nav nav-justified w-100">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('customer.wisata.filter', 'Alam') }}">Alam</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('customer.wisata.filter', 'Pantai') }}">Pantai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('customer.wisata.filter', 'Kawah') }}">Kawah</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('customer.wisata.filter', 'Gunung') }}">Gunung</a>
            </li>
        </ul>
    </nav>
</div>

<div class="container py-4">
    <div class="row g-4">
        @foreach($wisatas as $wisata)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card position-relative h-100 shadow-sm">
                @php
                    $images = json_decode($wisata->images, true);
                @endphp

                @if (!empty($images) && isset($images[0]))
                    <img src="{{ asset('storage/images/' . $images[0]) }}" 
                         class="card-img-top img-fluid" 
                         alt="{{ $wisata->name }}" 
                         style="object-fit: cover; height: 200px;">
                @else
                    <img src="{{ asset('images/default.jpg') }}" 
                         class="card-img-top img-fluid" 
                         alt="default" 
                         style="object-fit: cover; height: 200px;">
                @endif

                {{-- Tombol Wishlist (Love) --}}
                @auth
                    <form action="{{ in_array($wisata->id, $userWishlist) 
                        ? route('customer.wishlist.destroy', $wisata->id) 
                        : route('customer.wishlist.store', $wisata->id) }}" 
                        method="POST" 
                        class="position-absolute top-0 end-0 m-2">
                        @csrf
                        @if(in_array($wisata->id, $userWishlist))
                            @method('DELETE')
                            <button type="submit" class="btn btn-link p-0">
                                <i class="bi bi-heart-fill text-danger fs-4"></i>
                            </button>
                        @else
                            <button type="submit" class="btn btn-link p-0">
                                <i class="bi bi-heart text-dark fs-4"></i>
                            </button>
                        @endif
                    </form>
                @endauth

                <div class="card-body d-flex flex-column">
                    <h3 class="card-title fs-5">{{$wisata->name}}</h3>
                    <p class="card-text text-muted mb-2">Garut, Jawa Barat</p>
                    <div class="d-flex align-items-center justify-content-between mt-auto">
                        <div class="rating">
                            <span class="badge text-dark" style="font-size: 14px; background-color :#FFCB05;">
                                {{$wisata->rating_text}}
                            </span>
                        </div>
                        <a href="{{ route('customer.show', $wisata) }}" class="btn btn-sm text-white" style="background-color: #0046BF;">
                            View Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
