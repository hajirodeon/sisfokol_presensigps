<?php
sleep(1);

session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");



nocache;


//nilai
$filenya = "$sumber/android_pegawai/i_set_lokasi.php";


//nilai session
$sesiku = $_SESSION['sesiku'];
$brgkd = $_SESSION['brgkd'];
$sesinama = $_SESSION['sesinama'];
$kd6_session = nosql($_SESSION['sesiku']);
$notaku = nosql($_SESSION['notaku']);
$notakux = md5($notaku);



//detail
$qku = mysql_query("SELECT * FROM m_orang ".
						"WHERE kd = '$sesiku'");
$rku = mysql_fetch_assoc($qku);
$ku_nip = cegah($rku['nip']);
$ku_nama = cegah($rku['nama']);


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



<?php

//jika pmasuk
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'pmasuk'))
	{
	//ambil nilai
	$latx = cegah($_GET['latx']);
	$laty = cegah($_GET['laty']);


	$latx2 = balikin($_GET['latx']);
	$laty2 = balikin($_GET['laty']);
	
	$waktu = $today;


	
	
	//jika ada
	if (!empty($latx2))
		{
		//hari ini..
		$hariku = "$tahun-$bulan-$tanggal";
		$xyz = md5("$sesiku$hariku-MASUK");
		
		//deteksi, kalo udah masuk, gak boleh tekan lagi...
		$qcc = mysql_query("SELECT * FROM orang_lokasi ".
								"WHERE orang_kd = '$sesiku' ".
								"AND status = 'MASUK' ".
								"AND postdate LIKE '$hariku%'");
		$tcc = mysql_num_rows($qcc);
		
		//jika belum, entri ya...
		if (empty($tcc))
			{
			//insert
			mysql_query("INSERT INTO orang_lokasi(kd, orang_kd, orang_kode, orang_nama, ".
							"lat_x, lat_y, status, postdate) VALUES ".
							"('$xyz', '$sesiku', '$ku_nip', '$ku_nama', ".
							"'$latx', '$laty', 'MASUK', '$waktu')");
	
			?>						
			<br>
			<br>
			<div class="col-md-4 col-sm-6 col-xs-12">
			      <div class="info-box">
			        <span class="info-box-icon bg-green"><img src="img/p_masuk.png" height="75" /></span>
			
			        <div class="info-box-content">
			          <span class="info-box-text">PRESENSI MASUK</span>
			          <span class="info-box-number">
			          	BERHASIL...              	
			          	</span>
			        </div>
			        <!-- /.info-box-content -->
			      </div>
			      <!-- /.info-box -->
			      
		
				<?php						
				echo "<p>
				$waktu
				</p>
				
				<p>
				[$latx2]. [$laty2].
				</p>
				
				<p>
				<i>$nil_alaamt</i>
				</p>";
				?>
		
			      
			      
			    </div>
			<?php
			}
			
		else
			{
			?>
									
			<br>
			<br>
			<div class="col-md-4 col-sm-6 col-xs-12">
			      <div class="info-box">
			        <span class="info-box-icon bg-red"><img src="img/p_masuk.png" height="75" /></span>
			
			        <div class="info-box-content">
			          <span class="info-box-text">PRESENSI MASUK</span>
			          <span class="info-box-number">
			          	<font color="red">MAAF, ANDA SUDAH MASUK.</font>              	
			          	</span>
			        </div>
			        <!-- /.info-box-content -->
			      </div>
			      <!-- /.info-box -->
			      
			      
			    </div>
			<?php
			}			
			
			
		}

    exit();
	}

	

	
	

//jika ppulang
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'ppulang'))
	{
	//ambil nilai
	$latx = cegah($_GET['latx']);
	$laty = cegah($_GET['laty']);


	$latx2 = balikin($_GET['latx']);
	$laty2 = balikin($_GET['laty']);
	
	$waktu = $today;

	
		
	
	
	//jika ada
	if (!empty($latx2))
		{
		//hari ini..
		$hariku = "$tahun-$bulan-$tanggal";
		$xyz = md5("$sesiku$hariku-PULANG");
		
		
		//deteksi, kalo udah masuk, gak boleh tekan lagi...
		$qcc = mysql_query("SELECT * FROM orang_lokasi ".
								"WHERE orang_kd = '$sesiku' ".
								"AND status = 'PULANG' ".
								"AND postdate LIKE '$hariku%'");
		$tcc = mysql_num_rows($qcc);
		
		//jika belum, entri ya...
		if (empty($tcc))
			{
			//insert
			mysql_query("INSERT INTO orang_lokasi(kd, orang_kd, orang_kode, orang_nama, ".
							"lat_x, lat_y, status, postdate) VALUES ".
							"('$xyz', '$sesiku', '$ku_nip', '$ku_nama', ".
							"'$latx', '$laty', 'PULANG', '$waktu')");
	
			?>						
			<br>
			<br>
			<div class="col-md-4 col-sm-6 col-xs-12">
			      <div class="info-box">
			        <span class="info-box-icon bg-danger"><img src="img/p_pulang.png" height="75" /></span>
			
			        <div class="info-box-content">
			          <span class="info-box-text">PRESENSI PULANG</span>
			          <span class="info-box-number">
			          	BERHASIL...              	
			          	</span>
			        </div>
			        <!-- /.info-box-content -->
			      </div>
			      <!-- /.info-box -->
			      
		
				<?php						
				echo "<p>
				$waktu
				</p>
				
				<p>
				[$latx2]. [$laty2].
				</p>
				
				<p>
				<i>$nil_alaamt</i>
				</p>";
				?>
		
			      
			      
			    </div>
			<?php
			}
			
		else
			{
			?>
									
			<br>
			<br>
			<div class="col-md-4 col-sm-6 col-xs-12">
			      <div class="info-box">
			        <span class="info-box-icon bg-red"><img src="img/p_pulang.png" height="75" /></span>
			
			        <div class="info-box-content">
			          <span class="info-box-text">PRESENSI PULANG</span>
			          <span class="info-box-number">
			          	<font color="red">MAAF, ANDA SUDAH PULANG...</font>              	
			          	</span>
			        </div>
			        <!-- /.info-box-content -->
			      </div>
			      <!-- /.info-box -->
			      
			      
			    </div>
			<?php
			}			
			
			
		}

    exit();
	}
		
	
	
	
	
	
	
//jika error
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'error'))
	{
	?>

	<br>
	<br>
	<div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-map-pin"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">ERROR</span>
              <span class="info-box-number">
              	PASTIKAN GPS LOCATION AKTIF DAHULU...              	
              	</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        
    <?php 
    exit();
	}

	
	