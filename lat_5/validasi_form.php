<?php
  $emailErr = $umurErr = "";
  $email = $umur = "";

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
      // Validasi Email
      if (empty($_POST["email"])) {
          $emailErr = "Email wajib diisi!";
      } else {
          $email = trim($_POST["email"]);
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $emailErr = "Format email tidak valid!";
          }
      }

      // Validasi Umur (Angka)
      if (empty($_POST["umur"])) {
          $umurErr = "Umur wajib diisi!";
      } else {
          $umur = trim($_POST["umur"]);
          if (!filter_var($umur, FILTER_VALIDATE_INT) || $umur < 1) {
              $umurErr = "Umur harus berupa angka bulat positif!";
          }
      }
  }
?>

<form action="" method="POST">
  <label>Email:</label><br>
  <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
  <span style="color:red;">* <?php echo $emailErr; ?></span><br><br>

  <label>Umur:</label><br>
  <input type="text" name="umur" value="<?php echo htmlspecialchars($umur); ?>">
  <span style="color:red;">* <?php echo $umurErr; ?></span><br><br>

  <button type="submit">Proses Validasi</button>
</form>