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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../../../assets/css/templatemo-woox-travel.css">
<link rel="stylesheet" href="../../../assets/css/show.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">



<link rel="stylesheet" href="../assets/css/card.css">
<link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
<link href="../../../assets/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../../../assets/admin/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="../../../assets/admin/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="../../../assets/admin/vendor/quill/quill.snow.css" rel="stylesheet">
<link href="../../../assets/admin/vendor/quill/quill.bubble.css" rel="stylesheet">
<link href="../../../assets/admin/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="../../../assets/admin/vendor/simple-datatables/style.css" rel="stylesheet">


<!-- Template Main CSS File -->
<link href="../../../assets/admin/css/style.css" rel="stylesheet">
@yield('style')
<style>
    /* Preloader CSS */
    #preloader {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background-color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #preloader .spinner {
        width: 50px;
        height: 50px;
        border: 5px solid rgba(0, 0, 0, 0.1);
        border-left-color: #0046BF;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
    
</style>
</head>
    <body>
        <!-- Preloader -->
        <!-- @include('customer.layouts.preloader') -->
        
        <!-- ***** Header Area Start ***** -->
        @include('customer.layouts.navbar')

        <div class="main-content py-2">
            @yield('content')
        </div>
        
        @yield('footer')

        @include('customer.layouts.chatbot')
        @include('customer.layouts.scriptapp')
        @yield('script')
    </body>
</html>
