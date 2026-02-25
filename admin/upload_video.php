<?php
session_start();
include '../config.php';

if(!isset($_SESSION['admin'])){
    header("Location: admin.php");
    exit;
}

$status_msg = "";
$status_type = "";

/* =======================
   FUNGSI AUTO EMBED YOUTUBE
======================= */
function youtubeEmbed($url){
    if (preg_match('/youtu\.be\/([^\?]+)/', $url, $match)) {
        return 'https://www.youtube.com/embed/' . $match[1];
    } elseif (preg_match('/youtube\.com.*v=([^&]+)/', $url, $match)) {
        return 'https://www.youtube.com/embed/' . $match[1];
    }
    return '';
}

/* =======================
   TAMBAH VIDEO
======================= */
if(isset($_POST['submit'])){
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $link  = $_POST['link_video'];

    $embed = youtubeEmbed($link);

    if($embed == ""){
        $status_msg = "Link YouTube tidak valid!";
        $status_type = "error";
    } else {
        $sql = "INSERT INTO galeri_video (judul, link_video) VALUES ('$judul', '$embed')";
        if(mysqli_query($conn, $sql)){
            $status_msg = "Video berhasil ditambahkan!";
            $status_type = "success";
        } else {
            $status_msg = "Error database!";
            $status_type = "error";
        }
    }
}

/* =======================
   HAPUS VIDEO
======================= */
if(isset($_GET['hapus'])){
    $id = intval($_GET['hapus']);
    mysqli_query($conn, "DELETE FROM galeri_video WHERE id=$id");
    header("Location: upload_video.php");
    exit;
}

/* =======================
   AMBIL DATA VIDEO
======================= */
$dataVideo = mysqli_query($conn, "SELECT * FROM galeri_video ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Video Galeri</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/style.css">

    <style>
        :root{
            --color-primary:#1e7a4b;
            --color-secondary:#ffac33;
            --color-dark:#333;
            --color-white:#fff;
        }

        body{
            margin:0;
            font-family:'Poppins',sans-serif;
            background:#f4f6f9;
            display: flex;
        }

        /* SIDEBAR FIXED */
        .sidebar {
            width: 250px;
            background: var(--color-primary);
            color: var(--color-white);
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .logo-admin {
            text-align: center;
            padding: 30px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar nav {
            flex-grow: 1;
            padding: 20px 0;
        }

        .sidebar nav a {
            display: flex;
            align-items: center;
            padding: 15px 25px;
            color: var(--color-white);
            text-decoration: none;
            transition: 0.3s;
            border-left: 5px solid transparent;
        }

        .sidebar nav a i { margin-right: 15px; width: 20px; }

        .sidebar nav a:hover, .sidebar nav a.active {
            background: rgba(0,0,0,0.1);
            border-left: 5px solid var(--color-secondary);
        }

        .logout-btn-sidebar { padding: 20px; }
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

        /* MAIN CONTENT */
        .main-content {
            margin-left: 250px;
            padding: 40px;
            width: calc(100% - 250px);
        }

        .upload-container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            max-width: 600px;
            margin-bottom: 40px;
        }

        .upload-container input[type="text"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
        }

        .btn-submit {
            background: var(--color-primary);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            width: 100%;
        }

        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }

        .video-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .video-card iframe { width: 100%; height: 200px; border: none; }
        .video-card .info { padding: 15px; }
        
        .btn-delete {
            color: #dc3545;
            text-decoration: none;
            font-size: 0.9em;
            font-weight: 600;
        }

        .status-message {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .success { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="logo-admin">
        <img src="../assets/img/logo1.png" alt="Logo" style="width: 50px; margin-bottom: 10px;">
        <div style="font-weight: 700; font-size: 1.1em;">Admin Kepohbaru</div>
    </div>
    <nav>
        <a href="dashboard.php"><i class="fas fa-chart-line"></i> Dashboard</a>
        <a href="edit_profil.php"><i class="fas fa-address-card"></i> Profil</a>
        <a href="tambah_produk.php"><i class="fas fa-store"></i> Kelola Produk</a>
        <a href="tambah_desa.php"><i class="fas fa-globe-asia"></i> Kelola Desa</a>
        <a href="upload_foto.php"><i class="fas fa-camera"></i> Posting Foto</a>
        <a href="upload_video.php" class="active"><i class="fas fa-video"></i> Video Galeri</a>
        <a href="kelola_informasi.php"><i class="fas fa-headset"></i> Kelola Informasi</a>
    </nav>
    <div class="logout-btn-sidebar">
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<div class="main-content">
    <div class="page-header">
        <h1>Kelola Video Galeri</h1>
        <p>Tambah & hapus dokumentasi video YouTube untuk halaman galeri.</p>
    </div>

    <div class="upload-container">
        <?php if($status_msg): ?>
            <div class="status-message <?= $status_type ?>"><?= $status_msg ?></div>
        <?php endif; ?>

        <form method="POST">
            <label>Judul Video</label>
            <input type="text" name="judul" placeholder="Masukkan judul video..." required>

            <label>Link YouTube</label>
            <input type="text" name="link_video" placeholder="Contoh: https://www.youtube.com/watch?v=xxxx" required>

            <button type="submit" name="submit" class="btn-submit">
                <i class="fas fa-save"></i> Simpan Video
            </button>
        </form>
    </div>

    <div class="video-grid">
        <?php while($v = mysqli_fetch_assoc($dataVideo)): ?>
        <div class="video-card">
            <iframe src="<?= $v['link_video']; ?>" allowfullscreen></iframe>
            <div class="info">
                <h4 style="margin: 0 0 10px 0;"><?= htmlspecialchars($v['judul']); ?></h4>
                <a href="?hapus=<?= $v['id']; ?>" class="btn-delete" onclick="return confirm('Hapus video ini?')">
                    <i class="fas fa-trash"></i> Hapus Video
                </a>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

</body>
</html>