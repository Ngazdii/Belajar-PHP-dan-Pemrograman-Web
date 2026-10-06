<?php
  $inputNilai = "85.5";
  $dataUser = null;

  // Validasi Angka
  if (is_numeric($inputNilai)) {
      $nilaiValid = (float) $inputNilai;
      echo "Input valid berupa angka: " . $nilaiValid . "<br>";
  } else {
      echo "Input bukan angka!<br>";
  }

  // Pengecekan isset dan empty
  if (isset($dataUser)) {
      echo "Variabel dataUser terdefinisi.<br>";
  } else {
      echo "Variabel dataUser bernilai NULL atau belum dibuat.<br>";
  }
?>