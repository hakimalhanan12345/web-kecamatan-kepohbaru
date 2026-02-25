<?php
session_start();
include "../config.php";

// Proteksi Halaman Admin
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    die("ID Desa tidak ditemukan!");
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

// Ambil data desa lama
$query = mysqli_query($conn, "SELECT * FROM desa WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data desa tidak ditemukan!");
}

// PROSES UPDATE
if (isset($_POST['update'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $link = mysqli_real_escape_string($conn, $_POST['link']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    $update = mysqli_query($conn, "
        UPDATE desa SET 
            nama = '$nama', 
            deskripsi = '$deskripsi', 
            link = '$link' 
        WHERE id = '$id'
    ");

    if($update) {
        echo "<script>alert('Data Desa berhasil diperbarui!'); window.location='dashboard.php';</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Website Desa | Admin Kepohbaru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-green': '#1e7a4b', 
                        'secondary-orange': '#ffac33',
                    },
                    fontFamily: { 'poppins': ['Poppins', 'sans-serif'] }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 font-poppins flex items-center justify-center min-h-screen p-6">

    <div class="w-full max-w-xl bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-primary-green p-6 text-white flex items-center space-x-4">
            <div class="bg-white bg-opacity-20 p-3 rounded-lg">
                <i class="fas fa-edit text-2xl text-secondary-orange"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold">Edit Website Desa</h2>
                <p class="text-green-100 text-xs">Perbarui informasi dan tautan website desa</p>
            </div>
        </div>

        <div class="p-8">
            <form method="POST" class="space-y-6">
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-landmark mr-1 text-primary-green"></i> Nama Desa
                    </label>
                    <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']); ?>"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-green focus:border-primary-green focus:outline-none transition bg-gray-50 focus:bg-white"
                        placeholder="Masukkan nama desa..." required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-link mr-1 text-primary-green"></i> Link Website Desa
                    </label>
                    <input type="url" name="link" value="<?= htmlspecialchars($data['link']); ?>"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-green focus:border-primary-green focus:outline-none transition bg-gray-50 focus:bg-white text-blue-600"
                        placeholder="https://namadesa.desa.id" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-info-circle mr-1 text-primary-green"></i> Deskripsi Singkat
                    </label>
                    <textarea name="deskripsi" rows="5"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-green focus:border-primary-green focus:outline-none transition bg-gray-50 focus:bg-white"
                        placeholder="Tuliskan deskripsi atau potensi desa..." required><?= htmlspecialchars($data['deskripsi']); ?></textarea>
                </div>

                <div class="pt-4 flex flex-col sm:flex-row gap-3">
                    <button type="submit" name="update" 
                        class="flex-1 bg-primary-green hover:bg-green-800 text-white font-bold py-3 rounded-xl shadow-lg hover:shadow-green-200 transition-all transform active:scale-95 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                    </button>
                    
                    <a href="dashboard.php" 
                        class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-3 rounded-xl transition-all">
                        Batal
                    </a>
                </div>
            </form>
        </div>
        
        <div class="bg-gray-50 px-8 py-4 border-t border-gray-100 flex justify-between items-center text-[10px] text-gray-400">
            <span>ID Desa: #<?= $data['id']; ?></span>
            <span>Update Terakhir: <?= date('d M Y'); ?></span>
        </div>
    </div>

</body>
</html>