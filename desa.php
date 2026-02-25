<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Resmi Desa | Kecamatan Kepohbaru</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    <link rel="stylesheet" href="assets/style.css">

    <style>
        :root {
            --color-primary: #1e7a4b;
            --color-secondary: #ffac33;
            --color-light: #f0f9f4;
            --color-dark: #2d3436;
        }

        /* Hero Section */
        .desa-hero {
            background: linear-gradient(rgba(30, 122, 75, 0.85), rgba(30, 122, 75, 0.85)), url('assets/img/begron.jpg');
            background-size: cover;
            background-position: center;
            padding: 100px 20px;
            text-align: center;
            color: white;
        }

        .desa-hero h1 { font-size: 3rem; font-weight: 700; margin-bottom: 10px; }
        .desa-hero p { font-size: 1.1rem; opacity: 0.9; }

        /* Slider Styles */
        .swiper {
            width: 100%;
            padding: 50px 0 100px 0 !important;
        }
        
        .swiper-slide {
            display: flex;
            justify-content: center;
            height: auto;
        }

        .desa-card {
            background: #fff;
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            border: 1px solid #eee;
            transition: all 0.4s ease;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            width: 100%;
            max-width: 350px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .desa-card:hover {
            transform: translateY(-15px);
            border-color: var(--color-primary);
            box-shadow: 0 20px 40px rgba(30, 122, 75, 0.15);
        }

        .desa-icon-box {
            width: 80px;
            height: 80px;
            background: var(--color-light);
            color: var(--color-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 2rem;
            transition: 0.3s;
        }

        .desa-card:hover .desa-icon-box {
            background: var(--color-primary);
            color: white;
        }

        .desa-card h3 { font-size: 1.5rem; margin-bottom: 15px; color: var(--color-dark); }
        .desa-desc { color: #636e72; line-height: 1.6; margin-bottom: 30px; font-size: 0.95rem; }

        /* Swiper Navigation */
        .swiper-button-next, .swiper-button-prev {
            color: var(--color-primary) !important;
            background: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .swiper-pagination-bullet-active { background: var(--color-primary) !important; }

        .btn-desa-slider {
            display: inline-block;
            padding: 12px 25px;
            background: var(--color-primary);
            color: white;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-desa-slider:hover {
            background: var(--color-dark);
            transform: scale(1.05);
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
        <a href="galerineh.php" class="nav-link"><i class="fas fa-camera"></i> Dokumentasi</a>
        <a href="informasi.php" class="nav-link"><i class="fas fa-info-circle"></i> Informasi</a>
    </nav>
</header>

<main>
    <section class="desa-hero">
        <div class="container">
            <h1>E-Desa Kepohbaru</h1>
            <p>Geser kereta di bawah untuk menjelajahi website resmi desa kami</p>
        </div>
    </section>

    <section class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                
                <?php
                $query = mysqli_query($conn, "SELECT * FROM desa ORDER BY nama ASC");
                if (mysqli_num_rows($query) > 0):
                    while ($desa = mysqli_fetch_assoc($query)):
                        $deskripsi = !empty($desa['deskripsi']) ? $desa['deskripsi'] : "Website resmi pemerintah desa untuk pelayanan dan informasi masyarakat.";
                ?>
                    <div class="swiper-slide">
                        <div class="desa-card">
                            <div>
                                <div class="desa-icon-box">
                                    <i class="fas fa-university"></i>
                                </div>
                                <h3>Desa <?= htmlspecialchars($desa['nama']); ?></h3>
                                <p class="desa-desc"><?= htmlspecialchars($deskripsi); ?></p>
                            </div>
                            <a href="detail_desa.php?id=<?= $desa['id']; ?>" class="btn-desa-slider">
                                Lihat Desa <i class="fas fa-arrow-right" style="margin-left: 10px;"></i>
                            </a>
                        </div>
                    </div>
                <?php 
                    endwhile;
                else:
                    echo "<p style='text-align:center; width:100%;'>Data desa belum tersedia.</p>";
                endif; 
                ?>

            </div>
            
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
</main>

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
                <li><a href="produk.php">Produk Desa</a></li>
                <li><a href="desa.php">Website Desa</a></li>
                <li><a href="informasi.php">Pusat Informasi</a></li>

            </ul>
        </div>
        <div class="footer-column social-media text-center">
            <img src="assets/img/logo1.png" alt="Logo Kepohbaru" class="footer-logo">
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© 2025 Kecamatan Kepohbaru - Kabupaten Bojonegoro</p>
    </div>
</footer>

<a href="https://wa.me/6281234567890" class="whatsapp-float" target="_blank">
    <i class="fab fa-whatsapp"></i>
    <span class="wa-text">Hubungi Kami</span>
</a>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
  var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    grabCursor: true,
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      768: { slidesPerView: 2 },
      1024: { slidesPerView: 3 },
    },
  });
</script>

</body>
</html>