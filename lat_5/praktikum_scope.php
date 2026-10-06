<?php
  $hargaGlobal = 75000;

  function hitungTotal() {
      // Mengakses variabel dari luar fungsi menggunakan kata kunci global
      global $hargaGlobal;
      $jumlah = 2; // Variabel Local
      echo "Total Harga: Rp " . ($hargaGlobal * $jumlah) . "<br>";
  }

  function penghitungVisitor() {
      // Variabel static nilainya terus dipertahankan antar pemanggilan
      static $counter = 1;
      echo "Pengunjung ke: " . $counter . "<br>";
      $counter++;
  }

  hitungTotal();
  penghitungVisitor(); // Output: Pengunjung ke: 1
  penghitungVisitor(); // Output: Pengunjung ke: 2
  penghitungVisitor(); // Output: Pengunjung ke: 3
  penghitungVisitor(); // Output: Pengunjung ke: 4
?>

<?php
  // Menggunakan define()
  define("SITE_NAME", "Web Edukasi Kampus");
  define("VERSION", "2.1.0");

  // Menggunakan const
  const PI = 3.14159;

  echo "<h3>Selamat Datang di " . SITE_NAME . " (v" . VERSION . ")</h3>";
  
  // Contoh kalkulasi matematika dengan konstanta
  $jariJari = 7;
  $luas = PI * ($jariJari ** 2);
  echo "Luas Lingkaran: " . $luas;
?>

<?php
  $teks = "Halo PHP";
  $angka = 100;
  $desimal = 99.9;
  $status = false;
  $kosong = NULL;
  $listWarna = ["Merah", "Hijau", "Biru"];

  echo "<pre>";
  var_dump($teks);
  var_dump($angka);
  var_dump($desimal);
  var_dump($status);
  var_dump($kosong);
  var_dump($listWarna);
  echo "</pre>";
?>

<?php
  // Type Juggling (Otomatis oleh PHP)
  $strAngka = "10"; // String
  $total = $strAngka + 5; // Otomatis dikonversi menjadi Integer 15
  echo "Hasil Juggling: " . $total . "<br>";

  // Type Casting (Manual)
  $nilaiFloat = 87.65;
  $nilaiInt = (int) $nilaiFloat; // Mengubah Float menjadi Integer (Desimal dibuang)
  
  $strTeks = "123.45ABC";
  $angkaCasted = (float) $strTeks; // Mengambil komponen angka awal saja

  echo "Float ke Int: " . $nilaiInt . "<br>"; // Output: 87
  echo "String ke Float: " . $angkaCasted . "<br>"; // Output: 123.45
?>

<?php
  $pengguna = "Ahmad";
  $prodi = "Informatika";

  // Penulisan String Multi-baris dengan Heredoc (<<EOT)
  $pesanHeredoc = <<<EOT
  Halo, $pengguna!
  Selamat datang di program kami.
  Prodi: $prodi
  EOT;

  echo $pesanHeredoc;
?>

<?php
  $inputNilai = "85.5";
  $dataUser = null;

  // Validasi Angka
  if (is_numeric($inputNilai)) {
      $nilaiValid = (float) $inputNilai;
      echo "Input valid berupa angka: " . $nilaiValid . "<br>";
  } else {
      echo "Input bukan angka!<br>";
  }

  // Pengecekan isset dan empty
  if (isset($dataUser)) {
      echo "Variabel dataUser terdefinisi.<br>";
  } else {
      echo "Variabel dataUser bernilai NULL atau belum dibuat.<br>";
  }
?>

