<?php
$title = 'Edit Menu | Admin';
require_once 'Views/Layouts/app.php';

?>
<div class="section-container mt-5">
  <h1 class="text-2xl font-bold mb-4">Edit Menu</h1>
  <button onclick="goBack()" class="button-logout">Kembali</button>
  <script>
    function goBack() {
      window.history.back();
    }
  </script>

</div>

<div class="section-container mt-5 shadow-md p-5">

  <?php if (isset($_SESSION['error'])) : ?>
    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
      <span class="font-medium">Gagal!</span> <?php echo $_SESSION['error']; ?>
    </div>
  <?php
    unset($_SESSION['error']);
  endif;
  ?>

  <div class="card-menu mt-5">
    <div>
      <h1 class="text-2xl font-bold">Edit Menu <?php echo $menu['nama']; ?></h1>
      <p class="mb-4">Anda akan melakukan perubahan pada menu <?php echo $menu['nama']; ?>. Pastikan data yang Anda masukkan sudah benar sebelum melakukan perubahan.</p>
    </div>
    <form class="max-w-sm mx-auto" action="<?php echo url('/menu/update/' . $menu['id']); ?>" method="POST">
      <div class="mb-5">
        <label for="menu_baru" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Menu Baru</label>
        <input type="menu_baru" id="menu_baru" name="menu_baru" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?= $menu['nama']; ?>" />
      </div>
      <div class="mb-5">
        <label for="harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
        <input type="text" id="harga" name="harga" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?= $menu['harga']; ?>" />
      </div>

      <div class="mb-5">
        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status Menu</label>
        <select id="status" name="status" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          <option value="tersedia" <?php if ($menu['status'] == 'tersedia') echo 'selected'; ?>>Tersedia</option>
          <option value="kosong" <?php if ($menu['status'] == 'kosong') echo 'selected'; ?>>Kosong</option>
        </select>
      </div>
      <div class="mb-5">
        <label for="jenis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
        <select id="jenis" name="jenis" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          <option value="makanan" <?php if ($menu['jenis'] == 'makanan') echo 'selected'; ?>>Makanan</option>
          <option value="minuman" <?php if ($menu['jenis'] == 'minuman') echo 'selected'; ?>>Minuman</option>
        </select>
      </div>

      <button type="submit" class="button-logout">Simpan</button>
    </form>
  </div>

</div>