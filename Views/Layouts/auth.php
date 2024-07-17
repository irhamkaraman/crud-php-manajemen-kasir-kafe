<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>
  <!-- CDN Bootsrap -->
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="Assets/css/style.css">
</head>

<body>
  <?php
  ob_start();
  ?>

  <?php
  ?>

  <?php
  $content = ob_get_clean();

  echo $content;
  ?>

  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>

</body>

</html>