@extends('customer.layouts.app')
@section('style')
<style>
  .profile {
    padding-bottom:60px;

  }
  .rounded-image {
    width: 100px; /* Ubah ukuran sesuai kebutuhan */
    height: 100px; /* Ubah ukuran sesuai kebutuhan */
    object-fit: cover;
    border-radius: 50%;
}

</style>
@endsection
@section('content')
<div class="profile">
      <div class="row">
        <div class="col-xl-4">

        <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                <img class="rounded-image" src="{{ Auth::user()->profile && Auth::user()->profile->image ? asset('storage/' . Auth::user()->profile->image) : asset('../../../assets/admin/img/userimage.jpeg') }}" alt="">
                <span style="font-size: 12px; color: #0046BF;"><i>*Maximal size 5Mb</i></span>
                <div class="row mb-3">
                    <div class="pt-2">
                        <form id="upload-form" action="{{ route('customer.upload-image') }}" method="POST" enctype="multipart/form-data" style="display:inline;">
                            @csrf
                            <input type="file" name="image" id="image" style="display:none;" onchange="document.getElementById('upload-form').submit();">
                            
                            <label for="image" class="btn btn-warning btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></label>
                        </form>
                    </div>
                </div>
                <h5>{{ Auth::user()->name }}</h5>
            </div>
        </div>
        </div>

        <div class="col-xl-4">

          <div class="card">
            <div class="card-body">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8">{{ Auth::user()->name }}</div>
                  </div>
                
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{ Auth::user()->email }}</div>
                  </div>
                  
                  <div class="text-center">
                      <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          Keluar
                      </button>
                  </div>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>


                </div>

                <div class="tab-pane fade profile-edit pt-2" id="profile-edit">
                <!-- Profile Edit Form -->
                <form method="POST" action="{{ route('customer.updateprofil', ['id' => Auth::user()->id]) }}">
                  @csrf
                  @method('PUT')
                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="name" type="text" class="form-control" id="fullName" value="{{ Auth::user()->name }}">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="email" class="form-control" id="Email" value="{{ Auth::user()->email }}" disabled>
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->
              </div>


                <!-- Change Password Form -->
                <div class="tab-pane fade pt-2" id="profile-change-password">
                    <form action="{{ route('customer.password.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="current-password" type="password" class="form-control" id="currentPassword" required>
                                @error('current-password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="password" type="password" class="form-control" id="newPassword" required>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="password_confirmation" type="password" class="form-control" id="renewPassword" required>
                                @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                    </form>
                    <!-- End Change Password Form -->
                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
        <div class="col-xl-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Bantuan</h5>
              <div class="d-flex justify-content-between mt-3">
                <!-- Ikon Helpdesk dengan warna merah -->
                <a href="mailto:  infolokatiket@gmail.com" class="text-decoration-none">
                  <i class="fas fa-headset fa-2x text-danger"></i>
                  <span class="ms-2">Helpdesk</span>
                </a>
                <!-- Ikon Media Sosial -->
                <div>
                  <a href="https://facebook.com" class="text-decoration-none me-2" target="_blank">
                    <i class="fab fa-facebook fa-2x"></i>
                  </a>
                  <a href="https://twitter.com" class="text-decoration-none me-2" target="_blank">
                    <i class="fab fa-twitter fa-2x"></i>
                  </a>
                  <a href="https://www.instagram.com/lokatiket.id?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="text-decoration-none" target="_blank">
                    <i class="fab fa-instagram fa-2x"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection
@section('script')
<!-- Include SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

<script>
    @if(session('success'))
        Swal.fire({
            title: 'Success',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'OK',
            customClass: {
                confirmButton: 'btn-success'
            }
        });
    @endif
</script>

<script>
    document.getElementById('image').onchange = function() {
        document.getElementById('upload-form').submit();
    };
</script>
@endsection