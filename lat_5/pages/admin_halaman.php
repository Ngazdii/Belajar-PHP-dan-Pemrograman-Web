<?php
$aksi = $_GET['aksi'] ?? 'index';
$id = $_GET['id'] ?? null;

// Proses Simpan Data (Tambah / Edit)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul  = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $slug   = mysqli_real_escape_string($koneksi, strtolower(str_replace(' ', '-', $_POST['slug'])));
    $konten = mysqli_real_escape_string($koneksi, $_POST['konten']);

    if (isset($_POST['tambah'])) {
        $query = "INSERT INTO halaman (judul, konten, slug) VALUES ('$judul', '$konten', '$slug')";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Halaman berhasil ditambahkan!'); window.location='index.php?modul=admin_halaman';</script>";
        } else {
            echo "<p style='color:red;'>Gagal menyimpan: " . mysqli_error($koneksi) . "</p>";
        }
    } elseif (isset($_POST['edit'])) {
        $id_edit = (int)$_POST['id'];
        $query = "UPDATE halaman SET judul='$judul', konten='$konten', slug='$slug' WHERE id=$id_edit";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Halaman berhasil diperbarui!'); window.location='index.php?modul=admin_halaman';</script>";
        } else {
            echo "<p style='color:red;'>Gagal mengupdate: " . mysqli_error($koneksi) . "</p>";
        }
    }
}

// Proses Hapus
if ($aksi === 'hapus' && $id) {
    $id_hapus = (int)$id;
    mysqli_query($koneksi, "DELETE FROM halaman WHERE id=$id_hapus");
    echo "<script>alert('Halaman berhasil dihapus!'); window.location='index.php?modul=admin_halaman';</script>";
}
?>

<h2>Manajemen Konten Halaman</h2>

<?php if ($aksi === 'tambah'): ?>
  <!-- FORM TAMBAH -->
  <h3>Tambah Halaman Baru</h3>
  <form method="POST" action="">
    <p>
      <label>Judul Halaman:</label><br>
      <input type="text" name="judul" style="width: 100%; padding: 8px;" required>
    </p>
    <p>
      <label>Slug/URL (misal: beranda, profil, kontak):</label><br>
      <input type="text" name="slug" style="width: 100%; padding: 8px;" required>
    </p>
    <p>
      <label>Konten Halaman:</label><br>
      <textarea name="konten" rows="8" style="width: 100%; padding: 8px;" required></textarea>
    </p>
    <button type="submit" name="tambah" style="padding: 8px 15px; background: #2ecc71; color: white; border: none; cursor: pointer;">Simpan</button>
    <a href="index.php?modul=admin_halaman">Batal</a>
  </form>

<?php elseif ($aksi === 'edit' && $id): 
  $res = mysqli_query($koneksi, "SELECT * FROM halaman WHERE id=" . (int)$id);
  $data = mysqli_fetch_assoc($res);
?>
  <!-- FORM EDIT -->
  <h3>Edit Halaman</h3>
  <form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
    <p>
      <label>Judul Halaman:</label><br>
      <input type="text" name="judul" value="<?php echo htmlspecialchars($data['judul']); ?>" style="width: 100%; padding: 8px;" required>
    </p>
    <p>
      <label>Slug/URL:</label><br>
      <input type="text" name="slug" value="<?php echo htmlspecialchars($data['slug']); ?>" style="width: 100%; padding: 8px;" required>
    </p>
    <p>
      <label>Konten Halaman:</label><br>
      <textarea name="konten" rows="8" style="width: 100%; padding: 8px;" required><?php echo htmlspecialchars($data['konten']); ?></textarea>
    </p>
    <button type="submit" name="edit" style="padding: 8px 15px; background: #3498db; color: white; border: none; cursor: pointer;">Update</button>
    <a href="index.php?modul=admin_halaman">Batal</a>
  </form>

<?php else: ?>
  <!-- DAFTAR HALAMAN -->
  <a href="index.php?modul=admin_halaman&aksi=tambah" style="display:inline-block; margin-bottom:15px; padding:8px 12px; background:#2ecc71; color:white; text-decoration:none;">+ Tambah Halaman</a>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Slug</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      $query = mysqli_query($koneksi, "SELECT * FROM halaman ORDER BY id ASC");
      while ($row = mysqli_fetch_assoc($query)):
      ?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo htmlspecialchars($row['judul']); ?></td>
        <td><code><?php echo htmlspecialchars($row['slug']); ?></code></td>
        <td>
          <a href="index.php?modul=admin_halaman&aksi=edit&id=<?php echo $row['id']; ?>">Edit</a> | 
          <a href="index.php?modul=admin_halaman&aksi=hapus&id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus halaman ini?');" style="color:red;">Hapus</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
<?php endif; ?>