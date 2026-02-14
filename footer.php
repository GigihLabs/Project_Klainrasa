<footer style="background: #222; color: #fff; padding: 40px 0; margin-top: 60px;">
    <div class="wrap" style="text-align: center;">
        <h3 style="margin-bottom: 10px;">Klainrasa <strong>Coffee</strong></h3>
        <p style="opacity: 0.7; font-size: 14px;">Menyajikan kebahagiaan dalam setiap cangkir kopi.</p>
        <hr style="border: 0; border-top: 1px solid #444; margin: 25px 0;">
        <p style="font-size: 12px; opacity: 0.5;">&copy; 2025 Klainrasa Coffee. All Rights Reserved.</p>
    </div>
</footer>

  <script>
    const toggle = document.querySelector('.menu-toggle');
    const mobileMenu = document.querySelector('.mobile-menu');
    toggle && toggle.addEventListener('click', ()=> {
      const open = toggle.getAttribute('aria-expanded') === 'true';
      toggle.setAttribute('aria-expanded', String(!open));
      mobileMenu.style.display = open ? 'none' : 'block';
    });

    document.querySelectorAll('a[href^="#"]').forEach(a => {
      a.addEventListener('click', (e) => {
        const target = document.querySelector(a.getAttribute('href'));
        if(target) {
          e.preventDefault();
          target.scrollIntoView({behavior:'smooth', block:'start'});
          if(window.innerWidth < 1000) {
            mobileMenu.style.display = 'none';
            toggle.setAttribute('aria-expanded', 'false');
          }
        }
      });
    });
  </script>
</body>
</html>