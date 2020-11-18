<?php
include 'conf.php';
$id = $_GET["id"];
//mengambil id yang ingin dihapus

    //jalankan query DELETE untuk menghapus data
    $query = "DELETE FROM jualbeli WHERE id='$id' ";
    $hasil_query = mysqli_query($db, $query);

    //periksa query, apakah ada kesalahan
    if(!$hasil_query) {
      die ("Gagal menghapus data: ".mysqli_errno($db).
       " - ".mysqli_error($db));
    } else {
      echo "<script>alert('Data berhasil dihapus.');window.location='index.php';</script>";
    }