<?php
include '../database/koneksi.php';

$sql = "SELECT 
p.id_penyakit
, p.penyakit
, g.id_gejala
, g.gejala
, g.nilai_gejala as nilaipakar 
, IFNULL(s.nilai_user, 0) as nilaiuser
FROM tblkategori_gejala kg
JOIN tblpenyakit p ON kg.id_penyakit = p.id_penyakit
JOIN tblgejala g ON kg.id_gejala = g.id_gejala
LEFT JOIN storage s ON g.id_gejala = s.id_gejala
ORDER BY id_penyakit, id_gejala;";

$query = mysqli_query($bukaDatabase, $sql);

$rows = array();
while($r = mysqli_fetch_assoc($query)) {
    $rows[] = $r;
}

header('Content-type: application/json');
echo json_encode($rows);