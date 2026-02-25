<?php
session_start();
include '../config.php';

// Jika belum login, redirect ke admin.php (sebelumnya login.php)
if(!isset($_SESSION['admin'])){
    header("Location: admin.php"); 
    exit;
}

// FUNGSI UNTUK MENGHITUNG TOTAL DATA
$total_produk = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM produk"));
$total_desa = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM desa"));

// Ambil data produk dan desa
$produk = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC");
$desa = mysqli_query($conn, "SELECT * FROM desa ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Kepohbaru</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <link rel="stylesheet" href="../assets/style.css">
    
    <style>
        /* Variabel Warna (Mengambil dari style.css yang Anda tunjukkan sebelumnya) */
        :root {
            --color-primary: #1e7a4b; /* Hijau Tua */
            --color-secondary: #ffac33; /* Kuning Emas */
            --color-dark: #333333;
            --color-light: #f4f4f4;
            --color-white: #ffffff;
            --font-family: 'Poppins', sans-serif;
        }

        /* --- Layout Dasar Dashboard --- */
        body {
            display: flex; /* Mengaktifkan Flexbox untuk layout sidebar */
            font-family: var(--font-family);
            background: var(--color-light);
            min-height: 100vh;
        }
        
        /* --- SIDEBAR --- */
        .sidebar {
            width: 250px;
            background: var(--color-primary);
            color: var(--color-white);
            padding: 20px 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            position: fixed; /* Sidebar tetap */
            height: 100%;
        }
        .sidebar .logo-admin {
            text-align: center;
            padding: 10px 20px 30px;
            font-size: 1.5em;
            font-weight: 700;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        .sidebar nav a {
            display: block;
            padding: 15px 20px;
            color: var(--color-white);
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s, color 0.3s;
            border-left: 5px solid transparent;
        }
        .sidebar nav a:hover, .sidebar nav a.active {
            background: #145935; /* Primary color sedikit gelap saat hover */
            border-left: 5px solid var(--color-secondary);
        }
        .sidebar nav a i {
            margin-right: 10px;
        }
        .logout-btn-sidebar {
            position: absolute;
            bottom: 20px;
            width: 100%;
            padding: 0 20px;
        }
        .logout-btn-sidebar a {
            display: block;
            padding: 10px;
            background: var(--color-secondary);
            color: var(--color-dark);
            text-align: center;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
        }

        /* --- MAIN CONTENT --- */
        .main-content {
            margin-left: 250px; /* Jarak selebar sidebar */
            padding: 30px;
            flex-grow: 1;
        }
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 2px solid #ddd;
        }
        .page-header h1 {
            color: var(--color-dark);
            font-size: 2em;
        }

        /* --- DASHBOARD CARDS (Ringkasan Data) --- */
        .card-container {
            display: flex;
            gap: 20px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }
        .info-card {
            flex: 1;
            min-width: 250px;
            background: var(--color-white);
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .info-card h4 {
            margin: 0 0 5px 0;
            color: #777;
            font-weight: 400;
        }
        .info-card .count {
            font-size: 2.5em;
            font-weight: 700;
            color: var(--color-primary);
        }
        .info-card .icon {
            font-size: 3em;
            color: var(--color-secondary);
        }

        /* --- STYLE TABLE (Data Management) --- */
        .data-management {
            background: var(--color-white);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 40px;
        }
        .data-management h3 {
            color: var(--color-primary);
            margin-top: 0;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.5em;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 0.95em;
        }
        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }
        table th {
            background-color: var(--color-light);
            color: var(--color-dark);
            font-weight: 600;
            text-transform: uppercase;
        }
        table tr:hover {
            background-color: #fafafa;
        }
        .btn-action {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            margin-right: 5px;
        }
        .btn-edit {
            background: #007bff;
            color: var(--color-white);
        }
        .btn-delete {
            background: #dc3545;
            color: var(--color-white);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }
            .main-content {
                margin-left: 0;
            }
            .card-container {
                flex-direction: column;
            }
            .info-card {
                min-width: 100%;
            }
            .logout-btn-sidebar {
                position: static;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="logo-admin" style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
        <img src="../assets/img/logo1.png" alt="Logo" style="width: 60px; height: auto; filter: drop-shadow(0px 2px 4px rgba(0,0,0,0.2));">
        <span style="font-size: 0.9em;">Admin Kepohbaru</span>
    </div>
    <nav>
        <a href="dashboard.php" class="active"><i class="fas fa-chart-line"></i> Dashboard</a>
        <a href="edit_profil.php"><i class="fas fa-address-card"></i> Profil</a>
        <a href="tambah_produk.php"><i class="fas fa-store"></i> Kelola Produk</a>
        <a href="tambah_desa.php"><i class="fas fa-globe-asia"></i> Kelola Desa</a>
        <a href="upload_foto.php"><i class="fas fa-camera"></i> posting foto</a>
        <a href="upload_video.php"><i class="fas fa-video"></i> Video Galeri</a>
        <a href="kelola_informasi.php"><i class="fas fa-headset"></i> Kelola Informasi</a>


        </nav>
    <div class="logout-btn-sidebar">
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<div class="main-content">
    <div class="page-header">
        <h1>Halo, <?php echo htmlspecialchars($_SESSION['admin']); ?>!</h1>
    </div>

    <div class="card-container">
        <div class="info-card">
            <div>
                <h4>Total Produk</h4>
                <div class="count"><?php echo $total_produk; ?></div>
            </div>
            <i class="fas fa-boxes icon"></i>
        </div>
        
        <div class="info-card">
            <div>
                <h4>Total Website Desa Aktif</h4>
                <div class="count"><?php echo $total_desa; ?></div>
            </div>
            <i class="fas fa-globe icon"></i>
        </div>
    </div>

    <hr>

    <div class="data-management" id="produk-section">
        <h3>
            <i class="fas fa-store"></i> Produk Unggulan
            <a href="tambah_produk.php" class="btn btn-action" style="background: var(--color-primary); color: var(--color-white);"><i class="fas fa-plus"></i> Tambah Produk</a>
        </h3>
        
        <table>
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Deskripsi Singkat</th>
                    <th width="150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($produk) > 0) {
                    while($p = mysqli_fetch_assoc($produk)){
                        // Batasi deskripsi agar tabel tidak terlalu lebar
                        $deskripsi_singkat = (strlen($p['deskripsi']) > 50) ? substr($p['deskripsi'], 0, 50) . '...' : $p['deskripsi'];
                        echo "
                        <tr>
                            <td>".htmlspecialchars($p['nama'])."</td>
                            <td>".htmlspecialchars($deskripsi_singkat)."</td>
                            <td>
                                <a href='edit_produk.php?id={$p['id']}' class='btn-action btn-edit'><i class='fas fa-edit'></i> Edit</a>
                                <a href='hapus.php?type=produk&id={$p['id']}' class='btn-action btn-delete' onclick=\"return confirm('Yakin ingin menghapus produk ini?')\"><i class='fas fa-trash-alt'></i> Hapus</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' style='text-align:center;'>Belum ada data produk.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="data-management" id="desa-section">
        <h3>
            <i class="fas fa-globe-asia"></i> Website Desa
            <a href="tambah_desa.php" class="btn btn-action" style="background: var(--color-primary); color: var(--color-white);"><i class="fas fa-plus"></i> Tambah Desa</a>
        </h3>
        
        <table>
            <thead>
                <tr>
                    <th>Nama Desa</th>
                    <th>Link Website</th>
                    <th width="150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($desa) > 0) {
                    while($d = mysqli_fetch_assoc($desa)){
                        echo "
                        <tr>
                            <td>".htmlspecialchars($d['nama'])."</td>
                            <td><a href='".htmlspecialchars($d['link'])."' target='_blank'>".htmlspecialchars($d['link'])."</a></td>
                            <td>
                                <a href='edit_desa.php?id={$d['id']}' class='btn-action btn-edit'><i class='fas fa-edit'></i> Edit</a>
                                <a href='hapus.php?type=desa&id={$d['id']}' class='btn-action btn-delete' onclick=\"return confirm('Yakin ingin menghapus desa ini?')\"><i class='fas fa-trash-alt'></i> Hapus</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' style='text-align:center;'>Belum ada data desa.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>