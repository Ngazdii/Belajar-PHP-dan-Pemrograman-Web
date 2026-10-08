<?php
// Fungsi Sanitasi
function cleanInput($data) {
    return htmlspecialchars(stripslashes(trim($data)), ENT_QUOTES, 'UTF-8');
}

// Inisialisasi Variabel
$nama = $email = $pass = $kategori = "";
$minat = [];
$errors = [];
$suksesMsg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // 1. Validasi Nama
    if (empty($_POST["nama"])) {
        $errors['nama'] = "Nama lengkap wajib diisi!";
    } else {
        $nama = cleanInput($_POST["nama"]);
        if (strlen($nama) < 3) {
            $errors['nama'] = "Nama minimal 3 karakter!";
        }
    }

    // 2. Validasi Email
    if (empty($_POST["email"])) {
        $errors['email'] = "Email wajib diisi!";
    } else {
        $email = cleanInput($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Format email tidak valid!";
        }
    }

    // 3. Validasi Password
    if (empty($_POST["password"])) {
        $errors['password'] = "Password wajib diisi!";
    } else {
        $pass = $_POST["password"];
        if (strlen($pass) < 6) {
            $errors['password'] = "Password minimal 6 karakter!";
        }
    }

    // 4. Validasi Kategori
    if (empty($_POST["kategori"])) {
        $errors['kategori'] = "Pilih salah satu kategori!";
    } else {
        $kategori = cleanInput($_POST["kategori"]);
    }

    // 5. Checkbox Minat
    if (isset($_POST["minat"]) && is_array($_POST["minat"])) {
        foreach ($_POST["minat"] as $m) {
            $minat[] = cleanInput($m);
        }
    }

    // Jika Tidak Ada Error
    if (empty($errors)) {
        $suksesMsg = "Pendaftaran Berhasil! Terima kasih telah mendaftar.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Registrasi Anggota</title>
  <style>
    body { font-family: Arial, sans-serif; background-color: #f4f7f6; padding: 20px; }
    .form-container { max-width: 500px; margin: 0 auto; background: #ffffff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
    .form-group { margin-bottom: 15px; }
    label { font-weight: bold; display: block; margin-bottom: 5px; color: #333; }
    input[type="text"], input[type="email"], input[type="password"], select { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
    .error-text { color: #d9534f; font-size: 13px; margin-top: 3px; display: block; }
    .alert-success { background: #d4edda; color: #155724; padding: 12px; border-radius: 4px; border: 1px solid #c3e6cb; margin-bottom: 15px; }
    button { width: 100%; background: #0275d8; color: white; border: none; padding: 10px; font-size: 16px; border-radius: 4px; cursor: pointer; }
    button:hover { background: #025aa5; }
    .box-hasil { background: #f8f9fa; padding: 15px; border-left: 4px solid #0275d8; margin-top: 15px; }
  </style>
</head>
<body>

  <div class="form-container">
    <h2 style="text-align: center; color: #333; margin-top: 0;">Registrasi Anggota</h2>

    <?php if (!empty($suksesMsg)): ?>
      <div class="alert-success"><?php echo $suksesMsg; ?></div>
    <?php endif; ?>

    <form action="" method="POST">
      <div class="form-group">
        <label for="nama">Nama Lengkap:</label>
        <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>" placeholder="Masukkan nama">
        <?php if (isset($errors['nama'])): ?>
          <span class="error-text"><?php echo $errors['nama']; ?></span>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <label for="email">Alamat Email:</label>
        <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="contoh@domain.com">
        <?php if (isset($errors['email'])): ?>
          <span class="error-text"><?php echo $errors['email']; ?></span>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <label for="password">Kata Sandi:</label>
        <input type="password" id="password" name="password" placeholder="Minimal 6 karakter">
        <?php if (isset($errors['password'])): ?>
          <span class="error-text"><?php echo $errors['password']; ?></span>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <label for="kategori">Kategori Keanggotaan:</label>
        <select id="kategori" name="kategori">
          <option value="">-- Pilih Kategori --</option>
          <option value="Pelajar" <?php if ($kategori === 'Pelajar') echo 'selected'; ?>>Pelajar / Mahasiswa</option>
          <option value="Professional" <?php if ($kategori === 'Professional') echo 'selected'; ?>>Professional / Bekerja</option>
          <option value="Umum" <?php if ($kategori === 'Umum') echo 'selected'; ?>>Umum</option>
        </select>
        <?php if (isset($errors['kategori'])): ?>
          <span class="error-text"><?php echo $errors['kategori']; ?></span>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <label>Bidang Minat:</label>
        <input type="checkbox" name="minat[]" value="Web Dev" <?php if (in_array('Web Dev', $minat)) echo 'checked'; ?>> Web Development<br>
        <input type="checkbox" name="minat[]" value="Data Science" <?php if (in_array('Data Science', $minat)) echo 'checked'; ?>> Data Science<br>
        <input type="checkbox" name="minat[]" value="Cyber Security" <?php if (in_array('Cyber Security', $minat)) echo 'checked'; ?>> Cyber Security
      </div>

      <button type="submit">Daftar Sekarang</button>
    </form>

    <?php if (!empty($suksesMsg)): ?>
      <div class="box-hasil">
        <h4 style="margin-top: 0;">Ringkasan Pendaftaran:</h4>
        <p><strong>Nama:</strong> <?php echo $nama; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <p><strong>Kategori:</strong> <?php echo $kategori; ?></p>
        <p><strong>Minat:</strong> <?php echo !empty($minat) ? implode(", ", $minat) : "Tidak ada"; ?></p>
      </div>
    <?php endif; ?>
  </div>

</body>
</html>