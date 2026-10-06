<?php
  $kodeHari = 3; // 1 = Senin, 2 = Selasa, dst.
  $namaHari = "";

  switch ($kodeHari) {
      case 1:
          $namaHari = "Senin - Jadwal: Pemrograman Web";
          break;
      case 2:
          $namaHari = "Selasa - Jadwal: Basis Data";
          break;
      case 3:
          $namaHari = "Rabu - Jadwal: Jaringan Komputer";
          break;
      case 4:
          $namaHari = "Kamis - Jadwal: Sistem Operasi";
          break;
      case 5:
          $namaHari = "Jumat - Jadwal: Bahasa Inggris";
          break;
      default:
          $namaHari = "Akhir Pekan - Tidak Ada Jadwal Kuliah";
          break;
  }

  echo "Informasi Hari: " . $namaHari;
?>