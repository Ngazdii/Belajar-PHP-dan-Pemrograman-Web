<?php
  $uploadMsg = "";

  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["dokumen"])) {
      $file = $_FILES["dokumen"];
      $namaFile = $file["name"];
      $ukuranFile = $file["size"];
      $tmpName = $file["tmp_name"];
      $error = $file["error"];

      // Ekstensi yang diperbolehkan
      $ekstensiDiperbolehkan = ['pdf', 'doc', 'docx', 'png', 'jpg'];
      $ext = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

      if ($error === 0) {
          if (!in_array($ext, $ekstensiDiperbolehkan)) {
              $uploadMsg = "Ekstensi file tidak diizinkan!";
          } elseif ($ukuranFile > 2000000) { // Maks 2MB
              $uploadMsg = "Ukuran file terlalu besar (Maksimal 2MB)!";
          } else {
              $uploadMsg = "File <strong>" . htmlspecialchars($namaFile) . "</strong> valid dan siap diunggah.";
              // move_uploaded_file($tmpName, "uploads/" . $namaFile);
          }
      } else {
          $uploadMsg = "Terjadi kesalahan saat unggah file!";
      }
  }
?>

<form action="" method="POST" enctype="multipart/form-data">
  <label>Unggah Dokumen (PDF/DOCX/JPG, Maks 2MB):</label><br>
  <input type="file" name="dokumen" required><br><br>
  <button type="submit">Unggah Berkas</button>
</form>

<?php if (!empty($uploadMsg)): ?>
  <p style="color: blue;"><?php echo $uploadMsg; ?></p>
<?php endif; ?>