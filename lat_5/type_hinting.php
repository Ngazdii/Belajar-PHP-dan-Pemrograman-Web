<?php
  // Function dengan Strict Type Hinting (Parameter float/int, Return string)
  function formatRupiah(float $nominal): string {
      return "Rp " . number_format($nominal, 0, ',', '.');
  }

  echo formatRupiah(150000) . "<br><br>";

  // Anonymous Function (Closure)
  $hitungLuas = function(int $p, int $l): int {
      return $p * $l;
  };

  echo "Luas Persegi Panjang (5x4): " . $hitungLuas(5, 4) . " cm²";
?>