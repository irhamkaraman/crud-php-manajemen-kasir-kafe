<?php 
class KeranjangController
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

    if ($this->account()['role'] != 'Member') {
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
    $listKeranjang = $conn->query(
      "
        SELECT menu.*, keranjang.pembayaran, keranjang.konfirmasi 
        FROM keranjang 
        JOIN menu ON keranjang.menu_id = menu.id 
        WHERE keranjang.user_id = " . $user['id']
    );
    return require_once 'Views/Home/Member/Keranjang/Index.php';
  }


  public function store($id)
  {
    global $conn;
    $user = $this->account();

    $sql = "INSERT INTO keranjang (user_id, menu_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user['id'], $id);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
      $_SESSION['success'] = 'Menu berhasil di pesan';
      header('Location: ' . url('/'));
    }
  }

  public function delete($id)
  {
    global $conn;

    $user_id = $this->account()['id'];

    $sql = "DELETE FROM keranjang WHERE menu_id = ? AND user_id = ? AND pembayaran = 0";
    $stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id, $user_id);
    if (!$stmt->execute()) {
      $_SESSION['error'] = 'Menu gagal dihapus';
      header('Location: ' . url('/keranjang'));
      exit;
    }
    if ($stmt->affected_rows > 0) {
      $_SESSION['success'] = 'Menu berhasil dihapus';
      header('Location: ' . url('/keranjang'));
    } else {
      $_SESSION['error'] = 'Menu gagal dihapus';
      header('Location: ' . url('/keranjang'));
    }
    $stmt->close();
  }

  public function paid($id)
  {
    global $conn;
    $user = $this->account();
    
    $paid = "UPDATE keranjang SET pembayaran = 1 WHERE menu_id = ? AND user_id = ?";
    $stmt = $conn->prepare($paid);
    $stmt->bind_param("ii", $id, $user['id']);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
      $_SESSION['success'] = 'Menu berhasil di bayar';
      header('Location: ' . url('/keranjang'));
    } else {
      $_SESSION['error'] = 'Menu gagal di bayar';
      header('Location: ' . url('/keranjang'));
    }
  } 

}
?>