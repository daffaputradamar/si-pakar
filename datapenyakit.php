<?php 
  session_start();

  include 'database/koneksi.php';
  include 'fungsi.php';
  
  $edit = array();

  $penyakit = getData("SELECT * FROM tblpenyakit");

  if ( is_null( $_SESSION['login'] ) ) {
    header("location:login.php");
  }

  if (isset($_GET['logout'])) {
    session_destroy();
    header("location:login.php");
  }

  if(isset($_POST["submit"])){
    tambahPenyakit($_POST);
  }
  else if(isset($_POST["delete"])){
    $id = isset($_POST["delete"]) ? $_POST["delete"] : 0;
    deletePenyakit($id);
  }
  else if(isset($_POST["edit"])){
    $id = isset($_POST["edit"]) ? $_POST["edit"] : 0;
    $edit = getData("SELECT * FROM tblpenyakit WHERE id_penyakit = '$id'");
    $edit = $edit[0];
  }
  else if(isset($_POST["ganti"])){
    editPenyakit($_POST);
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
            <h1> Data Penyakit </h1>
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
                  <label for="">List Data Penyakit</label>
                  
                  <div class="form-group">
                    <span class="label label-info">Nama Penyakit</span>
                      <input type="text" name="penyakit" id="input" class="form-control" value="<?= sizeof($edit) > 0 ? $edit["penyakit"] : "" ?>"  required="required" >
                  </div>
                  <div class="form-group">
                    <span class="label label-info">Keterangan Penyakit</span>
                      <input type="text" name="keterangan" id="" class="form-control" value="<?= sizeof($edit) > 0 ? $edit["keterangan"] : "" ?>" required="required">
                  </div>
                  
                <div class="form-group">
                  <button type="submit" name="<?= sizeof($edit) > 0 ? "ganti": "submit" ?>" value=<?= sizeof($edit) > 0 ? $edit["id_penyakit"] : 0 ?> class="btn btn-primary" style="float:right">
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
                          <th>Nama Penyakit</th>
                          <th>Keterangan Penyakit</th>
                          <th colspan="3" width="20%">
                          <center>
                            Aksi
                          </center></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          foreach ($penyakit as $key => $value) { ?>
                          <tr>
                            <td><?= $key + 1?>.</td>
                            <td><?= $value["penyakit"] ?></td>
                            <td><?= is_null($value["keterangan"]) ? "-" : $value["keterangan"] ?></td>
                            <td>
                                <td>
                                  <button type="submit" name="edit" value="<?= $value["id_penyakit"] ?>" class="btn btn-primary">Edit</button>
                                </td>
                                <td>                
                                  <button type="submit" name="delete" value="<?= $value["id_penyakit"] ?>" onclick="return confirm('Apakah Anda Ingin Menghapus Data <?= $value['id_penyakit'] ?>');" class="btn btn-primary">Delete</button>
                                </td>
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
