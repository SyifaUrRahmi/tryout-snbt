<?php
      require_once "dbconfig.php";
			// Cek status login user 
			if (!$user->isLoggedIn()) {
			header("location: login.php"); //Redirect ke halaman login 
  		}
  		$currentUser = $user->getUser();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>SNBT | HASIL</title>
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
			crossorigin="anonymous"
		/>
    <link rel="stylesheet" href="assets/styles/style.css" />
	</head>
	<body>
		<?php
            include "koneksi.php";
            	$score1   = 0;
						  $score2   = 0;
						  $score3   = 0;
						  $score4   = 0;
						  $score5   = 0;
						  $score6   = 0;
						  $score7   = 0;
						  $score8   = 0;
						  $score9   = 0;
						  $benar1   = 0;
						  $benar2   = 0;
						  $benar3   = 0;
						  $benar4   = 0;
						  $benar5   = 0;
						  $benar6   = 0;
						  $benar7   = 0;
						  $benar8   = 0;
						  $benar9   = 0;
						  $salah    = 0;
						  $hasil    = 0;
						  $error = "";
						  $sukses = "";
                  if(isset($_POST['next'])){
                    if(empty($_POST['pilihan'])){
                  ?>
                      <script language="JavaScript">
                          alert('Oops! Serius. Anda tidak mengerjakan soal apapun ...');
                          document.location='./';
                      </script>
                  <?php
                  }

                  $pilihan    =$_POST["pilihan"];
                  $id_soal    =$_POST["id"];
                  $jumlah     =$_POST["jumlah"];

                  for($i=0;$i<$jumlah;$i++){
                      $nomor    =$id_soal[$i];
                      
                      // jika peserta tidak memilih jawaban
                      if(empty($pilihan[$nomor])){
                          $salah++;
                      }
                      // jika memilih
                      else {
                          $jawaban  = $pilihan[$nomor];
                          // cocokan kunci jawaban dengan database
                          $query1  = mysqli_query($koneksi, "SELECT * FROM pengetahuan_kuantitatif WHERE id='$nomor' AND jawaban='$jawaban' and bobot=10");
                          $cek1    =mysqli_num_rows($query1);
                          // bobot 10
                          if($cek1){
                            $benar1++;
                          }
                          else {
                              $salah++;
                          }

                          $query2  = mysqli_query($koneksi, "SELECT * FROM pengetahuan_kuantitatif WHERE id='$nomor' AND jawaban='$jawaban' and bobot=20");
                          $cek2    =mysqli_num_rows($query2);
                          
                          // bobot 20
                          if($cek2){
                            $benar2++;
                          }
                          else {
                              $salah++;
                          }

                          $query3  = mysqli_query($koneksi, "SELECT * FROM pengetahuan_kuantitatif WHERE id='$nomor' AND jawaban='$jawaban' and bobot=25");
                          $cek3    =mysqli_num_rows($query3);
                          
                          // bobot 25
                          if($cek3){
                            $benar3++;
                          }
                          else {
                              $salah++;
                          }

                          $query4  = mysqli_query($koneksi, "SELECT * FROM pengetahuan_kuantitatif WHERE id='$nomor' AND jawaban='$jawaban' and bobot=30");
                          $cek4    =mysqli_num_rows($query4);
                          
                          // bobot 30
                          if($cek4){
                            $benar4++;
                          }
                          else {
                              $salah++;
                          }

                          $query5  = mysqli_query($koneksi, "SELECT * FROM pengetahuan_kuantitatif WHERE id='$nomor' AND jawaban='$jawaban' and bobot=40");
                          $cek5    =mysqli_num_rows($query5);
                          
                          // bobot 40
                          if($cek5){
                            $benar5++;
                          }
                          else {
                              $salah++;
                          }

                          $query6  = mysqli_query($koneksi, "SELECT * FROM pengetahuan_kuantitatif WHERE id='$nomor' AND jawaban='$jawaban' and bobot=50");
                          $cek6    =mysqli_num_rows($query6);
                          
                          // bobot 50
                          if($cek6){
                            $benar6++;
                          }
                          else {
                              $salah++;
                          }

                          $query7  = mysqli_query($koneksi, "SELECT * FROM pengetahuan_kuantitatif WHERE id='$nomor' AND jawaban='$jawaban' and bobot=60");
                          $cek7    =mysqli_num_rows($query7);
                          
                          // bobot 60
                          if($cek7){
                            $benar7++;
                          }
                          else {
                              $salah++;
                          }

                          $query8  = mysqli_query($koneksi, "SELECT * FROM pengetahuan_kuantitatif WHERE id='$nomor' AND jawaban='$jawaban' and bobot=70");
                          $cek8    =mysqli_num_rows($query8);
                          // bobot 70
                          if($cek8){
                            $benar8++;
                          }
                          else {
                              $salah++;
                          }

                          $query9  = mysqli_query($koneksi, "SELECT * FROM pengetahuan_kuantitatif WHERE id='$nomor' AND jawaban='$jawaban' and bobot=80");
                          $cek9    =mysqli_num_rows($query9);
                          
                          // bobot 80
                          if($cek9){
                            $benar9++;
                          }
                          else {
                              $salah++;
                          }
                      }
                      $score1 = $benar1 * 10; 
                      $score2 = $benar2 * 20; 
                      $score3 = $benar3 * 25;
                      $score4 = $benar4 * 30;
                      $score5 = $benar5 * 40;
                      $score6 = $benar6 * 50;
                      $score7 = $benar7 * 60;
                      $score8 = $benar8 * 70;
                      $score9 = $benar9 * 80;
                      $hasil = $score1 + $score2 + $score3 + $score4 + $score5 + $score6 + $score7 + $score8 + $score9; 

                      $id = $currentUser['id'];
                      $update = "update user set pengetahuan_kuantitatif = '$hasil' where id = '$id'";
                      $sql    = mysqli_query($koneksi, $update);

                      

                      // if ($sql) {
                      //   $sukses = "Data berhasil diupdate";
                      //   } else {
                      //   $error  = "Data gagal diupdate";
                      // }
                    
                  }
              }
						$id = $currentUser['id'];
						
						$query = mysqli_query($koneksi, "SELECT * FROM user where id='$id'");
						$data = mysqli_fetch_array($query);
      ?>	
			<div align="center">
		  <!-- <div
			class="position-absolute top-50 start-50 translate-middle bg-dark rounded text-light p-3"
		  > -->
      <div
			class="col-md-6 col-lg-4 bg-dark rounded text-light p-3 mx-5 mt-5 mb-3"
		  >
      <p>Hasil Tryout UTBK-SNBT</p>
			<p>Nama : <?php echo $data['nama'] ?></p>
			<table class="table text-light">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Subtest</th>
						<th scope="col">Score</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row">1</th>
						<td>Kemampuan Penalaran Umum</td>
						<td><?php echo $data['penalaran_umum'] ?></td>
					</tr>
					<tr>
						<th scope="row">2</th>
						<td>Pengetahuan & Pemahaman Umum</td>
						<td><?php echo $data['pengetahuan_pemahaman'] ?></td>
					</tr>
					<tr>
						<th scope="row">3</th>
						<td>Kemampuan Memahami Bacaan & Menulis</td>
						<td><?php echo $data['memahami_bacaan_menulis'] ?></td>
					</tr>
					<tr>
						<th scope="row">4</th>
						<td>Pengetahuan Kuantitatif</td>
						<td><?php echo $data['pengetahuan_kuantitatif'] ?></td>
					</tr>
					<tr>
						<th scope="row">5</th>
						<td>Literasi dalam Bahasa Indonesia</td>
						<td><?php echo $data['literasi_indonesia'] ?></td>
					</tr>
					<tr>
						<th scope="row">6</th>
						<td>Literasi dalam Bahasa Inggris</td>
						<td><?php echo $data['literasi_inggris'] ?></td>
					</tr>
					<tr>
						<th scope="row">7</th>
						<td>Penalaran Matematika</td>
						<td><?php echo $data['penalaran_matematika'] ?></td>
					</tr>
				</tbody>
			</table>
      </div>
      <a href="index.php" class="btn btn-warning text-light">Home</a>
		</div>

    
		
	</body>
</html>
