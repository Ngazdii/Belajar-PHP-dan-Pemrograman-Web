<?php
  $gender = $_POST['gender'] ?? '';
  $hobi = $_POST['hobi'] ?? []; // Menyimpan array elemen checkbox

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
      echo "<h4>Pilihan Anda:</h4>";
      echo "Jenis Kelamin: " . htmlspecialchars($gender) . "<br>";
      echo "Hobi yang Dipilih: ";
      if (!empty($hobi)) {
          echo htmlspecialchars(implode(", ", $hobi));
      } else {
          echo "Tidak ada hobi yang dipilih.";
      }
  }
?>

<form action="" method="POST" style="margin-top:15px;">
  <label>Jenis Kelamin:</label><br>
  <input type="radio" name="gender" value="Laki-laki" <?php if ($gender === 'Laki-laki') echo 'checked'; ?>> Laki-laki
  <input type="radio" name="gender" value="Perempuan" <?php if ($gender === 'Perempuan') echo 'checked'; ?>> Perempuan
  <br><br>

  <label>Hobi (Bisa pilih lebih dari satu):</label><br>
  <input type="checkbox" name="hobi[]" value="Membaca" <?php if (in_array('Membaca', $hobi)) echo 'checked'; ?>> Membaca<br>
  <input type="checkbox" name="hobi[]" value="Olah Raga" <?php if (in_array('Olah Raga', $hobi)) echo 'checked'; ?>> Olah Raga<br>
  <input type="checkbox" name="hobi[]" value="Coding" <?php if (in_array('Coding', $hobi)) echo 'checked'; ?>> Coding<br><br>

  <button type="submit">Simpan Pilihan</button>
</form>