<?php
// Deklarasi Konstanta Perusahaan
define("PERSEN_PAJAK", 5); // Pajak 5%
define("TUNJANGAN_TRANSPORT", 500000);

$namaKaryawan = $jabatan = "";
$gajiPokok = 0;
$hasilKalkulasi = null;
$errorMsg = "";

// Cek Pengiriman Form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namaKaryawan = trim($_POST['nama']);
    $jabatan = trim($_POST['jabatan']);
    $inputGaji = $_POST['gaji_pokok'];

    // Validasi Tipe Data Input
    if (empty($namaKaryawan) || empty($jabatan) || empty($inputGaji)) {
        $errorMsg = "Semua kolom form wajib diisi!";
    } elseif (!is_numeric($inputGaji) || $inputGaji <= 0) {
        $errorMsg = "Gaji Pokok harus berupa angka positif!";
    } else {
        // Type Casting ke Float
        $gajiPokok = (float) $inputGaji;

        // Kalkulasi Keuangan
        $potonganPajak = $gajiPokok * (PERSEN_PAJAK / 100);
        $totalGajiKotor = $gajiPokok + TUNJANGAN_TRANSPORT;
        $gajiBersih = $totalGajiKotor - $potonganPajak;

        // Menyimpan Hasil dalam Associative Array
        $hasilKalkulasi = [
            "nama" => strtoupper($namaKaryawan),
            "jabatan" => ucfirst($jabatan),
            "gaji_pokok" => $gajiPokok,
            "tunjangan" => TUNJANGAN_TRANSPORT,
            "pajak" => $potonganPajak,
            "gaji_bersih" => $gajiBersih
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kalkulator Gaji Karyawan - PHP</title>
  <style>
    body { font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 20px; }
    .card { background: white; max-width: 450px; margin: 0 auto; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
    .form-group { margin-bottom: 12px; }
    label { display: block; font-weight: bold; margin-bottom: 4px; }
    input[type="text"], input[type="number"] { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
    button { width: 100%; background: #2c3e50; color: white; border: none; padding: 10px; border-radius: 4px; cursor: pointer; font-size: 16px; }
    button:hover { background: #1a252f; }
    .error { color: red; background: #ffe6e6; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
    .hasil { background: #e8f8f5; border-left: 4px solid #2ecc71; padding: 15px; margin-top: 15px; }
  </style>
</head>
<body>

  <div class="card">
    <h2 style="text-align:center; color:#2c3e50;">Kalkulator Gaji Karyawan</h2>

    <?php if (!empty($errorMsg)): ?>
      <div class="error"><?php echo $errorMsg; ?></div>
    <?php endif; ?>

    <form action="" method="POST">
      <div class="form-group">
        <label for="nama">Nama Karyawan:</label>
        <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($namaKaryawan); ?>" placeholder="Contoh: Budi Santoso">
      </div>

      <div class="form-group">
        <label for="jabatan">Jabatan:</label>
        <input type="text" id="jabatan" name="jabatan" value="<?php echo htmlspecialchars($jabatan); ?>" placeholder="Contoh: Staff IT">
      </div>

      <div class="form-group">
        <label for="gaji_pokok">Gaji Pokok (Rp):</label>
        <input type="number" id="gaji_pokok" name="gaji_pokok" value="<?php echo htmlspecialchars($gajiPokok ?: ''); ?>" placeholder="Contoh: 5000000">
      </div>

      <button type="submit">Hitung Gaji</button>
    </form>

    <?php if ($hasilKalkulasi): ?>
      <div class="hasil">
        <h3 style="margin-top:0;">Rincian Slip Gaji:</h3>
        <p><strong>Nama:</strong> <?php echo $hasilKalkulasi['nama']; ?></p>
        <p><strong>Jabatan:</strong> <?php echo $hasilKalkulasi['jabatan']; ?></p>
        <hr>
        <p>Gaji Pokok: Rp <?php echo number_format($hasilKalkulasi['gaji_pokok'], 0, ',', '.'); ?></p>
        <p>Tunjangan Transport: Rp <?php echo number_format($hasilKalkulasi['tunjangan'], 0, ',', '.'); ?></p>
        <p>Potongan Pajak (5%): Rp <?php echo number_format($hasilKalkulasi['pajak'], 0, ',', '.'); ?></p>
        <h4 style="color:#27ae60;">Gaji Bersih: Rp <?php echo number_format($hasilKalkulasi['gaji_bersih'], 0, ',', '.'); ?></h4>
      </div>
    <?php endif; ?>
  </div>

</body>
</html>