<?php
session_start();
include 'koneksi.php';

if(isset($_POST['kirim_ulasan'])){
    $nama = $_SESSION['nama'];
    $isi = mysqli_real_escape_string($koneksi, $_POST['isi_ulasan']);
    $tgl = date('Y-m-d');

    // Gunakan status 'pending' agar muncul di menu moderasi admin
    $query = "INSERT INTO ulasan (nama_pelanggan, isi_ulasan, status, tanggal) VALUES ('$nama', '$isi', 'pending', '$tgl')";
    
    if(mysqli_query($koneksi, $query)){
        echo "<script>alert('Ulasan dikirim! Menunggu persetujuan admin.'); window.location='index.php';</script>";
    }
}
?>