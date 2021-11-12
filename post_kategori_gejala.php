<?php 
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Max-Age: 1000");
    header("Access-Control-Allow-Header: X-Requested-With, Content-Type, Origin, Chace-Control, Pragma, Authorization, Accept, Accept-Encoding");
    header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");

    if ($_GET['aksi'] == 'tambahkategori') {
        $bukaDb = mysqli_connect('localhost' , 'root' , '' , 'si_pakar');

        $data = json_decode(file_get_contents('php://input'), true);
        $id_penyakit = $data['id_penyakit'];
        $id_gejala = $data['id_gejala'];

        $qInsertKategori = "INSERT INTO tblkategori_gejala(id_penyakit , id_gejala) VALUES('$id_penyakit' , '$id_gejala' ) ";

        $simpan = mysqli_query($bukaDb, $qInsertKategori);
        

        if ( $simpan ) {
            echo json_encode( ['sukses' => 'data berhasil ditambah'] );
        } else {
            echo json_encode( ['gagal' => $qInsertKategori] );

        }
    }

?>