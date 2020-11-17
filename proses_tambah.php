<?php
// memanggil file d$db.php untuk melakukan d$db database
include 'conf.php';

	// membuat variabel untuk menampung data dari form
  $nama_produk          = $_POST['nama_produk'];
  $deskripsi_produk     = $_POST['deskripsi_produk'];
  $beli_produk          = $_POST['beli_produk'];
  $jual_produk          = $_POST['jual_produk'];
  $gambar_produk        = $_FILES['gambar_produk']['name'];


//cek dulu jika ada gambar produk jalankan coding ini
if($gambar_produk != "") {
  $ekstensi_diperbolehkan = array('png','jpg'); //ekstensi file gambar yang bisa diupload 
  $file_img = $_FILES['gambar_produk']['name'];
  $x = explode('.', $file_img); //memisahkan nama file dengan ekstensi yang diupload
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['gambar_produk']['tmp_name'];  
  $tempat_simpan = "gambar/";
  $simpan_gambar = $tempat_simpan.$file_img;
  // $angka_acak     = rand(1,999);
  // $nama_gambar_baru = $angka_acak.'-'.$gambar_produk; //menggabungkan angka acak dengan nama file sebenarnya
  if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {     
    // move_uploaded_file($file_tmp, 'gambar/'.$gambar_produk); //memindah file gambar ke folder gambar
      // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
      $pindah_gambar = move_uploaded_file($file_tmp, $simpan_gambar);
      $query = "INSERT INTO jualbeli (nama_produk, deskripsi_produk, beli_produk, jual_produk, gambar_produk) VALUES ('$nama_produk', '$deskripsi_produk', '$beli_produk', '$jual_produk', '$file_img')";
      $result = mysqli_query($db, $query);
      // periska query apakah ada error
      if(!$result){
          die ("Query gagal dijalankan: ".mysqli_errno($db).
               " - ".mysqli_error($db));
      } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju
        echo "<script>alert('Data berhasil ditambah.');window.location='index.php';</script>";
      }

} else {     
 //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
    echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tambah_produk.php';</script>";
}
} else {
$query = "INSERT INTO jualbeli (nama_produk, deskripsi_produk, beli_produk, jual_produk, gambar_produk) VALUES ('$nama_produk', '$deskripsi_produk', '$beli_produk', '$jual_produk', '$gambar_produk',null)";
      $result = mysqli_query($db, $query);
      // periska query apakah ada error
      if(!$result){
          die ("Query gagal dijalankan: ".mysqli_errno($db).
               " - ".mysqli_error($db));
      } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju
        echo "<script>alert('Data berhasil ditambah.');window.location='index.php';</script>";
      }
}