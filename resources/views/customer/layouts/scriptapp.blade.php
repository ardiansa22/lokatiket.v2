<!-- Scripts -->
<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
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
    bannerTimer = setInterval(bannerSwitcher, 5000);
  });

  // Preloader
  $(window).on('load', function() {
    $('#preloader').fadeOut('slow', function() {
      $(this).remove();
    });
  });

  // Slick carousel
  $(document).ready(function() {
    $('.image-slider').slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1
    });

    // Search functionality
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

  // Tab functionality
  $('#bologna-list a').on('click', function(e) {
    e.preventDefault();
    $(this).tab('show');
  });

  // Add active class to the current button (highlight it)
  var url = window.location.href;
  $('#navbar1 .nav-link, #navbar2 .nav-link').filter(function() {
    return this.href === url;
  }).addClass('active');

  document.addEventListener("DOMContentLoaded", function() {
    var currentUrl = "{{ url()->current() }}";
    $('#navbar1 .nav-link').filter(function() {
      return this.href === currentUrl;
    }).addClass('active');
  });
</script>
