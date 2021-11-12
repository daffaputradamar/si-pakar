<?php
include 'database/koneksi.php';

# PENYAKIT
function getData($query){
    global $bukaDatabase;
    $exec = mysqli_query($bukaDatabase,$query);
    $row = mysqli_fetch_all($exec , MYSQLI_ASSOC);
    $arr = array();
    if(sizeof($row) > 0){
        $arr = $row;
    }
    return $arr;
}

function deletePenyakit($id){
    global $bukaDatabase;
    $query = "DELETE FROM `tblpenyakit` WHERE `id_penyakit` = '$id'";
    $exec = mysqli_query($bukaDatabase,$query);
    if($exec){
        echo '<script>alert("Data Penyakit Berhasil Dihapus")</script>';
    }
    else{
        echo '<script>alert("Data Penyakit Gagal Dihapus")</script>';
    }
    echo '<script>window.location="datapenyakit.php";</script>';
}

function editPenyakit($data){

    global $bukaDatabase;
    $id = isset($data["ganti"]) ? $data["ganti"] : 0;
    $penyakit = isset($data["penyakit"]) ? $data["penyakit"] : NULL;
    $keterangan = isset($data["keterangan"]) ? $data["keterangan"] : NULL;

    $query = "UPDATE `tblpenyakit` SET `penyakit`='$penyakit',`keterangan`='$keterangan' WHERE `id_penyakit` = '$id'";
    
    $exec = mysqli_query($bukaDatabase,$query);
    if($exec){
        echo '<script>alert("Data Penyakit Berhasil Diubah")</script>';
    }
    else{
        echo '<script>alert("Data Penyakit Gagal Diubah")</script>';
    }
    echo '<script>window.location="datapenyakit.php";</script>';
}

function tambahPenyakit($data){
    global $bukaDatabase;

    $penyakit = isset($data["penyakit"]) ? $data["penyakit"] : NULL;
    $keterangan = isset($data["keterangan"]) ? $data["keterangan"] : NULL;
    $query = "INSERT INTO `tblpenyakit`(`penyakit`, `keterangan`) VALUES ('$penyakit','$keterangan')";
    $exec = mysqli_query($bukaDatabase,$query);
    if($exec){
        echo '<script>alert("Data Penyakit Berhasil Ditambah")</script>';
    }
    else{
        echo '<script>alert("Data Penyakit Gagal Ditambah")</script>';
    }
    echo '<script>window.location="datapenyakit.php";</script>';
}

# GEJALA
function deleteGejalaPenyakit($id){
    global $bukaDatabase;
    $query = "DELETE FROM `tblgejala` WHERE `id_gejala` = '$id'";
    $exec = mysqli_query($bukaDatabase,$query);
    if($exec){
        echo '<script>alert("Data Gejala Penyakit Berhasil Dihapus")</script>';
    }
    else{
        echo '<script>alert("Data Gejala Penyakit Gagal Dihapus")</script>';
    }
    echo '<script>window.location="gejalapenyakit.php";</script>';
}

function editGejalaPenyakit($data){
    global $bukaDatabase;
    $id = isset($data["ganti"]) ? $data["ganti"] : 0;
    $gejala = isset($data["gejala"]) ? $data["gejala"] : NULL;
    $keterangan = isset($data["keterangan"]) ? $data["keterangan"] : NULL;
    $nilai_gejala = isset($data["nilai_gejala"]) ? $data["nilai_gejala"] : NULL;
    $nilai_gejala = doubleval($nilai_gejala);

    $query = "UPDATE `tblgejala` SET `gejala`='$gejala',`keterangan`='$keterangan', `nilai_gejala`='$nilai_gejala' WHERE `id_gejala` = '$id'";
    
    $exec = mysqli_query($bukaDatabase,$query);
    if($exec){
        echo '<script>alert("Data Gejala Penyakit Berhasil Diubah")</script>';
    }
    else{
        echo '<script>alert("Data Gejala Penyakit Gagal Diubah")</script>';
    }
    echo '<script>window.location="gejalapenyakit.php";</script>';
}

function tambahGejalaPenyakit($data){
    global $bukaDatabase;

    $gejala = isset($data["gejala"]) ? $data["gejala"] : NULL;
    $keterangan = isset($data["keterangan"]) ? $data["keterangan"] : NULL;
    $nilai_gejala = isset($data["nilai_gejala"]) ? $data["nilai_gejala"] : NULL;
    $nilai_gejala = doubleval($nilai_gejala);

    $query = "INSERT INTO `tblgejala`(`gejala`, `keterangan`,`nilai_gejala`) VALUES ('$gejala','$keterangan','$nilai_gejala')";
    $exec = mysqli_query($bukaDatabase,$query);
    if($exec){
        echo '<script>alert("Data Gejala Penyakit Berhasil Ditambah")</script>';
    }
    else{
        echo '<script>alert("Data Gejala Penyakit Gagal Ditambah")</script>';
    }
    echo '<script>window.location="gejalapenyakit.php";</script>';
}

# Kategori Gejala
function tambahKategoriGejala($data){
    global $bukaDatabase;

    $id_gejala = isset($data["id_gejala"]) ? $data["id_gejala"] : NULL;
    $id_penyakit = isset($data["id_penyakit"]) ? $data["id_penyakit"] : NULL;

    $query = "INSERT INTO `tblkategori_gejala`(`id_penyakit`, `id_gejala`) VALUES ($id_penyakit, $id_gejala)";
    $exec = mysqli_query($bukaDatabase,$query);
    if($exec){
        echo '<script>alert("Data Kategori Gejala Berhasil Ditambah")</script>';
    }
    else{
        echo '<script>alert("Data Kategori Gejala Gagal Ditambah")</script>';
    }
    header("Location: /kategorigejala.php?id_penyakit=$id_penyakit");
}

function deleteKategoriGejala($id_katgejala, $id_penyakit){
    global $bukaDatabase;
    $query = "DELETE FROM `tblkategori_gejala` WHERE `id_katgejala` = '$id_katgejala'";
    $exec = mysqli_query($bukaDatabase,$query);
    if($exec){
        echo '<script>alert("Data Kategori Gejala Berhasil Dihapus")</script>';
    }
    else{
        echo '<script>alert("Data Kategori Gejala Gagal Dihapus")</script>';
    }
    header("Location: /kategorigejala.php?id_penyakit=$id_penyakit");
}