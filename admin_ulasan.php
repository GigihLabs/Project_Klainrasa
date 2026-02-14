<?php 
session_start();
include 'koneksi.php';
if($_SESSION['role'] != "admin") { header("location:login.php"); }

// Logika Approve
if(isset($_GET['approve'])){
    $id = $_GET['approve'];
    mysqli_query($koneksi, "UPDATE ulasan SET status='approved' WHERE id='$id'");
    header("location:admin_ulasan.php");
}

// Logika Hapus
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($koneksi, "DELETE FROM ulasan WHERE id='$id'");
    header("location:admin_ulasan.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Moderasi Ulasan - Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background:#f4f4f4; padding:20px;">
    <h2>Daftar Moderasi Ulasan</h2>
    <a href="admin.php">← Kembali ke Dashboard</a>
    <table border="1" cellpadding="10" cellspacing="0" style="width:100%; background:#fff; margin-top:20px;">
        <tr style="background:#6F4E37; color:white;">
            <th>Nama</th>
            <th>Ulasan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php 
        $res = mysqli_query($koneksi, "SELECT * FROM ulasan ORDER BY status DESC, tanggal DESC");
        while($d = mysqli_fetch_array($res)){
        ?>
        <tr>
            <td><?php echo $d['nama_pelanggan']; ?></td>
            <td><?php echo $d['isi_ulasan']; ?></td>
            <td><strong><?php echo strtoupper($d['status']); ?></strong></td>
            <td>
                <?php if($d['status'] == 'pending'): ?>
                    <a href="?approve=<?php echo $d['id']; ?>" style="color:green;">Setujui</a> | 
                <?php endif; ?>
                <a href="?delete=<?php echo $d['id']; ?>" style="color:red;" onclick="return confirm('Hapus ulasan ini?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>