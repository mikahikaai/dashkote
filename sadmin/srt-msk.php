<?php
session_start();

include '../koneksi.php';

$query_srt = 'SELECT * FROM tbl_srt_msk m INNER JOIN tbl_bagian b ON m.id_bagian = b.id_bagian INNER JOIN tbl_user u ON u.id_user = m.id_user';
$result_srt = mysqli_query($conn, $query_srt);
?>

<!doctype html>
<html lang="en" class="">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--favicon-->
  <link rel="icon" href="../assets/images/favicon-32x32.png" type="image/png" />
  <!--plugins-->
  <link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <link href="../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
  <link href="../assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
  <link href="../assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
  <!-- loader-->
  <link href="../assets/css/pace.min.css" rel="stylesheet" />
  <script src="../assets/js/pace.min.js"></script>
  <!-- Bootstrap CSS -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/app.css" rel="stylesheet">
  <link href="../assets/css/icons.css" rel="stylesheet">
  <!-- Theme Style CSS -->
  <link rel="stylesheet" href="../assets/css/dark-theme.css" />
  <link rel="stylesheet" href="../assets/css/semi-dark.css" />
  <link rel="stylesheet" href="../assets/css/header-colors.css" />
  <title>Simawar - Data Surat Masuk</title>
</head>

<body>
  <!--wrapper-->
  <div class="wrapper">

    <?php include "theme-sidebar.php" ?>

    <?php include "theme-header.php" ?>

    <!--start page wrapper -->
    <div class="page-wrapper">
      <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
          <div class="ps-3">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="index.php"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Surat Masuk</li>
              </ol>
            </nav>
          </div>
        </div>
        <!--end breadcrumb-->
        <h5 class="my-4 text-uppercase">Data Surat Masuk</h5>
        <div class="col">
          <a href="Surat Masuk-tambah.php" class="btn btn-primary"><i class='bx bx-plus mr-1'></i>Tambah Data</a>
        </div>
        <hr />
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table id="example2" class="table table-hover table-bordered">
                <thead class="table-primary">
                  <tr>
                    <th>Action</th>
                    <th>Nomor</th>
                    <th>Tanggal</th>
                    <th>Lampiran</th>
                    <th>Hal</th>
                    <th>Dari</th>
                    <th>Untuk Bagian</th>
                    <th>Tgl Input</th>
                    <th>Oleh</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  while ($row_srt = mysqli_fetch_assoc($result_srt)) {
                  ?>
                    <tr>
                      <td>
                        <div class="d-flex order-actions">
                          <a href="srt-msk-edit.php?id=<?= $row_srt['id_srt_msk']; ?>" class="text-light bg-success border-0"><i class='bx bxs-edit'></i></a>
                          <a href="srt-msk-hapus.php?id=<?= $row_srt['id_srt_msk']; ?>" class="ms-4 text-light bg-warning border-0" onClick="return confirm('Apakah anda yakin ingin menghapus data ini...?')"><i class='bx bxs-trash'></i></a>
                        </div>
                      </td>
                      <td><?= $row_srt['no_srt'] ?></td>
                      <td><?= $row_srt['tgl_srt'] ?></td>
                      <td><?= $row_srt['lampiran'] ?></td>
                      <td><?= $row_srt['hal'] ?></td>
                      <td><?= $row_srt['dari'] ?></td>
                      <td><?= $row_srt['nm_bagian'] ?></td>
                      <td><?= $row_srt['tgl_input'] ?></td>
                      <td><?= $row_srt['nm_user'] ?></td>
                    </tr>
                  <?php }; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--end page wrapper -->
    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->

    <?php include "theme-footer.php" ?>

  </div>
  <!--end wrapper-->
  <!-- Bootstrap JS -->
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <!--plugins-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
  <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
  <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
  <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
  <script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#example').DataTable();
    });
  </script>
  <script>
    $(document).ready(function() {
      var table = $('#example2').DataTable({
        lengthChange: false,
        buttons: ['copy', 'excel', 'pdf', 'print']
      });

      table.buttons().container()
        .appendTo('#example2_wrapper .col-md-6:eq(0)');
    });
  </script>
  <!--app JS-->
  <script src="../assets/js/app.js"></script>
</body>

</html>