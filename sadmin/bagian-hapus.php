<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM tbl_bagian WHERE id_bagian = '$id'";
  $result = mysqli_query($conn, $query);

  if ($result) {
    echo '<script>
        alert("Data Berhasil Dihapus!");
        document.location.href = "bagian.php";
        </script>';
  } else {
    echo '<script>
        alert("Data Gagal Dihapus!");
        history.go(-1);
        </script>';
  }
}

?>