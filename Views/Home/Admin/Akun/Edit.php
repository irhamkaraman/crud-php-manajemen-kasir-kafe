<?php
$title = 'Edit Akun | Admin';
require_once 'Views/Layouts/app.php';

?>
<div class="section-container mt-5">
  <h1 class="text-2xl font-bold mb-4">Edit Akun <?php echo $userAccount['name']; ?></h1>
  <p class="mb-4">Berhati-hati ketika mengedit akun</p>

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
      <h1 class="text-2xl font-bold">Edit Profile</h1>
      <p class="mb-4">Berhati-hati ketika mengedit akun pengguna lain.</p>
    </div>
    <form class="max-w-sm mx-auto" action="<?php echo url('/akun/update/' . $userAccount['id']); ?>" method="POST">
      <div class="mb-5">
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
        <input type="name" id="name" name="name" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $userAccount['name']; ?>" />
      </div>
      <div class="mb-5">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
        <input type="email" id="email" name="email" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $userAccount['email']; ?>" />
      </div>

      <div class="mb-5">
        <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
        <select id="role" name="role" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          <option value="Member" <?php if ($userAccount['role'] == 'Member') echo 'selected'; ?>>Member</option>
          <option value="Admin" <?php if ($userAccount['role'] == 'Admin') echo 'selected'; ?>>Admin</option>
        </select>
      </div>



      <button type="submit" class="button-logout">Simpan</button>
    </form>
  </div>

</div>