<?php 
session_start();
include 'koneksi.php'; 

// Proteksi Halaman Admin
if(!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("location:login.php");
    exit();
}

// === LOGIKA CRUD MENU ===
if(isset($_POST['tambah_menu'])){
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $harga = $_POST['harga'];
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $gambar = $_POST['gambar']; // Asumsi input nama file gambar
    mysqli_query($koneksi, "INSERT INTO menu (nama_produk, harga, deskripsi, gambar) VALUES ('$nama', '$harga', '$deskripsi', '$gambar')");
    header("location:admin.php?pesan=menu_tambah");
}
if(isset($_GET['hapus_menu'])){
    $id = $_GET['hapus_menu'];
    mysqli_query($koneksi, "DELETE FROM menu WHERE id='$id'");
    header("location:admin.php?pesan=menu_hapus");
}

// === LOGIKA MODERASI ULASAN ===
if(isset($_GET['setujui_ulasan'])){
    $id = $_GET['setujui_ulasan'];
    mysqli_query($koneksi, "UPDATE ulasan SET status='approved' WHERE id='$id'");
    header("location:admin.php?pesan=ulasan_oke");
}
if(isset($_GET['tolak_ulasan'])){
    $id = $_GET['tolak_ulasan'];
    mysqli_query($koneksi, "DELETE FROM ulasan WHERE id='$id'");
    header("location:admin.php?pesan=ulasan_tolak");
}

// === LOGIKA CRUD CUSTOMER ===
if(isset($_POST['update_customer'])){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    mysqli_query($koneksi, "UPDATE pelanggan SET nama='$nama', email='$email', password='$pass' WHERE id='$id'");
    header("location:admin.php?pesan=cust_update");
}
if(isset($_GET['hapus_cust'])){
    $id = $_GET['hapus_cust'];
    mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id='$id'");
    header("location:admin.php?pesan=cust_hapus");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin - Klainrasa</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-section { background: white; padding: 20px; border-radius: 10px; margin-bottom: 30px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 12px; border: 1px solid #eee; text-align: left; }
        th { background: #6F4E37; color: white; }
        .btn-sm { padding: 5px 10px; border-radius: 4px; font-size: 12px; text-decoration: none; color: white; }
        .bg-green { background: #27ae60; }
        .bg-red { background: #e74c3c; }
        .bg-blue { background: #2980b9; }
        input, textarea { width: 100%; padding: 10px; margin-bottom: 10px; border-radius: 5px; border: 1px solid #ddd; }
    </style>
</head>
<body style="background: #fdfaf7; padding: 40px;">

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2>Panel Kendali <strong>Admin</strong></h2>
        <a href="logout.php" class="btn-sm bg-red">LOGOUT</a>
    </div>

    <div class="admin-section">
        <h3>1. Tambah & Kelola Menu Produk</h3>
        <form method="POST">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                <input type="text" name="nama_produk" placeholder="Nama Produk" required>
                <input type="number" name="harga" placeholder="Harga" required>
                <input type="text" name="gambar" placeholder="Nama File Gambar (ex: kopi.png)" required>
                <textarea name="deskripsi" placeholder="Deskripsi Menu" required></textarea>
            </div>
            <button type="submit" name="tambah_menu" class="btn-sm bg-green" style="width: 100%; font-size: 14px; cursor: pointer;">TAMBAH MENU BARU</button>
        </form>

        <table>
            <tr>
                <th>Nama Menu</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
            <?php 
            $q_menu = mysqli_query($koneksi, "SELECT * FROM menu");
            while($m = mysqli_fetch_array($q_menu)){ ?>
                <tr>
                    <td><?php echo $m['nama_produk']; ?></td>
                    <td>Rp <?php echo number_format($m['harga']); ?></td>
                    <td>
                        <a href="edit_menu.php?id=<?php echo $m['id']; ?>" class="btn-sm bg-blue">Edit</a>
                        <a href="admin.php?hapus_menu=<?php echo $m['id']; ?>" class="btn-sm bg-red" onclick="return confirm('Hapus menu?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <div class="admin-section">
        <h3>2. Daftar Customer Terdaftar</h3>
        <table>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Password</th>
                <th>Aksi</th>
            </tr>
            <?php 
            $q_cust = mysqli_query($koneksi, "SELECT * FROM pelanggan");
            while($c = mysqli_fetch_array($q_cust)){ ?>
                <tr>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $c['id']; ?>">
                        <td><input type="text" name="nama" value="<?php echo $c['nama']; ?>"></td>
                        <td><input type="email" name="email" value="<?php echo $c['email']; ?>"></td>
                        <td><input type="text" name="password" value="<?php echo $c['password']; ?>"></td>
                        <td>
                            <button type="submit" name="update_customer" class="btn-sm bg-blue" style="border:none; cursor:pointer;">Update</button>
                            <a href="admin.php?hapus_cust=<?php echo $c['id']; ?>" class="btn-sm bg-red" onclick="return confirm('Hapus customer?')">Hapus</a>
                        </td>
                    </form>
                </tr>
            <?php } ?>
        </table>
    </div>

    <div class="admin-section">
        <h3>3. Moderasi Ulasan Pelanggan</h3>
        <table>
            <tr>
                <th>Nama</th>
                <th>Ulasan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            <?php 
            $q_ul = mysqli_query($koneksi, "SELECT * FROM ulasan ORDER BY status DESC");
            while($u = mysqli_fetch_array($q_ul)){ ?>
                <tr style="<?php echo $u['status'] == 'pending' ? 'background: #fff8e1;' : ''; ?>">
                    <td><?php echo $u['nama_pelanggan']; ?></td>
                    <td><?php echo $u['isi_ulasan']; ?></td>
                    <td><strong><?php echo strtoupper($u['status']); ?></strong></td>
                    <td>
                        <?php if($u['status'] == 'pending'): ?>
                            <a href="admin.php?setujui_ulasan=<?php echo $u['id']; ?>" class="btn-sm bg-green">Setujui</a>
                        <?php endif; ?>
                        <a href="admin.php?tolak_ulasan=<?php echo $u['id']; ?>" class="btn-sm bg-red">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

</body>
</html>