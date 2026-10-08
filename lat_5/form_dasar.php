<?php
  $nama = $email = "";

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $nama = $_POST['nama'] ?? '';
      $email = $_POST['email'] ?? '';
  }
?>

<form action="" method="POST">
  <label for="nama">Nama Lengkap:</label><br>
  <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>"><br><br>

  <label for="email">Alamat Email:</label><br>
  <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br><br>

  <button type="submit">Kirim Data</button>
</form>

<?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
  <h4>Data Hasil Input:</h4>
  <p>Nama: <strong><?php echo $nama; ?></strong></p>
  <p>Email: <strong><?php echo $email; ?></strong></p>
<?php endif; ?>