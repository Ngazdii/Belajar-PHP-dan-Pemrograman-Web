<?php
  // Fungsi dengan default parameter value
  function salam($nama, $waktu = "Pagi") {
      return "Selamat {$waktu}, {$nama}!";
  }

  // Fungsi perhitungan nilai
  function hitungDiskon($totalBelanja, $persenDiskon = 10) {
      $potongan = $totalBelanja * ($persenDiskon / 100);
      return $totalBelanja - $potongan;
  }

  echo salam("Budi", "Siang") . "<br>";
  echo salam("Siti") . "<br><br>"; // Menggunakan default value $waktu = "Pagi"

  $total = 200000;
  $bayar = hitungDiskon($total, 15);
  echo "Total Belanja: Rp " . number_format($total, 0, ',', '.') . "<br>";
  echo "Total Bayar (Setelah Diskon 15%): Rp " . number_format($bayar, 0, ',', '.');
?>