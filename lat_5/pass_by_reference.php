<?php
  function tambahPoinPassByValue($poin) {
      $poin += 10;
  }

  function tambahPoinPassByReference(&$poin) {
      $poin += 10;
  }

  $poinUser = 50;

  tambahPoinPassByValue($poinUser);
  echo "Poin setelah Pass by Value: " . $poinUser . "<br>"; // Nilai tetap 50

  tambahPoinPassByReference($poinUser);
  echo "Poin setelah Pass by Reference: " . $poinUser; // Nilai berubah jadi 60
?>