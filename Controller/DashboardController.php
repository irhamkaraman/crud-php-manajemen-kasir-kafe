<?php
class DashboardController
{
   private function account()
   {
      global $conn;

      $sql = "SELECT * FROM user WHERE email = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $_SESSION['email']);
      $stmt->execute();
      $result = $stmt->get_result();
      return $result->fetch_assoc();
   }

   public function __construct()
   {
      if (!isset($_SESSION['auth'])) {
         header("Location: " . url('/login'));
      }
   }

   public function index()
   {
      global $conn;
      $user = $this->account();

      $foods = mysqli_query($conn, "SELECT * FROM menu WHERE jenis = 'makanan'");

      $drinks = mysqli_query($conn, "SELECT * FROM menu WHERE jenis = 'minuman'");

      if ($user['role'] == 'Admin') {
         return require_once 'Views/Home/Admin/Dashboard.php';
      } else if ($user['role'] == 'Member') {
         
         return require_once 'Views/Home/Member/Dashboard.php';
      } else {
         unset($_SESSION['auth']);
         unset($_SESSION['email']);
         header("Location: " . url('/login'));
      }
   }

   public function profile()
   {
      $user = $this->account();

      if ($user['role'] == 'Admin') {
         return require_once 'Views/Home/Admin/Profile.php';
      } elseif ($user['role'] == 'Member') {
         return require_once 'Views/Home/Member/Profile.php';
      } else {
         unset($_SESSION['auth']);
         unset($_SESSION['email']);
         header("Location: " . url('/login'));
      }
   }

   public function update()
   {
      $id = $this->account()['id'];
      $name = trim($_POST['name']);
      $email = trim($_POST['email']);

      if (!empty($name) && !empty($email)) {
         global $conn;

         // Memulai transaksi
         $conn->begin_transaction();

         // Escaping string untuk mencegah SQL Injection
         $name = $conn->real_escape_string($name);
         $email = $conn->real_escape_string($email);

         $sql = "UPDATE user SET name = '$name', email = '$email' WHERE id = $id";

         if ($conn->query($sql) === TRUE) {
            $conn->commit();
            $_SESSION['success'] = 'Profil berhasil diperbarui!';
         } else {
            $conn->rollback();
            // Debug: Menambahkan pesan error dari MySQL
            $_SESSION['error'] = 'Profil gagal diperbarui! Kesalahan eksekusi query: ' . $conn->error;
         }

         header("Location: " . url('/profile'));
         exit;
      } else {
         $_SESSION['error'] = 'Nama dan email tidak boleh kosong!';
         header("Location: " . url('/profile'));
         exit;
      }
   }

}
