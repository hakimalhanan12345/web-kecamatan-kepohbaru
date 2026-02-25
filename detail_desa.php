<?php 
include 'config.php'; 

if (isset($_GET['id'])) {
    $desa_id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM desa WHERE id='$desa_id'";
    $result = mysqli_query($conn, $query);
    $desa = mysqli_fetch_assoc($result);
} else {
    $desa = null;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $desa ? htmlspecialchars($desa['nama']) : 'Desa Tidak Ditemukan' ?> | Kecamatan Kepohbaru</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <style>
        .simple-content-card {
            max-width: 800px;
            margin: 60px auto;
            background: #ffffff;
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            text-align: center;
        }
        .desa-brand-icon {
            font-size: 3.5rem;
            color: var(--color-primary);
            margin-bottom: 20px;
        }
        .desa-description {
            font-size: 1.1rem;
            color: #555;
            line-height: 1.8;
            margin: 25px 0 40px 0;
            text-align: justify;
        }
        .btn-action-container {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        @media (max-width: 600px) {
            .simple-content-card { margin: 30px 20px; padding: 30px; }
            .btn-action-container { flex-direction: column; }
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
        <a href="desa.php" class="nav-link active"><i class="fas fa-globe-asia"></i> Website Desa</a>
        <a href="galerineh.php" class="nav-link"><i class="fas fa-camera"></i> Dokumentasi </a>
        <a href="informasi.php" class="nav-link"><i class="fas fa-info-circle"></i> Informasi</a>
    </nav>
</header>

<main style="min-height: 60vh;">
    <div class="simple-content-card">
        <?php if ($desa): ?>
            <div class="desa-brand-icon">
                <i class="fas fa-university"></i>
            </div>
            
            <h1 class="section-title">Desa <?= htmlspecialchars($desa['nama']); ?></h1>
            
            <div class="desa-description">
                <?= nl2br(htmlspecialchars($desa['deskripsi'] ?? 'Selamat datang di halaman informasi resmi Desa ' . $desa['nama'] . '. Silakan kunjungi website resmi kami untuk layanan publik dan informasi lebih lanjut.')); ?>
            </div>

            <div class="btn-action-container">
                <a href="<?= htmlspecialchars($desa['link']); ?>" target="_blank" class="btn btn-primary">
                    <i class="fas fa-external-link-alt"></i> Kunjungi Website Desa
                </a>
                <a href="desa.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

        <?php else: ?>
            <div style="padding: 50px 0;">
                <i class="fas fa-search-minus" style="font-size: 4em; color: #ddd; margin-bottom: 20px;"></i>
                <h2>Desa Tidak Ditemukan</h2>
                <p>Maaf, data desa tidak ditemukan dalam database kami.</p>
                <br>
                <a href="desa.php" class="btn btn-primary">Kembali ke Daftar Desa</a>
            </div>
        <?php endif; ?>
    </div>
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

    <div class="footer-bottom">
        <p class="copyright">© 2025 Kecamatan Kepohbaru - Kabupaten Bojonegoro. Hak Cipta Dilindungi.</p>
    </div>
</footer>

<a href="https://wa.me/6281234567890" class="whatsapp-float" target="_blank">
    <i class="fab fa-whatsapp"></i>
    <span class="wa-text">Hubungi Kami</span>
</a>

</body>
</html>