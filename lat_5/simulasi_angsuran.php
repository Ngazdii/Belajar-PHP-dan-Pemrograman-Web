<?php
$jumlahPinjaman = $strTenor = $strBunga = "";
$tabelAngsuran = [];
$errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $jumlahPinjaman = $_POST['pinjaman'] ?? '';
    $strTenor = $_POST['tenor'] ?? '';
    $strBunga = $_POST['bunga'] ?? '';

    // Validasi Kelengkapan Input
    if (empty($jumlahPinjaman) || empty($strTenor) || empty($strBunga)) {
        $errorMsg = "Semua bidang input wajib diisi!";
    } elseif (!is_numeric($jumlahPinjaman) || !is_numeric($strTenor) || !is_numeric($strBunga)) {
        $errorMsg = "Seluruh input harus berupa angka positif!";
    } else {
        $pinjaman = (float) $jumlahPinjaman;
        $tenorBulan = (int) $strTenor;
        $bungaPerTahun = (float) $strBunga;

        // Kalkulasi Bunga Flat per Bulan
        $pokokPerBulan = $pinjaman / $tenorBulan;
        $bungaPerBulan = ($pinjaman * ($bungaPerTahun / 100)) / 12;
        $totalAngsuranBulan = $pokokPerBulan + $bungaPerBulan;

        $sisaPinjaman = $pinjaman;

        // Generasi Tabel Angsuran Menggunakan Perulangan FOR
        for ($bulan = 1; $bulan <= $tenorBulan; $bulan++) {
            $sisaPinjaman -= $pokokPerBulan;
            // Menghindari hasil minus karena pembulatan desimal
            if ($sisaPinjaman < 0) $sisaPinjaman = 0;

            $tabelAngsuran[] = [
                'bulan'        => $bulan,
                'angsuran'     => $totalAngsuranBulan,
                'pokok'        => $pokokPerBulan,
                'bunga'        => $bungaPerBulan,
                'sisa_pinjaman'=> $sisaPinjaman
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simulasi Tabel Angsuran Pinjaman</title>
  <style>
    body { font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 20px; }
    .card { background: white; max-width: 700px; margin: 0 auto; padding: 25px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    .form-group { margin-bottom: 12px; }
    label { display: block; font-weight: bold; margin-bottom: 4px; color: #333; }
    input[type="number"] { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
    button { width: 100%; background: #2c3e50; color: white; border: none; padding: 10px; border-radius: 4px; cursor: pointer; font-size: 16px; margin-top: 10px; }
    button:hover { background: #1a252f; }
    .error { color: #721c24; background: #f8d7da; padding: 10px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #f5c6cb; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #ddd; padding: 8px; text-align: right; }
    th { background-color: #2c3e50; color: white; text-align: center; }
    tr:nth-child(even) { background-color: #f9f9f9; }
    td:first-child { text-align: center; font-weight: bold; }
  </style>
</head>
<body>

  <div class="card">
    <h2 style="text-align:center; color:#2c3e50; margin-top:0;">Kalkulator Tabel Angsuran</h2>

    <?php if (!empty($errorMsg)): ?>
      <div class="error"><?php echo $errorMsg; ?></div>
    <?php endif; ?>

    <form action="" method="POST">
      <div class="form-group">
        <label for="pinjaman">Jumlah Pinjaman (Rp):</label>
        <input type="number" id="pinjaman" name="pinjaman" value="<?php echo htmlspecialchars($jumlahPinjaman); ?>" placeholder="Contoh: 12000000">
      </div>

      <div class="form-group">
        <label for="tenor">Jangka Waktu / Tenor (Bulan):</label>
        <input type="number" id="tenor" name="tenor" value="<?php echo htmlspecialchars($strTenor); ?>" placeholder="Contoh: 12">
      </div>

      <div class="form-group">
        <label for="bunga">Bunga per Tahun (%):</label>
        <input type="number" id="bunga" name="bunga" step="0.1" value="<?php echo htmlspecialchars($strBunga); ?>" placeholder="Contoh: 10">
      </div>

      <button type="submit">Hitung Simulasi</button>
    </form>

    <?php if (!empty($tabelAngsuran)): ?>
      <h3 style="margin-top:25px; color:#2c3e50; text-align:center;">Jadwal Pembayaran Angsuran</h3>
      <table>
        <thead>
          <tr>
            <th>Bulan Ke-</th>
            <th>Angsuran (Rp)</th>
            <th>Pokok (Rp)</th>
            <th>Bunga (Rp)</th>
            <th>Sisa Pinjaman (Rp)</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tabelAngsuran as $row): ?>
            <tr>
              <td><?php echo $row['bulan']; ?></td>
              <td><?php echo number_format($row['angsuran'], 0, ',', '.'); ?></td>
              <td><?php echo number_format($row['pokok'], 0, ',', '.'); ?></td>
              <td><?php echo number_format($row['bunga'], 0, ',', '.'); ?></td>
              <td><?php echo number_format($row['sisa_pinjaman'], 0, ',', '.'); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>

</body>
</html>