<?php
session_start();
// Pastikan path ke config.php sudah benar.
include '../config.php'; 

// Inisialisasi pesan error
$msg = ""; 

if(isset($_POST['login'])){
    // Sanitasi input agar lebih aman
    $username = trim($_POST['username']);
    
    // *** PERUBAHAN PENTING 1: Ambil sandi input TANPA di-hash MD5 ***
    // Kita simpan sandi yang diinput pengguna dalam bentuk teks biasa (plain text)
    $input_password = $_POST['password']; 

    // Pastikan koneksi dan query aman
    $username_safe = mysqli_real_escape_string($conn, $username);

    // *** PERUBAHAN PENTING 2: QUERY DATABASE ***
    // Kita hanya perlu mengambil data pengguna dan HASH sandi yang tersimpan.
    $q = mysqli_query($conn, "SELECT username, password FROM admin WHERE username='$username_safe'");

    if(mysqli_num_rows($q) > 0){
        // Username ditemukan
        $data = mysqli_fetch_assoc($q);
        $hashed_password_from_db = $data['password'];

        // *** PERUBAHAN PENTING 3: VERIFIKASI SANDI DENGAN password_verify() ***
        // Fungsi ini membandingkan sandi input (plain text) dengan hash Bcrypt di DB
        if(password_verify($input_password, $hashed_password_from_db)){
            // VERIFIKASI BERHASIL: Sandi Cocok!
            $_SESSION['admin'] = $data['username'];
            header("Location: dashboard.php");
            exit;
        } else {
            // Sandi input salah
            $msg = "Username atau password salah!";
        }
    } else {
        // Username tidak ditemukan (tetap berikan pesan yang sama untuk keamanan)
        $msg = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔒 Login Administrator</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <link rel="stylesheet" href="../assets/style.css"> 

    <style>
        /* CSS Khusus untuk Tampilan Login */
        :root {
            /* Anda bisa sesuaikan warna ini agar cocok dengan identitas website Anda */
            --primary-color: #1e7a4b; /* Hijau Tua/Forest Green */
            --accent-color: #ffac33; /* Kuning Emas/Aksen */
            --bg-color: #f4f6f9; /* Latar belakang abu-abu muda */
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-color);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .login-box {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            text-align: center;
        }

        .login-box h2 {
            margin-bottom: 30px;
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.8em;
        }

        .login-box i {
            margin-right: 10px;
            color: var(--accent-color);
        }

        .login-box form > input {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 1em;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .login-box form > input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 5px rgba(30, 122, 75, 0.3);
            outline: none;
        }

        .login-box button {
            width: 100%;
            padding: 12px 0;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1em;
            font-weight: 600;
            margin-top: 10px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .login-box button:hover {
            background-color: #145935; /* Primary color sedikit lebih gelap */
            transform: translateY(-2px);
        }

        .error-msg {
            color: #d9534f; /* Merah yang lebih lembut */
            margin-top: 20px;
            font-weight: 600;
            font-size: 0.95em;
        }
    </style>
</head>
<body>

<div class="login-box">
    <div style="text-align: center; margin-bottom: 20px;">
        <img src="../assets/img/logo1.png" alt="Logo" style="width: 80px; height: auto; margin-bottom: 10px; filter: drop-shadow(0px 2px 5px rgba(0,0,0,0.1));">
        <h2 style="margin-top: 0; font-weight: 700; color: var(--color-dark);">Login <br> Admin Kepohbaru</h2>
    </div>
    <form method="POST">
        <input type="text" name="username" placeholder="&#xf007; Username" style="font-family: Arial, 'Font Awesome 6 Free';" required>
        <input type="password" name="password" placeholder="&#xf023; Password" style="font-family: Arial, 'Font Awesome 6 Free';" required>
        <button name="login">Masuk</button>
        
        <?php if (!empty($msg)) : ?>
            <p class="error-msg"><?php echo $msg; ?></p>
        <?php endif; ?>
        
    </form>
</div>

</body>
</html>