<?php 
  session_start();

  include 'database/koneksi.php';
  include 'fungsi.php';

  if ( is_null( $_SESSION['login'] ) ) {
    header("location:login.php");
  }

  if (isset($_GET['logout'])) {
    session_destroy();
    header("location:login.php");
  }

  $id_penyakit = NULL;
  if (isset($_GET['id_penyakit'])) {
    $id_penyakit = $_GET['id_penyakit'];

    if (isset($_GET['id_katgejala'])) {
      $id_katgejala = $_GET['id_katgejala'];
      deleteKategoriGejala($id_katgejala, $id_penyakit);
    }

    if (isset($_GET['id_gejala'])) {
      $id_katgejala = $_GET['id_gejala'];
      tambahKategoriGejala($_GET);
    }
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
            <h1> Tambah Kategori Gejala </h1>
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
              <form>
                <div class="card-body">
                <form action="">
                  <div class="form-group">
                    <label> Nama Penyakit: </label>
                    <select id="id_penyakit" name="id_penyakit" class="form-control">
                      <option disabled <?= (is_null($id_penyakit))? "selected" : "";  ?>>Pilih Jenis Penyakit</option>
                      <?php 
                        $qBukaPenyakit = "SELECT * FROM tblpenyakit order by penyakit ASC";

                        $bukaTabel = mysqli_query($bukaDatabase , $qBukaPenyakit);

                        while ($row = mysqli_fetch_assoc($bukaTabel) ) {
                      ?>
                           <option value="<?php echo $row['id_penyakit']; ?>" <?= (!is_null($id_penyakit) && $id_penyakit == $row['id_penyakit']) ? "selected" : "";  ?>> <?php echo $row['penyakit']; ?> </option> 
                      <?php
                        }
                      ?>  
                       
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary px-4">Lihat</button>
                </form>
                  <?php
                    if (!is_null($id_penyakit)):
                  ?>
                  <div class="form-group mt-3">
                    <label for="exampleInputPassword1"> Gejala Penyakit </label>
                    <div class="row">
                      <div class="col-md-7">
                        <table id="tblgejala" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td> ID Gejala </td>
                                    <td> Gejala Penyakit </td>
                                    <td class="text-center"> Action </td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $qBukaGejala = "SELECT 
                                kg.id_katgejala
                                , g.id_gejala
                                , g.gejala
                                FROM tblkategori_gejala kg
                                JOIN tblpenyakit p ON kg.id_penyakit = p.id_penyakit
                                JOIN tblgejala g ON kg.id_gejala = g.id_gejala
                                WHERE kg.id_penyakit = $id_penyakit
                                ORDER BY id_gejala ASC";
                                $buka = mysqli_query($bukaDatabase , $qBukaGejala );

                                while ( $row = mysqli_fetch_assoc($buka) ) {
                                ?>
                                    <tr>
                                        <td class='id_gejala'> <?= $row['id_gejala']; ?> </td>
                                        <td class="nr"> <?= $row['gejala']; ?> </td>
                                        <td class="text-center">
                                            <a class="btn btn-danger" href="?id_penyakit=<?= $id_penyakit ?>&id_katgejala=<?= $row['id_katgejala']; ?>">Delete</a>  
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>  
                            </tbody>
                        </table>  
                        </div>
                        <div class="col-md-5">   
                         <ul id="list_tujuan" class="list-group">
                            
                         </ul>         
                        </div>
                    </div>
                  </div>
                  <h5 class="mt-5">Tambah Gejala</h5>
                  <hr/>
                  <form action="">
                    <div class="form-group">
                      <input type="hidden" name="id_penyakit" value=<?= $id_penyakit ?>>
                      <label> Nama Gejala: </label>
                      <select id="id_gejala" name="id_gejala" class="form-control">
                        <option disabled selected>Pilih Gejala</option>
                        <?php 
                          $qBukaPenyakit = "SELECT * 
                          FROM tblgejala 
                          WHERE id_gejala NOT IN (
                            SELECT id_gejala FROM tblkategori_gejala WHERE id_penyakit = $id_penyakit
                          ) ORDER BY gejala";

                          $bukaTabel = mysqli_query($bukaDatabase , $qBukaPenyakit);

                          while ($row = mysqli_fetch_assoc($bukaTabel) ) {
                        ?>
                            <option value="<?php echo $row['id_gejala']; ?>" > <?php echo $row['gejala']; ?> </option> 
                        <?php
                          }
                        ?>  
                        
                      </select>
                    </div>
                    <button type="submit" class="btn btn-primary px-4">Tambah</button>
                  </form>
                  <?php endif; ?> 
                </div>
                <!-- /.card-body -->
              </form>
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

<script>
   $(function () {
     let arrkategori = [];
     let id_penyakit = '';
     let id_gejala = '';
     let gejala_penyakit = '';

     $('#id_penyakit').change(function (e) {
       e.preventDefault();
       id_penyakit = this.value;
     })


     $('#btnsimpan').click(function (e) {
       e.preventDefault();

       const url = 'http://localhost/sipakar/post_kategori_gejala.php?aksi=tambahkategori';

       arrkategori.forEach(el => {
         
        fetch(url,{
          method: 'POST',
          headers: {
            'Accept': 'applicaion/json',
            'Content-Type': 'applicaion/json'
          },
          body: JSON.stringify({
            id_penyakit : $.trim(el.id_penyakit),
            id_gejala: $.trim(el.id_gejala)
          })
        })
        .then(data => data.json() )
        .then(response => {
            console.log(response)
        })
        .catch(err => {
            console.log(err)
        })

       });

       swal("Good job!", "Data Berhail Disimpan", "success");
       
     });

     $('#tblgejala tbody tr #btnright').on('click', function (e) {
        e.preventDefault();
        id_penyakit = $('#id_penyakit').val();
        
        gejala_penyakit = $(this).closest("tr")   // Finds the closest row <tr> 
                            .find(".nr")     // Gets a descendent with class="nr"
                           .text();
        id_gejala = $(this).closest("tr")
                        .find(".id_gejala")
                        .text();
                        
        arrkategori.push( {id_penyakit : $.trim(id_penyakit), id_gejala : $.trim(id_gejala), gejala_penyakit : $.trim(gejala_penyakit) } );

        //  console.log($id_penyakit);  
        //  console.log(id_gejala);

        // buat pengecekan apakah gejala penyakit sudah ditambahkan
        // var valueArr = arrkategori.map(function(item) { return item.id_gejala });
        // var isDuplicate = valueArr.some(function(item, idx){
        //   return valueArr.indexOf(item) != id_gejala
        // });

        // console.log(isDuplicate);
        // if (isDuplicate == true) {
        //   console.log('data sudah ada');
        // } else {
          // arrkategori.push( {id_penyakit : $.trim(id_penyakit), id_gejala : $.trim(id_gejala), gejala_penyakit : $.trim(gejala_penyakit) } );
        // } 
        
        console.log(arrkategori);
          
         let isi_list = `
           <li class="list-group-item"> ${gejala_penyakit} </li>
         `;
         $('#list_tujuan').append( isi_list );
     });  
     
   }); 
</script>

</body>
</html>
