<?php 
session_start();
include 'koneksi.php';

// ... bagian atas login.php (session_start & koneksi) ...

if(isset($_POST['login'])){
    $user_input = mysqli_real_escape_string($koneksi, $_POST['user']);
    $password   = mysqli_real_escape_string($koneksi, $_POST['pass']);

    $q_admin = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$user_input' AND password='$password'");
    $q_cust  = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE email='$user_input' AND password='$password'");

    if(mysqli_num_rows($q_admin) > 0){
        // Login Admin
        $d = mysqli_fetch_assoc($q_admin);
        $_SESSION['status'] = "login";
        $_SESSION['role']   = "admin";
        header("location:admin.php");
    } else if(mysqli_num_rows($q_cust) > 0){
        // Login Customer
        $d = mysqli_fetch_assoc($q_cust);
        $_SESSION['status'] = "login";
        $_SESSION['role']   = "customer";
        $_SESSION['id_cust']= $d['id'];
        $_SESSION['nama']   = $d['nama'];
        
        // PENGALIHAN LANGSUNG KE AREA ISI ULASAN
        header("location:index.php#testimoni");
    } else {
        header("location:login.php?pesan=gagal");
    }
}


if(isset($_POST['login'])){
    $user_input = mysqli_real_escape_string($koneksi, $_POST['user']);
    $password   = mysqli_real_escape_string($koneksi, $_POST['pass']);

    $q_admin = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$user_input' AND password='$password'");
    $q_cust  = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE email='$user_input' AND password='$password'");

    if(mysqli_num_rows($q_admin) > 0){
        $d = mysqli_fetch_assoc($q_admin);
        $_SESSION['status'] = "login";
        $_SESSION['role']   = "admin";
        header("location:admin.php");
    } else if(mysqli_num_rows($q_cust) > 0){
        $d = mysqli_fetch_assoc($q_cust);
        $_SESSION['status'] = "login";
        $_SESSION['role']   = "customer";
        $_SESSION['id_cust']= $d['id'];
        $_SESSION['nama']   = $d['nama'];
        // PENGALIHAN LANGSUNG KE BAGIAN TESTIMONI
        header("location:index.php#testimoni");
    } else {
        header("location:login.php?pesan=gagal");
    }

    
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Klainrasa</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .login-box { max-width: 350px; margin: 80px auto; padding: 30px; background: #fff; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); text-align: center; }
        .login-box input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        
        /* Tombol disamakan dengan desain registrasi */
        .btn-submit { 
            width: 100%; 
            background: #6F4E37; /* Warna cokelat accent */
            color: white; 
            border: none; 
            padding: 12px; 
            border-radius: 5px; 
            cursor: pointer; 
            font-weight: bold; 
            font-size: 15px;
            transition: 0.3s;
        }
        .btn-submit:hover { background: #5a3f2d; }
    </style>
</head>
<body style="background: #fdfaf7;">
    <div class="login-box">
        <h3>Login <strong>Klainrasa</strong></h3>
        <form method="POST">
            <input type="text" name="user" placeholder="Username / Email" required>
            <input type="password" name="pass" placeholder="Password" required>
            <button type="submit" name="login" class="btn-submit">MASUK</button>
        </form>
        <p style="font-size: 13px; margin-top: 20px;">Belum punya akun? <a href="register_customer.php" style="color:#6F4E37; font-weight:bold;">Daftar</a></p>
    </div>
</body>
</html>