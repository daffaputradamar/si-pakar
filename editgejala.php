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


	<div class="container" style="margin-top:20px">
		<center><font size="6">Edit Data</font></center>

		<hr>

		<?php
		//jika sudah mendapatkan parameter GET id dari URL
		if(isset($_GET['id_gejala'])){
			//membuat variabel $id untuk menyimpan id dari GET id di URL
			$qBukaGejala = $_GET['id_gejala'];

			//query ke database SELECT tabel gejala berdasarkan id = $id
			$select = mysqli_query($koneksi, "SELECT * FROM tblgejala WHERE id_gejala='$id_gejala'") or die(mysqli_error($koneksi));

			//jika hasil query = 0 maka muncul pesan error
			if(mysqli_num_rows($select) == 0){
				echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
				exit();
			//jika hasil query > 0
			}else{
				//membuat variabel $data dan menyimpan data row dari query
				$data = mysqli_fetch_assoc($select);
			}
		}
		?>

		<?php
		//jika tombol simpan di tekan/klik
		if(isset($_POST['submit'])){
			$gejala    	= $_POST['gejala'];

			$sql = mysqli_query($koneksi, "UPDATE tblgejala SET gejala='$gejala' WHERE id_gejala='$id_gejala'") or die(mysqli_error($koneksi));

			if($sql){
				echo '<script>alert("Berhasil menyimpan data."); document.location="dashboard.php?page=gejalapenyakit";</script>';
			}else{
				echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
			}
		}
		?>

		<form action="dashboard.php?page=editgejala&id_gejala=<?php echo $id_gejala; ?>" method="post">
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">ID</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="id_gejala" class="form-control" size="4" value="<?php echo $data['id_gejala']; ?>" readonly required>
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align">Nama Gejala</label>
				<div class="col-md-6 col-sm-6">
					<input type="text" name="gejala" class="form-control" value="<?php echo $data['ngejala']; ?>" required>
				</div>
			</div>
           
			
			
			<div class="item form-group">
				<div class="col-md-6 col-sm-6 offset-md-3">
					<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
					<a href="dashboard.php?page=gejalapenyakit" class="btn btn-warning">Kembali</a>
				</div>
			</div>
		</form>
	</div>
