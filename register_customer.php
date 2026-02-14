<?php 
include 'koneksi.php';

// ... setelah koneksi ...
if(isset($_POST['register'])){
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query simpan
    $query_simpan = mysqli_query($koneksi, "INSERT INTO pelanggan (nama, email, password) VALUES ('$nama', '$email', '$password')");
    if($query_simpan){
        header("location:login.php?pesan=registrasi_berhasil");
    }

    // KOREKSI LETAK REDIRECT:
    if($query_simpan){
        // Jika berhasil, kirim ke login.php dengan pesan sukses
        header("location:login.php?pesan=registrasi_berhasil");
        exit(); // Penting untuk menghentikan script setelah redirect
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

?>

<main style="padding: 100px 20px; background: var(--bg); min-height: 80vh; display: flex; justify-content: center; align-items: center;">
    <div style="background: white; padding: 40px; border-radius: 20px; box-shadow: var(--shadow); width: 100%; max-width: 450px;">
        <h2 style="color: var(--accent); margin-top: 0;" class="text-center">Daftar <strong>Pelanggan</strong></h2>
        <p class="muted text-center" style="margin-bottom: 30px;">Bergabunglah untuk memberikan ulasan terbaik Anda.</p>

        <?php if(isset($error)) { echo "<p style='color:red; text-align:center; background:#fee; padding:10px; border-radius:8px;'>$error</p>"; } ?>

        <form method="POST">
            <div style="margin-bottom: 15px;">
                <label style="display:block; font-size: 14px; margin-bottom: 5px;">Nama Lengkap</label>
                <input type="text" name="nama" placeholder="Contoh: Budi Santoso" required 
                       style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display:block; font-size: 14px; margin-bottom: 5px;">Email</label>
                <input type="email" name="email" placeholder="email@anda.com" required 
                       style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display:block; font-size: 14px; margin-bottom: 5px;">Pekerjaan / Status</label>
                <input type="text" name="peran" placeholder="Contoh: Mahasiswa / Food Blogger" required 
                       style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px;">
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display:block; font-size: 14px; margin-bottom: 5px;">Password</label>
                <input type="password" name="password" placeholder="Min. 6 Karakter" required 
                       style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px;">
            </div>

            <div style="margin-top: 20px;">
                <button type="submit" name="register" class="btn primary" style="width: 100%; padding: 12px; font-weight: bold;">
                Daftar Sekarang
                </button>
            </div>
        </form>

        <p class="text-center" style="margin-top: 20px; font-size: 14px;">
            Sudah punya akun? <a href="login_customer.php" style="color: var(--accent); font-weight: bold;">Login di sini</a>
        </p>
    </div>
</main>



<?php 
include 'koneksi.php';

$pesan_error = "";

if(isset($_POST['register'])){
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // 1. CEK APAKAH EMAIL SUDAH TERDAFTAR
    $cek_email = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE email='$email'");
    
    if(mysqli_num_rows($cek_email) > 0){
        // Jika email sudah ada
        $pesan_error = "Email sudah terdaftar! Gunakan email lain atau silakan login.";
    } else {
        // 2. JIKA EMAIL BELUM ADA, BARU SIMPAN
        $query_simpan = mysqli_query($koneksi, "INSERT INTO pelanggan (nama, email, password) VALUES ('$nama', '$email', '$password')");
        
        if($query_simpan){
            header("location:login.php?pesan=registrasi_berhasil");
            exit();
        } else {
            $pesan_error = "Gagal mendaftar. Silakan coba lagi.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Akun - Klainrasa</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .reg-card { max-width: 400px; margin: 80px auto; padding: 30px; background: white; border-radius: 15px; box-shadow: 0 5px 25px rgba(0,0,0,0.1); }
        .reg-card input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; }
        .btn-reg { width: 100%; padding: 12px; background: #6F4E37; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; margin-top: 10px; }
        .error-msg { color: white; background: #e74c3c; padding: 10px; border-radius: 5px; font-size: 13px; margin-bottom: 15px; text-align: center; }
    </style>
</head>
<body style="background: #fdfaf7;">
    <div class="reg-card">
        <h2 style="text-align:center;">Buat <strong>Akun</strong></h2>
        <p style="text-align:center; font-size:13px; color:#888; margin-bottom: 20px;">Daftar untuk mulai memesan dan memberi ulasan</p>
        
        <?php if($pesan_error != ""): ?>
            <div class="error-msg"><?php echo $pesan_error; ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <input type="text" name="nama" placeholder="Nama Lengkap" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="register" class="btn-reg">DAFTAR SEKARANG</button>
        </form>
        
        <p style="text-align:center; margin-top:20px; font-size:14px;">
            Sudah punya akun? <a href="login.php" style="color:#6F4E37; font-weight:bold;">Login di sini</a>
            <br><br>
            <a href="index.php" style="text-decoration:none; font-size:12px; color:#888;">&larr; Kembali ke Beranda</a>
        </p>
    </div>
</body>
</html>