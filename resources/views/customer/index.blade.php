<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>LokaTiket</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-woox-travel.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/card.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
<!--

TemplateMo 580 Woox Travel

https://templatemo.com/tm-580-woox-travel

-->

  </head>

<body>

  <!-- ***** Header Area Start ***** -->
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
    <li class="nav-item" >
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
<div class="main-content">
  <!-- Konten utama di sini -->
  <!-- ***** Main Banner Area Start ***** -->
  <section id="section-1">
  <div class="content">

    <div class="search-container">
      <input type="text" placeholder="Cari tempat favorit kamu disini....">
      <button type="button">
        <i class="fa-solid fa-magnifying-glass"></i>
      </button>
    </div>
  </div>
</section>

  <!-- ***** Main Banner Area End ***** -->
  
  <div class="menu">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="more-info">
            <div class="row">
              <p class="mb-3" style="text-align: left; font-size: 20px; color:black;">Kategori</p>
              <div class="col-lg-4 col-sm-6 col-6">
                <a href="">
                <i class="fa-solid fa-tree"></i>
                </a>
                <h4><span>Alam</span></h4>
              </div>
              <div class="col-lg-4 col-sm-6 col-6">
                <a href="{{ route('customer.wisata.filter', 'Pantai') }}">
                <i class="fa-solid fa-umbrella-beach"></i>
                </a>
                <h4><span>Pantai</span></h4>
              </div>
              <div class="col-lg-4 col-sm-6 col-6">
                <a href="{{ route('customer.wisata.filter', 'Gunung') }}">
                <i class="fa-solid fa-mountain" ></i>
                </a>
                <h4><span>Gunung</span></h4>
              </div>
              <div class="col-lg-4 col-sm-6 col-6">
                <a href="{{ route('customer.wisata.filter', 'Situ') }}">
                <i class="fa-solid fa-water"></i>
                </a>
                <h4><span>Situ</span></h4>
              </div>
              <div class="col-lg-4 col-sm-6 col-6">
                <a href="{{route('customer.explore')}}">
              <i class="fa-solid fa-border-all"></i>
              </a>
                <h4><span>Semua</span></h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="cities-town">
    <div class="container">
      <div class="row">
      
        <div class="col-lg-12">
        <p class="mb-3" style="text-align: left; font-size: 20px; color:black; margin-left:15px;">Rekomendasi</p>
        </div>
        <div class="slider-content">
          <div class="row">
            <div class="col-lg-12">
              <div class="owl-cites-town owl-carousel">
                @foreach($wisatas as $wisata)
                <div class="item">
                  <div class="thumb">
                    <img src="{{ asset('storage/images/' . json_decode($wisata->images)[0]) }}" alt="">
                  </div>
                  <h1>{{$wisata->name}}</h1>
                  <span class="badge text-dark">⭐ {{$wisata->rating_text}}</span>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
    
  </div>
</div>

  <!-- <div class="visit-country">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p class="mb-3" style="text-align: left; font-size: 20px; color:black; margin-left:15px;">Explore More</p>
        </div>
        <div class="col-lg-12">
          <div class="items">
            <div class="row">
              @foreach($wisatas as $wisata)
                <div class="col-lg-6 col-md-12 mb-4">
                  <div class="item">
                    <div class="row">
                      <div class="col-lg-4 col-sm-5">
                      <div id="carousel-{{$wisata->id}}" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                          @foreach(json_decode($wisata->images) as $index => $image)
                            <div class="carousel-item @if($loop->first) active @endif">
                              <img src="{{ asset('storage/images/' . $image) }}" class="d-block w-100" alt="..." style="border-radius: 15px;">
                            </div>
                          @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{$wisata->id}}" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{$wisata->id}}" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                      </div>
                      </div>
                      <div class="col-lg-8 col-sm-7">
                        <div class="right-content">
                          <h4>{{$wisata->name}}</h4>
                          <span>{{$wisata->kategori}}</span>
                          
                          <p>{{$wisata->description}}</p>
                          <ul>
                            <li><i class="fa-solid fa-square-check" style="color: #5D71C9;"></i>Toilet</li>
                            <li><i class="fa-solid fa-square-check" style="color: #5D71C9;"></i>Mushola</li>
                            <li><i class="fa-solid fa-square-check" style="color: #5D71C9;"></i>Kantin</li>
                          </ul>
                          <ul>
                            <li><i class="fa fa-star" style="color: orange;"></i> 5.0</li>
                            <li><i class="fa fa-heart" style="color: red;"></i> 41</li>
                            <li><i class="fa fa-money-check"></i>{{$wisata->price}}</li>
                          </ul>
                          <a href="{{ route('customer.show', $wisata) }}">
                            <button class="btn ms-2 " style="color: white; background-color:#5D71C9;">Explore More</button>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->

 


  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/wow.js"></script>
  <script src="assets/js/tabs.js"></script>
  <script src="assets/js/popup.js"></script>
  <script src="assets/js/custom.js"></script>

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
  </body>

</html>
