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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

  <script>
     // Preloader
     $(window).on('load', function() {
                $('#preloader').fadeOut('slow', function() {
                    $(this).remove();
                });
            });
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
      var url = window.location.href;
      $('#navbar1 .nav-link').filter(function() {
          return this.href === url;
      }).addClass('active');
  </script>