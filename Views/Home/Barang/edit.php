<?php
$title = 'Edit Barang';
require_once 'Views/Layouts/app.php';

?>

<div class="container mt-5">
  <h1>Edit Barang</h1>
  <form action="<?php echo url('/update'); ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $barang['id']; ?>">
    <div class="form-group">
      <label for="nama_barang">Nama Barang</label>
      <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?php echo $barang['nama']; ?>" required>
    </div>
    <div class="form-group">
      <label for="harga">Harga</label>
      <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $barang['harga']; ?>" required>
    </div>
    <div class="form-group">
      <label for="tanggal">Tanggal</label>
      <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $barang['tanggal']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
</div>

