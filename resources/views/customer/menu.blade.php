<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Lokatiket - Pilihan Menu Utama</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* Palet Warna */
        :root {
            --primary-blue: #0046bf; /* Biru Tua Primer */
            --secondary-orange: #FF8F00; /* Oranye Sekunder */
            --light-bg: #F8F9FA; /* Latar Belakang Cerah */
            --dark-text: #212529; /* Teks Gelap */
        }

        /* CSS Umum */
        body {
            margin: 0;
            font-family: 'Poppins', 'Segoe UI', Roboto, Arial, sans-serif;
            background: var(--light-bg); /* Latar belakang cerah */
            color: var(--dark-text);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* Header dan Logo */
        .header-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .header-logo img {
            max-width: 250px; /* LOGO LEBIH GEDE */
            height: auto;
            margin-bottom: 10px;
        }
        
        .catchy-title {
            color: var(--primary-blue);
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 5px 0;
        }
        
        .subtitle {
            color: #6C757D;
            font-size: 16px;
            margin: 0;
            max-width: 80%;
            margin-left: auto;
            margin-right: auto;
        }

        /* Container Menu Utama */
        .menu-container {
            display: flex;
            gap: 40px; /* Jarak antara ikon */
            padding: 20px 0;
            max-width: 600px;
            width: 100%;
            justify-content: center;
        }

        /* Gaya Tombol/Icon */
        .menu-item {
            text-decoration: none;
            color: var(--dark-text);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            flex: 1; /* Memastikan kedua item menu mengambil ruang yang sama */
            max-width: 180px;
        }

        .menu-item:hover {
            transform: translateY(-8px); /* Efek melayang yang lebih menonjol */
        }

        .icon-box {
            background-color: var(--primary-blue);
            width: 160px; /* Ukuran box ikon yang lebih besar */
            height: 160px;
            border-radius: 25px; /* Sudut lebih membulat */
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            /* Bayangan yang lebih profesional */
            box-shadow: 0 10px 20px rgba(10, 61, 98, 0.25), 0 6px 6px rgba(10, 61, 98, 0.15);
            transition: box-shadow 0.3s ease-in-out;
        }

        .menu-item:hover .icon-box {
            box-shadow: 0 15px 30px rgba(10, 61, 98, 0.4), 0 8px 8px rgba(10, 61, 98, 0.2);
        }

        .icon-box svg {
            width: 90px; /* Ukuran ikon di dalam box */
            height: 90px;
            fill: var(--secondary-orange); /* Warna ikon oranye kontras */
        }

        .icon-label {
            font-weight: 600;
            font-size: 20px;
            color: var(--primary-blue);
        }

        /* Responsif untuk Mobile */
        @media (max-width: 600px) {
            .header-logo img {
                max-width: 180px; /* Logo di mobile */
            }
            
            .catchy-title {
                font-size: 22px;
            }
            
            .subtitle {
                font-size: 14px;
            }
            
            .menu-container {
                /* MEMBUAT MENU SEJAJAR DI MOBILE */
                flex-direction: row; 
                gap: 20px; 
                justify-content: space-around; /* Menyebar item menu */
                width: 90%;
            }
            
            .menu-item {
                max-width: 45%; /* Memastikan keduanya muat dan sejajar */
            }

            .icon-box {
                width: 110px; /* Perkecil ukuran box di mobile */
                height: 110px;
                border-radius: 15px;
            }

            .icon-box svg {
                width: 55px; /* Perkecil ikon di mobile */
                height: 55px;
            }
            
            .icon-label {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="header-section">
        <div class="header-logo">
            <img src="/assets/images/logolk.png" alt="Lokatiket Logo"> 
        </div>
        <h1 class="catchy-title">Pilih Petualanganmu Sekarang!</h1>
        <p class="subtitle">Akses cepat ke destinasi impian, baik untuk menjelajah lokasi atau merencanakan studi wisata.</p>
    </div>

    <div class="menu-container">
        
        <a href="{{ route('wisata.map') }}" class="menu-item">
            <div class="icon-box">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                </svg>
            </div>
            <span class="icon-label">Peta Wisata</span>
        </a>

        <a href="{{ route('customer.index') }}" class="menu-item">
            <div class="icon-box">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 18H6V4h12v16zM12 7.5c-2.3 0-3.5 1.7-3.5 3.5 0 .7.3 1.3.8 1.8l2.7 3.3c.3.3.7.3 1 0l2.7-3.3c.5-.5.8-1.1.8-1.8 0-1.8-1.2-3.5-3.5-3.5zm0 5.5c-.8 0-1.5-.7-1.5-1.5s.7-1.5 1.5-1.5 1.5.7 1.5 1.5-.7 1.5-1.5 1.5z"/>
                </svg>
            </div>
            <span class="icon-label">Tiket & Informasi</span>
        </a>
    </div>
    

</body>
</html>