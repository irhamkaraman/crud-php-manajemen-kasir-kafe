<nav class="bg-white border-gray-200 dark:bg-gray-900">
  <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
    <a href="<?php echo url('/'); ?>" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="https://static.vecteezy.com/system/resources/previews/002/412/377/non_2x/coffee-cup-logo-coffee-shop-icon-design-free-vector.jpg" class="h-8" alt="Flowbite Logo" />
      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">CoffeeDay</span>
    </a>
    <div class="flex items-center space-x-6 rtl:space-x-reverse">
      <a href="<?php echo url('/profile'); ?>" class="text-sm  text-gray-500 dark:text-white hover:underline"><?php echo $user['name']; ?></a>
      <a href="<?php echo url('/logout'); ?>" class="button-logout hover:underline">Keluar</a>
    </div>
  </div>
</nav>
<nav class="bg-gray-50 dark:bg-gray-700">
  <div class="max-w-screen-xl px-4 py-3 mx-auto">
    <div class="flex items-center">
      <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
        <?php
        if ($user['role'] == 'Member') { ?>

          <li>
            <a href="<?php echo url('/'); ?>" class="text-gray-900 dark:text-white hover:underline" aria-current="page">Beranda</a>
          </li>

          <li>
            <a href="<?php echo url('/keranjang'); ?>" class="text-gray-900 dark:text-white hover:underline">
              Keranjang

              <?php
              global $conn;

              if (isset($user['id'])) {
                $keranjangSql = "SELECT COUNT(*) FROM keranjang WHERE user_id = ? AND pembayaran = 0";
                $keranjangStmt = $conn->prepare($keranjangSql);
                $keranjangStmt->bind_param("i", $user['id']);
                $keranjangStmt->execute();
                $keranjangStmt->bind_result($keranjangCount);
                $keranjangStmt->fetch();
                $keranjangStmt->close();

                if ($keranjangCount > 0) {
                  echo '<span class="bg-red-500 text-white text-xs font-medium px-2.5 py-0.5 rounded ml-2">' . $keranjangCount . '</span>';
                }
              }
              ?>

            </a>
          </li>

          <li>
            <a href="<?php echo url('/riwayat'); ?>" class="text-gray-900 dark:text-white hover:underline">
              Riwayat
              <?php
              if (isset($user['id'])) {
                $keranjangSql = "SELECT COUNT(*) FROM keranjang WHERE user_id = ? AND konfirmasi = 1 AND pembayaran = 1 AND tandai = 0";
                $keranjangStmt = $conn->prepare($keranjangSql);
                $keranjangStmt->bind_param("i", $user['id']);
                $keranjangStmt->execute();
                $keranjangStmt->bind_result($keranjangCount);
                $keranjangStmt->fetch();
                $keranjangStmt->close();

                if ($keranjangCount > 0) {
                  echo '<span class="bg-red-500 text-white text-xs font-medium px-2.5 py-0.5 rounded ml-2">' . $keranjangCount . '</span>';
                }
              }
              ?>
            </a>
          </li>

        <?php } else if ($user['role'] == 'Admin') { ?>

          <li>
            <a href="<?php echo url('/') ?>" class="text-gray-900 dark:text-white hover:underline" aria-current="page">Beranda</a>
          </li>

          <li></li>
          <a href="<?php echo url('/akun'); ?>" class="text-gray-900 dark:text-white hover:underline">Akun</a>
          </li>

          <li></li>
          <a href="<?php echo url('/konfirmasi'); ?>" class="text-gray-900 dark:text-white hover:underline">
            Konfirmasi
            <?php

            global $conn;
            if (isset($user['id'])) {
              $keranjangSql = "SELECT COUNT(*) FROM keranjang WHERE pembayaran = 1 AND konfirmasi = 0 ";
              $keranjangStmt = $conn->prepare($keranjangSql);
              $keranjangStmt->execute();
              $keranjangStmt->bind_result($keranjangCount);
              $keranjangStmt->fetch();
              $keranjangStmt->close();

              if ($keranjangCount > 0) {
                echo '<span class="bg-red-500 text-white text-xs font-medium px-2.5 py-0.5 rounded ml-2">' . $keranjangCount . '</span>';
              }
            }
            ?>
          </a>
          </li>

        <?php } ?>

      </ul>
    </div>
  </div>
</nav>