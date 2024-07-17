<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>
  <!-- CDN Bootsrap -->
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="<?php echo url('/'); ?>/Assets/css/style.css?v=1.0">

</head>

<body>

  <?php
  require_once 'Views/Components/Navbar.php';
  ?>

  <?php ob_start(); ?>

  <?php 
  $content = ob_get_clean();
  echo $content;
  ?>


  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.js"></script>
  <script src="<?php echo url('/'); ?>/Assets/js/setting.js"></script>
</body>

</html>