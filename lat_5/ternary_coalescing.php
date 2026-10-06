<?php
  $nilaiUjian = 78;
  
  // Menggunakan Ternary Operator
  $statusLulus = ($nilaiUjian >= 75) ? "LULUS" : "TIDAK LULUS";
  echo "Hasil Ujian: " . $statusLulus . "<br>";

  // Menggunakan Null Coalescing Operator
  // Memeriksa parameter 'user' dari URL ($_GET), jika tidak ada maka gunakan 'Tamu'
  $namaPengguna = $_GET['user'] ?? 'Tamu';
  echo "Selamat Datang, " . htmlspecialchars($namaPengguna) . "!";
?>