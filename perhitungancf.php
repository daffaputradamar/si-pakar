<?php
session_start();

include 'database/koneksi.php';

if ( is_null( $_SESSION['login'] ) ) {
  header("location:login.php");
}

if (isset($_GET['logout'])) {
  session_destroy();
  header("location:login.php");
}
?>

<?php
if(@$_GET['act'] == "add") {
  $id_gejala = $_POST['id_gejala'];
  $nilai_user = $_POST['nilai_user'];

  $sql_nilai_gejala = mysqli_query($bukaDatabase, "SELECT nilai_gejala FROM tblgejala WHERE id_gejala = '$id_gejala'");
  $res_nilai_gejala = mysqli_fetch_assoc($sql_nilai_gejala);

  $sqlIn = mysqli_query($bukaDatabase, 'INSERT INTO storage (id_gejala, nilai_gejala, nilai_user) VALUES ("'.$id_gejala.'", "'.$res_nilai_gejala['nilai_gejala'].'", "'.$nilai_user.'")');
  header("Location: perhitungancf.php");
}

if(@$_GET['act'] == "del") {
  $idStore = $_GET['id'];

  $exec = mysqli_query($bukaDatabase, "DELETE FROM storage WHERE id_store = '$idStore'");
  header("Location: perhitungancf.php");
}

if(@$_GET['act'] == "hitung") {
  // $sqlSel = mysqli_query($bukaDatabase, "SELECT * FROM storage ORDER BY nama_gejala ASC");
  // $array = array();
  // $cfold = array();
  // $no = 1;

  // while($selRow = mysqli_fetch_assoc($sqlSel)){
  //   $array[] = $selRow;
  // }

  // if(count($array) == 1) {
  //   $cfold[0] = $array[0]["cf_he"] * (1 - $array[0]["cf_he"]);
  // }

  // // if(count($array) == 2) {
  // $cfold[0] = $array[0]["cf_he"] + $array[1]["cf_he"] * (1 - $array[0]["cf_he"]);
  // // }

  // if(count($array) >= 2) {
  //   for($i = 1; $i < (count($array)-1); $i++) {
  //     $cfold[$i] = $cfold[$i-1] + $array[$i+1]["cf_he"] * (1 - $cfold[$i-1]);
  //   }
  // }

  // // for($i = 0; $i < (count($array)-1); $i++) {
  // //   echo "Cfold".$no." = ".$cfold[$i]."<br>";
  // //   $no++;
  // // }

  // for($i = 0; $i < count($array); $i++) {
  //   $nmGjl = $array[$i]["nama_gejala"];
  //   $cfUser = $array[$i]["cf_user"];
  //   $nilGejala = $array[$i]["nilai_gejala"];
  //   $nilCfUser = $array[$i]["nilai_cfuser"];
  //   $nilCfHe = $array[$i]["cf_he"];
  //   $total = end($cfold) * 100;

  //   $sqlInsert = mysqli_query($bukaDatabase, 'INSERT INTO tbldiagnosa (nama_gejala, cf_user, nilai_gejala, nilai_cfuser, cf_he, cfold_akhir) VALUES ("'.$nmGjl.'", "'.$cfUser.'", "'.$nilGejala.'", "'.$nilCfUser.'", "'.$nilCfHe.'", "'.$total.'")');
  //   $sqlDel = mysqli_query($bukaDatabase, "DELETE FROM storage");
  //   header("Location: perhitungancf.php");
  // }
}

