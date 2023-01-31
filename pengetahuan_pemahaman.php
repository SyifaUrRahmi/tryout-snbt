<?php
    include "koneksi.php";
     $score    =0;
        $benar    =0;
        $salah    =0;
        $kosong    =0;
        $hasil = 0;
        $error = "";
        $sukses = "";
    if(isset($_POST['tes'])){
        if(empty($_POST['pilihan'])){
        }
        
        $pilihan    =$_POST["pilihan"];
        $id_soal    =$_POST["id"];
        $jumlah     =$_POST["jumlah"];
        
       

        for($i=0;$i<$jumlah;$i++){
            $nomor    =$id_soal[$i];
            
            // jika peserta tidak memilih jawaban
            if(empty($pilihan[$nomor])){
                $kosong++;
            }
            // jika memilih
            else {
                $jawaban    =$pilihan[$nomor];

                // cocokan kunci jawaban dengan database
                $query    =mysqli_query($koneksi, "SELECT * FROM soal_math WHERE id='$nomor' AND jawaban='$jawaban'");
                $cek    =mysqli_num_rows($query);
                
                // jika jawaban benar (cocok dengan database)
                if($cek){
                    $benar++;
                }
                // jika jawaban salah (tidak cocok dengan database)
                else {
                    $salah++;
                }
            }
            /*
                ----------
                Nilai 100
                ----------
                Hasil = 100 / jumlah soal * Jawaban Benar
            */
            // script php membuat soal pilihan ganda
            // hitung skor
            $hitung =mysqli_query($koneksi, "SELECT * FROM soal_math");
            $jumlah_soal    =mysqli_num_rows($hitung);
            $score    =100 / $jumlah_soal * $benar;
            $hasil    =number_format($score,2);

            require_once "dbconfig.php";
			// Cek status login user 
			if (!$user->isLoggedIn()) {
			header("location: login.php"); //Redirect ke halaman login 
  		}
  		$currentUser = $user->getUser();
            $id = $currentUser['id'];
            // $penalaran_umum = $_POST['$penalaran_umum'];
            $update = "update user set penalaran_umum = '$hasil' where id = '$id'";
            $sql         = mysqli_query($koneksi, $update);

            // header("location: pengetahuan_pemahaman.php");
            if ($sql) {
                        $sukses = "Data berhasil diupdate";
                        } else {
                        $error  = "Data gagal diupdate";
                      }
        }
    }
    echo"
    <h1> $hasil</h1>";
    if ($error) {
                    ?>
                    <div class="alert alert-danger" role="alert">
                      <?php echo $error ?>
                    </div>
                  <?php
                      // header("refresh:1;url=index.php"); //1 : detik
                    }
                    ?>
                  <?php
                    if ($sukses) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      <?php echo $sukses ?>
                    </div>
                  <?php
                      // header("refresh:1;url=index.php");
                    }
  ?>
<h1>echo $hasil</h1>
