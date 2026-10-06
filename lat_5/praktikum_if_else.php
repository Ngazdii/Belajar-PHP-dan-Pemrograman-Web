<?php
  $umur = 18;
  $punyaSim = true;

  if ($umur >= 17 && $punyaSim) {
      echo "Status: Diizinkan mengendarai kendaraan.<br>";
  } elseif ($umur >= 17 && !$punyaSim) {
      echo "Status: Usia mencukupi, tetapi belum memiliki SIM!<br>";
  } else {
      echo "Status: Belum cukup umur untuk mengendarai kendaraan.<br>";
  }
?>

