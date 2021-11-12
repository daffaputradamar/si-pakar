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
                    <label for="exampleInputPassword1"> Gejala Penyakit </label>
                    <div class="row">
                      <div class="col-md-7">
                          <form action="?act=add" method="post">
                        <table id="tblgejala" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td>Gejala Penyakit</td>
                                    <td>CF User</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="tr_clone">
                                    <td>
                                        <select name="nama_gejala" id="nama_gejala" class="form-control">
                                            <?php
                                            $sql = mysqli_query($bukaDatabase, "SELECT * FROM tblgejala ORDER BY gejala ASC");
                                            while($row = mysqli_fetch_assoc($sql)) {
                                            ?>
                                            <option value="<?php echo $row['gejala']; ?>"><?php echo $row['gejala']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="cf_user" id="cf_user" class="form-control">
                                            <option value="0.2">Sangat Tidak Yakin</option>
                                            <option value="0.4">Tidak Yakin</option>
                                            <option value="0.6">Yakin</option>
                                            <option value="0.8">Cukup Yakin</option>
                                            <option value="1">Sangat Yakin</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="submit" id="btnplus" value="+" class="btn btn-primary">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </form>
                        <?php
                            $no = 1;
                            $sql1 = mysqli_query($bukaDatabase, "SELECT * FROM storage ORDER BY nama_gejala ASC");
                            $rows = mysqli_num_rows($sql1);
                        ?>
                        <?php if($rows > 0) { ?>
                        <table class="table table-striped table-bordered table-hover" style="float:left;">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Nama Gejala</td>
                                    <td>CF User</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while($row1 = mysqli_fetch_array($sql1)) {
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row1['nama_gejala']; ?></td>
                                    <td><?php echo $row1['cf_user']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php } ?>
                        </div>
                        <div class="col-md-5">   
                         <ul id="list_tujuan" class="list-group">
                            
                         </ul>         
                        </div>
                    </div>
                  </div>
                  
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button id="btnsimpan" type="submit" class="btn btn-primary">Simpan</button>
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

</body>

<?php 
    if($_GET['act'] == "add") {
        $namaGejala = $_POST['nama_gejala'];
        $cfUser = $_POST['cf_user'];

        $sqlSel = mysqli_query($bukaDatabase, "SELECT cfpakar FROM tblgejala WHERE gejala = '$namaGejala'");
        $selQuery = mysqli_fetch_array($sqlSel);

        if ($cfUser == "0.2") {
            $text = "Sangat Tidak Yakin";
        } else if ($cfUser == "0.4") {
            $text = "Tidak Yakin";
        } else if ($cfUser == "0.6") {
            $text = "Yakin";
        } else if ($cfUser == "0.8") {
            $text = "Cukup Yakin";
        } else if ($cfUser == "1") {
            $text = "Sangat Yakin";
        }

        $sqlIn = mysqli_query($bukaDatabase, 'INSERT INTO storage (nama_gejala, cf_user, nilai_gejala, nilai_cfuser) VALUES ("'.$namaGejala.'", "'.$text.'", "'.$selQuery['cfpakar'].'", "'.$cfUser.'")');
        echo "<script>window.location.href = 'perhitungancf1.php'</script>";
    } 
?>

</html>