@extends('customer.layouts.app') 

@section('content')
<div class="container py-4 py-md-5"> {{-- Tambahkan padding lebih responsif --}}
    
    {{-- Header Halaman: Dibuat Responsif dan Lebih Clean --}}
    <div class="mb-4 pt-4 border-bottom pb-3">
        
        {{-- Judul Besar untuk Desktop, Normal untuk Mobile --}}
        <h1 class="fw-bolder text-dark mb-2 fs-2 fs-md-1 d-flex align-items-center">
            <i class="fas fa-heart text-danger me-3"></i> 
            Daftar Wisata Impian Anda
        </h1>
        
        {{-- Deskripsi/Subjudul --}}
        <p class="text-muted mb-3 d-none d-md-block">Kelola semua tujuan wisata yang ingin Anda kunjungi di sini.</p>

        {{-- Tombol "Jelajahi Lebih Banyak" Dibuat Blok di Mobile --}}
        <div class="d-grid d-md-block mb-3">
            <a href="{{ route('explore') ?? '#' }}" class="btn btn-outline-primary w-100 w-md-auto">
                <i class="fas fa-search me-2"></i> Jelajahi Wisata Lainnya
            </a>
        </div>
        
    </div>
    
    ---

    {{-- Tampilkan Pesan Flash --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Konten Wishlist --}}
    @if ($wishlist->isEmpty())
        <div class="alert alert-info text-center py-4" role="alert">
            <h4 class="alert-heading">Wishlist Masih Kosong!</h4>
            <p>Sepertinya Anda belum menyimpan wisata apapun. Cari pengalaman baru dan tambahkan ke sini.</p>
            <hr>
            <a href="{{ route('explore') ?? '#' }}" class="btn btn-primary">Mulai Jelajah Sekarang</a>
        </div>
    @else
        {{-- Card grid dengan kolom tunggal di mobile --}}
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            
            @foreach ($wishlist as $wisata)
                
                {{-- Logika untuk Mengurai Gambar (JSON Decode) --}}
                @php
                    $images = json_decode($wisata->images, true);
                    $firstImage = (is_array($images) && count($images) > 0) 
                                  ? asset('storage/images/' . $images[0]) 
                                  : asset('images/no-image.png');
                @endphp
                
                <div class="col">
                    <div class="card shadow-sm h-100 border-0">
                        
                        {{-- Gambar Wisata --}}
                        <img 
                            src="{{ $firstImage }}" 
                            class="card-img-top" 
                            alt="{{ $wisata->name }}" 
                            style="height: 200px; object-fit: cover;">
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-truncate">{{ $wisata->name }}</h5>
                            
                            {{-- Detail Kategori dan Harga --}}
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-secondary text-white">{{ $wisata->kategori }}</span>
                                <h4 class="text-success mb-0 fw-bold">
                                    {{ 'Rp' . number_format($wisata->price, 0, ',', '.') }}
                                </h4>
                            </div>
                            
                            {{-- Tombol Aksi --}}
                            <div class="mt-auto d-grid gap-2">
                                {{-- Tombol Detail --}}
                                <a href="{{ route('show', $wisata) }}" class="btn btn-outline-primary btn-sm">
                                    Lihat Detail
                                </a>
                                
                                {{-- Tombol Hapus --}}
                                <form action="{{ route('customer.wishlist.destroy', $wisata->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus {{ $wisata->name }} dari wishlist?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm w-100">
                                        <i class="fas fa-trash me-1"></i> Hapus dari Wishlist
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            
        </div>
    @endif
    
</div>
@endsection