<?php
$title = 'Daftar Barang';
require_once 'Views/Layouts/app.php';

?>
<div class="container mt-5">
  <h1>Daftar Barang</h1>
  <a href="<?php echo url('/tambah'); ?>" class="btn btn-primary mb-3">Tambah Barang</a>
  <a href="<?php echo url('/logout'); ?>" class="btn btn-secondary mb-3">Keluar</a>
  <table class="table">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Tanggal</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($barang as $i => $b) : ?>
        <tr>
          <td><?= $i + 1 ?></td>
          <td><?= $b['nama'] ?></td>
          <td><?= $b['harga'] ?></td>
          <td><?= $b['tanggal'] ?></td>
          <td>
            <form action="<?= url('/edit') ?>" method="post" style="display: inline;">
              <input type="hidden" name="id" value="<?= $b['id'] ?>">
              <button type="submit" class="btn btn-warning btn-sm">Edit</button>
            </form>
            <form action="<?= url('/hapus') ?>" method="post" style="display: inline;">
              <input type="hidden" name="id" value="<?= $b['id'] ?>">
              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

