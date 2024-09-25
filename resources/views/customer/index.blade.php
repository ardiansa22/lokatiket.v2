<!DOCTYPE html>
<html lang="en">

@include('customer.layouts.headindex')

<body>
<div id="preloader">
        <div class="spinner"></div>
  </div>
    <!-- ***** Header Area Start ***** -->
    <nav id="navbar1" class="navbar navbar-expand fixed-bottom" style="background-color: white;">
  <ul class="navbar-nav nav-justified w-100">
    <li class="nav-item">
      <a class="nav-link" href="{{route('customer.index')}}">
        <i class="fa-solid fa-house" style="font-size: 26px;"></i>
        <span>Beranda</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('customer.explore')}}">
        <i class="fa-solid fa-globe" style="font-size: 26px;"></i>
        <span>Jelajah</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('customer.riwayat')}}">
        <i class="fa-solid fa-bell" style="font-size: 26px;"></i>
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
                    <input type="text" id="search" placeholder="Cari tempat favorit kamu">
                    <button type="button">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <div id="search-results" style="display: none;">
                    <ul></ul>
                </div>
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
                                <p class="mb-3" style="text-align: left; font-size: 20px; color:black; font-weight:bold;">Kategori</p>
                                <div class="col-lg-4 col-sm-6 col-6">
                                    <a href="{{ route('customer.wisata.filter', 'Alam') }}">
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
                                        <i class="fa-solid fa-mountain"></i>
                                    </a>
                                    <h4><span>Gunung</span></h4>
                                </div>
                                <div class="col-lg-4 col-sm-6 col-6">
                                    <a href="{{ route('customer.wisata.filter', 'Kawah') }}">
                                        <i class="fa-solid fa-water"></i>
                                    </a>
                                    <h4><span>Kawah</span></h4>
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
                        <p class="mt-2" style="text-align: left; font-size: 20px; color:black; margin-left:15px; font-weight:bold;">Rekomendasi</p>
                    </div>
                    <div class="slider-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="owl-cites-town owl-carousel">
                                    @foreach($wisatas as $wisata)
                                    <div class="item">
                                        <div class="thumb">
                                            <a href="{{ route('customer.show', $wisata) }}">
                                                <img src="{{ asset('storage/images/' . json_decode($wisata->images)[0]) }}" alt="">
                                            </a>
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
    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/wow.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/popup.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var currentUrl = "{{ url()->current() }}";
        $('#navbar1 .nav-link').filter(function() {
            return this.href === currentUrl;
        }).addClass('active');
    });
</script>

    <script>
        $(document).ready(function() {
            $(window).on('load', function() {
                $('#preloader').fadeOut('slow', function() {
                    $(this).remove();
                });
            });
           
            $('.image-slider').slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1
            });

            $('#search').on('keyup', function() {
                let query = $(this).val();
                if (query.length > 2) {
                    $.ajax({
                        url: "{{ route('customer.search') }}",
                        type: "GET",
                        data: { query: query },
                        success: function(data) {
                            $('#search-results').show();
                            $('#search-results ul').empty();
                            $.each(data, function(index, wisata) {
                                $('#search-results ul').append('<li><a href="' + "{{ route('customer.show', '') }}" + '/' + wisata.id + '">' + wisata.name + '</a></li>');
                            });
                        }
                    });
                } else {
                    $('#search-results').hide();
                }
            });

            $(document).on('click', function(event) {
                if (!$(event.target).closest('.search-container').length) {
                    $('#search-results').hide();
                }
            });
        });
    </script>
</body>

</html>
