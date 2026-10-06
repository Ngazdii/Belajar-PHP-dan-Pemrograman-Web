<?php
  echo "<h4>Mencari Angka (Berhenti saat menemukan angka 7 dengan break):</h4>";
  for ($i = 1; $i <= 10; $i++) {
      if ($i === 7) {
          echo "<strong style='color:red;'>Angka " . $i . " ditemukan! Perulangan dihentikan.</strong><br>";
          break; // Keluar dari loop
      }
      echo "Memeriksa angka: " . $i . "<br>";
  }

  echo "<h4>Menampilkan Angka Ganjil Saja (Melompati angka genap dengan continue):</h4>";
  for ($n = 1; $n <= 10; $n++) {
      if ($n % 2 === 0) {
          continue; // Lompat ke angka berikutnya jika genap
      }
      echo "Angka Ganjil: " . $n . "<br>";
  }
?>