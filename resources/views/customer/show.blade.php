@extends('customer.layouts.app')

@section('style')
<style>
    /* Styling umum untuk detail produk/wisata */
    .detail-card {
        border: none; /* Hapus border card default */
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    /* Gambar Slider */
    .image-slider {
        /* Memastikan gambar slider mengisi area dengan baik */
        height: 100%;
        overflow: hidden;
        border-radius: 15px 0 0 15px; /* Pojok membulat di sisi kiri */
    }

    .image-slider img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Memastikan gambar terpotong rapi tanpa merusak aspek rasio */
        display: block;
    }

    /* Konten Kanan */
    .right-content {
        padding: 30px;
    }

    /* Judul dan Kategori */
    .right-content h4 {
        color: #333;
        font-weight: 700;
        margin-bottom: 5px;
        font-size: 2rem;
    }

    .right-content .category-tag {
        display: inline-block;
        background-color: #e9ecef; /* Warna latar belakang abu-abu muda */
        color: #6c757d; /* Warna teks abu-abu tua */
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        margin-bottom: 20px;
    }

    /* Bagian Info (Harga & Rating) */
    .info-bar {
        list-style: none;
        padding: 0;
        display: flex;
        gap: 25px; /* Jarak antar elemen info */
        margin-bottom: 20px;
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
    }

    .info-bar li {
        font-size: 1.1rem;
        color: #555;
        font-weight: 500;
        display: flex;
        align-items: center;
    }

    .info-bar li i {
        margin-right: 8px;
        font-size: 1.2rem;
    }

    /* Daftar Fasilitas (Responsif) */
    .facilities-title {
        color: #333;
        font-size: 1.2rem;
        font-weight: 600;
        margin-top: 20px;
        margin-bottom: 15px;
    }

    .facilities-list {
        list-style-type: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 10px 0; /* Jarak vertikal */
    }

    .facilities-list li {
        width: 50%; /* 2 kolom di desktop */
        display: flex;
        align-items: center;
        font-size: 0.95rem;
        color: #495057;
    }

    .facilities-list li i {
        color: #0046BF; /* Warna aksen biru */
        margin-right: 8px;
        font-size: 1rem;
    }

    /* Tombol dan Input */
    #quantity {
        width: 50px;
        height: 38px; /* Sesuaikan dengan tinggi tombol */
        padding: 0;
        border-radius: 0;
        border-color: #ced4da;
    }

    .quantity-control button {
        border-radius: 0.25rem;
        font-size: 0.9rem;
    }
    
    #visit_date {
        padding: 0.375rem 0.75rem;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }
    
    /* Responsivitas untuk mobile */
    @media (max-width: 991.98px) {
        .image-slider {
            height: 250px; /* Ketinggian tetap untuk mobile */
            border-radius: 15px 15px 0 0; /* Pojok membulat di atas */
        }
        
        .right-content {
            padding: 20px;
        }

        .right-content h4 {
            font-size: 1.75rem;
        }

        .info-bar {
            flex-direction: column;
            gap: 10px;
        }

        .facilities-list li {
            width: 100%; /* 1 kolom di mobile */
        }
    }
    
    @media (min-width: 992px) {
        .detail-item-row > div:first-child {
            /* Pastikan kolom gambar mengisi 100% tinggi row */
            align-self: stretch;
        }
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="card detail-card">
        <div class="row g-0 detail-item-row">
            {{-- Kolom Kiri: Gambar Slider --}}
            <div class="col-lg-5 col-md-12">
                <div class="image-slider">
                    @php
                        $images = json_decode($wisata->images, true);
                    @endphp

                    {{-- Cek apakah ada gambar untuk slider --}}
                    @if (is_array($images) && count($images) > 0)
                        {{-- NOTE: Asumsi Anda akan mengintegrasikan library slider (misalnya Slick/Swiper) di sini.
                            Saat ini hanya menampilkan gambar pertama sebagai placeholder. --}}
                        <img src="{{ asset('storage/images/' . $images[0]) }}" alt="{{ $wisata->name }}">
                    @else
                        <img src="{{ asset('images/no-image.png') }}" alt="No Image Available">
                    @endif
                </div>
            </div>

            {{-- Kolom Kanan: Detail Konten --}}
            <div class="col-lg-7 col-md-12">
                <div class="right-content">
                    {{-- Judul dan Kategori --}}
                    <h4>{{ $wisata->name }}</h4>
                    <span class="category-tag">{{ $wisata->kategori }}</span>

                    {{-- Info Bar: Harga dan Rating --}}
                    <ul class="info-bar">
                        <li>
                            <i class="fas fa-money-bill-wave" style="color: #28a745;"></i> {{-- Ikon uang yang lebih umum --}}
                            **Harga:** Rp.{{ number_format($wisata->price, 0, ',', '.') }}
                        </li>
                        <li>
                            <i class="fas fa-star" style="color: orange;"></i>
                            **Rating:** {{ $wisata->rating_text ?? 'N/A' }}
                        </li>
                    </ul>

                    {{-- Deskripsi --}}
                    <p class="text-secondary">{{ $wisata->description }}</p>

                    {{-- Fasilitas --}}
                    @php
                        $facilities = json_decode($wisata->facilities, true);
                    @endphp
                    
                    <h5 class="facilities-title">Fasilitas Tersedia</h5>
                    @if (is_array($facilities) && count($facilities) > 0)
                        <ul class="facilities-list row">
                            @foreach($facilities as $facility)
                                <li class="col-6 col-sm-4 col-lg-6 mb-2">
                                    <i class="fas fa-check-circle"></i> {{ $facility }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">Tidak ada fasilitas yang dicantumkan.</p>
                    @endif

                    <hr class="my-4">

                    {{-- Kontrol Kuantitas dan Checkout --}}
                    <form id="checkout-form" action="{{ route('customer.checkout') }}" method="POST">
                        @csrf
                        
                        <div class="row align-items-center mb-3">
                            <div class="col-md-4 col-6">
                                <label for="quantity" class="form-label fw-bold">Jumlah Tiket</label>
                                <div class="input-group quantity-control">
                                    <button class="btn btn-outline-secondary px-3" type="button" onclick="document.getElementById('quantity').stepDown()">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input id="quantity" min="1" name="quantity_display" value="1" type="number" class="form-control text-center" />
                                    <button class="btn btn-outline-secondary px-3" type="button" onclick="document.getElementById('quantity').stepUp()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="col-md-5 col-6">
                                <label for="visit_date" class="form-label fw-bold">Tanggal Kunjungan <span class="text-danger">*</span></label>
                                <input type="date" name="visit_date" required id="visit_date" class="form-control">
                                <small class="text-primary mt-1 d-block"><i>*Tanggal wajib diisi</i></small>
                            </div>
                        </div>

                        {{-- Hidden Inputs untuk Form --}}
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id ?? '' }}">
                        <input type="hidden" name="wisata_id" value="{{ $wisata->id }}">
                        <input type="hidden" name="quantity" id="hiddenQuantity" value="1">
                        <input type="hidden" name="total_price" id="total_price" value="{{ $wisata->price }}">

                        @if(auth()->check())
                            <button type="submit" class="btn btn-lg mt-3" style="background-color: #0046BF; color: white;">
                                <i class="fas fa-shopping-cart me-2"></i> Checkout Sekarang
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-lg mt-3" style="background-color: #0046BF; color: white;">
                                <i class="fas fa-shopping-cart me-2"></i> Checkout Sekarang
                            </a>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const pricePerTicket = {{ $wisata->price }};
    const quantityInput = document.getElementById('quantity');
    const hiddenQuantityInput = document.getElementById('hiddenQuantity');
    const totalPriceInput = document.getElementById('total_price');
    const visitDateInput = document.getElementById('visit_date');

    // Fungsi untuk memperbarui nilai tersembunyi
    function updateHiddenValues() {
        const quantity = parseInt(quantityInput.value) || 1;
        hiddenQuantityInput.value = quantity;
        totalPriceInput.value = quantity * pricePerTicket;
    }

    // Event listener saat kuantitas berubah
    quantityInput.addEventListener('change', function() {
        // Pastikan kuantitas minimal 1
        if (parseInt(this.value) < 1 || isNaN(parseInt(this.value))) {
            this.value = 1;
        }
        updateHiddenValues();
    });

    // Perbarui nilai saat form disubmit (sebagai fallback)
    document.getElementById('checkout-form').addEventListener('submit', function() {
        updateHiddenValues();
    });

    // Mengatur tanggal minimum ke tanggal hari ini
    const today = new Date().toISOString().split('T')[0];
    visitDateInput.setAttribute('min', today);
</script>
@endsection