<?php
session_start();
include "../config.php";

// Proteksi Admin
if (!isset($_SESSION['admin'])) { 
    header("Location: login.php"); 
    exit; 
}

// 1. PROSES TAMBAH DATA
if (isset($_POST['tambah'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi   = mysqli_real_escape_string($conn, $_POST['isi']);
    $icon  = mysqli_real_escape_string($conn, $_POST['icon']);

    if (!empty($judul) && !empty($isi)) {
        $query = "INSERT INTO informasi (judul, isi, icon) VALUES ('$judul', '$isi', '$icon')";
        mysqli_query($conn, $query);
        // Refresh kembali ke halaman ini sendiri
        header("Location: kelola_informasi.php?pesan=berhasil");
        exit;
    }
}

// 2. PROSES HAPUS DATA
if (isset($_GET['hapus'])) {
    $id = mysqli_real_escape_string($conn, $_GET['hapus']);
    mysqli_query($conn, "DELETE FROM informasi WHERE id='$id'");
    // Refresh kembali ke halaman ini sendiri
    header("Location: kelola_informasi.php?pesan=terhapus");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Kelola Informasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-50 p-4 md:p-10 font-sans">

    <div class="max-w-5xl mx-auto">
        
        <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'berhasil'): ?>
            <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm">
                <i class="fas fa-check-circle mr-2"></i> Informasi berhasil ditambahkan!
            </div>
        <?php endif; ?>

        <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'terhapus'): ?>
            <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded shadow-sm">
                <i class="fas fa-trash-alt mr-2"></i> Informasi telah dihapus.
            </div>
        <?php endif; ?>

        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Kelola Informasi</h1>
                <p class="text-gray-500">Tambah atau hapus jadwal & informasi pelayanan warga</p>
            </div>
            <a href="dashboard.php" class="bg-gray-800 hover:bg-black text-white px-6 py-2 rounded-lg transition shadow-md">
                <i class="fas fa-arrow-left mr-2"></i> Ke Dashboard
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-xl font-semibold mb-6 flex items-center text-green-700">
                        <i class="fas fa-plus-circle mr-2"></i> Tambah Data
                    </h2>
                    
                    <form method="POST" class="space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Informasi</label>
                            <input type="text" name="judul" placeholder="Contoh: Jadwal Layanan KTP" 
                                class="w-full p-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 outline-none transition" required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Isi Informasi</label>
                            <textarea name="isi" rows="5" placeholder="Tulis rincian informasi di sini..." 
                                class="w-full p-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 outline-none transition" required></textarea>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Ikon</label>
                            <select name="icon" class="w-full p-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 outline-none transition">
                                <option value="fa-clock">Jam Operasional (Jam)</option>
                                <option value="fa-file-alt">Persyaratan (Kertas)</option>
                                <option value="fa-bullhorn">Pengumuman (Toa)</option>
                                <option value="fa-id-card">Identitas (KTP)</option>
                                <option value="fa-info-circle">Umum (Tanda Tanya)</option>
                            </select>
                        </div>

                        <button type="submit" name="tambah" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl transition shadow-lg shadow-green-100">
                            Simpan Informasi
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Informasi</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php
                            $res = mysqli_query($conn, "SELECT * FROM informasi ORDER BY id DESC");
                            if(mysqli_num_rows($res) > 0):
                                while($row = mysqli_fetch_assoc($res)):
                            ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-start">
                                        <div class="bg-green-100 text-green-600 p-2 rounded-lg mr-4">
                                            <i class="fas <?= $row['icon']; ?>"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-800"><?= htmlspecialchars($row['judul']); ?></h4>
                                            <div class="text-sm text-gray-500 mt-1"><?= nl2br(htmlspecialchars($row['isi'])); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="?hapus=<?= $row['id']; ?>" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus informasi ini?')"
                                       class="inline-block bg-red-50 text-red-600 hover:bg-red-600 hover:text-white p-2 px-4 rounded-lg transition text-sm font-medium">
                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                            <?php 
                                endwhile; 
                            else:
                            ?>
                            <tr>
                                <td colspan="2" class="px-6 py-10 text-center text-gray-400 italic">
                                    Belum ada informasi yang ditambahkan.
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</body>
</html>