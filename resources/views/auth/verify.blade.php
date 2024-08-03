
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Lokatiket</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../../../assets/images/logo.png" rel="icon">
  <link href="../../../assets/images/logo.png" rel="apple-touch-icon">
  <script src="{{ asset('js/app.js') }}" defer></script>
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../../assets/admin//vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../../assets/admin//vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../../assets/admin//vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../../assets/admin//vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../../../assets/admin//vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../../../assets/admin//vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../../../assets/admin//vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../../../assets/admin/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jul 27 2023 with Bootstrap v5.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
<div class="container py-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">click here to request another</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

