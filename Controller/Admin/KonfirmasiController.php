<?php
class KonfirmasiController
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

    if ($this->account()['role'] != 'Admin') {
      unset($_SESSION['auth']);
      unset($_SESSION['email']);
      $_SESSION['error'] = 'Akun anda tidak memiliki akses!';
      header("Location: " . url('/login'));
    }
  }
  public function index()
  {
    global $conn;
    $user = $this->account();

    $sql = "
        SELECT menu.*, keranjang.pembayaran, keranjang.konfirmasi, keranjang.tandai, user.name
        FROM keranjang 
        JOIN menu ON keranjang.menu_id = menu.id 
        JOIN user ON keranjang.user_id = user.id
        WHERE keranjang.konfirmasi = 0";

    $result = $conn->query($sql);

    if ($result === false) {
      die('Query Error: ' . $conn->error);
    }

    $listKeranjang = $result->fetch_all(MYSQLI_ASSOC);

    return require_once 'Views/Home/Admin/Konfirmasi/Index.php';
  }

  public function konfirmasi($id)
  {
    global $conn;
    $user = $this->account();

    $sql = "UPDATE keranjang SET konfirmasi = ? WHERE menu_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $konfirmasi, $id);
    $konfirmasi = 1;
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
      $_SESSION['success'] = 'Menu berhasil di konfirmasi';
      header('Location: ' . url('/konfirmasi'));
    } else {
      $_SESSION['error'] = 'Menu gagal di konfirmasi';
      header('Location: ' . url('/konfirmasi'));
    }
  }

}
