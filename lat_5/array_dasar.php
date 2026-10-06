<?php
  // 1. Indexed Array
  $buah = ["Apel", "Jeruk", "Mangga"];
  echo "Buah favorit: " . $buah[0] . "<br>"; // Output: Apel

  // 2. Associative Array
  $mahasiswa = [
      "nama" => "Budi Santoso",
      "nim"  => "2026101001",
      "ipk"  => 3.85
  ];
  echo "Nama Mahasiswa: " . $mahasiswa["nama"] . " (IPK: " . $mahasiswa["ipk"] . ")";
?>