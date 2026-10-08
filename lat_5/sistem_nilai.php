<?php
// DEFINISI FUNGSI-FUNGSI HELPER

// 1. Fungsi Menghitung Nilai Akhir (40% Tugas, 30% UTS, 30% UAS)
function hitungNilaiAkhir(float $tugas, float $uts, float $uas): float {
    return ($tugas * 0.4) + ($uts * 0.3) + ($uas * 0.3);
}

// 2. Fungsi Menentukan Grade
function konversiGrade(float $nilai): string {
    if ($nilai >= 85) return "A";
    if ($nilai >= 75) return "B";
    if ($nilai >= 60) return "C";
    if ($nilai >= 50) return "D";
    return "E";
}

// 3. Fungsi Menentukan Status Kelulusan
function cekKelulusan(string $grade): string {
    return ($grade === "D" || $grade === "E") ? "Tidak Lulus" : "Lulus";
}

// VARIABEL PENAMPUNG FORM
$nama = $tugas = $uts = $uas = "";
$hasil = null;
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST['nama'] ?? '');
    $tugas = $_POST['tugas'] ?? '';
    $uts = $_POST['uts'] ?? '';
    $uas = $_POST['uas'] ?? '';

    if (empty($nama) || $tugas === '' || $uts === '' || $uas === '') {
        $error = "Semua bidang data wajib diisi!";
    } else {
        $nTugas = (float)$tugas;
        $nUts = (float)$uts;
        $nUas = (float)$uas;

        // Memanggil Fungsi Custom
        $nilaiAkhir = hitungNilaiAkhir($nTugas, $nUts, $nUas);
        $grade = konversiGrade($nilaiAkhir);
        $status = cekKelulusan($grade);

        $hasil = [
            'nama' => $nama,
            'nilai_akhir' => $nilaiAkhir,
            'grade' => $grade,
            'status' => $status
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Pengolahan Nilai Siswa</title>
  <style>
    body { font-family: Arial, sans-serif; background-color: #eef2f5; padding: 20px; }
    .container { max-width: 500px; margin: 0 auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    .form-group { margin-bottom: 12px; }
    label { display: block; margin-bottom: 4px; font-weight: bold; color: #2c3e50; }
    input[type="text"], input[type="number"] { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
    button { width: 100%; padding: 10px; background-color: #27ae60; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; margin-top: 10px; }
    button:hover { background-color: #219150; }
    .alert-error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #f5c6cb; }
    .result-box { margin-top: 20px; padding: 15px; background-color: #f8f9fa; border-radius: 5px; border-left: 5px solid #27ae60; }
    .status-lulus { color: green; font-weight: bold; }
    .status-gagal { color: red; font-weight: bold; }
  </style>
</head>
<body>

  <div class="container">
    <h2 style="text-align: center; color: #2c3e50; margin-top: 0;">Kalkulator Nilai Siswa</h2>

    <?php if (!empty($error)): ?>
      <div class="alert-error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="" method="POST">
      <div class="form-group">
        <label for="nama">Nama Siswa:</label>
        <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>" placeholder="Masukkan nama siswa">
      </div>

      <div class="form-group">
        <label for="tugas">Nilai Tugas (0-100):</label>
        <input type="number" id="tugas" name="tugas" min="0" max="100" value="<?php echo htmlspecialchars($tugas); ?>">
      </div>

      <div class="form-group">
        <label for="uts">Nilai UTS (0-100):</label>
        <input type="number" id="uts" name="uts" min="0" max="100" value="<?php echo htmlspecialchars($uts); ?>">
      </div>

      <div class="form-group">
        <label for="uas">Nilai UAS (0-100):</label>
        <input type="number" id="uas" name="uas" min="0" max="100" value="<?php echo htmlspecialchars($uas); ?>">
      </div>

      <button type="submit">Proses Nilai</button>
    </form>

    <?php if ($hasil !== null): ?>
      <div class="result-box">
        <h3 style="margin-top:0;">Laporan Hasil Belajar</h3>
        <p><strong>Nama:</strong> <?php echo htmlspecialchars($hasil['nama']); ?></p>
        <p><strong>Nilai Akhir:</strong> <?php echo number_format($hasil['nilai_akhir'], 2); ?></p>
        <p><strong>Grade:</strong> <?php echo $hasil['grade']; ?></p>
        <p><strong>Keterangan:</strong> 
          <span class="<?php echo $hasil['status'] === 'Lulus' ? 'status-lulus' : 'status-gagal'; ?>">
            <?php echo $hasil['status']; ?>
          </span>
        </p>
      </div>
    <?php endif; ?>
  </div>

</body>
</html>