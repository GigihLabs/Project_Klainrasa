<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<link rel="stylesheet" type="text/css" href="style.css"/>

  <header>
    <div class="nav wrap">
      <div class="brand">
        <img src="IMG/logoKL.png" alt="Logo Klainrasa" style="width:160px;height:50px;border-radius:5px;object-fit:cover;">
        <div>
          <div style="font-weight:700"></div>
          <div class="muted" style="font-size:13px"></div>
        </div>
      </div>

      <nav class="desktop-menu">
        <ul>
          <li><a href="#home">Beranda</a></li>
          <li><a href="#products">Produk <strong>Unggulan</strong></a></li>
          <li><a href="#testimoni">Ulasan <strong>Pelanggan</strong></a></li>
          <li><a href="#about">Profil & <strong>Owner</strong></a></li>
          <li><a href="#partners"><strong>Kemitraan</strong></a></li>
          <li><a href="login.php" style="background: var(--accent); color: white; padding: 5px 15px; border-radius: 5px;">Login</a></li>
        </ul>
      </nav>
      
      <button class="menu-toggle" aria-expanded="false">☰</button>
    </div>
    
    <nav class="mobile-menu" style="display:none;">
      <ul>
      <?php if(isset($_SESSION['status']) && $_SESSION['status'] == "login"): ?>
                    <li>Halo, <b><?php echo $_SESSION['nama']; ?></b></li>
                    <?php if($_SESSION['role'] == "admin"): ?>
                        <li><a href="admin.php" style="color:blue;">Admin Panel</a></li>
                    <?php endif; ?>
                    <li><a href="logout.php" style="color:red;">Keluar</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register_customer.php" style="background:#6F4E37; color:white; padding:5px 15px; border-radius:5px;">Daftar</a></li>
                <?php endif; ?>
      </ul>
    </nav>
  </header>
</body>