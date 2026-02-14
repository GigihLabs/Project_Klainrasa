<?php 
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php?pesan=belum_login");
    exit();
}
?>

<?php 
session_start();
include 'koneksi.php';

// Proteksi Halaman: Hanya admin yang boleh masuk
if($_SESSION['status'] != "login"){
    header("location:login.php?pesan=belum_login");
}

// 1. Ambil ID menu yang akan diedit dari URL
if(!isset($_GET['id'])){
    header("location:admin.php");
}
$id = $_GET['id'];

// 2. Ambil data lama dari database berdasarkan ID
$query = mysqli_query($koneksi, "SELECT * FROM menu WHERE id='$id'");
$m = mysqli_fetch_array($query);

// Jika data tidak ditemukan di database
if(mysqli_num_rows($query) < 1){
    die("Data menu tidak ditemukan.");
}

// 3. Logika Proses Update saat tombol Simpan ditekan
if (isset($_POST['update'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $gambar = mysqli_real_escape_string($koneksi, $_POST['gambar']);

    $update = mysqli_query($koneksi, "UPDATE menu SET 
                nama_produk = '$nama', 
                harga = '$harga', 
                deskripsi = '$deskripsi', 
                gambar = '$gambar' 
                WHERE id = '$id'");

    if($update) {
        header("location:admin.php?pesan=update_berhasil");
    } else {
        $error = "Gagal memperbarui data!";
    }
}

include 'header.php'; 
?>

<main class="wrap" style="padding: 50px 20px;">
    <div style="background: white; padding: 30px; border-radius: 15px; box-shadow: var(--shadow); max-width: 600px; margin: auto;">
        <h2 style="color: var(--accent); margin-top: 0;">Edit Menu <strong>Klainrasa</strong></h2>
        <p class="muted">Ubah informasi produk di bawah ini.</p>

        <?php if(isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>

        <form method="POST">
            <div style="margin-bottom: 15px;">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" value="<?php echo $m['nama_produk']; ?>" required 
                       style="width:100%; padding:10px; border:1px solid #ddd; border-radius:8px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label>Harga (Rp)</label>
                <input type="number" name="harga" value="<?php echo $m['harga']; ?>" required 
                       style="width:100%; padding:10px; border:1px solid #ddd; border-radius:8px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label>Deskripsi Singkat</label>
                <textarea name="deskripsi" required 
                          style="width:100%; height:100px; padding:10px; border:1px solid #ddd; border-radius:8px;"><?php echo $m['deskripsi']; ?></textarea>
            </div>

            <div style="margin-bottom: 20px;">
                <label>Nama File Gambar</label>
                <input type="text" name="gambar" value="<?php echo $m['gambar']; ?>" required 
                       style="width:100%; padding:10px; border:1px solid #ddd; border-radius:8px;">
                <small class="muted">Contoh: produk1.png (Pastikan file ada di folder IMG)</small>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" name="update" class="btn primary" style="flex: 2;">Simpan Perubahan</button>
                <a href="admin.php" class="btn" style="flex: 1; text-align: center; background: #eee; color: #333; padding: 12px; border-radius: 8px;">Batal</a>
            </div>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>