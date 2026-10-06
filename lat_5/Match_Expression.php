<?php
  $roleUser = "admin";

  // Match Expression langsung mengembalikan nilai
  $hakAkses = match ($roleUser) {
      'admin', 'superadmin' => "Akses Penuh: Tambah, Edit, Hapus Data",
      'editor'             => "Akses Terbatas: Tambah dan Edit Data",
      'user'               => "Akses Read-Only: Hanya Lihat Data",
      default              => "Akses Ditolak: Role tidak dikenal!"
  };

  echo "Role: " . ucfirst($roleUser) . "<br>";
  echo "Hak Akses: " . $hakAkses;
?>