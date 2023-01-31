 <?php

  // Lampirkan dbconfig 

  require_once "dbconfig.php";

  // Cek status login user 

  if (!$user->isLoggedIn()) {

    header("location: login.php"); //Redirect ke halaman login 

  }

  // Ambil data user saat ini 

  $currentUser = $user->getUser();

  $host       = "localhost";
  $user       = "root";
  $pass       = "";
  $db         = "kipk";

  $koneksi    = mysqli_connect($host, $user, $pass, $db);
  if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
  }
  $nim        = "";
  $nama       = "";
  $no_kipk    = "";
  $fakultas   = "";
  $prodi      = "";
  $angkatan   = "";
  $sukses     = "";
  $error      = "";

  if (isset($_GET['op'])) {
    $op = $_GET['op'];
  } else {
    $op = "";
  }
  if ($op == 'delete') {
    $id         = $_GET['id'];
    $delete       = "delete from penerima where id = '$id'";
    $sql1         = mysqli_query($koneksi, $delete);
    if ($sql1) {
      $sukses = "Berhasil hapus data";
    } else {
      $error  = "Gagal melakukan delete data";
    }
  }
  if ($op == 'edit') {
    $id         = $_GET['id'];
    $select     = "select * from penerima where id = '$id'";
    $sql2       = mysqli_query($koneksi, $select);
    $q1         = mysqli_fetch_array($sql2);
    $nim        = $q1['nim'];
    $nama       = $q1['nama'];
    $no_kipk    = $q1['no_kipk'];
    $fakultas   = $q1['fakultas'];
    $prodi      = $q1['prodi'];
    $angkatan   = $q1['angkatan'];

    if ($nim == '') {
      $error = "Data tidak ditemukan";
    }
  }
  if (isset($_POST['simpan'])) { // create Data
    $nim        = $_POST['nim'];
    $nama       = $_POST['nama'];
    $no_kipk    = $_POST['no_kipk'];
    $fakultas   = $_POST['fakultas'];
    $prodi      = $_POST['prodi'];
    $angkatan   = $_POST['angkatan'];

    if ($nim && $nama && $no_kipk && $fakultas && $prodi && $angkatan) {
      if ($op == 'edit') { // update Data
        $update       = "update penerima set nim = '$nim',nama='$nama',no_kipk = '$no_kipk',fakultas='$fakultas',prodi = $prodi, angkatan = $angkatan where id = '$id'";
        $sql3         = mysqli_query($koneksi, $update);
        if ($sql3) {
          $sukses = "Data berhasil diupdate";
        } else {
          $error  = "Data gagal diupdate";
        }
      } else { // insert Data
        $insert   = "insert into penerima(nim,nama,no_kipk,fakultas,prodi,angkatan) values ('$nim','$nama','$no_kipk','$fakultas','$prodi','$angkatan')";
        $sql4     = mysqli_query($koneksi, $insert);
        if ($sql4) {
          $sukses     = "Berhasil memasukkan data baru";
        } else {
          $error      = "Gagal memasukkan data";
        }
      }
    } else {
      $error = "Silahkan masukkan semua data";
    }
  }
  ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Data Penerima KIP-K Unhas</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
   <link rel="stylesheet" href="assets/styles/style.css" />
 </head>

 <body>
   <div class="container p-2 m-2">
     <h3 class="col-6">Selamat datang <?php echo $currentUser['nama'] ?> <a href="logout.php">
         <button class="btn btn-warning rounded" type="button">Logout</button></a></h3>
   </div>
   <div class="mx-auto">
     <!-- untuk memasukkan data -->
     <div class="card">
       <div class="card-header text-white bg-secondary">
         Create / Edit Data
       </div>
       <div class="card-body">
         <?php
          if ($error) {
          ?>
           <div class="alert alert-danger" role="alert">
             <?php echo $error ?>
           </div>
         <?php
            header("refresh:1;url=index.php"); //1 : detik
          }
          ?>
         <?php
          if ($sukses) {
          ?>
           <div class="alert alert-success" role="alert">
             <?php echo $sukses ?>
           </div>
         <?php
            header("refresh:1;url=index.php");
          }
          ?>
         <form action="" method="POST">
           <div class="mb-3 row">
             <label for="nim" class="col-sm-2 col-form-label">NIM</label>
             <div class="col-sm-10">
               <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $nim ?>">
             </div>
           </div>
           <div class="mb-3 row">
             <label for="nama" class="col-sm-2 col-form-label">Nama</label>
             <div class="col-sm-10">
               <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
             </div>
           </div>
           <div class="mb-3 row">
             <label for="nama" class="col-sm-2 col-form-label">No KIP</label>
             <div class="col-sm-10">
               <input type="text" class="form-control" id="no_kipk" name="no_kipk" value="<?php echo $no_kipk ?>">
             </div>
           </div>
           <div class="mb-3 row">
             <label for="fakultas" class="col-sm-2 col-form-label">Fakultas</label>
             <div class="col-sm-10">
               <select class="form-control" name="fakultas" id="fakultas">
                 <option value="">- Pilih Fakultas -</option>
                 <option value="FMIPA" <?php if ($fakultas == "FMIPA") echo "Selected" ?>>FMIPA</option>
                 <option value="FISIP" <?php if ($fakultas == "FISIP") echo "Selected" ?>>FISIP</option>
                 <option value="FT" <?php if ($fakultas == "FT") echo "Selected" ?>>FT</option>
                 <option value="FH" <?php if ($fakultas == "FH") echo "Selected" ?>>FH</option>
                 <option value="FPET" <?php if ($fakultas == "FPET") echo "Selected" ?>>FPET</option>
                 <option value="FIB" <?php if ($fakultas == "FIB") echo "Selected" ?>>FIB</option>
                 <option value="FEB" <?php if ($fakultas == "FEB") echo "Selected" ?>>FEB</option>
                 <option value="FKG" <?php if ($fakultas == "FKG") echo "Selected" ?>>FKG</option>
                 <option value="FK" <?php if ($fakultas == "FK") echo "Selected" ?>>FK</option>
                 <option value="FKEP" <?php if ($fakultas == "FKEP") echo "Selected" ?>>FKEP</option>
                 <option value="FF" <?php if ($fakultas == "FF") echo "Selected" ?>>FF</option>
                 <option value="FKM" <?php if ($fakultas == "FKM") echo "Selected" ?>>FKM</option>
                 <option value="FHUT" <?php if ($fakultas == "FHUT") echo "Selected" ?>>FHUT</option>
                 <option value="FAPERTA" <?php if ($fakultas == "FAPERTA") echo "Selected" ?>>FAPERTA</option>
                 <option value="FIKP" <?php if ($fakultas == "FIKP") echo "Selected" ?>>FIKP</option>
               </select>
             </div>
           </div>
           <div class="mb-3 row">
             <label for="nama" class="col-sm-2 col-form-label">Prodi</label>
             <div class="col-sm-10">
               <input type="text" class="form-control" id="prodi" name="prodi" value="<?php echo $prodi ?>">
             </div>
           </div>
           <div class="mb-3 row">
             <label for="nama" class="col-sm-2 col-form-label">Angkatan</label>
             <div class="col-sm-10">
               <input type="text" class="form-control" id="angkatan" name="angkatan" value="<?php echo $angkatan ?>">
             </div>
           </div>
           <div class="col-12">
             <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
           </div>
         </form>
       </div>
     </div>

     <!-- untuk mengeluarkan data -->
     <div class="card">
       <div class="card-header text-white bg-secondary">
         Data Penerima KIP-K Unhas
       </div>
       <div class="card-body">
         <table class="table">
           <thead>
             <tr>
               <th scope="col">No</th>
               <th scope="col">NIM</th>
               <th scope="col">Nama</th>
               <th scope="col">No KIP</th>
               <th scope="col">Fakultas</th>
               <th scope="col">Prodi</th>
               <th scope="col">Angkatan</th>
               <th scope="col">Aksi</th>
             </tr>
           </thead>
           <tbody>
             <?php
              $select   = "select * from penerima order by id asc";
              $sql5     = mysqli_query($koneksi, $select);
              $nomor   = 1;
              while ($q2 = mysqli_fetch_array($sql5)) {
                $id         = $q2['id'];
                $nim        = $q2['nim'];
                $nama       = $q2['nama'];
                $no_kipk    = $q2['no_kipk'];
                $fakultas   = $q2['fakultas'];
                $prodi      = $q2['prodi'];
                $angkatan   = $q2['angkatan'];

              ?>
               <tr>
                 <th scope="row"><?php echo $nomor++ ?></th>
                 <td scope="row"><?php echo $nim ?></td>
                 <td scope="row"><?php echo $nama ?></td>
                 <td scope="row"><?php echo $no_kipk ?></td>
                 <td scope="row"><?php echo $fakultas ?></td>
                 <td scope="row"><?php echo $prodi ?></td>
                 <td scope="row"><?php echo $angkatan ?></td>
                 <td scope="row">
                   <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                   <a href="index.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>
                 </td>
               </tr>
             <?php
              }
              ?>
           </tbody>

         </table>
       </div>
     </div>
   </div>
 </body>

 </html>