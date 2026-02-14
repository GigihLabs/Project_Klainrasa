<?php
session_start();
session_destroy(); // Menghapus semua session
header("location:index.php?pesan=logout");
exit();
?>