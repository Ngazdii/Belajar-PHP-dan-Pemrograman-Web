<?php
  echo "<h4>Uji Coba Include (File Hilang):</h4>";
  include 'file_tidak_ada.php'; // Muncul Warning, tapi baris bawah tetap dieksekusi!
  echo "Pesan ini tetap tampil karena menggunakan include.<hr>";

  echo "<h4>Uji Coba Require (File Hilang):</h4>";
  require 'file_tidak_ada.php'; // Fatal Error! Program berhenti total di sini.
  echo "Pesan ini TIDAK AKAN PERNAH TAMPIL!";
?>