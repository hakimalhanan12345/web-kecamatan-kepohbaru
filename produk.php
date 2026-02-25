<?php 
include 'config.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Unggulan Desa | Kecamatan Kepohbaru</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/style.css">

    <style> 
        /* ===== GALERI PRODUK ===== */

.product-card {
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

/* Wrapper gambar */
.product-img {
    width: 100%;
    height: 180px;              /* KUNCI TINGGI */
    object-fit: cover;          /* POTONG RAPINYA */
    border-radius: 12px;
    margin-bottom: 15px;
    background: #f2f2f2;
}

/* Grid galeri */
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 25px;
}

/* Deskripsi biar rapi */
.product-desc {
    font-size: 0.9em;
    color: #555;
    line-height: 1.5;
    margin-bottom: 10px;

    /* Batas tinggi teks */
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

    </style>
</head>
<body>

<!-- HEADER (TIDAK DIUBAH) -->
<header class="main-header">
    <div class="logo-container">
        <img src="assets/img/logo1.png" alt="Logo Kepohbaru" class="logo">
        <span class="site-title">Kepohbaru</span>
    </div>
    <nav class="main-nav">
        <a href="index.php" class="nav-link"><i class="fas fa-home"></i> Beranda</a>
        <a href="produk.php" class="nav-link active"><i class="fas fa-store"></i> Produk Desa</a>
        <a href="desa.php" class="nav-link"><i class="fas fa-globe-asia"></i> Website Desa</a>
        <a href="galerineh.php" class="nav-link"><i class="fas fa-camera"></i> Dokumentasi</a>
        <a href="informasi.php" class="nav-link"><i class="fas fa-info-circle"></i> Informasi</a>
    </nav>
</header>

<!-- CONTENT -->
<main>
    <section class="content-section">
        <h2 class="section-title">Produk Unggulan UMKM Desa</h2>
    

        <div class="grid">

            <?php
            $query = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC");

            if (mysqli_num_rows($query) > 0):
                while ($produk = mysqli_fetch_assoc($query)):
            ?>

                <div class="card product-card">
                    <img 
                        src="assets/img/<?= htmlspecialchars($produk['gambar']); ?>" 
                        alt="<?= htmlspecialchars($produk['nama']); ?>" 
                        class="product-img"
                    >

                    <h3><?= htmlspecialchars($produk['nama']); ?></h3>

                    <p class="product-desc">
                        <?= htmlspecialchars($produk['deskripsi']); ?>
                    </p>

                    <a href="detail_produk.php?id=<?= $produk['id']; ?>" 
                       class="btn btn-primary btn-small">
                        Detail Produk
                    </a>
                </div>

            <?php
                endwhile;
            else:
            ?>
                <p style="grid-column:1/-1;text-align:center;color:#cc0000;">
                    Data produk belum tersedia.
                </p>
            <?php endif; ?>

        </div>
    </section>
</main>

<!-- FOOTER (TIDAK DIUBAH) -->
<footer class="main-footer">
    <div class="footer-grid">
        <div class="footer-column">
            <h3>Tentang Kami</h3>
            <p>Kecamatan Kepohbaru hadir sebagai pusat layanan dan informasi potensi wilayah, desa, serta pemberdayaan masyarakat di Kabupaten Bojonegoro.</p>
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

        <div class="footer-column social-media">
            <img src="assets/img/logo1.png" alt="Logo Kepohbaru" class="footer-logo">
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>© 2025 Kecamatan Kepohbaru - Kabupaten Bojonegoro</p>
    </div>
</footer>

</body>
</html>
