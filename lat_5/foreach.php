<?php
  // Indexed Array
  $matakuliah = ["Pemrograman Web", "Basis Data", "Jaringan Komputer", "Sistem Operasi"];

  echo "<h4>Daftar Mata Kuliah:</h4><ol>";
  foreach ($matakuliah as $mk) {
      echo "<li>" . $mk . "</li>";
  }
  echo "</ol>";

  // Associative Array
  $nilaiUjian = [
      "Budi" => 88,
      "Siti" => 95,
      "Andi" => 72
  ];

  echo "<h4>Daftar Nilai Ujian:</h4><ul>";
  foreach ($nilaiUjian as $nama => $nilai) {
      echo "<li><strong>" . $nama . ":</strong> " . $nilai . " pts</li>";
  }
  echo "</ul>";
?>