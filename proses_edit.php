<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include 'conf.php';

	// membuat variabel untuk menampung data dari form
  $id = $_POST['id'];
  $nama_produk          = $_POST['nama_produk'];
  $deskripsi_produk     = $_POST['deskripsi_produk'];
  $beli_produk          = $_POST['beli_produk'];
  $jual_produk          = $_POST['jual_produk'];
  $gambar_produk        = $_FILES['gambar_produk']['name'];
  //cek dulu jika merubah gambar produk jalankan coding ini
  if($gambar_produk != "") {
    $ekstensi_diperbolehkan = array('png','jpg'); //ekstensi file gambar yang bisa diupload 
    $x = explode('.', $gambar_produk); //memisahkan nama file dengan ekstensi yang diupload
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar_produk']['tmp_name'];   
    $angka_acak     = rand(1,999);
    $nama_gambar_baru = $angka_acak.'-'.$gambar_produk; //menggabungkan angka acak dengan nama file sebenarnya
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {
                  move_uploaded_file($file_tmp, 'gambar/'.$nama_gambar_baru); //memindah file gambar ke folder gambar
                      
                    // jalankan query UPDATE berdasarkan ID yang produknya kita edit
                   $query  = "UPDATE jualbeli SET nama_produk = '$nama_produk', deskripsi_produk = '$deskripsi_produk', beli_produk = '$beli_produk', jual_produk = '$jual_produk', gambar_produk = '$nama_gambar_baru'";
                    $query .= "WHERE id = '$id'";
                    $result = mysqli_query($db, $query);
                    // periska query apakah ada error
                    if(!$result){
                        die ("Query gagal dijalankan: ".mysqli_errno($db).
                             " - ".mysqli_error($db));
                    } else {
                      //tampil alert dan akan redirect ke halaman index.php
                      //silahkan ganti index.php sesuai halaman yang akan dituju
                      echo "<script>alert('Data berhasil diubah.');window.location='index.php';</script>";
                    }
              } else {     
               //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                  echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tambah_produk.php';</script>";
              }
            } else {
                // jalankan query UPDATE berdasarkan ID yang produknya kita edit
                $query  = "UPDATE jualbeli SET nama_produk = '$nama_produk', deskripsi_produk = '$deskripsi_produk', beli_produk = '$beli_produk', jual_produk = '$jual_produk'";
                $query .= "WHERE id = '$id'";
                $result = mysqli_query($db, $query);
                // periska query apakah ada error
                if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($db).
                                       " - ".mysqli_error($db));
                } else {
                  //tampil alert dan akan redirect ke halaman index.php
                  //silahkan ganti index.php sesuai halaman yang akan dituju
                    echo "<script>alert('Data berhasil diubah.');window.location='index.php';</script>";
                }
              }
          