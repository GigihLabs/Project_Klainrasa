<?php
include 'koneksi.php';
if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $status = $_POST['status'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Keamanan password

    $query = "INSERT INTO pelanggan (nama, email, password, status_peran) VALUES ('$nama', '$email', '$password', '$status')";
    if (mysqli_query($koneksi, $query)) {
        header("location:login_customer.php?pesan=berhasil_daftar");
    }
}
?>
<div class="login-container">
    <h2>Daftar <strong>Akun Pelanggan</strong></h2>
    <form method="POST">
        <input type="text" name="nama" placeholder="Nama Lengkap" required>
        <input type="email" name="email" placeholder="Email" required>
        <select name="status" style="width:100%; padding:12px; margin:10px 0; border-radius:8px; border:1px solid #ddd;">
            <option value="Mahasiswa">Mahasiswa</option>
            <option value="Pekerja Kreatif">Pekerja Kreatif</option>
            <option value="Umum">Umum</option>
        </select>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="register" class="btn-login">Buat Akun</button>
    </form>
</div>