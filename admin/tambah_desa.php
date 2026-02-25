<?php
include '../config.php';

if (isset($_POST['save'])) {
    // Ambil & amankan input
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $link = mysqli_real_escape_string($conn, $_POST['link']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    // Simpan ke database
    $query = "INSERT INTO desa (nama, deskripsi, link) VALUES ('$nama', '$deskripsi', '$link')";

    if(mysqli_query($conn, $query)) {
        echo "<script>alert('Website Desa berhasil ditambahkan!'); window.location='dashboard.php';</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Website Desa | Admin Kepohbaru</title>
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
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 font-poppins flex items-center justify-center min-h-screen p-6">

    <div class="w-full max-w-lg bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-primary-green p-6 text-white flex items-center justify-center space-x-3">
            <i class="fas fa-globe-asia text-2xl text-secondary-orange"></i>
            <div class="text-center">
                <h2 class="text-2xl font-bold">Tambah Website Desa</h2>
                <p class="text-green-100 text-xs opacity-80">Input data administrasi website desa baru</p>
            </div>
        </div>

        <div class="p-8">
            <form method="POST" class="space-y-6">
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-map-marker-alt mr-1 text-primary-green"></i> Nama Desa
                    </label>
                    <input type="text" name="nama" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-green focus:border-primary-green focus:outline-none transition bg-gray-50 focus:bg-white"
                        placeholder="Contoh: Desa Sidomulyo" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-link mr-1 text-primary-green"></i> URL Website Desa
                    </label>
                    <input type="url" name="link" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-green focus:border-primary-green focus:outline-none transition bg-gray-50 focus:bg-white text-blue-600"
                        placeholder="https://sidomulyo-kepohbaru.desa.id" required>
                    <p class="text-[10px] text-gray-400 mt-1 italic">*Gunakan format lengkap (http:// atau https://)</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-align-left mr-1 text-primary-green"></i> Deskripsi Singkat Desa
                    </label>
                    <textarea name="deskripsi" rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-green focus:border-primary-green focus:outline-none transition bg-gray-50 focus:bg-white"
                        placeholder="Tuliskan profil singkat desa atau potensi utamanya..." required></textarea>
                </div>

                <div class="pt-4 flex flex-col space-y-3">
                    <button type="submit" name="save" 
                        class="w-full bg-primary-green hover:bg-green-800 text-white font-bold py-3 rounded-xl shadow-lg hover:shadow-green-200 transition-all transform active:scale-95 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i> Simpan Website Desa
                    </button>
                    
                    <a href="dashboard.php" 
                        class="w-full text-center py-2 text-sm font-medium text-gray-500 hover:text-red-500 transition-colors">
                        Batal dan Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>