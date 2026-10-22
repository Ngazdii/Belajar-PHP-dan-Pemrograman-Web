<?php
$aksi = $_GET['aksi'] ?? 'index';
$id   = $_GET['id'] ?? null;

// PROSES TAMBAH / EDIT
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul  = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $slug   = mysqli_real_escape_string($koneksi, strtolower(str_replace(' ', '-', $_POST['slug'])));
    $konten = mysqli_real_escape_string($koneksi, $_POST['konten']);
    
    // Penanganan Upload Foto
    $nama_foto = $_POST['foto_lama'] ?? '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['foto']['tmp_name'];
        $nama_foto = time() . '_' . $_FILES['foto']['name'];
        
        // Buat folder 'uploads' di luar jika belum ada
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }
        move_uploaded_file($tmp_name, 'uploads/' . $nama_foto);
    }

    if (isset($_POST['tambah'])) {
        $query = "INSERT INTO halaman (judul, konten, slug, foto) VALUES ('$judul', '$konten', '$slug', '$nama_foto')";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Konten berhasil ditambahkan!'); window.location='index.php?modul=admin_konten';</script>";
        } else {
            echo "<p style='color:red;'>Gagal menyimpan: " . mysqli_error($koneksi) . "</p>";
        }
    } elseif (isset($_POST['edit'])) {
        $id_edit = (int)$_POST['id'];
        $query = "UPDATE halaman SET judul='$judul', konten='$konten', slug='$slug', foto='$nama_foto' WHERE id=$id_edit";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Konten berhasil diperbarui!'); window.location='index.php?modul=admin_konten';</script>";
        } else {
            echo "<p style='color:red;'>Gagal mengupdate: " . mysqli_error($koneksi) . "</p>";
        }
    }
}

// PROSES HAPUS
if ($aksi === 'hapus' && $id) {
    $id_hapus = (int)$id;
    
    // Hapus file foto dari folder jika ada
    $res = mysqli_query($koneksi, "SELECT foto FROM halaman WHERE id=$id_hapus");
    $data = mysqli_fetch_assoc($res);
    if ($data && !empty($data['foto']) && file_exists('uploads/' . $data['foto'])) {
        unlink('uploads/' . $data['foto']);
    }

    mysqli_query($koneksi, "DELETE FROM halaman WHERE id=$id_hapus");
    echo "<script>alert('Konten berhasil dihapus!'); window.location='index.php?modul=admin_konten';</script>";
}
?>

<h2>Admin Konten Halaman</h2>

<?php if ($aksi === 'tambah'): ?>
  <h3>Tambah Konten Baru</h3>
  <form method="POST" action="" enctype="multipart/form-data">
    <p>
      <label>Judul:</label><br>
      <input type="text" name="judul" style="width: 100%; padding: 8px;" required>
    </p>
    <p>
      <label>Slug/URL (misal: beranda, profil, kontak):</label><br>
      <input type="text" name="slug" style="width: 100%; padding: 8px;" required>
    </p>
    <p>
      <label>Konten:</label><br>
      <textarea name="konten" rows="6" style="width: 100%; padding: 8px;" required></textarea>
    </p>
    <p>
      <label>Foto:</label><br>
      <input type="file" name="foto" accept="image/*">
    </p>
    <button type="submit" name="tambah" style="padding: 8px 15px; background: #2ecc71; color: white; border: none; cursor: pointer;">Simpan</button>
    <a href="index.php?modul=admin_konten">Batal</a>
  </form>

<?php elseif ($aksi === 'edit' && $id): 
  $res = mysqli_query($koneksi, "SELECT * FROM halaman WHERE id=" . (int)$id);
  $data = mysqli_fetch_assoc($res);
?>
  <h3>Edit Konten</h3>
  <form method="POST" action="" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
    <input type="hidden" name="foto_lama" value="<?php echo htmlspecialchars($data['foto'] ?? ''); ?>">
    
    <p>
      <label>Judul:</label><br>
      <input type="text" name="judul" value="<?php echo htmlspecialchars($data['judul']); ?>" style="width: 100%; padding: 8px;" required>
    </p>
    <p>
      <label>Slug/URL:</label><br>
      <input type="text" name="slug" value="<?php echo htmlspecialchars($data['slug']); ?>" style="width: 100%; padding: 8px;" required>
    </p>
    <p>
      <label>Konten:</label><br>
      <textarea name="konten" rows="6" style="width: 100%; padding: 8px;" required><?php echo htmlspecialchars($data['konten']); ?></textarea>
    </p>
    <p>
      <label>Foto:</label><br>
      <?php if (!empty($data['foto'])): ?>
        <img src="uploads/<?php echo htmlspecialchars($data['foto']); ?>" width="80" style="display:block; margin-bottom:5px;">
      <?php endif; ?>
      <input type="file" name="foto" accept="image/*">
    </p>
    <button type="submit" name="edit" style="padding: 8px 15px; background: #3498db; color: white; border: none; cursor: pointer;">Update</button>
    <a href="index.php?modul=admin_konten">Batal</a>
  </form>

<?php else: ?>
  <a href="index.php?modul=admin_konten&aksi=tambah" style="display:inline-block; margin-bottom:15px; padding:8px 12px; background:#2ecc71; color:white; text-decoration:none;">+ Tambah Konten</a>

  <table>
    <thead>
      <tr>
        <th>no</th>
        <th>judul</th>
        <th>konten</th>
        <th>slug</th>
        <th>foto</th>
        <th>aksi</th>
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
        <td><?php echo htmlspecialchars(substr(strip_tags($row['konten']), 0, 50)) . '...'; ?></td>
        <td><code><?php echo htmlspecialchars($row['slug']); ?></code></td>
        <td>
          <?php if (!empty($row['foto']) && file_exists('uploads/' . $row['foto'])): ?>
            <img src="uploads/<?php echo htmlspecialchars($row['foto']); ?>" width="60" alt="Foto">
          <?php else: ?>
            <span style="color:#aaa;">Tanpa Foto</span>
          <?php endif; ?>
        </td>
        <td>
          <a href="index.php?modul=admin_konten&aksi=edit&id=<?php echo $row['id']; ?>">Edit</a> | 
          <a href="index.php?modul=admin_konten&aksi=hapus&id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?');" style="color:red;">Hapus</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
<?php endif; ?>