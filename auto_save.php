<?php  
include 'koneksi.php';
 
if(isset($_POST["judul"]) && isset($_POST["deksripsi"])){
  $judul = mysqli_real_escape_string($db1, $_POST["judul"]);
  $deksripsi = mysqli_real_escape_string($db1, $_POST["deksripsi"]);
  if($_POST["post_id"] != ''){
    $id = $_POST["post_id"];
    $query = "UPDATE tbl_post SET judul=?, deksripsi=? WHERE id=?";
    $dewan1 = $db1->prepare($query);
    $dewan1->bind_param('ssi', $judul, $deksripsi, $id);
    $dewan1->execute();
  } else {
    $query = "INSERT INTO tbl_post(judul, deksripsi, status) VALUES (?, ?, 'draft')";
    $dewan1 = $db1->prepare($query);
    $dewan1->bind_param('ss', $judul, $deksripsi);
    $dewan1->execute();
    echo mysqli_insert_id($db1);  
  }
 }  
 ?>