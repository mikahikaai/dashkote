<?php
include '../phpqrcode/qrlib.php';
session_start();

include '../koneksi.php';

$id_srt_klr = $_GET['id'];

$tgl_ttd = date('Y-m-d');

$query_srt_klr = "UPDATE tbl_srt_klr SET
tgl_ttd = '$tgl_ttd'
WHERE id_srt_klr = '$id_srt_klr'";
$result_srt_klr = mysqli_query($conn, $query_srt_klr);
// var_dump($row_srt_klr);
// die();

if ($result_srt_klr) {
  $text_qrcode = $_SERVER['HTTP_HOST'] . "/srt-klr.php?id=$id_srt_klr";
  $tempdir = "../phpqrcode/images/";
  $namafile = "image$id_srt_klr.png";
  $quality = "H";
  $ukuran = 10;
  $padding = 4;

  QRcode::png($text_qrcode, $tempdir . $namafile, $quality, $ukuran, $padding);

  echo '<script>
        alert("Data Berhasil Ditandatangai!");
        document.location.href = "srt-klr.php";
        </script>';
} else {
  echo '<script>
        alert("Data Gagal Ditandatangani!");
        history.go(-1);
        </script>';
}
