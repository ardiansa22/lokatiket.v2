<nav id="navbar1" class="navbar navbar-expand fixed-bottom" style="background-color: white;">
  <ul class="navbar-nav nav-justified w-100">

    <!-- Beranda -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('menu') }}">
        <i class="fa-solid fa-house" style="font-size: 26px;"></i>
        <span>Beranda</span>
      </a>
    </li>

    <!-- Jelajah -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('explore') }}">
        <i class="fa-solid fa-globe" style="font-size: 26px;"></i>
        <span>Jelajah</span>
      </a>
    </li>

    <!-- Pesanan (hanya login, kalau tidak → login) -->
    <li class="nav-item">
      <a class="nav-link" 
         href="{{ auth()->check() ? route('customer.riwayat') : route('login') }}">
        <i class="fa-solid fa-bell" style="font-size: 26px;"></i>
        <span>Pesanan</span>
      </a>
    </li>

    <!-- Profil (hanya login, kalau tidak → login) -->
    <li class="nav-item">
      <a class="nav-link" 
         href="{{ auth()->check() ? route('customer.profile') : route('login') }}">
        <i class="fa-solid fa-user" style="font-size: 26px;"></i>
        <span>Profil</span>
      </a>
    </li>

  </ul>
</nav>
