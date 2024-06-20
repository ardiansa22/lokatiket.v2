<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>LokaTiket</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-woox-travel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css">
</head>
<body>
    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <nav class="navbar navbar-expand fixed-bottom" style="background-color: white;">
      <ul class="navbar-nav nav-justified w-100" >
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fa-solid fa-house-chimney" style="font-size: 26px;">
          </i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
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

    <div class="visit-country">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="items">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="item">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-5">
                                        <div class="image-slider">
                                            @foreach(json_decode($wisata->images) as $image)
                                                <div class="slide">
                                                    <img src="{{ asset('storage/images/' . $image) }}" alt="">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-7">
                                        <div class="right-content">
                                            <h4>{{ $wisata->name }}</h4>
                                            <span>{{ $wisata->kategori }}</span>
                                            <ul class="info">
                                                <li><i class="fa fa-money-check" style="color: #A16CE6;"></i> {{ $wisata->price }}</li>
                                                <li><i class="fa fa-heart" style="color: red;"></i> 41</li>
                                                <li><i class="fa fa-star" style="color: orange;"></i> 5.0</li>
                                            </ul>
                                            <p>{{ $wisata->description }}</p>
                                            <ul class="info">
                                                <li><i class="fa-solid fa-square-check" style="color: #A16CE6;"></i>Toilet</li>
                                                <li><i class="fa-solid fa-square-check" style="color: #A16CE6;"></i>Mushola</li>
                                                <li><i class="fa-solid fa-square-check" style="color: #A16CE6;"></i>Kantin</li>
                                            </ul>
                                            <div class="d-flex align-items-center" style="margin-top: 20px;">
                                                <button class="btn btn-primary px-3 me-2" style="color: white; background-color:#A16CE6;"
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input id="form1" min="0" name="quantity" value="1" type="number" class="form-control text-center" style="width: 60px; margin-top:1px;" />
                                                <button class="btn btn-primary px-3 ms-2" style="color: white; background-color:#A16CE6;"
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                                <button class="btn btn-primary ms-2 " style="color: white; background-color:#A16CE6;">Order</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright © 2024 <a href="#">FSAJ</a> Company. All rights reserved.
                        <br>Design: <a href="https://templatemo.com" target="_blank" title="free CSS templates">TemplateMo</a> Distribution: <a href="https://themewagon.com" target="_blank">ThemeWagon</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('assets/js/wow.js') }}"></script>
    <script src="{{ asset('assets/js/tabs.js') }}"></script>
    <script src="{{ asset('assets/js/popup.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>
</body>
</html>
