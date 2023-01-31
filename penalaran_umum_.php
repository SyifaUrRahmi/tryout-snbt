<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>SNBT | PENALARAN UMUM</title>

		<!-- Kita membutuhkan jquery, disini saya menggunakan langsung dari jquery.com, jquery ini bisa didownload dan ditaruh dilocal -->
		<script
			src="http://code.jquery.com/jquery-1.10.2.min.js"
			type="text/javascript"
		></script>

		<!-- Script Timer -->
		<script type="text/javascript">
			$(document).ready(function () {
				/** Membuat Waktu Mulai Hitung Mundur Dengan
				 * var detik = 0,
				 * var menit = 1,
				 * var jam = 1
				 */
				var detik = 10;
				var menit = 0;
				var jam = 0;

				/**
				 * Membuat function hitung() sebagai Penghitungan Waktu
				 */
				function hitung() {
					/** setTimout(hitung, 1000) digunakan untuk
					 * mengulang atau merefresh halaman selama 1000 (1 detik)
					 */
					setTimeout(hitung, 1000);

					/** Jika waktu kurang dari 10 menit maka Timer akan berubah menjadi warna merah */
					if (menit < 11 && jam == 0) {
						var peringatan = 'style="color:red"';
					}

					/** Menampilkan Waktu Timer pada Tag #Timer di HTML yang tersedia */
					$("#timer").html(
						'<h4 align="right"' +
							peringatan +
							">Sisa waktu anda : &nbsp;&nbsp;&nbsp;" +
							jam +
							" jam : " +
							menit +
							" menit : " +
							detik +
							" detik</h4><hr>"
					);

					/** Melakukan Hitung Mundur dengan Mengurangi variabel detik - 1 */
					detik--;

					/** Jika var detik < 0
					 * var detik akan dikembalikan ke 59
					 * Menit akan Berkurang 1
					 */
					if (detik < 0) {
						detik = 59;
						menit--;

						/** Jika menit < 0
						 * Maka menit akan dikembali ke 59
						 * Jam akan Berkurang 1
						 */
						if (menit < 0) {
							menit = 59;
							jam--;

							/** Jika var jam < 0
							 * clearInterval() Memberhentikan Interval dan submit secara otomatis
							 */
							if (jam < 0) {
								clearInterval();
								/** Variable yang digunakan untuk submit secara otomatis di Form */
								var frmSoal = document.getElementById("frmSoal");
								frmSoal.submit();
							}
						}
					}
				}
				/** Menjalankan Function Hitung Waktu Mundur */
				hitung();
			});
			// ]]>
		</script>
	</head>
	<body>
		<p id="timer"></p>
		<table border="0">
        <tbody>
		 <?php
        require_once "dbconfig.php";
			// Cek status login user 
			if (!$user->isLoggedIn()) {
			header("location: login.php"); //Redirect ke halaman login 
  		}
  		$currentUser = $user->getUser();
            include "koneksi.php";
            $query    =mysqli_query($koneksi, "SELECT * FROM soal_math ORDER BY id DESC");
            $jumlah =mysqli_num_rows($query);
            $no = 0;
            while($data = mysqli_fetch_array($query)){
            $no++
            ?>
            <form action="index.php" method="POST" id="frmSoal">
                <input type="hidden" name="id[]" value="<?php echo $data['id']; ?>">
                <input type="hidden" name="jumlah" value="<?php echo $jumlah; ?>">
                <tr>
                    <td><?php echo $no?>.</td>
                    <td><?php echo $data['soal'];?></td>
                </tr>
                <?php
                    if(!empty($data['gambar'])){
                        echo "<tr><td></td><td><img src='assets/img/$data[gambar]' width='80' height='80'></td></tr>";
                    }
                ?>
                <tr>
                    <td></td>
                    <td>A. <input name="pilihan[<?php echo $data['id']?>]" type="radio" value="A"><?php echo $data['pilihan_a'];?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>B. <input name="pilihan[<?php echo $data['id']?>]" type="radio" value="B"><?php echo $data['pilihan_b'];?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>C. <input name="pilihan[<?php echo $data['id']?>]" type="radio" value="C"><?php echo $data['pilihan_c'];?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>D. <input name="pilihan[<?php echo $data['id']?>]" type="radio" value="D"><?php echo $data['pilihan_d'];?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>E. <input name="pilihan[<?php echo $data['id']?>]" type="radio" value="E"><?php echo $data['pilihan_e'];?></td>
                </tr>
                <?php
                }
                ?>
                <tr>
                    <td height="40"></td>
                    <td>
                        <!-- <input id="frmSoal" type="submit" name="submit" value="Jawab">
                        <input type="reset" value="Reset"> -->
                        <button class="btn btn-info m-2" type="submit">Selanjutnya</button>
                    </td>
                </tr>
            </form>
        </tbody>
    </table>
	</body>
</html>
