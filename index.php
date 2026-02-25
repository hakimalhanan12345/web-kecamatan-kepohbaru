<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kecamatan Kepohbaru | Bojonegoro</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/style.css">

    <style>
        /* Mengambil gaya background dari halaman informasi */
        .hero-section {
            background: linear-gradient(rgba(30, 122, 75, 0.85), rgba(30, 122, 75, 0.85)), url('assets/img/begron.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed; /* Memberikan efek parallax halus saat di-scroll */
            padding: 120px 20px; /* Menyesuaikan ruang agar teks tetap proporsional */
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            min-height: 70vh; /* Memastikan area selamat datang cukup luas */
        }

        .hero-content h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            line-height: 1.2;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.3);
        }

        .hero-content .subtitle {
            font-size: 1.2rem;
            max-width: 800px;
            margin: 0 auto 30px auto;
            color: rgba(255, 255, 255, 0.9);
        }
    </style>
</head>
<body>

<header class="main-header">
    <div class="logo-container">
        <img src="assets/img/logo1.png" alt="Logo Kepohbaru" class="logo">
        <span class="site-title">Kecamatan Kepohbaru</span>
    </div>
    <nav class="main-nav">
        <a href="index.php" class="nav-link active"><i class="fas fa-home"></i> Beranda</a>
        <a href="produk.php" class="nav-link"><i class="fas fa-store"></i> Produk Desa</a>
        <a href="desa.php" class="nav-link"><i class="fas fa-globe-asia"></i> Website Desa</a>
        <a href="galerineh.php" class="nav-link"><i class="fas fa-camera"></i> Dokumentasi </a>
        <a href="informasi.php" class="nav-link"><i class="fas fa-info-circle"></i> Informasi</a>
    </nav>
</header>

<main>
    <section class="hero-section">
        <div class="hero-content">
            <h1>Selamat Datang <br> di Website Kecamatan Kepohbaru</h1>
            <p class="subtitle">Website resmi untuk informasi desa, potensi wilayah, dan layanan publik di Kecamatan Kepohbaru.</p>
            <a href="produk.php" class="btn btn-primary"><i class="fas fa-box-open"></i> Lihat Produk Unggulan</a>
        </div>
    </section>

    <section class="stats-section">
        <div class="stat-card">
            <i class="fas fa-chart-line icon-stat"></i>
            <h3>25</h3>
            <p>Jumlah Desa</p>
        </div>
        <div class="stat-card">
            <i class="fas fa-hand-holding-heart icon-stat"></i>
            <h3>100+</h3>
            <p>Produk UMKM</p>
        </div>
        <div class="stat-card">
            <i class="fas fa-tractor icon-stat"></i>
            <h3>5668 Ha</h3>
            <p>Lahan Pertanian</p>
        </div>
    </section>

    <section class="content-section about-section">
        <h2 class="section-title text-center">Profil Kecamatan</h2>
        <div class="about-content">
            <p>Kecamatan Kepohbaru adalah wilayah administratif di Kabupaten Bojonegoro yang kaya akan sumber daya. Fokus kami adalah pemberdayaan masyarakat melalui pengembangan "UMKM, pertanian berkelanjutan", dan promosi "produk unggulan desa" untuk meningkatkan perekonomian lokal.</p>
            <div style="text-align: center; margin-top: 20px;">
                <a href="profil.php" class="btn btn-secondary">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <section class="content-section map-section">
        <div class="container">
            <h2 class="section-title">Peta Lokasi & Wilayah Administrasi</h2>
            <p class="subtitle-text" style="text-align: center; margin-bottom: 30px;">
                Kecamatan Kepohbaru, Kabupaten Bojonegoro, Jawa Timur.
            </p>
            
            <div class="map-container" style="border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border: 5px solid white;">
                <iframe 
                    width="100%" 
                    height="450" 
                    frameborder="0" 
                    style="border:0;" 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63334.61864115318!2d112.00165783353457!3d-7.193630652877567!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e779038084a441b%3A0xc47b97c02b37805d!2sKepohbaru%2C%20Kabupaten%20Bojonegoro%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1710000000000!5m2!1sid!2sid" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            
            <div style="text-align: center; margin-top: 20px;">
                <a href="https://maps.app.goo.gl/9ZpP5k7M89Q8x2Yh6" target="_blank" class="btn btn-secondary" style="font-size: 0.9rem;">
                    <i class="fas fa-map-marked-alt"></i> Lihat Lokasi di Google Maps
                </a>
            </div>
        </div>
    </section>
</main>

<footer class="main-footer">
    <div class="footer-grid">
        <div class="footer-column">
            <h3>Tentang Kami</h3>
            <p>Kecamatan Kepohbaru hadir sebagai pusat layanan dan informasi potensi wilayah, desa, serta pemberdayaan masyarakat di Kabupaten Bojonegoro.</p>
        </div>

        <div class="footer-column">
            <h3>Hubungi Kami</h3>
            <ul class="contact-list">
                <li><i class="fas fa-map-marker-alt"></i> Jl. Raya Kepohbaru No. 123, Bojonegoro 62194</li>
                <li><i class="fas fa-envelope"></i> kepohbaru@bojonegorokab.go.id</li>
                <li><i class="fas fa-phone"></i> (0353) 123456</li>
            </ul>
        </div>

        <div class="footer-column">
            <h3>Tautan Cepat</h3>
            <ul class="quick-links">
                <li><a href="index.php">Beranda</a></li>
                <li><a href="produk.php">Produk Unggulan</a></li>
                <li><a href="desa.php">Website Desa</a></li>
                <li><a href="informasi.php">Pusat Informasi</a></li>
            </ul>
        </div>
        
        <div class="footer-column social-media">
            <img src="assets/img/logo1.png" alt="Logo Kepohbaru" class="footer-logo">
            <p>Ikuti Kami:</p>
            <div class="social-icons">
                <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </div>

    <div class="footer-bottom text-center">
        <p class="copyright">© 2025 Kecamatan Kepohbaru - Kabupaten Bojonegoro. Hak Cipta Dilindungi.</p>
    </div>
</footer>

<a href="https://wa.me/6281234567890" class="whatsapp-float" target="_blank">
    <i class="fab fa-whatsapp"></i>
    <span class="wa-text">Hubungi Kami</span>
</a>

</body>
</html>