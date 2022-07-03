<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM tbl_srt_msk WHERE id_srt_msk = '$id'";
  $result = mysqli_query($conn, $query);

  if ($result) {
    echo '<script>
        alert("Data Berhasil Dihapus!");
        document.location.href = "srt-msk.php";
        </script>';
  } else {
    echo '<script>
        alert("Data Gagal Dihapus!");
        history.go(-1);
        </script>';
  }
}

?>