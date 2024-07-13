<?php
class BarangController
{
  public function __construct() {
    if (!isset($_SESSION['user'])) {
      header("Location: " . url('/login'));
      exit;
    }
  }
  
  public function index()
  {

    global $conn;
    $sql = "SELECT * FROM barang";
    $result = mysqli_query($conn, $sql);
    $barang = mysqli_fetch_all($result, MYSQLI_ASSOC);
    require_once 'Views/Home/dashboard.php';
  }

  public function create()
  {
    require_once 'Views/Home/Barang/create.php';
  }

  public function simpan()
  {
    global $conn;

    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $tanggal = $_POST['tanggal'];

    $sql = "SELECT * FROM barang WHERE nama = '$nama_barang'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      echo "Barang dengan nama '$nama_barang' sudah ada";
    } else {
      $sql = "INSERT INTO barang (nama, harga, tanggal) VALUES ('$nama_barang', '$harga', '$tanggal')";

      if (mysqli_query($conn, $sql)) {
        header("Location: " . url('/'));
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }
  }

  public function edit()
  {
    global $conn;
    $id = $_POST['id'];
    $sql = "SELECT * FROM barang WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $barang = mysqli_fetch_assoc($result);

    require_once 'Views/Home/Barang/edit.php';
  }

  public function update()
  {
    global $conn;
    $id = $_POST['id'];
    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $tanggal = $_POST['tanggal'];

    $sql = "UPDATE barang SET nama = '$nama', harga = '$harga', tanggal = '$tanggal' WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
      header("Location: " . url('/'));
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }

  public function hapus()
  {
    global $conn;
    $id = $_POST['id'];
    $sql = "DELETE FROM barang WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
      header("Location: " . url('/'));  
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }

}
