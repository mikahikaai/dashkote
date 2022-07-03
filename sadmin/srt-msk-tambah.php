<?php

session_start();

include '../koneksi.php';

if (isset($_POST['submit'])) {
  $no_srt = $_POST['no_srt_msk'];
  $tgl_srt = $_POST['tgl_srt'];
  $lampiran = $_POST['lampiran'];
  $hal = $_POST['hal'];
  $dari = $_POST['dari'];
  $id_bagian = $_POST['id_bagian'];
  $tgl_input = $_POST['tgl_input'];
  $id_user = $_POST['id_user'];

  $namaFile = $_FILES['file']['name'];
  $ukuranFile = $_FILES['file']['size'];
  $error = $_FILES['file']['error'];
  $tmpName = $_FILES['file']['tmp_name'];

  $ekstensifileValid = ['pdf', 'doc', 'docx', 'xls', 'xlsx'];
  $ekstensifile = explode(".", $namaFile);
  $ekstensifile = strtolower(end($ekstensifile));

  if (!in_array($ekstensifile, $ekstensifileValid)) {
    echo "<script>
    alert('Format file tidak sesuai...!');
    history.go(-1);
    </script>";
    return false;
  }

  if ($ukuranFile > 10240000) {
    echo "<script>
    alert('Ukuran file maksimal 10mb...!');
    history.go(-1);
    </script>";
    return false;
  }

  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ekstensifile;

  move_uploaded_file($tmpName, '../assets/files/' . $namaFileBaru);

  $file = $namaFileBaru;

  $query = "INSERT INTO tbl_srt_msk VALUES (NULL, '$no_srt', '$tgl_srt', '$lampiran', '$hal', '$dari', '$id_bagian', '$file', '$tgl_input', '$id_user')";
  $result = mysqli_query($conn, $query);

  if ($result) {
    echo '<script>
        alert("Data Berhasil Disimpan!");
        document.location.href = "srt-msk.php";
        </script>';
  } else {
    echo '<script>
        alert("Data Gagal Disimpan!");
        history.go(-1);
        </script>';
  }
}

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
  <title>Simawar - Tambah Surat Masuk</title>
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
                <li class="breadcrumb-item"><a href="srt_msk.php"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="tes.php">Data Surat Masuk</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Surat Masuk</li>
              </ol>
            </nav>
          </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
          <div class="col-xl-12 mx-auto">
            <h6 class="mb-0 text-uppercase">Data Surat Masuk</h6>
            <hr />
            <div class="card border-top border-0 border-4 border-primary">
              <div class="card-body px-5 pb-5">
                <div class="card-title d-flex align-items-center">
                  <div><i class="bx bx-plus me-1 font-22 text-primary"></i>
                  </div>
                  <h5 class="mb-0 text-primary">Tambah Surat Masuk</h5>
                </div>
                <hr>
                <form class="row g-3" method="POST" target="" enctype="multipart/form-data">
                  <div class="col-12">
                    <label for="no_srt_msk" class="form-label">Nomor Surat :</label>
                    <input type="text" class="form-control" name="no_srt_msk" id="no_srt_msk" placeholder="Nomor Surat Masuk" required>
                  </div>
                  <div class="col-12">
                    <label for="tgl_srt" class="form-label">Tanggal Surat :</label>
                    <input type="date" class="form-control" name="tgl_srt" id="tgl_srt" placeholder="Tanggal Surat Masuk" required>
                  </div>
                  <div class="col-12">
                    <label for="lampiran" class="form-label">Lampiran :</label>
                    <input type="text" class="form-control" name="lampiran" id="lampiran" placeholder="Lampiran Surat Masuk" required>
                  </div>
                  <div class="col-12">
                    <label for="hal" class="form-label">Hal :</label>
                    <input type="text" class="form-control" name="hal" id="hal" placeholder="Perihal Surat Masuk" required>
                  </div>
                  <div class="col-12">
                    <label for="dari" class="form-label">dari :</label>
                    <input type="text" class="form-control" name="dari" id="dari" placeholder="Surat Masuk Dari" required>
                  </div>
                  <div class="col-12">
                    <label for="id_bagian" class="form-label">Bagian :</label>
                    <select name="id_bagian" id="id_bagian" class="form-select" required>
                      <option value="">Pilih Bagian...</option>
                      <?php
                      $query_bagian = "SELECT * FROM tbl_bagian";
                      $result_bagian = mysqli_query($conn, $query_bagian);
                      while ($row_bagian = mysqli_fetch_assoc($result_bagian)) {
                      ?>
                        <option value="<?= $row_bagian['id_bagian'] ?>"><?= $row_bagian['nm_bagian'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-12">
                    <label for="file" class="form-label">Upload File Surat :</label>
                    <input class="form-control" type="file" name="file" id="file" required>
                  </div>
                  <small>File format .PDF .DOX .DOCX. .XLS .XLSX dengan ukuran maksimal 10 MB</small>
                  <input type="hidden" name="tgl_input" value="<?= date('Y-m-d H:i:s'); ?>">
                  <input type="hidden" name="id_user" value="<?= $_SESSION['id_user']; ?>">
                  <div class="col-12">
                    <button type="submit" name="submit" class="btn btn-primary px-5">Simpan</button>
                    <button type="reset" class="btn btn-secondary px-5">Batal</button>
                  </div>
                </form>
              </div>
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

    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="../assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="../assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--app JS-->
    <script src="../assets/js/app.js"></script>
</body>

</html>