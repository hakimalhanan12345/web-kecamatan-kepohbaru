<?php
include '../config.php';

// Ambil data lama
$query = mysqli_query($conn, "SELECT * FROM profil_kecamatan LIMIT 1");
$data = mysqli_fetch_assoc($query);

if(isset($_POST['update'])){
    $profil = mysqli_real_escape_string($conn, $_POST['profil']);
    $sejarah = mysqli_real_escape_string($conn, $_POST['sejarah']);
    
    // Proses Gambar Profil
    $g_profil = $_FILES['g_profil']['name'];
    if($g_profil != "") {
        move_uploaded_file($_FILES['g_profil']['tmp_name'], "../assets/img/".$g_profil);
        mysqli_query($conn, "UPDATE profil_kecamatan SET gambar_profil='$g_profil' WHERE id=".$data['id']);
    }

    // Proses Gambar Sejarah
    $g_sejarah = $_FILES['g_sejarah']['name'];
    if($g_sejarah != "") {
        move_uploaded_file($_FILES['g_sejarah']['tmp_name'], "../assets/img/".$g_sejarah);
        mysqli_query($conn, "UPDATE profil_kecamatan SET gambar_sejarah='$g_sejarah' WHERE id=".$data['id']);
    }

    mysqli_query($conn, "UPDATE profil_kecamatan SET profil='$profil', sejarah='$sejarah' WHERE id=".$data['id']);
    echo "<script>alert('Data dan Gambar berhasil diperbarui!'); window.location='dashboard.php';</script>";}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Profil & Gambar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 p-10 font-['Poppins']">
    <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-[#1e7a4b] p-6 text-white text-center">
            <h2 class="text-2xl font-bold">Update Konten Profil & Sejarah</h2>
        </div>
        
        <form method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                <div>
                    <label class="block font-semibold mb-2 text-green-800 border-b-2 border-green-200">Konten Profil</label>
                    <textarea name="profil" rows="10" class="w-full p-4 border rounded-lg focus:ring-2 focus:ring-[#1e7a4b]"><?php echo $data['profil']; ?></textarea>
                </div>
                <div>
                    <label class="block font-semibold mb-2 text-green-800 border-b-2 border-green-200">Gambar Profil</label>
                    <input type="file" name="g_profil" class="mb-4 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                    <?php if($data['gambar_profil']) : ?>
                        <img src="../assets/img/<?php echo $data['gambar_profil']; ?>" class="w-full h-48 object-cover rounded-lg shadow-sm border">
                    <?php endif; ?>
                </div>
            </div>

            <hr>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                <div>
                    <label class="block font-semibold mb-2 text-orange-800 border-b-2 border-orange-200">Konten Sejarah</label>
                    <textarea name="sejarah" rows="10" class="w-full p-4 border rounded-lg focus:ring-2 focus:ring-[#1e7a4b]"><?php echo $data['sejarah']; ?></textarea>
                </div>
                <div>
                    <label class="block font-semibold mb-2 text-orange-800 border-b-2 border-orange-200">Gambar Sejarah</label>
                    <input type="file" name="g_sejarah" class="mb-4 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                    <?php if($data['gambar_sejarah']) : ?>
                        <img src="../assets/img/<?php echo $data['gambar_sejarah']; ?>" class="w-full h-48 object-cover rounded-lg shadow-sm border">
                    <?php endif; ?>
                </div>
            </div>

            <button name="update" class="w-full bg-[#1e7a4b] text-white py-4 rounded-xl font-bold text-lg hover:bg-green-800 transition shadow-lg">Simpan Seluruh Perubahan</button>
            <a href="dashboard.php" class="block text-center text-gray-500 hover:text-red-500 transition">Batal dan Kembali</a>
        </form>
    </div>
</body>
</html>