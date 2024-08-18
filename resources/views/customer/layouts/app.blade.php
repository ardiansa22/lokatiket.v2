<!DOCTYPE html>
<html lang="en">
    @include('customer.layouts.headapp')
    <body>
        <!-- Preloader -->
        @include('customer.layouts.preloader')
        
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
