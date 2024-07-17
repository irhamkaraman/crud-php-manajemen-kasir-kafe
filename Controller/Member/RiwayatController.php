<?php
class RiwayatController
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
        SELECT menu.*, keranjang.pembayaran, keranjang.konfirmasi, keranjang.tandai 
        FROM keranjang 
        JOIN menu ON keranjang.menu_id = menu.id 
        WHERE keranjang.user_id = " . $user['id'] .
        " AND keranjang.pembayaran = 1 AND keranjang.konfirmasi = 1"
        
    );
    return require_once 'Views/Home/Member/Riwayat/Index.php';
  }

  public function tanda($id)
  {
    global $conn;
    $user = $this->account();
    $tandai = "UPDATE keranjang SET tandai = 1 WHERE user_id = " . $user['id'] . " AND menu_id = " . $id . "  AND pembayaran = 1 AND konfirmasi = 1";
    if ($conn->query($tandai)) {
      $_SESSION['success'] = 'Struk diterima!';
      header("Location: " . url('/riwayat'));
    } else {
      $_SESSION['error'] = 'Tanda gagal diterima!';
      header("Location: " . url('/riwayat'));
    }
  }

  public function delete($id)
  {
    global $conn;
    $user = $this->account();
    $sql = "DELETE FROM keranjang WHERE user_id = ? AND menu_id = ? AND pembayaran = 1 AND konfirmasi = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user['id'], $id);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
      $_SESSION['success'] = 'Riwayat berhasil dihapus!';
      header("Location: " . url('/riwayat'));
    } else {
      $_SESSION['error'] = 'Riwayat gagal dihapus!';
      header("Location: " . url('/riwayat'));
    }
  }

}
