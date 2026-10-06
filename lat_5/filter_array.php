<?php
  $angka = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

  // Memfilter hanya angka genap
  $angkaGenap = array_filter($angka, function($n) {
      return $n % 2 === 0;
  });

  echo "Angka Genap: " . implode(", ", $angkaGenap);
?>