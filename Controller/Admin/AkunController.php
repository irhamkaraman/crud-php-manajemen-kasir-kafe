<?php
class AkunController
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

  private function listUsers()
  {
    global $conn;

    $sql = "SELECT * FROM user WHERE email != ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION['email']);
    $stmt->execute();
    $result = $stmt->get_result();
    $listUsers = [];
    while ($row = $result->fetch_assoc()) {
      $listUsers[] = $row;
    }
    return $listUsers;
  }

  public function index()
  {
    $user = $this->account();
    $listUsers = $this->listUsers();
    return require_once 'Views/Home/Admin/Akun/Index.php';
  }

  public function edit($id)
  {
    global $conn;
    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $userAccount = $result->fetch_assoc();

    $user = $this->account();

    return require_once 'Views/Home/Admin/Akun/Edit.php';
  }

  public function update($id)
  {
    if (!empty($_POST['name']) && !empty($_POST['email']) && isset($_POST['role'])) {
      global $conn;

      $name = $_POST['name'];
      $email = $_POST['email'];
      $role = $_POST['role'];

      $sql = "UPDATE user SET name = ?, email = ?, role = ? WHERE id = ?";
      $stmt = $conn->prepare($sql);

      if ($stmt) {
        $stmt->bind_param("sssi", $name, $email, $role, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
          $_SESSION['success'] = 'Akun berhasil diperbarui';
        } else {
          $_SESSION['error'] = 'Tidak ada perubahan dilakukan';
        }

        $stmt->close();
      } else {
        $_SESSION['error'] = 'Gagal mempersiapkan statement SQL';
      }

      header('Location: ' . url('/akun'));
      exit;
    } else {
      $_SESSION['error'] = 'Input tidak boleh kosong';
      header('Location: ' . url('/akun/' . $id . '/edit'));
      exit;
    }
  }


  public function delete($id)
  {

    global $conn;
    $sql = "DELETE FROM user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $_SESSION['success'] = 'Akun Berhasil';
    header('Location: ' . url('/akun'));
  }
}
