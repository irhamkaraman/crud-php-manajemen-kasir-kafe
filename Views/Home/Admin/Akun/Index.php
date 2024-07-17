<?php
$title = 'List Akun Member | Admin';
require_once 'Views/Layouts/app.php';

?>
<div class="section-container mt-5">
  <h1 class="text-2xl font-bold mb-4">List Seluruh Akun</h1>
  <p class="mb-4">Berhati-hati ketika mengedit akun</p>

</div>
<div class="section-container mt-5">

  <?php if (isset($_SESSION['success'])) : ?>
    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
      <span class="font-medium">Berhasil!</span> <?php echo $_SESSION['success']; ?>
    </div>
  <?php
    unset($_SESSION['success']);
  endif;
  ?>

  <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="px-6 py-3">
            Nama
          </th>
          <th scope="col" class="px-6 py-3">
            Email
          </th>
          <th scope="col" class="px-6 py-3">
            Role
          </th>
          <th scope="col" class="px-6 py-3">
            Opsi
          </th>
        </tr>
      </thead>
      <tbody>

        <?php foreach ($listUsers as $listUser) : ?>
          <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              <?php echo $listUser['name']; ?>
            </th>
            <td class="px-6 py-4">
              <?php echo $listUser['email']; ?>
            </td>
            <td class="px-6 py-4">
              <?php echo $listUser['role']; ?>
            </td>
            <td class="px-6 py-4">
              <a href="<?php echo url('/akun/' . $listUser['id'] . '/edit'); ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
              |
              <button data-modal-target="popup-modal-<?php echo $listUser['id']; ?>" data-modal-toggle="popup-modal-<?php echo $listUser['id']; ?>" class="font-medium text-red-600 dark:text-red-500 hover:underline" type="button">
                Hapus
              </button>

              <div id="popup-modal-<?php echo $listUser['id']; ?>" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                  <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal-<?php echo $listUser['id']; ?>">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                      </svg>
                      <span class="sr-only"></span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                      <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                      </svg>
                      <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah anda ingin menghapus akun <?php echo $listUser['name']; ?> ini?</h3>

                      <div class="flex justify-center">
                        <form action="<?php echo url('/akun/' . $listUser['id'] . '/delete'); ?>" method="post">
                          <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Ya, Hapus
                          </button>
                        </form>

                        <button data-modal-hide="popup-modal-<?php echo $listUser['id']; ?>" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                          Tidak
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </td>

          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  </div>

</div>