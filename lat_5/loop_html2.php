<?php
  $katalogProduk = [
      ["nama" => "Kemeja Polos", "harga" => 150000, "is_ready" => true],
      ["nama" => "Celana Chino", "harga" => 220000, "is_ready" => false],
      ["nama" => "Jaket Parka", "harga" => 350000, "is_ready" => true]
  ];
?>

<h4>Katalog Produk Toko:</h4>
<table border="1" cellpadding="8" cellspacing="0">
  <tr style="background:#eee;">
    <th>No</th>
    <th>Nama Barang</th>
    <th>Harga (Rp)</th>
    <th>Status Stok</th>
  </tr>

  <!-- Menggunakan endforeach; -->
  <?php $no = 1; foreach ($katalogProduk as $produk): ?>
    <tr>
      <td><?php echo $no++; ?></td>
      <td><?php echo htmlspecialchars($produk['nama']); ?></td>
      <td><?php echo number_format($produk['harga'], 0, ',', '.'); ?></td>
      <td>
        <?php if ($produk['is_ready']): ?>
          <span style="color:green;">Tersedia</span>
        <?php else: ?>
          <span style="color:red;">Habis</span>
        <?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>
</table>