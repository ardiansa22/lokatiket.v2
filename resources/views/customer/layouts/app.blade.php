<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>LokaTiket</title>
    @laravelPWA
    <!-- Web Application Manifest -->
<link rel="manifest" href="{{route('laravelpwa.manifest')}}">
<!-- Chrome for Android theme color -->
<meta name="theme-color" content="#000000">

<!-- Add to homescreen for Chrome on Android -->
<meta name="mobile-web-app-capable" content="yes">
<meta name="application-name" content="PWA">
<link rel="icon" sizes="512x512" href="/images/icons/icon-512x512.png">

<!-- Add to homescreen for Safari on iOS -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-title" content="PWA">
<link rel="apple-touch-icon" href="/images/icons/icon-512x512.png">

<link href="/images/icons/splash-640x1136.png" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-750x1334.png" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-1242x2208.png" media="(device-width: 621px) and (device-height: 1104px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-1125x2436.png" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-828x1792.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-1242x2688.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-1536x2048.png" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-1668x2224.png" media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-1668x2388.png" media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-2048x2732.png" media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />

<!-- Tile for Win8 -->
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/images/icons/icon-512x512.png">

<script type="text/javascript">
    // Initialize the service worker
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/serviceworker.js', {
            scope: '.'
        }).then(function (registration) {
            // Registration was successful
            console.log('Laravel PWA: ServiceWorker registration successful with scope: ', registration.scope);
        }, function (err) {
            // registration failed :(
            console.log('Laravel PWA: ServiceWorker registration failed: ', err);
        });
    }
</script>

    <!-- Bootstrap core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../../../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../../../assets/css/templatemo-woox-travel.css">
    <link rel="stylesheet" href="../../../assets/css/show.css">


    
    <link rel="stylesheet" href="../assets/css/card.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link href="../../../assets/admin//vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../assets/admin//vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../../assets/admin//vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../../assets/admin//vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../../../assets/admin//vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../../../assets/admin//vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../../../assets/admin//vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../../../assets/admin//css/style.css" rel="stylesheet">
  </head>

<body>


  <!-- ***** Header Area Start ***** -->
  <nav id="navbar1" class="navbar navbar-expand fixed-bottom" style="background-color: white;">
  <ul class="navbar-nav nav-justified w-100">
    <li class="nav-item">
      <a class="nav-link" href="{{route('customer.index')}}">
        <i class="fa-solid fa-house-chimney" style="font-size: 26px;"></i>
        <span>Beranda</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('customer.explore')}}">
        <i class="fa-solid fa-compass" style="font-size: 26px;"></i>
        <span>Jelajah</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('customer.riwayat')}}">
        <i class="fa-solid fa-ticket" style="font-size: 26px;"></i>
        <span>Pesanan</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('customer.profile')}}">
        <i class="fa-solid fa-user" style="font-size: 26px;"></i>
        <span>Profil</span>
      </a>
    </li>
  </ul>
</nav>

<div class="main-content py-2">
  @yield('content')
</div>
 


  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="../../vendor/jquery/jquery.min.js"></script>
  <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="../../assets/js/isotope.min.js"></script>
  <script src="../../assets/js/owl-carousel.js"></script>
  <script src="../../assets/js/wow.js"></script>
  <script src="../../assets/js/tabs.js"></script>
  <script src="../../assets/js/popup.js"></script>
  <script src="../../assets/js/custom.js"></script>

  <script>
    function bannerSwitcher() {
      next = $('.sec-1-input').filter(':checked').next('.sec-1-input');
      if (next.length) next.prop('checked', true);
      else $('.sec-1-input').first().prop('checked', true);
    }

    var bannerTimer = setInterval(bannerSwitcher, 5000);

    $('nav .controls label').click(function() {
      clearInterval(bannerTimer);
      bannerTimer = setInterval(bannerSwitcher, 5000)
    });
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
  <script>
      $(document).ready(function(){
          $('.image-slider').slick({
              infinite: true,
              slidesToShow: 1,
              slidesToScroll: 1
          });
      });
  </script>
  <script>
      $('#bologna-list a').on('click', function (e) {
    e.preventDefault()
    $(this).tab('show')
  })
  </script>
  <script>
      // Add active class to the current button (highlight it)
      var url = window.location.href;
      $('#navbar2 .nav-link').filter(function() {
          return this.href === url;
      }).addClass('active');
  </script>
    @yield('script')
  </body>
</html>
