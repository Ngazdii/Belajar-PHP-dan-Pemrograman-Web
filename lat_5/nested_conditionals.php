<?php
  $usernameInput = "azdi";
  $passwordInput = "123456";
  $isAccountActive = false;

  if ($usernameInput === "azdi" && $passwordInput === "123456") {
      // Kondisi bersarang di dalam pengecekan kredensial
      if ($isAccountActive) {
          echo "Login Berhasil! Selamat datang di Dashboard.";
      } else {
          echo "Login Gagal: Akun Anda dalam status non-aktif!";
      }
  } else {
      echo "Login Gagal: Username atau Password salah!";
  }
?>