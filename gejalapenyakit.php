<?php 
  session_start();

  include 'database/koneksi.php';
  include 'fungsi.php';
  
  $edit = array();

  $gejala_penyakit = getData("SELECT * FROM tblgejala");

  if ( is_null( $_SESSION['login'] ) ) {
    header("location:login.php");
  }

  if (isset($_GET['logout'])) {
    session_destroy();
    header("location:login.php");
  }

  if(isset($_POST["submit"])){
    tambahGejalaPenyakit($_POST);
  }
  else if(isset($_POST["delete"])){
    $id = isset($_POST["delete"]) ? $_POST["delete"] : 0;
    deleteGejalaPenyakit($id);
  }
  else if(isset($_POST["edit"])){
    $id = isset($_POST["edit"]) ? $_POST["edit"] : 0;
    $edit = getData("SELECT * FROM tblgejala WHERE id_gejala = '$id'");
    $edit = $edit[0];
  }
  else if(isset($_POST["ganti"])){
    editGejalaPenyakit($_POST);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Pakar Diagnosa Penyakit</title>

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
            <h1> Data Gejala Penyakit </h1>
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
              <form action="" method="post">
              <div class="card-footer">
                  <!-- <button href="editpenyakit.php" type="submit" class="btn btn-primary">Edit</button> -->
                  <label for="">List Data Gejala Penyakit</label>
                  
                  <div class="form-group">
                    <span class="label label-info">Nama Gejala Penyakit</span>
                      <input type="text" name="gejala" id="input" class="form-control" value="<?= sizeof($edit) > 0 ? $edit["gejala"] : "" ?>"  required="required" >
                  </div>
                  <div class="form-group">
                    <span class="label label-info">Keterangan Gejala Penyakit</span>
                      <input type="text" name="keterangan" id="" class="form-control" value="<?= sizeof($edit) > 0 ? $edit["keterangan"] : "" ?>" required="required">
                  </div>
                  
                  <div class="form-group">
                    <span class="label label-info">Nilai Gejala Penyakit</span>
                      <input type="text" name="nilai_gejala" id="" class="form-control" value="<?= sizeof($edit) > 0 ? $edit["nilai_gejala"] : "" ?>" required="required">
                  </div>
                  
                <div class="form-group">
                  <button type="submit" name="<?= sizeof($edit) > 0 ? "ganti": "submit" ?>" value=<?= sizeof($edit) > 0 ? $edit["id_gejala"] : 0 ?> class="btn btn-primary" style="float:right">
                  <?= sizeof($edit) > 0 ? "Edit" : "Tambah" ?>
                  </button>
                  </div>
                </div>

              </form>

                <div class="card-body">
                  <div class="form-group">
                  <form action="" method="post">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Nama Gejala Penyakit</th>
                          <th>Keterangan Gejala Penyakit</th>
                          <th>Nilai Gejala Penyakit</th>
                          <th colspan="3" width="20%">
                          <center>
                            Aksi
                          </center></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          foreach ($gejala_penyakit as $key => $value) { ?>
                          <tr>
                            <td><?= $key + 1?>.</td>
                            <td><?= $value["gejala"] ?></td>
                            <td><?= is_null($value["keterangan"]) ? "-" : $value["keterangan"] ?></td>
                            <td><?= $value["nilai_gejala"] ?></td>
                            <td>
                              <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" name="edit" value="<?= $value["id_gejala"] ?>" class="btn btn-warning mr-3">Edit</button>
                                <button type="submit" name="delete" value="<?= $value["id_gejala"] ?>" onclick="return confirm('Apakah Anda Ingin Menghapus Data <?= $value['id_gejala'] ?>');" class="btn btn-danger">Delete</button>
                              </div>
                            </td>
                          </tr>                        
                        <?php  }
                        ?>
                      </tbody>
                    </table>
                  </form>
                  </div>
                </div>
                  
                  
                </div>
                <!-- /.card-body -->

                
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
<!-- Page specific script -->

<script>
   $(function () {
     $('#tblgejala tbody tr #btnright').on('click', function (e) {
        e.preventDefault();
        
         var $item = $(this).closest("tr")   // Finds the closest row <tr> 
                            .find(".nr")     // Gets a descendent with class="nr"
                           .text(); 
         console.log($item);  
         let isi_list = `
           <li class="list-group-item"> ${$item} </li>
         `;
         $('#list_tujuan').append( isi_list );
     });  
     
   }); 
</script>

</body>
</html>
