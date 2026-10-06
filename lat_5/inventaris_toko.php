<?php
// Data Master Produk (Array Multidimensi)
$produkMaster = [
    ["id" => "PRD001", "nama" => "Laptop Asus Zenbook", "kategori" => "Elektronik", "harga" => 12500000, "stok" => 8],
    ["id" => "PRD002", "nama" => "Mouse Wireless Logi", "kategori" => "Aksesoris", "harga" => 250000, "stok" => 25],
    ["id" => "PRD003", "nama" => "Keyboard Mekanikal", "kategori" => "Aksesoris", "harga" => 750000, "stok" => 15],
    ["id" => "PRD004", "nama" => "Monitor LG 24 Inch", "kategori" => "Elektronik", "harga" => 2100000, "stok" => 5],
    ["id" => "PRD005", "nama" => "Headset Gaming Redragon", "kategori" => "Aksesoris", "harga" => 450000, "stok" => 12]
];

$keyword = trim($_POST['keyword'] ?? '');
$filterKategori = $_POST['kategori'] ?? '';
$produkTampil = $produkMaster;

// Pemrosesan Pencarian & Filter Array
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $produkTampil = array_filter($produkMaster, function($item) use ($keyword, $filterKategori) {
        $matchKeyword = empty($keyword) || (stripos($item['nama'], $keyword) !== false);
        $matchKategori = empty($filterKategori) || ($item['kategori'] === $filterKategori);
        return $matchKeyword && $matchKategori;
    });
}

// Hitung Agregat Total
$totalStok = 0;
$totalAset = 0;
foreach ($produkTampil as $p) {
    $totalStok += $p['stok'];
    $totalAset += ($p['harga'] * $p['stok']);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Inventaris Toko</title>
  <style>
    body { font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 20px; }
    .container { background: white; max-width: 800px; margin: 0 auto; padding: 25px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    .filter-box { display: flex; gap: 10px; margin-bottom: 20px; background: #f8f9fa; padding: 15px; border-radius: 6px; }
    input[type="text"], select { padding: 8px; border: 1px solid #ccc; border-radius: 4px; flex: 1; }
    button { background: #27ae60; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; font-weight: bold; }
    button:hover { background: #219150; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
    th { background-color: #2c3e50; color: white; }
    tr:nth-child(even) { background-color: #f9f9f9; }
    .summary-box { display: flex; justify-content: space-between; margin-top: 20px; background: #e8f8f5; padding: 15px; border-radius: 6px; border-left: 4px solid #27ae60; }
  </style>
</head>
<body>

  <div class="container">
    <h2 style="text-align:center; color:#2c3e50; margin-top:0;">Sistem Inventaris Toko</h2>

    <!-- Form Filter & Pencarian -->
    <form action="" method="POST" class="filter-box">
      <input type="text" name="keyword" value="<?php echo htmlspecialchars($keyword); ?>" placeholder="Cari nama produk...">
      <select name="kategori">
        <option value="">-- Semua Kategori --</option>
        <option value="Elektronik" <?php echo ($filterKategori === 'Elektronik') ? 'selected' : ''; ?>>Elektronik</option>
        <option value="Aksesoris" <?php echo ($filterKategori === 'Aksesoris') ? 'selected' : ''; ?>>Aksesoris</option>
      </select>
      <button type="submit">Cari</button>
    </form>

    <!-- Tabel Produk -->
    <table>
      <thead>
        <tr>
          <th>Kode</th>
          <th>Nama Produk</th>
          <th>Kategori</th>
          <th>Harga (Rp)</th>
          <th>Stok</th>
          <th>Subtotal (Rp)</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($produkTampil)): ?>
          <?php foreach ($produkTampil as $item): ?>
            <tr>
              <td><strong><?php echo $item['id']; ?></strong></td>
              <td><?php echo htmlspecialchars($item['nama']); ?></td>
              <td><?php echo $item['kategori']; ?></td>
              <td><?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
              <td><?php echo $item['stok']; ?></td>
              <td><?php echo number_format($item['harga'] * $item['stok'], 0, ',', '.'); ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="6" style="text-align:center; color:red;">Data produk tidak ditemukan!</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <!-- Ringkasan Total -->
    <div class="summary-box">
      <div><strong>Total Jenis Produk:</strong> <?php echo count($produkTampil); ?> Item</div>
      <div><strong>Total Stok:</strong> <?php echo $totalStok; ?> Unit</div>
      <div><strong>Total Nilai Aset:</strong> Rp <?php echo number_format($totalAset, 0, ',', '.'); ?></div>
    </div>
  </div>

</body>
</html>