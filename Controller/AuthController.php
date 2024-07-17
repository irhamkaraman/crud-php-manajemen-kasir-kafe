<?php
class AuthController
{
  public function __construct()
  {
    if (isset($_SESSION['auth'])) {
      header("Location: " . url('/'));
    }
  }

  public function login()
  {
    return require_once 'Views/Auth/login.php';
  }

  public function auth()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      global $conn;

      $email = $_POST['email'];
      $password = md5($_POST['password']);

      if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'Semua kolom harus diisi!';
        header("Location: " . url('/login'));
        exit;
      }

      $result = mysqli_query($conn, "SELECT password FROM user WHERE email = '$email'");

      if (mysqli_num_rows($result) == 0) {
        $_SESSION['error'] = 'Akun belum terdaftar!';
        header("Location: " . url('/login'));
        exit;
      } elseif (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($password == $row['password']) {
          $_SESSION['auth'] = $row;
          $_SESSION['email'] = $email;
          $_SESSION['success'] = 'Anda berhasil Login!';
          header("Location: " . url('/'));
        } else {
          $_SESSION['error'] = 'Password salah!';
          header("Location: " . url('/login'));
          exit;
        }
      }
    } else {
      $_SESSION['error_message'] = 'Anda harus login terlebih dahulu!';
      header("Location: " . url('/login'));
      exit;
    }
  }

  public function register()
  {
    return require_once 'Views/Auth/register.php';
  }

  public function store()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      global $conn;
      $username = $_POST['name'];
      $email = $_POST['email'];
      $password = ($_POST['password']);
      $password_confirmation = $_POST['password_confirmation'];

      if (empty($username) || empty($email) || empty($password) || empty($password_confirmation)) {
        $_SESSION['error'] = 'Semua kolom harus diisi!';
        header("Location: " . url('/register'));
        exit;
      }

      $sql = "SELECT * FROM user WHERE email = '$email'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = 'Username atau email sudah terdaftar!';
        header("Location: " . url('/register'));
        exit;
      }

      if ($password == $password_confirmation) {
        $password = md5($password);
      } else {
        $_SESSION['error'] = 'Konfirmasi kata sandi tidak cocok!';
        header("Location: " . url('/register'));
        exit;
      }

      $role = 'Member';
      $sql = "INSERT INTO user (name, email, password, role) VALUES ('$username', '$email', '$password', '$role')";
      if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = 'Pendaftaran akun berhasil!';
        header("Location: " . url('/login'));
      } else {
        $_SESSION['error'] = 'Pendaftaran akun gagal!';
        header("Location: " . url('/register'));
        exit;
      }
    } else {
      $_SESSION['error'] = 'Anda harus login terlebih dahulu!';
      header("Location: " . url('/register'));
      exit;
    }
  }

  public function logout()
  {
    unset($_SESSION['auth']);
    unset($_SESSION['email']);
    
    $_SESSION['success'] = 'Anda berhasil keluar!';
    header("Location: " . url('/login'));
    exit;
  }
}
