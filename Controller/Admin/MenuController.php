<?php
class MenuController
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

  public function create()
  {
    $user = $this->account();
    return require_once 'Views/Home/Admin/Menu/Create.php';
  }

  public function store()
  {
    global $conn;

    $menu_baru = $_POST['menu_baru'];
    $harga = $_POST['harga'];
    $status = $_POST['status'];
    $jenis = $_POST['jenis'];

    if (empty($menu_baru) || empty($harga) || empty($status) || empty($jenis)) {
      $_SESSION['error'] = 'Semua kolom harus diisi!';
      header("Location: " . url('/menu/create'));
      return;
    }

    $sql = "INSERT INTO menu (nama, harga, status, jenis) VALUES ('$menu_baru', '$harga', '$status', '$jenis')";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
      $_SESSION['error'] = 'Menu gagal ditambahkan!';
      header("Location: " . url('/menu/create'));
      return;
    }

    $_SESSION['success'] = 'Menu baru ditambahkan!';
    header("Location: " . url('/'));
    return;
  }

  public function edit($id)
  {
    global $conn;
    $id = intval($id);
    $sql = "SELECT * FROM menu WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $user = $this->account();
      $menu = mysqli_fetch_assoc($result);
      return require_once 'Views/Home/Admin/Menu/Edit.php';
    } else {
      $_SESSION['error'] = 'Menu tidak ditemukan!';
      header("Location: " . url('/'));
      return;
    }
  }

  public function update($id)
  {
    global $conn;

    $menu_baru = $_POST['menu_baru'];
    $harga = $_POST['harga'];
    $status = $_POST['status'];
    $jenis = $_POST['jenis'];

    if (empty($menu_baru) || empty($harga) || empty($status) || empty($jenis)) {
      $_SESSION['error'] = 'Semua kolom harus diisi!';
      header("Location: " . url('/menu/edit/' . $id));
      return;
    }

    $sql = "UPDATE menu SET nama = '$menu_baru', harga = '$harga', status = '$status', jenis = '$jenis' WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
      $_SESSION['error'] = 'Menu gagal diubah!';
      header("Location: " . url('/menu/edit/' . $id));
      return;
    }

    $_SESSION['success'] = 'Menu berhasil diperbarui!';
    header("Location: " . url('/'));
    return;
  }

  public function delete($id)
  {
    global $conn;
    $id = intval($id);
    $sql = "DELETE FROM menu WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $_SESSION['success'] = 'Menu berhasil dihapus!';
      header("Location: " . url('/'));
      return;
    } else {
      $_SESSION['error'] = 'Menu gagal dihapus!';
      header("Location: " . url('/'));
      return;
    }
  }
}
