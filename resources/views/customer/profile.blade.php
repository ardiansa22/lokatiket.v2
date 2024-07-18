@extends('customer.layouts.app')

@section('content')
<div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            <span></span>Overview <i
                                class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row">
            <div class="col-xl-4">
        <div class="card mb-4 mb-xl-0">
            <div class="card-body text-center">
                <img class="img-account-profile rounded-circle mb-2" id="profile-img" alt="Default Profile Photo" style="width: 150px; height: 150px; object-fit: cover;">
                <div class="small font-italic text-muted mb-4">JPG atau PNG file tidak boleh lebih dari 512 KB</div>
                <div class="mb-3">
                    <input class="form-control" type="file" name="profile_photo" id="profile-photo-input">
                </div>
                <button class="btn btn-gradient-primary btn-sm" type="submit" style="background-color:#0046BF; color:white;">Upload new image</button>
            </div>
        </div>
    </div>
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="">
                                @csrf
                                @method('PUT')
                                <div class="">
                                    <label class="small mb-1" for="inputFullName">Nama
                                        Vendor</label>
                                    <input class="form-control" id="inputFullName" type="text" name="name"
                                        placeholder="Masukan nama lengkap Anda" value="{{ Auth::user()->name }}">
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputEmailAddress">Email
                                        address</label>
                                    <input class="form-control" id="inputEmailAddress"
                                        type="email"
                                        placeholder="Enter your email address"
                                        value="{{ Auth::user()->email }}" readonly>
                                </div>
                                <button class="btn" style="background-color:#0046BF; color:white;" type="submit">Save
                                    changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
        document.getElementById('profile-photo-input').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-img').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection