@extends('customer.layouts.app')

@section('style')
<style>
    /* 1. Styling Navigasi Filter (Tabs) */
    .filter-tabs {
        border-bottom: 1px solid #dee2e6; /* Garis pemisah di bawah tab */
        padding-bottom: 5px;
        margin-bottom: 20px;
        /* Membuat tab bisa di-scroll horizontal di layar kecil */
        overflow-x: auto;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }

    .filter-tabs .nav-link {
        color: #6c757d; /* Teks abu-abu default */
        border-radius: 0.5rem;
        padding: 8px 15px;
        margin: 0 5px;
        transition: all 0.3s;
    }

    /* Warna saat link aktif/hover */
    .filter-tabs .nav-link:hover {
        color: #0046BF;
        background-color: #f8f9fa;
    }

    /* Asumsi rute filter saat ini adalah yang aktif */
    .filter-tabs .nav-link.active,
    .filter-tabs .nav-link[href*="{{ request()->segment(3) }}"] { /* Logika dasar untuk menandai yang aktif */
        color: white;
        background-color: #0046BF; /* Warna biru aksen */
        font-weight: 600;
    }

    /* 2. Styling Card Wisata */
    .wisata-card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .wisata-card:hover {
        transform: translateY(-5px); /* Efek angkat saat hover */
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15) !important;
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
    }

    /* Styling badge harga/rating */
    .price-badge {
        background-color: #0046BF; /* Warna biru untuk harga */
        color: white;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 1rem;
    }
    
    .rating-text {
        color: #ffc107; /* Warna kuning standar untuk rating */
        font-size: 0.95rem;
        font-weight: 600;
    }

    /* Styling tombol wishlist */
    .wishlist-btn {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        z-index: 10;
        transition: background-color 0.2s;
    }
    .wishlist-btn i {
        font-size: 1.2rem;
    }
</style>
@endsection

@section('content')

{{-- Filter Navigasi (Menggunakan nav-pills untuk tampilan modern) --}}
<div class="container mt-4">
    <div class="filter-tabs">
        <ul class="nav nav-pills flex-nowrap">
            {{-- Tambahkan link untuk 'Semua' jika diperlukan --}}
            
            <li class="nav-item">
                <a class="nav-link {{ request()->segment(3) == 'Alam' ? 'active' : '' }}" 
                   href="{{ auth()->check() ? route('wisata.filter', 'Alam') : route('login') }}">
                   <i class="fas fa-tree me-1"></i> Alam
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->segment(3) == 'Pantai' ? 'active' : '' }}" 
                   href="{{ auth()->check() ? route('wisata.filter', 'Pantai') : route('login') }}">
                   <i class="fas fa-water me-1"></i> Pantai
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->segment(3) == 'Kawah' ? 'active' : '' }}" 
                   href="{{ auth()->check() ? route('wisata.filter', 'Kawah') : route('login') }}">
                   <i class="fas fa-volcano me-1"></i> Kawah
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->segment(3) == 'Gunung' ? 'active' : '' }}" 
                   href="{{ auth()->check() ? route('wisata.filter', 'Gunung') : route('login') }}">
                   <i class="fas fa-mountain me-1"></i> Gunung
                </a>
            </li>
        </ul>
    </div>
</div>


<div class="container py-4">
    @if ($wisatas->isEmpty())
        <div class="alert alert-warning text-center" role="alert">
            Tidak ada data wisata yang tersedia untuk kategori ini.
        </div>
    @endif
    
    <div class="row g-4">
        {{-- Looping Data Wisata --}}
        @foreach($wisatas as $wisata)
        {{-- Responsif grid: 1 kolom di XS, 2 di SM, 3 di MD, 4 di LG --}}
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card wisata-card h-100 shadow">
                @php
                    $images = json_decode($wisata->images, true);
                    $price = number_format($wisata->price, 0, ',', '.');
                @endphp

                {{-- Gambar Wisata --}}
                @if (!empty($images) && isset($images[0]))
                    <img src="{{ asset('storage/images/' . $images[0]) }}" 
                         class="card-img-top" 
                         alt="{{ $wisata->name }}">
                @else
                    {{-- Ganti 'default.jpg' dengan nama gambar default yang sesuai --}}
                    <img src="{{ asset('images/default.jpg') }}" 
                         class="card-img-top" 
                         alt="Gambar Default">
                @endif

                {{-- Tombol Wishlist (Love) --}}
                @auth
                <form action="{{ in_array($wisata->id, $userWishlist ?? []) 
                        ? route('customer.wishlist.destroy', $wisata->id) 
                        : route('customer.wishlist.store', $wisata->id) }}" 
                    method="POST" 
                    class="position-absolute top-0 end-0 m-2">
                    @csrf
                    @if(in_array($wisata->id, $userWishlist ?? []))
                        @method('DELETE')
                        <button type="submit" class="btn btn-link p-0 wishlist-btn" title="Hapus dari Wishlist">
                            <i class="fas fa-heart text-danger"></i> {{-- Ikon terisi --}}
                        </button>
                    @else
                        <button type="submit" class="btn btn-link p-0 wishlist-btn" title="Tambahkan ke Wishlist">
                            <i class="far fa-heart text-dark"></i> {{-- Ikon outline --}}
                        </button>
                    @endif
                </form>
                @endauth

                {{-- Card Body --}}
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold text-truncate" title="{{$wisata->name}}">{{$wisata->name}}</h5>
                    <p class="card-text text-muted mb-3 d-flex align-items-center">
                        <i class="fas fa-map-marker-alt me-1" style="font-size: 0.85rem;"></i>
                        Garut, Jawa Barat {{-- (Ganti dengan lokasi dinamis jika ada) --}}
                    </p>
                    
                    {{-- Harga dan Detail --}}
                    <div class="d-flex flex-column mt-auto pt-2">
                        {{-- Rating --}}
                        <div class="mb-2">
                            <i class="fas fa-star" style="color: #ffc107;"></i>
                            <span class="rating-text">
                                {{$wisata->rating_text ?? '0.0'}}
                            </span>
                        </div>
                        
                        {{-- Harga --}}
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="price-badge">
                                Rp.{{ $price }}
                            </span>
                            <a href="{{ route('show', $wisata) }}" class="btn btn-sm text-white" style="background-color: #0046BF;">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection