<?php
  echo "<h4>1. Perulangan FOR (Angka 1 - 5):</h4>";
  for ($i = 1; $i <= 5; $i++) {
      echo "Angka ke-" . $i . "<br>";
  }

  echo "<h4>2. Perulangan WHILE (Hitung Mundur 5 - 1):</h4>";
  $j = 5;
  while ($j >= 1) {
      echo "Hitung: " . $j . "<br>";
      $j--;
  }

  echo "<h4>3. Perulangan DO-WHILE (Minimal Dieksekusi 1 Kali):</h4>";
  $k = 10;
  do {
      echo "Nilai k saat ini: " . $k . " (Kondisi k < 5 sebenarnya bernilai false)<br>";
      $k++;
  } while ($k < 5);
?>