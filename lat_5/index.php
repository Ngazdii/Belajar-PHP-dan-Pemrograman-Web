<!DOCTYPE html>
<html>
<head>
  <title>Praktikum PHP 1</title>
</head>
<body>

  <h1><?php echo "Halo! Selamat belajar PHP!"; ?></h1>

  <?php
    $namaLengkap = "Budi Santoso";
    $umur = 20;
    $ipk = 3.75;
    $isAktif = true;

    echo "Nama: " . $namaLengkap . "<br>";
    echo "Umur: " . $umur . " tahun<br>";
    echo "IPK: " . $ipk . "<br>";
    ?>

    <?php
    $nilai = 79;

    if ($nilai >= 85) {
        $grade = "A";
    } elseif ($nilai >= 75) {
        $grade = "B";
    } elseif ($nilai >= 60) {
        $grade = "C";
    } else {
        $grade = "D";
    }

    echo "Nilai Ujian: " . $nilai . "<br>";
    echo "Grade Anda: " . $grade;
    ?>

    <?php
    // Associative Array
    $mahasiswa = [
        "nama" => "Siti Aminah",
        "nim" => "2026101001",
        "prodi" => "Informatika"
    ];

    echo "<h3>Data Mahasiswa:</h3>";
    echo "<ul>";
    foreach ($mahasiswa as $key => $val) {
        echo "<li><strong>" . ucfirst($key) . ":</strong> " . $val . "</li>";
    }
    echo "</ul>";
    ?>

    <?php
    // Deklarasi fungsi
    function hitungDiskon($harga, $persenDiskon) {
        $potongan = $harga * ($persenDiskon / 100);
        $totalBayar = $harga - $potongan;
        return $totalBayar;
    }   

    // Memanggil fungsi
    $hargaAwal = 90000;
    $diskon = 20;
    $hargaAkhir = hitungDiskon($hargaAwal, $diskon);

    echo "Harga Awal: Rp " . number_format($hargaAwal) . "<br>";
    echo "Setelah Diskon " . $diskon . "%: Rp " . number_format($hargaAkhir);
    ?>

    <!-- Form HTML -->
    <form action="" method="POST">
    <label>Masukkan Nama:</label>
    <input type="text" name="input_nama" required>
    <button type="submit" name="btn_submit">Kirim</button>
    </form>

    <!-- Pemrosesan PHP pada berkas yang sama -->
    <?php
    if (isset($_POST['btn_submit'])) {
        $namaUser = $_POST['input_nama'];
        echo "<p>Selamat datang, <strong>" . htmlspecialchars($namaUser) . "</strong>!</p>";
    }
    ?>

</body>
</html>