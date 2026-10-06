<?php
  $hobi = ["Membaca", "Koding", "Bermain Musik"];
  $profil = [
      "Username" => "alex99",
      "Email"    => "alex@example.com",
      "Status"   => "Aktif"
  ];

  echo "<h4>Daftar Hobi:</h4><ol>";
  foreach ($hobi as $item) {
      echo "<li>" . $item . "</li>";
  }
  echo "</ol>";

  echo "<h4>Profil Pengguna:</h4><ul>";
  foreach ($profil as $kunci => $nilai) {
      echo "<li><strong>" . $kunci . ":</strong> " . $nilai . "</li>";
  }
  echo "</ul>";
?>