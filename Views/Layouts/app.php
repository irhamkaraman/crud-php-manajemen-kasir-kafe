<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>
  <!-- CDN Bootsrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
</body>

</html>