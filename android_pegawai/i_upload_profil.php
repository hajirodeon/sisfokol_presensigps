<?php
session_start();


//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");



nocache;

//nilai
$filenya = "$sumber/android_pegawai/i_upload_profil.php";
$filenyax = "$sumber/android_pegawai/i_upload_profil.php";
$judul = "Upload Foto Profil";
$juduli = $judul;



//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];





//detail
$qku = mysql_query("SELECT * FROM m_orang ".
						"WHERE kd = '$sesiku'");
$rku = mysql_fetch_assoc($qku);
$ku_nip = cegah($rku['nip']);
$ku_nama = cegah($rku['nama']);
$ku_jabatan = cegah($rku['jabatan']);





//simpan
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'simpan'))
	{
	//nilai
	$new_image_name = "$sesiku-$tahun$bulan$tanggal$jam$menit$detik.jpg";
	
	
	//copy...
	move_uploaded_file($_FILES["file"]["tmp_name"], "../filebox/pegawai/".$new_image_name);
	
	
	
	//kd
	$xyz = md5("$sesiku$new_image_name");
	$filexnya = cegah($new_image_name);
	
	
	//update
	mysql_query("UPDATE m_orang SET filex1 = '$filexnya' ".
					"WHERE kd = '$sesiku'");



	exit();
	}
	
	








//form
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'form'))
	{
	/*
	//munculkan image terakhir
	$qyuk = mysql_query("SELECT * FROM m_orang ".
							"WHERE kd = '$sesiku'");
	$ryuk = mysql_fetch_assoc($qyuk);
	$yuk_kd = nosql($ryuk['kd']);
	$yuk_filex = balikin($ryuk['filex1']);
	

	echo '<table width="100%" border="0" cellpadding="5" cellspacing="5">
	<tr align="center">
	
	<td width="10">&nbsp;</td>
	<td valign="top">

	
	<img src="'.$sumber.'/filebox/pegawai/'.$yuk_filex.'" width="100%" />

	
	</td>
	
	<td width="10">&nbsp;</td>
	</tr>
	</table>

	<br>
	<br>
	<br>';
	
	 * 
	 */
	 
	 
	//re-direct
	
	?>
	
	
	
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
			window.location.href = "akun_profil.html"; 
	
	});
	
	</script>
	
	<?php
	exit();
	}
	
	



exit();	
?>