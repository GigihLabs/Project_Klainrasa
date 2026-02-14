<?php 
session_start();
include 'koneksi.php'; 

// Update visitor counter
mysqli_query($koneksi, "UPDATE statistik SET hits = hits + 1 WHERE id = 1");
$res = mysqli_query($koneksi, "SELECT hits FROM statistik WHERE id = 1");
$data_stat = mysqli_fetch_array($res);

include 'header.php'; 
?>

<main>
  <section class="hero wrap" id="home">
    <div class="hero-content">
      <h1>Klainrasa: <br> Rasa yang Membuat <strong>Ketagihan</strong></h1>
      <p>
        Kami menyajikan kopi terbaik dari biji pilihan, diolah dengan sepenuh hati untuk memberikan pengalaman rasa yang tak terlupakan di setiap sesapan.
        <br><br>
        Web ini telah dikunjungi sebanyak <strong><?php echo $data_stat['hits']; ?></strong> kali.
      </p>
      <div style="display:flex;gap:12px;margin-top:12px">
        <a href="#products" class="btn primary">Lihat Menu <strong>Produk</strong> &rarr;</a>
      </div>
    </div>
    <div class="hero-image">
      <img src="IMG/ilustrasi.png" alt="Hero Klainrasa" class="main-image">
    </div>
  </section>

  <section class="section products-focus" id="products">
    <div class="wrap">
        <h2 class="text-center">Mengapa Klainrasa Begitu <strong>Spesial</strong>?</h2>
        <p class="text-center muted-sub">Fokus kami pada <strong>kualitas bahan baku</strong> menjamin pengalaman minum kopi yang <strong>tak tertandingi</strong>. Kami tidak hanya menjual kopi, kami menjual <strong>kebahagiaan</strong>.</p>
        <div class="products-grid">
            <?php 
            $menu = mysqli_query($koneksi, "SELECT * FROM menu");
            while($m = mysqli_fetch_array($menu)){
            ?>
            <div class="product">
                <img src="IMG/<?php echo $m['gambar']; ?>" alt="<?php echo $m['nama_produk']; ?>">
                <div class="product-info">
                    <h3><?php echo $m['nama_produk']; ?></h3>
                    <p><?php echo $m['deskripsi']; ?></p>
                    <span class="price">Rp <?php echo number_format($m['harga']); ?></span>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
  </section>

  <section class="section" id="testimoni" style="background: #fff; padding: 60px 0;">
    <div class="wrap">
        <h2 class="text-center">Apa Kata <strong>Pelanggan Kami?</strong></h2>
        <p class="text-center muted" style="margin-bottom: 40px;">Ulasan jujur dari mereka yang sudah mencoba kelezatan Klainrasa.</p>

        <div class="testimoni-grid">
            <?php 
            // Hanya menampilkan ulasan dengan status 'approved'
            $testi = mysqli_query($koneksi, "SELECT * FROM ulasan WHERE status='approved' ORDER BY id DESC");
            
            if(mysqli_num_rows($testi) == 0) {
                echo "<p class='text-center muted' style='grid-column: 1/-1;'>Belum ada ulasan yang disetujui.</p>";
            }

            while($t = mysqli_fetch_array($testi)){
            ?>
            <div class="testi-card">
                <p>"<?php echo $t['isi_ulasan']; ?>"</p>
                <strong>- <?php echo $t['nama_pelanggan']; ?></strong>
            </div>
            <?php } ?>
        </div>

        <div id="form-ulasan" style="margin-top: 50px; padding: 30px; background: #fdfaf7; border-radius: 12px; border: 1px solid #eee;">
            <h3>Berikan Ulasan Anda</h3>
            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'customer'): ?>
                <form action="proses_ulasan.php" method="POST">
                    <textarea name="isi_ulasan" placeholder="Ceritakan pengalaman Anda di Klainrasa..." required style="width:100%; height:120px; padding:15px; border-radius:8px; border:1px solid #ddd; margin-top: 10px;"></textarea>
                    <button type="submit" name="kirim_ulasan" style="background:#6F4E37; color:white; padding:12px 25px; border:none; border-radius:6px; cursor:pointer; font-weight:bold; margin-top:10px;">KIRIM ULASAN</button>
                </form>
            <?php else: ?>
                <p style="color:#888;">Silahkan <a href="login.php" style="color:#6F4E37; font-weight:bold;">Login</a> untuk mengisi ulasan.</p>
            <?php endif; ?>
        </div>
    </div>
  </section>

  <section class="section about-section" id="about">
    <div class="wrap about-content-grid">
        <div class="about-text">
            <p class="muted" style="font-weight: 600;">PROFIL <strong>PERUSAHAAN</strong></p>
            <h2>Filosofi & <strong>Sejarah</strong> Klainrasa</h2>
            <p>Klainrasa didirikan pada tahun <strong>2018</strong> dengan visi <strong>sederhana</strong>: menyajikan kopi <strong>berkualitas tinggi</strong> tanpa <strong>kompromi</strong>.</p>
            <p>Kami membangun brand yang <strong>kuat</strong> melalui kemitraan <strong>langsung</strong> dengan petani <strong>lokal</strong>, memastikan <strong>kesejahteraan mereka</strong> sekaligus <strong>kualitas biji kopi terbaik</strong>.</p>
        </div>
        <div class="about-image">
            <img src="IMG/owner.jpeg" alt="Foto Owner Kedai Klainrasa">
            <p class="caption muted"><strong>Owner Klainrasa</strong>: Rajendra</p>
        </div>
    </div>
  </section>

  <section class="section partners-section" id="partners">
    <div class="wrap">
        <h2 class="text-center">Jaringan <strong>Kemitraan</strong> Kami</h2>
        <div class="partners">
            <div class="partner">
                <img src="IMG/Shfood.PNG" alt="Logo Shopee Food">
                <p>Shopee Food</p>
            </div>
            <div class="partner">
                <img src="IMG/Gfood.png" alt="Logo GoFood">
                <p>GoFood</p>
            </div>
            <div class="partner">
                <img src="IMG/Grfood.png" alt="Logo GrabFood">
                <p>GrabFood</p>
            </div>
            <div class="partner">
                <img src="IMG/qris.png" alt="Logo QRIS">
                <p>QRIS Payment</p>
            </div>
        </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>