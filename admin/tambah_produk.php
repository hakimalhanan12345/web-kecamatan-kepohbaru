<?php
session_start();
include '../config.php';

if(isset($_POST['save'])){
    // Menggunakan mysqli_real_escape_string untuk keamanan input dari karakter aneh/SQL Injection
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $desk = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $gambar = $_FILES['gambar']['name'];

    // Pastikan folder ../assets/img/ sudah ada
    move_uploaded_file($_FILES['gambar']['tmp_name'], "../assets/img/".$gambar);

    // Proses Insert ke Database
    mysqli_query($conn, "INSERT INTO produk(nama,deskripsi,gambar) VALUES('$nama','$desk','$gambar')");
    
    // Alihkan kembali ke dashboard setelah berhasil
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk Baru | Admin Kepohbaru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        // Konfigurasi warna agar selaras dengan sidebar hijau dan tombol oranye Anda
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

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-primary-green p-6 text-white text-center">
            <h2 class="text-2xl font-bold">Tambah Produk Unggulan Desa</h2>
            <p class="text-green-100 text-sm opacity-90">Kecamatan Kepohbaru</p>
        </div>

        <div class="p-8">
            <form method="POST" enctype="multipart/form-data" class="space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Produk</label>
                    <input type="text" name="nama" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-green focus:border-primary-green focus:outline-none transition"
                        placeholder="Masukkan nama produk..." required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Produk</label>
                    <textarea name="deskripsi" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-green focus:border-primary-green focus:outline-none transition"
                        placeholder="Jelaskan detail produk..." required></textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Foto Produk</label>
                    <div class="relative mt-1">
                        <input name="gambar" type="file" 
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" 
                            required onchange="previewImage(event)">
                        
                        <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl group-hover:border-secondary-orange transition bg-white relative">
                            <div id="upload-placeholder" class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-secondary-orange transition" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="text-sm text-gray-600">
                                    <span class="text-primary-green font-bold">Klik di sini untuk pilih gambar</span>
                                </div>
                                <p class="text-xs text-gray-400">Format: PNG, JPG (Maks. 2MB)</p>
                            </div>
                            <img id="img-preview" class="absolute inset-0 w-full h-full object-cover rounded-xl hidden">
                        </div>
                    </div>
                </div>
                <div class="pt-4 space-y-3">
                    <button name="save" type="submit"
                        class="w-full bg-primary-green hover:bg-green-800 text-white font-bold py-3 rounded-xl shadow-lg transition-all transform active:scale-95 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Simpan Produk
                    </button>
                    
                    <a href="dashboard.php" 
                        class="block text-center text-sm font-medium text-gray-500 hover:text-red-500 transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const output = document.getElementById('img-preview');
            const placeholder = document.getElementById('upload-placeholder');
            
            reader.onload = function() {
                output.src = reader.result;
                output.classList.remove('hidden');
                placeholder.classList.add('opacity-0');
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>