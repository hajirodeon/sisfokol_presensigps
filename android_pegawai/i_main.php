<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");



nocache;


//nilai
$filenya = "$sumber/android_pegawai/i_main.php";
$filenya_jamku = "$sumber/android_pegawai/i_jamku.php";


//nilai session
$sesiku = $_SESSION['sesiku'];
$brgkd = $_SESSION['brgkd'];
$sesinama = $_SESSION['sesinama'];
$kd6_session = nosql($_SESSION['sesiku']);
$notaku = nosql($_SESSION['notaku']);
$notakux = md5($notaku);




//deteksi waktu
$qkuy = mysql_query("SELECT * FROM m_waktu");
$rkuy = mysql_fetch_assoc($qkuy);
$masuk_jam = balikin($rkuy['masuk_jam']);
$masuk_menit = balikin($rkuy['masuk_menit']);
$pulang_jam = balikin($rkuy['pulang_jam']);
$pulang_menit = balikin($rkuy['pulang_menit']);


?>


  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/dist/css/skins/skins-biasawae.css">





<script>
$(document).ready(function(){


	setInterval(loadLog, 1000);
	
	function loadLog(){
		console.log("interval...");
		$("#ijamku").load("<?php echo $filenya_jamku;?>");
	}




})
</script>




<br>

<div class="row">

	<div class="col-md-12" align="center">

			<img src="img/logo.png" height="100" />
			
	</div>
	
</div>

<div class="row">

	<div class="col-md-12" align="center">

		
		<h3>
			Sistem Bersama Hadir
		</h3>

		<div id="ijamku"></div>	
	</div>

</div>

<hr>


