<?php
class AuthController
{
  public function __construct()
  {
    if (isset($_SESSION['user'])) {
      header("Location: " . url('/'));
    }
  }
  public function login()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      global $conn;

      $username = $_POST['username'];
      $password = $_POST['password'];

      $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        $_SESSION['user'] = $username;
        header("Location: " . url('/'));
      } else {
        require_once 'Views/Auth/login.php';
      }
    } else {
      require_once 'Views/Auth/login.php';
    }
  }

  public function register() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      global $conn;
      $username = $_POST['username'];
      $password = $_POST['password'];
      $sql = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
      if (mysqli_query($conn, $sql)) {
        $_SESSION['user'] = $username;
        header("Location: " . url('/'));
      } else {
        require_once 'Views/Auth/register.php'; 
      }
    } else {
      require_once 'Views/Auth/register.php';
    }
  }

  public function logout() {
    session_destroy();
    header("Location: " . url('/'));
  }
}
