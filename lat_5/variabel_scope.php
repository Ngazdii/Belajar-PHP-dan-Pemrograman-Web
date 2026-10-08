<?php
  $namaAplikasi = "Portal Kampus";

  function tampilkanInfo() {
      // Mengakses variabel dari luar fungsi menggunakan kata kunci 'global'
      global $namaAplikasi;
      $versi = "v2.1"; // Variabel lokal

      echo "Aplikasi: " . $namaAplikasi . " (" . $versi . ")<br>";
  }

  tampilkanInfo();
  // echo $versi; // Error: $versi tidak bisa diakses dari luar fungsi!
?>