<?php
if (!empty($sesiku))
	{
	//detail
	$qku = mysql_query("SELECT * FROM m_orang ".
							"WHERE kd = '$sesiku'");
	$rku = mysql_fetch_assoc($qku);
	$ku_nip = balikin($rku['nip']);
	$ku_nama = balikin($rku['nama']);
	$ku_jabatan = balikin($rku['jabatan']);
	$ku_filex = balikin($rku['filex1']);
	
	
	
	$tanggalx = round($tanggal);
	$bulanx = round($bulan);
	
	
	//deteksi, presensi masuk hari ini...
	$qyuk = mysql_query("SELECT * FROM orang_lokasi ".
							"WHERE orang_kd = '$sesiku' ".
							"AND round(DATE_FORMAT(postdate, '%d')) = '$tanggalx' ".
							"AND round(DATE_FORMAT(postdate, '%m')) = '$bulanx' ".
							"AND round(DATE_FORMAT(postdate, '%Y')) = '$tahun' ".
							"AND status = 'MASUK' ".
							"ORDER BY postdate ASC");
	$ryuk = mysql_fetch_assoc($qyuk);
	$tyuk = mysql_num_rows($qyuk);
	
	
	
	//deteksi, presensi pulang hari ini...
	$qyuk2 = mysql_query("SELECT * FROM orang_lokasi ".
							"WHERE orang_kd = '$sesiku' ".
							"AND round(DATE_FORMAT(postdate, '%d')) = '$tanggalx' ".
							"AND round(DATE_FORMAT(postdate, '%m')) = '$bulanx' ".
							"AND round(DATE_FORMAT(postdate, '%Y')) = '$tahun' ".
							"AND status = 'PULANG' ".
							"ORDER BY postdate DESC");
	$ryuk2 = mysql_fetch_assoc($qyuk2);
	$tyuk2 = mysql_num_rows($qyuk2);
	?>		


    
  <div class="row">

	<?php
	//jika belum presensi masuk
	if (empty($tyuk))
		{
		//jika kurang dari jam masuk
		if (round($jam) <= round($masuk_jam))
			{
			//tombol aktif
			echo '<div class="col-6" align="center">
				<a href="p_masuk.html" class="btn btn-success"><img src="img/p_masuk.png" height="100" /></a>
			</div>';
			}
		else
			{
			//tombol pasif
			echo '<div class="col-6" align="center">
				<img src="img/p_masuk.png" height="100" />
			</div>';				
			}
			
			
		//tombol pasif
		echo '<div class="col-6" align="center">
			<img src="img/p_pulang.png" height="100" />
		</div>';
		}
		
	//jika belum presensi pulang
	else if (empty($tyuk2))
		{
		//tombol pasif
		echo '<div class="col-6" align="center">
			<img src="img/p_masuk.png" height="100" />
		</div>';
				

		//jika diatas jam pulang
		if (round($jam) >= round($pulang_jam))
			{
			//aktif					
			echo '<div class="col-6" align="center">
				<a href="p_pulang.html" class="btn btn-danger"><img src="img/p_pulang.png" height="100" /></a>
			</div>';
			}	
			
		else
			{
			//pasif					
			echo '<div class="col-6" align="center">
				<img src="img/p_pulang.png" height="100" />
			</div>';
			}
		}


	else
		{
		//tombol pasif
		echo '<div class="col-6" align="center">
			<img src="img/p_masuk.png" height="100" />
		</div>';
				
		//pasif					
		echo '<div class="col-6" align="center">
			<img src="img/p_pulang.png" height="100" />
		</div>';
		}
	?>
        
        
  </div>
  
  
  <hr>
  
  <div class="row">

		<div class="col-12" align="center">
		<p>
		Nomor Induk :
		<br>
		<b><?php echo $ku_nip;?></b>
		</p>
		
		<p>
		Nama : 
		<br>
		<b><?php echo $ku_nama;?></b>
		</p>
		
		</div>
	
	</div>


  <div class="row">

	<div class="col-1">

	</div>

		<div class="col-10" align="center">
			<hr>
					<table width="100%" border="0" cellpadding="5" cellspacing="5">
					<tr align="top">
					<td valign="top" align="left">
						<font color="green">PRESENSI MASUK</font>
					</td>
					
					<td valign="top" align="right">
						
						<?php
						//history hadir ...
						$qku = mysql_query("SELECT orang_lokasi.*, ".
												"DATE_FORMAT(postdate, '%H') AS jam, ".
												"DATE_FORMAT(postdate, '%i') AS menit ".
												"FROM orang_lokasi ".
												"WHERE orang_kd = '$sesiku' ".
												"AND status = 'MASUK' ".
												"AND round(DATE_FORMAT(postdate, '%d')) = '$tanggalx' ".
												"AND round(DATE_FORMAT(postdate, '%m')) = '$bulanx' ".
												"AND round(DATE_FORMAT(postdate, '%Y')) = '$tahun' ".
												"ORDER BY postdate DESC");
						$ryuk = mysql_fetch_assoc($qku);
						$yuk_postdate = balikin($ryuk['postdate']);
						$yuk_jam = balikin($ryuk['jam']);
						$yuk_menit = balikin($ryuk['menit']);
						
						//jika ada
						if (!empty($yuk_jam))
							{
							echo "<font color='green'><b>$yuk_jam:$yuk_menit WIB</b></font>";
							}
						?>
					

					</td>
					</tr>
					</table>
			<hr>

					<table width="100%" border="0" cellpadding="5" cellspacing="5">
					<tr align="top">
					<td valign="top" align="left">
						<font color="red">PRESENSI PULANG</font>
					</td>
					
					<td valign="top" align="right">
						<?php
						//history hadir ...
						$qku = mysql_query("SELECT orang_lokasi.*, ".
												"DATE_FORMAT(postdate, '%H') AS jam, ".
												"DATE_FORMAT(postdate, '%i') AS menit ".
												"FROM orang_lokasi ".
												"WHERE orang_kd = '$sesiku' ".
												"AND status = 'PULANG' ".
												"AND round(DATE_FORMAT(postdate, '%d')) = '$tanggalx' ".
												"AND round(DATE_FORMAT(postdate, '%m')) = '$bulanx' ".
												"AND round(DATE_FORMAT(postdate, '%Y')) = '$tahun' ".
												"ORDER BY postdate DESC");
						$ryuk = mysql_fetch_assoc($qku);
						$yuk_postdate = balikin($ryuk['postdate']);
						$yuk_jam = balikin($ryuk['jam']);
						$yuk_menit = balikin($ryuk['menit']);
						
						//jika ada
						if (!empty($yuk_jam))
							{
							echo "<font color='red'><b>$yuk_jam:$yuk_menit WIB</b></font>";
							}
						?>
					

					</td>
					</tr>
					</table>
			<hr>

		</div>

		
		<div class="col-1">
	
		</div>
		
	</div>





	<?php
	//kasi log login ///////////////////////////////////////////////////////////////////////////////////
	$todayx = $today;
	
				
	//detail
	$qku = mysql_query("SELECT * FROM m_orang ".
							"WHERE kd = '$sesiku'");
	$rku = mysql_fetch_assoc($qku);
	$ku_nip = cegah($rku['nip']);
	$ku_nama = cegah($rku['nama']);
	
				
	//insert
	mysql_query("INSERT INTO orang_login(kd, orang_kd, orang_kode, ".
					"orang_nama, postdate) VALUES ".
					"('$x', '$sesiku', '$ku_nip', ".
					"'$ku_nama', '$todayx')");
	//kasi log login ///////////////////////////////////////////////////////////////////////////////////
	}
?>
