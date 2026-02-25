<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Layanan | Kecamatan Kepohbaru</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/style.css">

    <style>
        /* Gaya khusus untuk halaman informasi */
        .info-hero {
            background: linear-gradient(rgba(30, 122, 75, 0.9), rgba(30, 122, 75, 0.9)), url('assets/img/begron.jpg');
            background-size: cover;
            background-position: center;
            padding: 80px 20px;
            text-align: center;
            color: white;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
            margin: -50px auto 80px auto; /* Membuat kartu naik ke area hero */
            max-width: 1200px;
            padding: 0 20px;
        }

        .info-card {
            background: #fff;
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            border-bottom: 5px solid var(--color-secondary);
            transition: all 0.3s ease;
            position: relative;
        }

        .info-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 45px rgba(0,0,0,0.15);
        }

        .info-icon-circle {
            width: 70px;
            height: 70px;
            background: var(--color-light);
            color: var(--color-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        .info-card h3 {
            color: var(--color-primary);
            font-size: 1.4rem;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .info-card p {
            line-height: 1.8;
            color: #555;
            white-space: pre-line; /* Agar ganti baris dari database tetap terbaca */
        }

        .alert-info-box {
            background: #fff9eb;
            border: 1px dashed #ffac33;
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            color: #856404;
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
        <a href="index.php" class="nav-link"><i class="fas fa-home"></i> Beranda</a>
        <a href="produk.php" class="nav-link"><i class="fas fa-store"></i> Produk Desa</a>
        <a href="desa.php" class="nav-link"><i class="fas fa-globe-asia"></i> Website Desa</a>
        <a href="galerineh.php" class="nav-link"><i class="fas fa-camera"></i> Dokumentasi </a>
        <a href="informasi.php" class="nav-link active"><i class="fas fa-info-circle"></i> Informasi</a>
    </nav>
</header>

<main>
    <section class="info-hero">
        <div class="container">
            <h1>Pusat Informasi & Pelayanan</h1>
            <p>Jadwal operasional, persyaratan dokumen, dan panduan layanan publik Kecamatan Kepohbaru.</p>
        </div>
    </section>

    <section class="container">
        <div class="info-grid">
            <?php
            $query = mysqli_query($conn, "SELECT * FROM informasi ORDER BY id DESC");
            if (mysqli_num_rows($query) > 0):
                while($row = mysqli_fetch_assoc($query)):
            ?>
            <div class="info-card">
                <div class="info-icon-circle">
                    <i class="fas <?= htmlspecialchars($row['icon']); ?>"></i>
                </div>
                <h3><?= htmlspecialchars($row['judul']); ?></h3>
                <p><?= nl2br(htmlspecialchars($row['isi'])); ?></p>
            </div>
            <?php 
                endwhile;
            else:
            ?>
                <div style="grid-column: 1/-1; text-align: center; padding: 50px; background: white; border-radius: 20px;">
                    <i class="fas fa-info-circle" style="font-size: 3rem; color: #ddd; margin-bottom: 15px;"></i>
                    <p>Belum ada informasi layanan yang diterbitkan.</p>
                </div>
            <?php endif; ?>
        </div>
        
        <div style="max-width: 800px; margin: 0 auto 80px auto;">
            <div class="alert-info-box">
                <i class="fas fa-exclamation-circle" style="font-size: 1.5rem;"></i>
                <p style="font-size: 0.9rem; margin: 0;">
                    Informasi di atas dapat berubah sewaktu-waktu sesuai dengan peraturan daerah yang berlaku. Untuk konsultasi lebih lanjut, silakan hubungi kami via WhatsApp.
                </p>
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