<?php
$currentUrl = "/crud_pemweb";
define('BASE_URL', 'http://localhost/crud_pemweb');

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'coffee_day';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
  die("Koneksi database gagal: " . mysqli_connect_error());
}
