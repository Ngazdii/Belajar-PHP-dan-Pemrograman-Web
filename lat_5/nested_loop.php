<?php
  $tinggi = 100;

  echo "<h4>Pola Segitiga Bintang:</h4>";
  for ($i = 1; $i <= $tinggi; $i++) {
      for ($j = 1; $j <= $i; $j++) {
          echo "* ";
      }
      echo "<br>";
  }
?>