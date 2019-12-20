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
$qyuk = mysql_query("SELECT * FROM barang_lokasi ".
						"WHERE alamat = '' ".
						"ORDER BY RAND()");
$ryuk = mysql_fetch_assoc($qyuk);
$x_kd = nosql($ryuk['kd']);
$x_long = balikin($ryuk['lat_x']);
$x_lat = balikin($ryuk['lat_y']);











//detail
$qdatai = mysql_query("SELECT * FROM barang_lokasi ".
						"ORDER BY postdate DESC");
$rdatai = mysql_fetch_assoc($qdatai);

do
	{
	$ikdi = $ikdi + 1;
	$yuk_postdate = balikin($rdatai['postdate']);
	$yuk_status = balikin($rdatai['status']);
	$yuk_kode = balikin($rdatai['orang_kode']);
	$yuk_jamnama = balikin($rdatai['orang_nama']);
	$x_long = balikin($rdatai['lat_x']);
	$x_lat = balikin($rdatai['lat_y']);
	$x_alamat = balikin($rdatai['alamat']);

	echo "<font color=green>$yuk_postdate. $yuk_status.</font>
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
