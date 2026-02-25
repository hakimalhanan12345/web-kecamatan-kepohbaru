<?php
session_start();
include '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit;
}

$status_msg = "";
$status_type = "";

if (isset($_POST['submit'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);

    if (!empty($_FILES['foto']['name'])) {

        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $allow = ['jpg','jpeg','png'];

        if (!in_array($ext, $allow)) {
            $status_msg = "Format file harus JPG / JPEG / PNG";
            $status_type = "error";
        } else {

            $folder = "../assets/img/galeri/";
            if (!is_dir($folder)) mkdir($folder, 0777, true);

            $nama_file = 'kepohbaru_' . time() . '.' . $ext;
            $target = $folder . $nama_file;

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
                mysqli_query($conn, "INSERT INTO galeri_foto (judul, nama_file) VALUES ('$judul','$nama_file')");
                $status_msg = "Foto berhasil diunggah";
                $status_type = "success";
            } else {
                $status_msg = "Gagal upload file";
                $status_type = "error";
            }
        }
    } else {
        $status_msg = "Silakan pilih file foto";
        $status_type = "info";
    }
}

if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    $q = mysqli_query($conn, "SELECT nama_file FROM galeri_foto WHERE id=$id");
    if ($d = mysqli_fetch_assoc($q)) {
        $path = "../assets/img/galeri/".$d['nama_file'];
        if (file_exists($path)) unlink($path);
        mysqli_query($conn, "DELETE FROM galeri_foto WHERE id=$id");
    }
    header("Location: upload_foto.php");
    exit;
}

$dataFoto = mysqli_query($conn, "SELECT * FROM galeri_foto ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Admin - Galeri Foto</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
:root{
    --primary:#1e7a4b;
    --secondary:#ffac33;
    --dark:#333;
    --light:#f4f6f9;
    --white:#fff;
    font-family:'Poppins',sans-serif;
}

*{box-sizing:border-box}

body{
    margin:0;
    background:var(--light);
    display:flex;
    min-height:100vh;
}

/* ===== SIDEBAR ===== */
.sidebar{
    width:280px;
    background:var(--primary);
    color:var(--white);
    position:fixed;
    height:100%;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
}

.logo-admin{
    padding:20px;
    text-align:center;
    font-size:1.5em;
    font-weight:700;
    background:rgba(0,0,0,.1);
}

.sidebar nav a{
    display:flex;
    align-items:center;
    padding:15px 25px;
    color:#fff;
    text-decoration:none;
    border-left:5px solid transparent;
}

.sidebar nav a:hover{
    background:rgba(0,0,0,.15);
}

.sidebar nav a.active{
    background:#145935;
    border-left:5px solid var(--secondary);
}

.sidebar nav a i{margin-right:12px}

.logout{
    padding:20px;
}

.logout a{
    display:block;
    background:var(--secondary);
    color:#333;
    padding:12px;
    text-align:center;
    border-radius:8px;
    font-weight:600;
    text-decoration:none;
}

/* ===== MAIN ===== */
.main{
    margin-left:280px;
    padding:40px;
    width:100%;
}

h1{margin-top:0}

/* ===== FORM ===== */
.card{
    max-width:700px;
    background:#fff;
    padding:30px;
    border-radius:15px;
    box-shadow:0 10px 30px rgba(0,0,0,.1);
    margin-bottom:50px;
}

input,button{
    width:100%;
    padding:14px;
    border-radius:8px;
    border:1px solid #ccc;
    font-size:1em;
}

button{
    background:var(--primary);
    color:#fff;
    font-weight:700;
    border:none;
    margin-top:25px;
    cursor:pointer;
}

/* ===== STATUS ===== */
.status{
    padding:14px;
    margin-bottom:20px;
    border-radius:8px;
    font-weight:600;
}
.success{background:#d4edda;color:#155724}
.error{background:#f8d7da;color:#721c24}
.info{background:#cce5ff;color:#004085}

/* ===== GRID FOTO (ANTI BESAR) ===== */
.foto-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(220px,1fr));
    gap:20px;
}

.foto-card{
    background:#fff;
    border-radius:14px;
    overflow:hidden;
    box-shadow:0 8px 25px rgba(0,0,0,.1);
}

.foto-card img{
    width:100%;
    height:180px;
    object-fit:cover;
    display:block;
}

.foto-card .info{
    padding:14px;
}

.hapus{
    display:inline-block;
    background:#dc3545;
    color:#fff;
    padding:8px 14px;
    border-radius:6px;
    text-decoration:none;
    font-size:.9em;
}
</style>
</head>

<body>

<div class="sidebar">
    <div>
        <div class="logo-admin" style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
            <img src="../assets/img/logo1.png" alt="Logo" style="width: 60px; height: auto; filter: drop-shadow(0px 2px 4px rgba(0,0,0,0.2));">
            <span style="font-size: 0.9em;">Admin Kepohbaru</span>
        </div>
        <nav>
            <a href="dashboard.php"><i class="fas fa-chart-line"></i> Dashboard</a>
            <a href="edit_profil.php"><i class="fas fa-address-card"></i> Profil</a>
            <a href="tambah_produk.php"><i class="fas fa-store"></i> Kelola Produk</a>
            <a href="tambah_desa.php"><i class="fas fa-globe-asia"></i> Kelola Desa</a>
            <a href="upload_foto.php" class="active"><i class="fas fa-camera"></i> Posting Foto </a>
            <a href="upload_video.php"><i class="fas fa-video"></i> Video Galeri</a>
            <a href="kelola_informasi.php"><i class="fas fa-headset"></i> Kelola Informasi</a>

        </nav>
    </div>
    <div class="logout">
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<div class="main">
    <h1>Unggah Foto Galeri</h1>

    <div class="card">
        <?php if($status_msg): ?>
            <div class="status <?= $status_type ?>"><?= $status_msg ?></div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">
            <label>Judul Foto</label>
            <input type="text" name="judul" required>

            <label style="margin-top:15px">File Foto</label>
            <input type="file" name="foto" accept="image/*" required>

            <button type="submit" name="submit">Upload Foto</button>
        </form>
    </div>

    <div class="foto-grid">
        <?php while($f=mysqli_fetch_assoc($dataFoto)): ?>
        <div class="foto-card">
            <img src="../assets/img/galeri/<?= $f['nama_file'] ?>">
            <div class="info">
                <strong><?= htmlspecialchars($f['judul']) ?></strong><br><br>
                <a class="hapus" href="?hapus=<?= $f['id'] ?>" onclick="return confirm('Hapus foto?')">
                    <i class="fas fa-trash"></i> Hapus
                </a>
            </div>
        </div>
        <?php endwhile; ?>
    </div>

</div>
</body>
</html>
