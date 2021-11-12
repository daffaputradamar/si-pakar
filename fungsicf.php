<?php 
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Max-Age: 1000");
    header("Access-Control-Allow-Header: X-Requested-With, Content-Type, Origin, Chace-Control, Pragma, Authorization, Accept, Accept-Encoding");
    header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");

    function getGejala()
    {
        $bukaDatabase = mysqli_connect('localhost' , 'root' , '' , 'si_pakar');
        $qBukaGejala = "SELECT * FROM tblgejala ORDER BY gejala ASC";

        $buka = mysqli_query($bukaDatabase, $qBukaGejala);

        $data = [];
        $nomor = 0;

        while ($row = mysqli_fetch_assoc($buka) ) {
            $data[$nomor]['id_gejala'] = $row['id_gejala'];
            $data[$nomor]['gejala'] = $row['gejala'];
            $data[$nomor]['cfpakar'] = $row['cfpakar'];
            $nomor++;
        }

        echo json_encode($data);
    }

    if (isset($_GET['aksi'] ) == 'getGejala' ) {
        getGejala();
    }

?>