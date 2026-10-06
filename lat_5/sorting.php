<?php
  $nilaiSiswa = [
      "Budi"  => 85,
      "Siti"  => 95,
      "Andi"  => 78,
      "Dewi"  => 90
  ];

  // Mengurutkan berdasarkan Nilai (Value) dari tertinggi ke terendah
  arsort($nilaiSiswa);

  echo "<h4>Peringkat Nilai Siswa:</h4><ol>";
  foreach ($nilaiSiswa as $nama => $nilai) {
      echo "<li>" . $nama . " - " . $nilai . "</li>";
  }
  echo "</ol>";
?>