if(@$_GET['act'] == "awal") {
  $xAwal = mysqli_query($bukaDatabase, "DELETE FROM storage");
  header("Location: perhitungancf.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Pakar Diagnosa Penyakit Ayam</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Sistem Pakar</span>
    </a>

    <!-- Sidebar -->
    <?php
    include 'template/sidebar.php';
    ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Perhitungan CF </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"> </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
                <div class="form-group">
                  <?php
                  $no = 1;
                  $sql2 = mysqli_query($bukaDatabase, "SELECT * FROM tbldiagnosa ORDER BY nama_gejala ASC");
                  $row = mysqli_fetch_array($sql2);
                  $rows1 = mysqli_num_rows($sql2);
                  ?>
                  <?php
                  if($rows1 == null) {
                    ?>
                    <h5 class="mb-3"> Tambah Gejala Penyakit </h5>
                  <?php } ?>
                  <div class="row">
                    <div class="col-md-8">
                      <?php
                      if($rows1 == null) {
                        ?>
                        <form action="?act=add" method="post">
                          <table id="tblgejala" class="table table-striped table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>Gejala Penyakit</th>
                                <th>Tingkat Keyakinan</th>
                                <th class="text-center">&nbsp;</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr class="tr_clone">
                                <td>
                                  <select name="id_gejala" id="id_gejala" class="form-control">
                                    <?php
                                    $sql = mysqli_query($bukaDatabase, "SELECT * 
                                    FROM tblgejala 
                                    WHERE id_gejala NOT IN (
                                      SELECT id_gejala FROM storage
                                    )
                                    ORDER BY gejala ASC");
                                    while($row = mysqli_fetch_assoc($sql)) {
                                      ?>
                                      <option value="<?php echo $row['id_gejala']; ?>"><?php echo $row['gejala']; ?></option>
                                    <?php } ?>
                                  </select>
                                </td>
                                <td>
                                  <select name="nilai_user" id="nilai_user" class="form-control">
                                    <option value="0.2">Sangat Tidak Yakin</option>
                                    <option value="0.4">Tidak Yakin</option>
                                    <option value="0.6">Yakin</option>
                                    <option value="0.8">Cukup Yakin</option>
                                    <option value="1">Sangat Yakin</option>
                                  </select>
                                </td>
                                <td class="text-center">
                                  <input type="submit" id="btnplus" value="+" class="btn btn-primary">
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </form>
                      <?php } ?>

                      <?php
                      $no = 1;
                      $sql1 = mysqli_query($bukaDatabase, "SELECT 
                      s.id_store,
                      g.gejala,
                      s.nilai_user
                      FROM storage s
                      JOIN tblgejala g ON s.id_gejala = g.id_gejala
                      ORDER BY g.gejala ASC");
                      $rows = mysqli_num_rows($sql1);
                      ?>
                      <?php if($rows > 0) { ?>
                        <hr class="my-4" />
                        <h5 class="mb-3"> Gejala Penyakit </h5>
                        <table class="table table-striped table-bordered table-hover" style="float:left;">
                          <thead>
                            <tr>
                              <td>No</td>
                              <td>Nama Gejala</td>
                              <td>Tingkat Keyakinan</td>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            while($row1 = mysqli_fetch_array($sql1)) {
                              ?>
                              <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row1['gejala']; ?></td>
                                <td>
                                  <?php 
                                    switch($row1['nilai_user']) {
                                      case 0.2:
                                        echo "Sangat Tidak Yakin";
                                        break;
                                      case 0.4:
                                        echo "Tidak Yakin";
                                        break;
                                      case 0.6:
                                        echo "Yakin";
                                        break;
                                      case 0.8:
                                        echo "Cukup Yakin";
                                        break;
                                      case 1:
                                        echo "Sangat Yakin";
                                        break;
                                    } 
                                  ?>
                                </td>
                                <td class="text-center">
                                  <a href="?act=del&id=<?php echo $row1['id_store']; ?>">
                                    <input type="submit" id="btnplus" value="x" class="btn btn-danger">
                                  </a>
                              </td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                        <button id="btnhitung" class="btn btn-primary px-4">Hitung</button>
                      <?php } ?>
                        <hr class="my-4"/>
                        <div id="containerdiagnosa" class="d-none">
                          <h5 class="mb-3">Hasil Diagnosa</h5>
                          <table class="table table-striped table-bordered table-hover" style="float:left;">
                            <thead>
                              <tr>
                                <td>No</td>
                                <td>Nama Penyakit</td>
                                <td>Hasil Kalkulasi CF</td>
                              </tr>
                            </thead>
                            <tbody id="tbldiagnosa">
                            </tbody>
                          </table>
                          <a href="?act=awal"><button id="btnsimpan" type="submit" class="btn btn-outline-primary">Cari Gejala Lain</button></a>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Page specific script -->
<script src="lib/calculate.js"></script>


</body>

</html>
