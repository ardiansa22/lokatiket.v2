@extends('customer.layouts.app')
@section('style')
<style>
/* CSS Ditingkatkan untuk kejelasan */
.profile-header {
    margin-bottom: 20px;
}
.profile-picture-container {
    position: relative;
    width: 120px; /* Ukuran yang sedikit lebih besar */
    height: 120px;
    margin: 0 auto 10px; /* Tengahkan dan beri jarak */
}
.rounded-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid #f8f9fa; /* Tambahkan bingkai untuk kesan profesional */
    box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Bayangan halus */
}
.upload-label {
    position: absolute;
    bottom: 0;
    right: 0;
    cursor: pointer;
    background-color: #007bff; /* Warna biru untuk tombol aksi utama */
    color: white;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}
.upload-label:hover {
    background-color: #0056b3;
}
.max-size-info {
    font-size: 0.75rem; /* Ukuran yang lebih kecil */
    color: #6c757d; /* Abu-abu untuk informasi sekunder */
    margin-top: 5px;
}
/* Menyesuaikan padding card */
.card-body {
    padding: 1.5rem;
}

/* Menggunakan kelas label yang lebih baik dari Bootstrap */
.profile-overview .label {
    font-weight: 600; /* Tebal untuk label */
    color: #495057; /* Warna abu-abu gelap */
}
</style>
@endsection
@section('content')
<div class="profile">
    <div class="row justify-content-center"> {{-- Tengahkan konten --}}
        <div class="col-lg-8"> {{-- Gunakan kolom yang lebih lebar untuk konten utama --}}

            <div class="card">
                <div class="card-body">
                    
                    <div class="profile-header text-center">
                        <div class="profile-picture-container">
                            <img class="rounded-image" 
                                src="{{ Auth::user()->profile && Auth::user()->profile->image ? asset('storage/' . Auth::user()->profile->image) : asset('../../../assets/admin/img/userimage.jpeg') }}" 
                                alt="Foto Profil">

                            <form id="upload-form" action="{{ route('customer.upload-image') }}" method="POST" enctype="multipart/form-data" style="display:inline;">
                                @csrf
                                <input type="file" name="image" id="image" style="display:none;" onchange="document.getElementById('upload-form').submit();" accept="image/*">
                                <label for="image" class="upload-label" title="Ubah foto profil"><i class="bi bi-camera"></i></label>
                            </form>
                        </div>

                        <h4 class="mt-2">{{ Auth::user()->name }}</h4> {{-- Judul lebih besar --}}
                        <p class="max-size-info">*Ukuran maksimal 5MB</p>
                    </div>
                    
                    <hr> {{-- Garis pemisah antara header dan tab --}}

                    <ul class="nav nav-tabs nav-tabs-bordered">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profil</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Ganti Password</button>
                        </li>
                    </ul>

                    <div class="tab-content pt-3">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">Detail Akun</h5>

                            <div class="row mb-2">
                                <div class="col-md-4 label">Nama Lengkap</div>
                                <div class="col-md-8">{{ Auth::user()->name }}</div>
                            </div>
                            
                            <div class="row mb-2">
                                <div class="col-md-4 label">Email</div>
                                <div class="col-md-8">{{ Auth::user()->email }}</div>
                            </div>

                            <hr class="my-4">

                            <h5 class="card-title">Bantuan dan Pengaturan Akun</h5>
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                
                                <div class="d-flex align-items-center mb-2 me-4">
                                    <a href="mailto:infolokatiket@gmail.com" class="text-decoration-none text-secondary d-flex align-items-center">
                                        {{-- Ganti ikon agar lebih konsisten (misal: Bootstrap Icons 'bi bi-info-circle') --}}
                                        <i class="bi bi-info-circle-fill me-2 fs-5 text-primary"></i> 
                                        <span>Pusat Bantuan (infolokatiket@gmail.com)</span>
                                    </a>
                                </div>
                                
                                <div>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-1"></i> Keluar
                                    </button>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                            
                            <div class="mt-3 text-center">
                                <p class="text-muted mb-1">Ikuti kami di media sosial:</p>
                                <a href="https://facebook.com" class="text-decoration-none me-3" target="_blank"><i class="fab fa-facebook-f fa-lg"></i></a>
                                <a href="https://twitter.com" class="text-decoration-none me-3" target="_blank"><i class="fab fa-twitter fa-lg"></i></a>
                                <a href="https://www.instagram.com/lokatiket.id?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="text-decoration-none" target="_blank"><i class="fab fa-instagram fa-lg"></i></a>
                            </div>

                        </div>

                        <div class="tab-pane fade profile-edit pt-2" id="profile-edit">
                            <form method="POST" action="{{ route('customer.updateprofil', ['id' => Auth::user()->id]) }}">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="name" type="text" class="form-control" id="fullName" value="{{ Auth::user()->name }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        {{-- Tambahkan kelas form-control-plaintext untuk input non-editable --}}
                                        <input type="email" class="form-control-plaintext" id="Email" value="{{ Auth::user()->email }}" readonly> 
                                        <small class="text-muted">Untuk mengganti email, hubungi Support.</small>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade pt-2" id="profile-change-password">
                            <form action="{{ route('customer.password.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Password Lama</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="current-password" type="password" class="form-control" id="currentPassword" required>
                                        @error('current-password')
                                            <div class="text-danger mt-1 small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Password Baru</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="password" type="password" class="form-control" id="newPassword" required>
                                        @error('password')
                                            <div class="text-danger mt-1 small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Konfirmasi Password Baru</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="password_confirmation" type="password" class="form-control" id="renewPassword" required>
                                        @error('password_confirmation')
                                            <div class="text-danger mt-1 small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary px-4">Ubah Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> 
<!-- Tambahkan setelah jQuery (kalau pakai), atau langsung -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Logika SweetAlert tetap sama
    @if(session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'OK',
            customClass: {
                confirmButton: 'btn-success'
            }
        });
    @endif
    // Logika form upload tetap sama
    document.getElementById('image').onchange = function() {
        document.getElementById('upload-form').submit();
    };
</script>
@endsection