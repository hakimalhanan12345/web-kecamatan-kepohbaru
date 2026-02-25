<?php 
include 'config.php'; 

// Ambil data profil dari database
$query = mysqli_query($conn, "SELECT * FROM profil_kecamatan LIMIT 1");
$data = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil & Sejarah | Kecamatan Kepohbaru</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <style>
        .profile-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            margin-top: -50px; /* Membuat konten agak naik menimpa hero */
            position: relative;
            z-index: 10;
        }
        .text-content {
            text-align: justify;
            margin-bottom: 40px;
            line-height: 1.8;
        }
        .page-header-mini {
            background: linear-gradient(rgba(30, 122, 75, 0.8), rgba(30, 122, 75, 0.8)), url('assets/img/begron.jpg') center/cover;
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
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
        <a href="informasi.php" class="nav-link"><i class="fas fa-info-circle"></i> Informasi</a>
    </nav>
</header>

<main>
    <section class="page-header-mini">
        <div class="text-center">
            <h1>Profil & Sejarah Singkat Kecamatan Kepohbaru</h1>
            <p>Eksplorasi Detail Kecamatan Kepohbaru</p>
        </div>
    </section>

    <div class="content-section">
        <div class="profile-container">
            
            <div style="display: flex; flex-wrap: wrap; gap: 30px; align-items: start; margin-bottom: 50px;">
                <div style="flex: 1; min-width: 300px;">
                    <h2 class="section-title">Profil Wilayah</h2>
                    <div class="text-content">
                        <?php echo nl2br($data['profil']); ?>
                    </div>
                </div>
                <?php if($data['gambar_profil']): ?>
                <div style="flex: 1; min-width: 300px;">
                    <img src="assets/img/<?php echo $data['gambar_profil']; ?>" style="width: 100%; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                </div>
                <?php endif; ?>
            </div>

            <hr style="border: 0; border-top: 1px solid #eee; margin: 50px 0;">

            <div style="display: flex; flex-wrap: wrap-reverse; gap: 30px; align-items: start;">
                <?php if($data['gambar_sejarah']): ?>
                <div style="flex: 1; min-width: 300px;">
                    <img src="assets/img/<?php echo $data['gambar_sejarah']; ?>" style="width: 100%; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                </div>
                <?php endif; ?>
                <div style="flex: 1; min-width: 300px;">
                    <h2 class="section-title">Sejarah Kecamatan</h2>
                    <div class="text-content">
                        <?php echo nl2br($data['sejarah']); ?>
                    </div>
                </div>
            </div>

        </div>
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
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p class="copyright">© 2025 Kecamatan Kepohbaru - Bojonegoro.</p>
    </div>
</footer>

</body>
</html>