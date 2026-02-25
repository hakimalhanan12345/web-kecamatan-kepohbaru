<?php
session_start();
include "../config.php";

// Pastikan session admin aktif
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

if(!isset($_GET['id'])){
    die("ID Produk Tidak Ditemukan!");
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if(!$data){
    die("Data produk tidak ditemukan!");
}

if(isset($_POST['update'])){
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    // Logika Update Gambar
    if($_FILES['gambar']['name'] != ""){
        $fileName = time()."_".$_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../assets/img/$fileName");

        // Hapus gambar lama jika perlu (opsional)
        // unlink("../assets/img/".$data['gambar']);

        mysqli_query($conn, "UPDATE produk SET nama='$nama', deskripsi='$deskripsi', gambar='$fileName' WHERE id='$id'");
    } else {
        mysqli_query($conn, "UPDATE produk SET nama='$nama', deskripsi='$deskripsi' WHERE id='$id'");
    }

    echo "<script>alert('Produk berhasil diperbarui!'); window.location='dashboard.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk | Admin Kepohbaru</title>
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

    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-primary-green p-6 text-white flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <i class="fas fa-edit text-2xl text-secondary-orange"></i>
                <h2 class="text-2xl font-bold">Edit Produk</h2>
            </div>
            <a href="dashboard.php" class="text-white hover:text-secondary-orange transition">
                <i class="fas fa-times text-xl"></i>
            </a>
        </div>

        <form method="POST" enctype="multipart/form-data" class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Produk</label>
                    <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-green focus:outline-none transition" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="5"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-green focus:outline-none transition" required><?= htmlspecialchars($data['deskripsi']) ?></textarea>
                </div>

                <div class="pt-4 flex space-x-3">
                    <button type="submit" name="update" 
                        class="flex-1 bg-primary-green hover:bg-green-800 text-white font-bold py-3 rounded-xl shadow-lg transition-all transform active:scale-95">
                        <i class="fas fa-save mr-2"></i> Update
                    </button>
                    <a href="dashboard.php" 
                        class="flex-1 text-center bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-3 rounded-xl transition-all">
                        Batal
                    </a>
                </div>
            </div>

            <div class="space-y-4 text-center">
                <label class="block text-sm font-semibold text-gray-700 text-left">Foto Produk</label>
                
                <div class="relative group">
                    <div class="w-full h-64 bg-gray-50 border-2 border-dashed border-gray-300 rounded-2xl overflow-hidden flex items-center justify-center relative">
                        <img id="img-preview" src="../assets/img/<?= $data['gambar'] ?>" 
                             class="w-full h-full object-cover">
                        
                        <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                            <p class="text-white text-sm font-medium">Klik "Pilih File" untuk ganti</p>
                        </div>
                    </div>
                </div>

                <div class="mt-2">
                    <input type="file" name="gambar" id="file-input" onchange="previewImage(event)"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 cursor-pointer">
                    <p class="text-[10px] text-gray-400 mt-2 italic">*Kosongkan jika tidak ingin mengubah gambar</p>
                </div>
            </div>

        </form>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const output = document.getElementById('img-preview');
            
            reader.onload = function() {
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>