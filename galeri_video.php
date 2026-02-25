<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Galeri Video | Kecamatan Kepohbaru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FONT & ICON -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/style.css">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f4f4f4;
        }

        /* ================= GALERI ================= */
        .gallery-section {
            padding: 60px 50px;
            max-width: 1200px;
            margin: auto;
        }

        .gallery-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .gallery-title h2 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        /* ===== TAB FOTO & VIDEO ===== */
        .gallery-tabs {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 35px;
        }

        .tab-btn {
            padding: 12px 30px;
            border-radius: 30px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            background: #e0e0e0;
            color: #555;
            box-shadow: 0 4px 10px rgba(0,0,0,.15);
            transition: .3s;
            text-decoration: none;
        }

        .tab-btn i {
            margin-right: 8px;
        }

        .tab-btn.active {
            background: linear-gradient(135deg, #1e88e5, #1565c0);
            color: #fff;
        }

        .tab-btn:hover {
            transform: translateY(-2px);
        }

        /* ===== GRID VIDEO ===== */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .video-item {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,.15);
        }

        .video-item iframe {
            width: 100%;
            height: 220px;
            border: none;
        }

        .video-caption {
            padding: 12px;
            font-weight: 600;
            font-size: 14px;
        }
    </style>
</head>
<body>

<!-- HEADER -->
<header class="main-header">
    <div class="logo-container">
        <img src="assets/img/logo1.png" alt="Logo Kepohbaru" class="logo">
        <span class="site-title">Kecamatan Kepohbaru</span>
    </div>
    <nav class="main-nav">
        <a href="index.php" class="nav-link"><i class="fas fa-home"></i> Beranda</a>
        <a href="produk.php" class="nav-link"><i class="fas fa-store"></i> Produk Desa</a>
        <a href="desa.php" class="nav-link"><i class="fas fa-globe-asia"></i> Website Desa</a>
        <a href="galerineh.php" class="nav-link active"><i class="fas fa-camera"></i> Dokumentasi</a>
        <a href="informasi.php" class="nav-link"><i class="fas fa-info-circle"></i> Informasi</a>
    </nav>
</header>

<!-- GALERI VIDEO -->
<section class="gallery-section">

    <div class="gallery-title">
        <h2>Galeri Video Kecamatan</h2>
        <p>Dokumentasi video kegiatan Kepohbaru</p>
    </div>

    <div class="gallery-tabs">
        <a href="galerineh.php" class="tab-btn">
            <i class="fas fa-image"></i> Foto
        </a>
        <a href="video.php" class="tab-btn active">
            <i class="fas fa-video"></i> Video
        </a>
    </div>

    <div class="gallery-grid">
        <?php
        $q = mysqli_query($conn, "SELECT * FROM galeri_video ORDER BY tanggal_upload DESC");
        while ($row = mysqli_fetch_assoc($q)) {
        ?>
        <div class="video-item">
            <iframe src="<?= $row['link_video']; ?>" allowfullscreen></iframe>
            <div class="video-caption">
                <?= $row['judul']; ?>
            </div>
        </div>
        <?php } ?>
    </div>

</section>

<!-- FOOTER -->
<footer class="main-footer">
    <div class="footer-grid">
        <div class="footer-column">
            <h3>Tentang Kami</h3>
            <p>Kecamatan Kepohbaru hadir sebagai pusat layanan dan informasi potensi wilayah, desa, serta pemberdayaan masyarakat.</p>
        </div>
        <div class="footer-column">
            <h3>Hubungi Kami</h3>
            <ul class="contact-list">
                <li><i class="fas fa-map-marker-alt"></i> Jl. Raya Kepohbaru No. 123</li>
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
    </div>
    <div class="footer-bottom">
        <p>© 2025 Kecamatan Kepohbaru</p>
    </div>
</footer>

<a href="https://wa.me/6281234567890?text=Halo%20Admin%2C%20saya%20ingin%20bertanya%20tentang%20layanan%20Kecamatan%20Kepohbaru." class="whatsapp-float" target="_blank">
    <i class="fab fa-whatsapp"></i>
    <span class="wa-text">Hubungi Kami</span>
</a>

</body>
</html>
