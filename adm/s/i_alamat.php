<?php
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");



$id_provinsi  = cegah($_POST['id_provinsi']);
$id_kabupaten  = cegah($_POST['id_kabupaten']);


if(isset($_POST["id_provinsi"]) && !empty($_POST["id_provinsi"]))
	{
	$qku = mysql_query("SELECT * FROM kabupaten ".
							"WHERE id_prov = '$id_provinsi' ".
  							"ORDER BY nama ASC");
	$rku = mysql_fetch_assoc($qku);

	do
		{
		$ku_idkab = nosql($rku['id_kab']);
		$ku_nama = balikin($rku['nama']);
		$ku_nama2 = cegah($rku['nama']);
		

		echo '<option value="'.$ku_idkab.'">'.$ku_nama.'</option>';
		}
	while ($rku = mysql_fetch_assoc($qku));
	
	exit();
  	}




if(isset($_POST["id_kabupaten"]) && !empty($_POST["id_kabupaten"]))
	{
	$qku = mysql_query("SELECT * FROM kecamatan ".
							"WHERE id_kab = '$id_kabupaten' ".
  							"ORDER BY nama ASC");
	$rku = mysql_fetch_assoc($qku);

	do
		{
		$ku_idkec = nosql($rku['id_kec']);
		$ku_nama = balikin($rku['nama']);
		$ku_nama2 = cegah($rku['nama']);

		echo '<option value="'.$ku_idkec.'">'.$ku_nama.'</option>';
		}
	while ($rku = mysql_fetch_assoc($qku));
	
	exit();
  	}








exit();
?>