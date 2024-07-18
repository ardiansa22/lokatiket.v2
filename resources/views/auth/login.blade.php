<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="/assets/images/logo.png">
  <title>Lokatiket</title>
  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- <link href="assets/css/nucleo-svg.css" rel="stylesheet" /> -->
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
  <style>
    body, html {
      height: 100%;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .login-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }
    .login-card {
      width: 100%;
      max-width: 400px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;

    }
    .login-card img {
      max-width: 100%;
      margin-bottom: 20px;
      text-align :center;
    }
    .login-card h4 {
      margin-bottom: 10px;
      text-align :center;
    }
    .login-card p {
      margin-bottom: 20px;
    }
    .login-card .form-control {
      margin-bottom: 15px;
    }
    .login-card .btn-primary {
      width: 100%;
    }
    .login-card .additional-links {
      margin-top: 15px;
      text-align: center;
    }
  </style>
</head>
<body class="">
  <main class="main-content">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-12 d-flex flex-column mx-auto">
              <div class="card login-card">
                <div class="card-body">
                  <img src="/assets/images/logolk.png" alt="Illustration">
                  <h4 class="font-weight-bolder">Halo, Selamat datang !</h4>
                  <p class="text-muted text-center font-weight-bolder">Silahkan Masuk</p>
                  <form role="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                      <input type="email" placeholder="Email" aria-label="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                      @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" style="background-color:#0046BF;">Masuk</button>
                    </div>
                  </form>
                  <div class="additional-links">
                    <a href="{{ route('password.request') }}">Lupa Password ?</a><br>
                    <a href="{{ route('register') }}">Tidak punya akun ?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- Core JS Files -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>
</html>
