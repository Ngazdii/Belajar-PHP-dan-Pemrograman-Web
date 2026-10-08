<?php
  // Fungsi Helper Sanitasi Data Input
  function bersihkanInput($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
      return $data;
  }

  $komentar = "";
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $komentar = bersihkanInput($_POST['komentar'] ?? '');
  }
?>

<form action="" method="POST">
  <label for="komentar">Komentar Anda:</label><br>
  <textarea name="komentar" id="komentar" rows="4" cols="40"><?php echo $komentar; ?></textarea><br>
  <button type="submit">Kirim Komentar</button>
</form>

<?php if (!empty($komentar)): ?>
  <h4>Komentar Aman Ter-Sanitasi:</h4>
  <p><?php echo $komentar; ?></p>
<?php endif; ?>