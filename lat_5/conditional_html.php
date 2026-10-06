<?php
  $isLoggedIn = true;
  $namaMember = "Siti Aminah";
  $poin = 120;
?>

<!-- Penggunaan sintaks alternatif if : endif; -->
<?php if ($isLoggedIn): ?>
  <div style="background: #d4edda; padding: 10px; border-radius: 4px;">
    <h4 style="margin: 0;">Selamat Datang Kembali, <?php echo htmlspecialchars($namaMember); ?>!</h4>
    
    <?php if ($poin >= 100): ?>
      <p>Status: <strong style="color: gold;">Member VIP (Poin: <?php echo $poin; ?>)</strong></p>
    <?php else: ?>
      <p>Status: Member Regular (Poin: <?php echo $poin; ?>)</p>
    <?php endif; ?>
  </div>
<?php else: ?>
  <div style="background: #f8d7da; padding: 10px; border-radius: 4px;">
    <p style="margin: 0;">Silakan <a href="#">Login</a> untuk mengakses halaman ini.</p>
  </div>
<?php endif; ?>