<?php
  // 1. Fungsi String
  $teks = "  belajar php menyenangkan  ";
  echo "<h4>Fungsi String:</h4>";
  echo "Teks Asli: '" . $teks . "'<br>";
  echo "Trim: '" . trim($teks) . "'<br>";
  echo "Uppercase: " . strtoupper(trim($teks)) . "<br>";
  echo "Jumlah Karakter: " . strlen(trim($teks)) . "<br>";

  // 2. Fungsi Array
  $buah = ["Apel", "Jeruk"];
  array_push($buah, "Mangga", "Pisang"); // Menambah elemen
  echo "<h4>Fungsi Array:</h4>";
  echo "Jumlah Buah: " . count($buah) . "<br>";
  echo "Cetak Array: " . implode(", ", $buah) . "<br>";

  // 3. Fungsi Waktu & Tanggal
  echo "<h4>Fungsi Tanggal:</h4>";
  echo "Tanggal Sekarang: " . date("d-m-Y H:i:s") . "<br>";
?>