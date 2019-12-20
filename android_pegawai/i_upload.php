<?php
session_start();


//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");



nocache;

//nilai
$filenya = "$sumber/android_pegawai/i_upload.php";
$filenyax = "$sumber/android_pegawai/i_upload.php";
$judul = "Upload Foto Barang";
$juduli = $judul;



//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];


$keyku = "AIzaSyByk0KLTzm6gkP9a8SYTYwwJ0qHlbTfRi8";




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
	$e_status = cegah($_GET["e_status"]);
	//$new_image_name = strtolower($_FILES['file']['name']);
	$new_image_name = "$sesiku-$tahun$bulan$tanggal$jam$menit$detik.jpg";
	
	
	//ketahui koordinat dan alamat lokasi...
	
	//copy...
	move_uploaded_file($_FILES["file"]["tmp_name"], "../filebox/barang/".$new_image_name);
	
	
	
	//kd
	$xyz = md5("$sesiku$new_image_name");
	$filexnya = cegah($new_image_name);
	
	
	//masukin ke database...
	mysql_query("INSERT INTO barang_lokasi(kd, orang_kd, orang_kode, orang_nama, filex, postdate) VALUES ".
					"('$xyz', '$sesiku', '$ku_nip', '$ku_nama', '$filexnya', '$today')");



	exit();
	}
	
	







//jika simpan2
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'simpan2'))
	{
	//ambil nilai
	$e_kd = cegah($_GET['kd']);
	$e_isi = cegah($_GET['e_isi']);

	
	//empty
	if (empty($e_isi))
		{
		echo '<b>
		<font color="red">GAGAL. SILAHKAN ULANGI LAGI...!!</font>
		</b>';	
		} 
	else
		{
		//update
		mysql_query("UPDATE barang_lokasi SET status = '$e_isi' ".
						"WHERE kd = '$e_kd'");
								
		?>
		
		<script language='javascript'>
		//membuat document jquery
		$(document).ready(function(){
		
			$("#iform").hide();
		
		});
		
		</script>
		
		<?php
		echo '<b>
		<font color="green">Terima Kasih, Telah Memberikan Laporan.</font>
		</b>';				
		}	

	
	exit();
	}













//form
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'form'))
	{
	//munculkan image terakhir
	$qyuk = mysql_query("SELECT * FROM barang_lokasi ".
							"WHERE orang_kd = '$sesiku' ".
							"ORDER BY postdate DESC");
	$ryuk = mysql_fetch_assoc($qyuk);
	$yuk_kd = nosql($ryuk['kd']);
	$yuk_filex = balikin($ryuk['filex']);
	
	?>
	
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
	
		$("#btnKRM").on('click', function(){
			$("#formx2").submit(function(){
				$.ajax({
					url: "<?php echo $filenyax;?>?aksi=simpan2&kd=<?php echo $yuk_kd;?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#ihasil").html(data);
						}
					});
				return false;
			});
		
		
		});	
	
	
	});
	
	</script>
	


	
	<?php
	echo '<table width="100%" border="0" cellpadding="5" cellspacing="5">
	<tr align="center">
	
	<td width="10">&nbsp;</td>
	<td valign="top">

	
	<img src="'.$sumber.'/filebox/barang/'.$yuk_filex.'" width="100%" />

	

	<hr>
	<div id="ihasil"></div>
	
	
	<div id="iform">
		<form name="formx2" id="formx2">
		<p>
		Keluhan/Saran/Catatan : 
		<br>
		<textarea cols="10" name="e_isi" id="e_isi" wrap="yes" rows="5" class="btn-block btn-success"></textarea>
		</p>
		
		<p>
		<input type="submit" name="btnKRM" id="btnKRM" value="KIRIM >" class="btn btn-block btn-danger">
		</p>
		
		
		</form>
	</div>
	
	</td>
	
	<td width="10">&nbsp;</td>
	</tr>
	</table>

	<br>
	<br>
	<br>';
	

	exit();
	}
	
	
	
	
	
	
	

//jika pmasuk
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'pmasuk'))
	{
	//ambil nilai
	$latx = cegah($_GET['latx']);
	$laty = cegah($_GET['laty']);


	$latx2 = balikin($_GET['latx']);
	$laty2 = balikin($_GET['laty']);



	//jadikan alamat ///////////////////////////////////////////////////////////////////////////////////////////////
	$lat = $latx2;
	$long = $laty2; 
	
	
	function geo2address2($lat,$long,$keyku) {
		
	    $url = "https://maps.googleapis.com/maps/api/geocode/json?key=$keyku&latlng=$lat,$long&sensor=false";
	    $curlData=file_get_contents(    $url);
	    $address = json_decode($curlData);
	    $a=$address->results[0];
	    return explode(",",$a->formatted_address);
	}
	
	
	
	
	$nilku = geo2address2($lat,$long,$keyku);
	
	
	$nil1 = $nilku[0];
	$nil2 = $nilku[1];
	$nil3 = $nilku[2];
	$nil4 = $nilku[3];
	$nil5 = $nilku[4];
	$nil6 = $nilku[5];
	$nil7 = $nilku[6];
	$nil_tujuan = cegah("$nil1, $nil2, $nil3, $nil4, $nil5, $nil6, $nil7");
	$nil_tujuan2 = balikin("$nil1, $nil2, $nil3, $nil4, $nil5, $nil6, $nil7");





	//munculkan terakhir
	$qyuk = mysql_query("SELECT * FROM barang_lokasi ".
							"WHERE orang_kd = '$sesiku' ".
							"ORDER BY postdate DESC");
	$ryuk = mysql_fetch_assoc($qyuk);
	$yuk_kd = nosql($ryuk['kd']);

	
	//update...
	mysql_query("UPDATE barang_lokasi SET lat_x = '$latx', ".
					"lat_y = '$laty', ".
					"alamat = '$nil_tujuan' ".
					"WHERE kd = '$yuk_kd'");
	
	
	
	echo "<p>
	Barang Berada di :
	<br>
	<i>$nil_tujuan2</i>
	<br>
	[$latx2]. [$laty2].
	</p>";

    exit();
	}

	

	
	
	
	
	
	
//jika error
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'error'))
	{
	echo "<b>
	<font color=red>
	GPS LOCATION Belum Diaktifkan...!!
	</font>
	</b>";


    exit();
	}

	
	
		
	
	





exit();	
?>