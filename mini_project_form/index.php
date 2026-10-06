<?php
// Inisialisasi variabel input & error
$nama = $nim = $prodi = $gender = "";
$errors = [];
$successMsg = "";

// Cek apakah form dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Validasi Nama
    if (empty($_POST["nama"])) {
        $errors["nama"] = "Nama wajib diisi!";
    } else {
        $nama = trim($_POST["nama"]);
    }

    // 2. Validasi NIM
    if (empty($_POST["nim"])) {
        $errors["nim"] = "NIM wajib diisi!";
    } else {
        $nim = trim($_POST["nim"]);
    }

    // 3. Validasi Program Studi
    if (empty($_POST["prodi"])) {
        $errors["prodi"] = "Pilih salah satu Program Studi!";
    } else {
        $prodi = $_POST["prodi"];
    }

    // 4. Validasi Jenis Kelamin
    if (empty($_POST["gender"])) {
        $errors["gender"] = "Pilih jenis kelamin!";
    } else {
        $gender = $_POST["gender"];
    }

    // Jika tidak ada error validasi
    if (empty($errors)) {
        $successMsg = "Data Berhasil Disimpan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Biodata Mahasiswa - PHP</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="container">
    <h2>Form Biodata Mahasiswa (PHP)</h2>

    <?php if (!empty($successMsg)): ?>
      <div class="alert-success">
        <strong><?php echo $successMsg; ?></strong><br>
        Nama: <?php echo htmlspecialchars($nama); ?><br>
        NIM: <?php echo htmlspecialchars($nim); ?><br>
        Prodi: <?php echo htmlspecialchars($prodi); ?><br>
        Jenis Kelamin: <?php echo htmlspecialchars($gender); ?>
      </div>
    <?php endif; ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      
      <!-- Input Nama -->
      <div class="form-group">
        <label for="nama">Nama Lengkap:</label>
        <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>" class="<?php echo isset($errors['nama']) ? 'is-invalid' : ''; ?>" placeholder="Masukkan nama...">
        <span class="error-msg"><?php echo $errors['nama'] ?? ''; ?></span>
      </div>

      <!-- Input NIM -->
      <div class="form-group">
        <label for="nim">NIM:</label>
        <input type="text" id="nim" name="nim" value="<?php echo htmlspecialchars($nim); ?>" class="<?php echo isset($errors['nim']) ? 'is-invalid' : ''; ?>" placeholder="Masukkan NIM...">
        <span class="error-msg"><?php echo $errors['nim'] ?? ''; ?></span>
      </div>

      <!-- Input Program Studi -->
      <div class="form-group">
        <label for="prodi">Program Studi:</label>
        <select id="prodi" name="prodi" class="<?php echo isset($errors['prodi']) ? 'is-invalid' : ''; ?>">
          <option value="">-- Pilih Program Studi --</option>
          <option value="Informatika" <?php echo ($prodi === 'Informatika') ? 'selected' : ''; ?>>Informatika</option>
          <option value="Sistem Informasi" <?php echo ($prodi === 'Sistem Informasi') ? 'selected' : ''; ?>>Sistem Informasi</option>
          <option value="Teknik Komputer" <?php echo ($prodi === 'Teknik Komputer') ? 'selected' : ''; ?>>Teknik Komputer</option>
        </select>
        <span class="error-msg"><?php echo $errors['prodi'] ?? ''; ?></span>
      </div>

      <!-- Input Jenis Kelamin -->
      <div class="form-group">
        <label>Jenis Kelamin:</label>
        <div class="radio-group <?php echo isset($errors['gender']) ? 'is-invalid' : ''; ?>">
          <label><input type="radio" name="gender" value="Laki-laki" <?php echo ($gender === 'Laki-laki') ? 'checked' : ''; ?>> Laki-laki</label>
          <label><input type="radio" name="gender" value="Perempuan" <?php echo ($gender === 'Perempuan') ? 'checked' : ''; ?>> Perempuan</label>
        </div>
        <span class="error-msg"><?php echo $errors['gender'] ?? ''; ?></span>
      </div>

      <button type="submit">Simpan Data</button>
    </form>
  </div>

</body>
</html>