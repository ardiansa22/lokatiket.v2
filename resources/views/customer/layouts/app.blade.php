<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>LokaTiket</title>

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
    
  </head>

<body>


  <!-- ***** Header Area Start ***** -->
  <nav id ="navbar1" class="navbar navbar-expand fixed-bottom" style="background-color: white;">
      <ul class="navbar-nav nav-justified w-100" >
        <li class="nav-item">
          <a class="nav-link" href="{{route('customer.index')}}">
            <i class="fa-solid fa-house-chimney" style="font-size: 26px;">
          </i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('customer.explore')}}">
            <i class="fa-solid fa-compass" style="font-size: 26px;"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link">
            <i class="fa-solid fa-bell" style="font-size: 26px;">
          </i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link">
            <i class="fa-solid fa-user" style="font-size: 26px;">
          </i></a>
        </li>
      </ul>
</nav>
<div class="main-content">
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
  </body>

</html>
