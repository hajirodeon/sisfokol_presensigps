<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");

nocache;

//nilai
$filenya = "ifr_display_log_pulang.php";
$judul = "Display PULANG";
$judulku = "$judul";
$judulx = $judul;


$jml_detik = "15000";
$ke = "$filenya";





//detail
$qdatai = mysql_query("SELECT DISTINCT(orang_kd) AS kdnya ".
						"FROM orang_lokasi ".
						"WHERE status = 'PULANG' ".
						"ORDER BY postdate DESC");
$rdatai = mysql_fetch_assoc($qdatai);

do
	{
	$ikdi = $ikdi + 1;
	$i_jamkd = nosql($rdatai['kdnya']);


	//ambil koordinat terakhir tiap orang
	$qyuk = mysql_query("SELECT * FROM orang_lokasi ".
							"WHERE orang_kd = '$i_jamkd' ".
							"AND status = 'PULANG' ".
							"ORDER BY postdate DESC");
	$ryuk = mysql_fetch_assoc($qyuk);
	$yuk_postdate = balikin($ryuk['postdate']);
	$yuk_status = balikin($ryuk['status']);
	$yuk_kode = balikin($ryuk['orang_kode']);
	$yuk_jamnama = balikin($ryuk['orang_nama']);
	$x_long = balikin($ryuk['lat_x']);
	$x_lat = balikin($ryuk['lat_y']);
	$x_alamat = balikin($ryuk['alamat']);

	echo "<font color=red>$yuk_postdate. PRESENSI $yuk_status.</font>
	<br>
	$yuk_kode. 
	$yuk_jamnama
	<br>
	[$x_long]. [$x_lat]. $x_alamat
	<hr>";
	}
while ($rdatai = mysql_fetch_assoc($qdatai));

?>


<script>setTimeout("location.href='<?php echo $ke;?>'", <?php echo $jml_detik;?>);</script>

<?php
exit();
?>
