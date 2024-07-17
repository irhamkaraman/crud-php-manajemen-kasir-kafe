<?php
$title = 'Buat Menu Baru';
require_once 'Views/Layouts/app.php';

?>

<div class="section-container mt-5 shadow-md p-5">

  <?php if (isset($_SESSION['error'])) : ?>
    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
      <span class="font-medium">Gagal!</span> <?php echo $_SESSION['error']; ?>
    </div>
  <?php
    unset($_SESSION['error']);
  endif;
  ?>

  <?php if (isset($_SESSION['success'])) : ?>
    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
      <span class="font-medium">Sukses!</span> <?php echo $_SESSION['success']; ?>
    </div>
  <?php
    unset($_SESSION['success']);
  endif;
  ?>

  <div class="card-menu mt-5">
    <div>
      <h1 class="text-2xl font-bold">Edit Profile</h1>
      <p class="mb-4">Anda hanya dapat melakukan pembaruan nama saja, jika ingin melakukan pembaruan email anda, silahkan hubungi admin</p>
    </div>
    <form class="max-w-sm mx-auto" action="<?php echo url('/profile/update'); ?>" method="POST">
      <div class="mb-5">
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
        <input type="name" id="name" name="name" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $user['name']; ?>" />
      </div>
      <div class="mb-5">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
        <input type="email" id="email" name="email" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $user['email']; ?>" />
      </div>
      
      <div class="mb-5">
        <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status Anda</label>
        <input type="text" id="role" name="role" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $user['role']; ?>" disabled style="cursor: not-allowed;"/>
        <style>
          #role:hover {
            cursor: not-allowed;
          }
        </style>
      </div>



      <button type="submit" class="button-logout">Simpan</button>
    </form>
  </div>

</div>