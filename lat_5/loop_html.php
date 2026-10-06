<form>
  <label for="tgl">Pilih Tanggal Lahir:</label>
  <select id="tgl" name="tgl">
    <?php
      for ($t = 1; $t <= 31; $t++) {
          // Menambahkan angka 0 di depan jika < 10 (contoh: 01, 02)
          $val = str_pad($t, 2, "0", STR_PAD_LEFT);
          echo "<option value='{$val}'>{$val}</option>";
      }
    ?>
  </select>

  <label for="tahun">Tahun:</label>
  <select id="tahun" name="tahun">
    <?php
      $tahunSekarang = 2026;
      for ($thn = $tahunSekarang; $thn >= 1980; $thn--) {
          echo "<option value='{$thn}'>{$thn}</option>";
      }
    ?>
  </select>
</form>