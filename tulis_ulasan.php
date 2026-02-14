<?php 
session_start();
include 'koneksi.php';

// Cek apakah sudah login pelanggan
if (!isset($_SESSION['status_pelanggan'])) {
    header("location:login_customer.php");
}

if (isset($_POST['kirim_ulasan'])) {
    $id_pelanggan = $_SESSION['pelanggan_id'];
    $isi_ulasan = mysqli_real_escape_string($koneksi, $_POST['isi_ulasan']);
    
    // Simpan ke database dengan status = 0 (Menunggu Persetujuan Admin)
    $q = mysqli_query($koneksi, "INSERT INTO testimoni (id_pelanggan, isi_ulasan, status) VALUES ('$id_pelanggan', '$isi_ulasan', 0)");
    
    if ($q) {
        echo "<script>alert('Terima kasih! Ulasan Anda akan diperiksa oleh admin sebelum ditampilkan.'); window.location='index.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tulis Ulasan - Klainrasa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background: var(--bg); padding: 50px;">
    <div class="wrap" style="background: white; padding: 40px; border-radius: 15px; max-width: 600px; margin: auto;">
        <h3>Halo, <strong><?php echo $_SESSION['pelanggan_nama']; ?></strong>!</h3>
        <p class="muted">Bagikan pengalaman Anda menikmati kopi kami.</p>
        
        <form method="POST">
            <textarea name="isi_ulasan" placeholder="Tulis ulasan Anda di sini..." required 
                      style="width:100%; height:150px; padding:15px; border-radius:10px; border:1px solid #ddd; margin-bottom:20px; font-family:inherit;"></textarea>
            <button type="submit" name="kirim_ulasan" class="btn primary">Kirim Ulasan</button>
            <a href="index.php" style="margin-left: 15px;">Kembali ke Beranda</a>
        </form>
    </div>
</body>
</html>