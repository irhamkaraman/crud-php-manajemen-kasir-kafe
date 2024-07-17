<!DOCTYPE html>
<html>

<head>
  <title>Halaman Tidak Ditemukan</title>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="Assets/css/style.css">

  <style>
    .error-button {
      background-color: #000;
      border: none;
      color: white;
      padding: 8px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
    }
  </style>
</head>

<body>

  <section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
      <div class="mx-auto max-w-screen-sm text-center container">
        <h1 class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-primary-600 dark:text-primary-500">404</h1>
        <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">Oops! Halaman Tidak Ditemukan</p>
        <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400">Maaf, Anda tidak dapat mengakses halaman yang Anda cari.</p>
        <a href="<?php echo url('/'); ?>" class="error-button inline-flex font-medium rounded-sm text-sm px-5 py-2.5 text-center my-4">Kembali Ke Halaman Utama</a>
      </div>
    </div>
  </section>

</body>

</html>