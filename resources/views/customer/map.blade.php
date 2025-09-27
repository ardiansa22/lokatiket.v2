<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Peta Wisata Terdekat - Lokatiket</title>

    <link rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        crossorigin=""
    />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        /* Variabel Warna */
        :root {
            --primary-blue: #0A3D62; /* Biru Tua */
            --secondary-orange: #FF8F00; /* Oranye */
            --light-bg: #F8F9FA;
            --dark-text: #212529;
        }

        /* CSS Umum */
        body {
            margin: 0;
            font-family: 'Poppins', 'Segoe UI', Roboto, Arial, sans-serif;
            background: var(--light-bg);
            color: var(--dark-text);
            display: flex;
            flex-direction: column;
        }
        
        /* Header yang Lebih Kompak dan Menarik */
        .section-header {
            text-align: center;
            padding: 15px 20px; /* Padding lebih kecil */
            background-color: #fff; /* Latar belakang putih */
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Bayangan lembut */
            z-index: 1000; /* Pastikan di atas peta */
            position: sticky; /* Menempel di atas */
            top: 0;
        }
        
        .section-header h1 {
            color: var(--primary-blue); 
            font-size: 24px; /* Ukuran lebih kecil untuk ergonomi mobile */
            margin: 0;
            font-weight: 700;
        }
        
        .section-header p {
            font-size: 14px; /* Ukuran lebih kecil */
            color: #6C757D;
            margin: 5px auto 0;
            max-width: 90%;
            line-height: 1.4;
            /* Menyembunyikan deskripsi di mobile untuk menghemat ruang */
            display: none; 
        }

        /* Peta */
        #map {
            width: 100%;
            height: calc(100vh - 54px); /* Peta mengisi sisa viewport, dikurangi tinggi header default */
            flex-grow: 1;
        }

        /* Styling Popup Leaflet */
        .leaflet-popup-content-wrapper {
            border-radius: 10px;
            padding: 10px;
        }
        .leaflet-popup-content strong {
            color: var(--primary-blue);
            font-size: 16px;
        }

        /* Media Query untuk Desktop (Header Lebih Besar) */
        @media (min-width: 601px) {
            .section-header {
                padding: 20px 20px;
            }
            .section-header h1 {
                font-size: 32px;
            }
            .section-header p {
                display: block; /* Deskripsi ditampilkan di desktop */
                font-size: 16px;
            }
            #map {
                /* Mengurangi tinggi peta di desktop karena header lebih besar */
                height: calc(100vh - 120px); 
            }
        }
    </style>
</head>
<body>

    <div class="section-header">
        <h1>🗺️ Jelajahi Lokasi Terdekat</h1>
        <p>
            Temukan destinasi wisata yang paling dekat dari lokasi Anda. Rencanakan perjalanan Anda dengan mudah dan praktis!
        </p>
    </div>

    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

    <script>
        // Data dari controller (Wisata::all(['id','name','latitude','longitude']))
        // Perhatikan bahwa @json($wisata) adalah sintaks Laravel Blade, asumsi ini digunakan.
        const locations = @json($wisata);

        // Inisialisasi peta
        // Koordinat awal disetel ke pusat yang umum.
        const map = L.map('map').setView([-7.21, 107.91], 12);

        // Mengganti Tile Layer dengan yang lebih menarik secara visual (CartoDB Positron)
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
            maxZoom: 19
        }).addTo(map);

        // Group untuk semua marker
        const markers = L.layerGroup().addTo(map);

        // Tambahkan marker dari data
        locations.forEach(loc => {
            if (!loc.latitude || !loc.longitude) return;
            L.marker([loc.latitude, loc.longitude])
                .bindPopup(`<strong>${escapeHtml(loc.name)}</strong><br><a href="customer/wisata/${loc.id}" style="color:var(--secondary-orange); font-weight:600;">Lihat Detail</a>`) // Menambah link detail
                .addTo(markers);
        });

        // Sesuaikan zoom agar semua marker terlihat
        if (markers.getLayers().length) {
            map.fitBounds(markers.getBounds().pad(0.15));
        } else {
             // Jika tidak ada data, kembalikan ke setView awal
             map.setView([-6.9, 107.6], 12); 
        }

        // Helper untuk menghindari XSS
        function escapeHtml(unsafe) {
            if (!unsafe) return '';
            return String(unsafe)
                .replace(/&/g,"&amp;")
                .replace(/</g,"&lt;")
                .replace(/>/g,"&gt;")
                .replace(/"/g,"&quot;")
                .replace(/'/g,"&#039;");
        }
    </script>
</body>
</html>