<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");

nocache;

//nilai
$filenya = "ifr_display_log_masuk.php";
$judul = "Display MASUK";
$judulku = "$judul";
$judulx = $judul;


$jml_detik = "15000";
$ke = "$filenya";


$keyku = "AIzaSyByk0KLTzm6gkP9a8SYTYwwJ0qHlbTfRi8";






//kasi alamat, yang masih null /////////////////////////////////////////////////////////////////////////
$qyuk = mysql_query("SELECT * FROM orang_lokasi ".
						"WHERE alamat = '' ".
						"ORDER BY RAND()");
$ryuk = mysql_fetch_assoc($qyuk);
$x_kd = nosql($ryuk['kd']);
$x_long = balikin($ryuk['lat_x']);
$x_lat = balikin($ryuk['lat_y']);





//jadikan alamat ////////////////////////////////////////////////////////////////////////////////////////
$url = "https://maps.googleapis.com/maps/api/geocode/json?key=$keyku&latlng=$x_long,$x_lat&sensor=false";

// persiapkan curl
$ch = curl_init(); 

// set url 
curl_setopt($ch, CURLOPT_URL, $url);

// return the transfer as a string 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

// $output contains the output string 
$curlData = curl_exec($ch); 

// tutup curl 
curl_close($ch);      


$address = json_decode($curlData);
$a=$address->results[0];
$nilku = explode(",",$a->formatted_address);

$nil1 = $nilku[0];
$nil2 = $nilku[1];
$nil3 = $nilku[2];
$nil4 = $nilku[3];
$nil5 = $nilku[4];
$nil6 = $nilku[5];
$nil7 = $nilku[6];
$nil_alamat = cegah("$nil1, $nil2, $nil3, $nil4, $nil5, $nil6, $nil7");
//jadikan alamat ////////////////////////////////////////////////////////////////////////////////////////



//update
mysql_query("UPDATE orang_lokasi SET alamat = '$nil_alamat' ".
				"WHERE kd = '$x_kd'");
//kasi alamat, yang masih null /////////////////////////////////////////////////////////////////////////











//detail
$qdatai = mysql_query("SELECT DISTINCT(orang_kd) AS kdnya ".
						"FROM orang_lokasi ".
						"WHERE status = 'MASUK' ".
						"ORDER BY postdate DESC");
$rdatai = mysql_fetch_assoc($qdatai);

do
	{
	$ikdi = $ikdi + 1;
	$i_jamkd = nosql($rdatai['kdnya']);


	//ambil koordinat terakhir tiap orang
	$qyuk = mysql_query("SELECT * FROM orang_lokasi ".
							"WHERE orang_kd = '$i_jamkd' ".
							"AND status = 'MASUK' ".
							"ORDER BY postdate DESC");
	$ryuk = mysql_fetch_assoc($qyuk);
	$yuk_postdate = balikin($ryuk['postdate']);
	$yuk_status = balikin($ryuk['status']);
	$yuk_kode = balikin($ryuk['orang_kode']);
	$yuk_jamnama = balikin($ryuk['orang_nama']);
	$x_long = balikin($ryuk['lat_x']);
	$x_lat = balikin($ryuk['lat_y']);
	$x_alamat = balikin($ryuk['alamat']);

	echo "<font color=green>$yuk_postdate. PRESENSI $yuk_status.</font>
	<br>
	$yuk_kode. 
	$yuk_jamnama
	<br>
	[$x_long]. [$x_lat]. $x_alamat.
	<hr>";
	}
while ($rdatai = mysql_fetch_assoc($qdatai));
?>


<script>setTimeout("location.href='<?php echo $ke;?>'", <?php echo $jml_detik;?>);</script>

<?php
exit();
?>
