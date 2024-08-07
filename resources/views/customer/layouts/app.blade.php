<!DOCTYPE html>
<html lang="en">
    @include('customer.layouts.headapp')
    <body>
        <!-- Preloader -->
        <div id="preloader">
            <div class="spinner"></div>
        </div>
        
        <!-- ***** Header Area Start ***** -->
        @include('customer.layouts.navbar')

        <div class="main-content py-2">
            @yield('content')
        </div>
        
        @yield('footer')

        @include('customer.layouts.scriptapp')
        @yield('script')
    </body>
</html>
