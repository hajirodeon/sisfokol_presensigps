<?php
ini_set('max_execution_time', 0);
error_reporting(0);


//ambil nilai
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");


header('Content-Type: application/json');

 
?>






{

"points":[

	<?php    
    //detail e
	$qku = mysql_query("SELECT * FROM orang_lokasi ".
							"WHERE lat_x <> '' ".
							"OR orang_nama <> '' ".
							"ORDER BY postdate DESC LIMIT 0,50");
	$rku = mysql_fetch_assoc($qku);
	$tku = mysql_num_rows($qku);
	
	do
		{
		$iku = $iku + 1;
		$ku_namax = trim(balikin($rku['orang_kode']));
		$ku_long = trim(balikin($rku['lat_x']));
		$ku_lat = trim(balikin($rku['lat_y']));


	    echo '{"id":'.$iku.',"nama":'.$ku_namax.',"lat":'.$ku_long.',"lon":'.$ku_lat.'},';
		}
	while ($rku = mysql_fetch_assoc($qku));

	
	//kasi yang terakhir
	$qku = mysql_query("SELECT * FROM orang_lokasi ".
							"WHERE lat_x <> '' ".
							"OR orang_nama <> '' ".
							"ORDER BY postdate ASC");
	$rku = mysql_fetch_assoc($qku);
	$tku = mysql_num_rows($qku);
	$ku_namax = trim(balikin($rku['orang_kode']));
	$ku_long = trim(balikin($rku['lat_x']));
	$ku_lat = trim(balikin($rku['lat_y']));
		
    echo '{"id":'.$iku.',"nama":'.$ku_namax.',"lat":'.$ku_long.',"lon":'.$ku_lat.'}';
	?>

]


}