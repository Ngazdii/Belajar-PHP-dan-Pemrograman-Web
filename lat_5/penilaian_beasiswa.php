<?php
$nama = $strNilaiUjian = $strSks = "";
$hasilPenilaian = null;
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST['nama'] ?? '');
    $strNilaiUjian = $_POST['nilai_ujian'] ?? '';
    $strSks = $_POST['sks'] ?? '';
    $penghasilanOrtu = $_POST['penghasilan'] ?? 0;

    // Validasi Kelengkapan Input
    if (empty($nama) || $strNilaiUjian === '' || $strSks === '') {
        $error = "Semua bidang input wajib diisi!";
    } elseif (!is_numeric($strNilaiUjian) || !is_numeric($strSks)) {
        $error = "Nilai Ujian dan Jumlah SKS harus berupa angka!";
    } else {
        $nilaiUjian = (float) $strNilaiUjian;
        $sks = (int) $strSks;
        $penghasilan = (float) $penghasilanOrtu;

        // 1. Evaluasi Grade & Predikat dengan Match Expression
        $grade = match (true) {
            $nilaiUjian >= 85 => 'A',
            $nilaiUjian >= 75 => 'B',
            $nilaiUjian >= 65 => 'C',
            $nilaiUjian >= 50 => 'D',
            default           => 'E',
        };

        $predikat = match ($grade) {
            'A' => "Sangat Memuaskan",
            'B' => "Memuaskan",
            'C' => "Cukup",
            'D' => "Kurang",
            'E' => "Gagal",
        };

        // 2. Evaluasi Kelulusan
        $isLulus = ($nilaiUjian >= 65 && $sks >= 18);

        // 3. Evaluasi Beasiswa (Bersarang / Nested Conditionals)
        $layakBeasiswa = false;
        $alasanBeasiswa = "";

        if ($isLulus) {
            if ($grade === 'A' && $penghasilan <= 3000000) {
                $layakBeasiswa = true;
                $alasanBeasiswa = "Lulus dengan Nilai A dan Ekonomi Memenuhi Kriteria";
            } elseif ($grade === 'A') {
                $alasanBeasiswa = "Nilai Sangat Baik, tetapi Penghasilan Orang Tua Melebihi Batas Maksimal Beasiswa";
            } else {
                $alasanBeasiswa = "Syarat Minimum Beasiswa adalah Grade A";
            }
        } else {
            $alasanBeasiswa = "Tidak Memenuhi Syarat Kelulusan Akumulasi Nilai/SKS";
        }

        // Simpan Hasil ke Array
        $hasilPenilaian = [
            'nama'            => $nama,
            'nilai'           => $nilaiUjian,
            'sks'             => $sks,
            'grade'           => $grade,
            'predikat'        => $predikat,
            'is_lulus'        => $isLulus,
            'layak_beasiswa'  => $layakBeasiswa,
            'alasan_beasiswa' => $alasanBeasiswa
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Penilaian Ujian & Beasiswa</title>
  <style>
    body { font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 20px; }
    .card { background: white; max-width: 500px; margin: 0 auto; padding: 25px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    .form-group { margin-bottom: 12px; }
    label { display: block; font-weight: bold; margin-bottom: 4px; color: #333; }
    input[type="text"], input[type="number"] { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
    button { width: 100%; background: #2980b9; color: white; border: none; padding: 10px; border-radius: 4px; cursor: pointer; font-size: 16px; margin-top: 10px; }
    button:hover { background: #1c5980; }
    .error { color: #721c24; background: #f8d7da; padding: 10px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #f5c6cb; }
    .hasil { background: #f8f9fa; border-left: 5px solid #2980b9; padding: 15px; margin-top: 20px; }
    .badge { display: inline-block; padding: 4px 8px; border-radius: 4px; font-weight: bold; color: white; }
    .badge-success { background: #27ae60; }
    .badge-danger { background: #e74c3c; }
  </style>
</head>
<body>

  <div class="card">
    <h2 style="text-align:center; color:#2c3e50; margin-top:0;">Evaluasi Nilai & Beasiswa</h2>

    <?php if (!empty($error)): ?>
      <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="" method="POST">
      <div class="form-group">
        <label for="nama">Nama Mahasiswa:</label>
        <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>" placeholder="Masukkan nama...">
      </div>

      <div class="form-group">
        <label for="nilai_ujian">Nilai Ujian (0 - 100):</label>
        <input type="number" id="nilai_ujian" name="nilai_ujian" min="0" max="100" step="0.1" value="<?php echo htmlspecialchars($strNilaiUjian); ?>" placeholder="Contoh: 88.5">
      </div>

      <div class="form-group">
        <label for="sks">Jumlah SKS Lulus:</label>
        <input type="number" id="sks" name="sks" min="0" value="<?php echo htmlspecialchars($strSks); ?>" placeholder="Contoh: 20">
      </div>

      <div class="form-group">
        <label for="penghasilan">Penghasilan Orang Tua (Rp/Bulan):</label>
        <input type="number" id="penghasilan" name="penghasilan" placeholder="Contoh: 2500000">
      </div>

      <button type="submit">Proses Evaluasi</button>
    </form>

    <?php if ($hasilPenilaian): ?>
      <div class="hasil">
        <h3 style="margin-top:0; color:#2c3e50;">Hasil Penilaian:</h3>
        <p><strong>Nama:</strong> <?php echo htmlspecialchars($hasilPenilaian['nama']); ?></p>
        <p><strong>Nilai Ujian:</strong> <?php echo $hasilPenilaian['nilai']; ?> (Grade: <strong><?php echo $hasilPenilaian['grade']; ?></strong> - <?php echo $hasilPenilaian['predikat']; ?>)</p>
        
        <p><strong>Status Kelulusan:</strong> 
          <?php if ($hasilPenilaian['is_lulus']): ?>
            <span class="badge badge-success">LULUS</span>
          <?php else: ?>
            <span class="badge badge-danger">TIDAK LULUS</span>
          <?php endif; ?>
        </p>

        <hr>

        <p><strong>Rekomendasi Beasiswa:</strong><br>
          <?php if ($hasilPenilaian['layak_beasiswa']): ?>
            <span style="color:#27ae60; font-weight:bold;">✓ LAYAK MENDAPATKAN BEASISWA</span>
          <?php else: ?>
            <span style="color:#e74c3c; font-weight:bold;">✗ TIDAK LAYAK BEASISWA</span>
          <?php endif; ?>
          <br><small style="color:#666;">Catatan: <?php echo $hasilPenilaian['alasan_beasiswa']; ?></small>
        </p>
      </div>
    <?php endif; ?>
  </div>

</body>
</html>