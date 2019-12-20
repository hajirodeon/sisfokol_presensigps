<?php
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");

$lokkd = balikin($_POST['lokkd']);
$nilx = balikin($_POST['nilx']);
$nily = balikin($_POST['nily']);




//update
mysql_query("UPDATE a_profil SET lat_x = '$nilx', ".
				"lat_y = '$nily', ".
				"postdate = '$today'");
				
exit();
?>