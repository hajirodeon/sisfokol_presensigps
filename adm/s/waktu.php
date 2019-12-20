<?php
session_start();

//ambil nilai
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");
$tpl = LoadTpl("../../template/admin.html");


nocache;

//nilai
$filenya = "waktu.php";
$judul = "[SETTING]. Waktu Masuk dan Pulang";
$judulku = "$judul";




//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//simpan
if ($_POST['btnSMP'])
	{
	//ambil nilai
	$masuk_jam = cegah($_POST["masuk_jam"]);
	$masuk_menit = cegah($_POST["masuk_menit"]);
	$pulang_jam = cegah($_POST["pulang_jam"]);
	$pulang_menit = cegah($_POST["pulang_menit"]);

	//cek
	//nek null
	if ((empty($masuk_jam)) OR (empty($masuk_menit)) OR (empty($pulang_jam)) OR (empty($pulang_menit)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}

	else
		{
		//perintah SQL
		mysql_query("UPDATE m_waktu SET masuk_jam = '$masuk_jam', ".
						"masuk_menit = '$masuk_menit', ".
						"pulang_jam = '$pulang_jam', ".
						"pulang_menit = '$pulang_menit', ".
						"postdate = '$today'");


		//auto-kembali
		xloc($filenya);
		exit();
		}
	}
	
	
	
	
	
	
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






//isi *START
ob_start();






     	
echo '<form action="'.$filenya.'" method="post" name="formx">';


//detail
$qku = mysql_query("SELECT * FROM m_waktu");
$rku = mysql_fetch_assoc($qku);
$masuk_jam = balikin($rku['masuk_jam']);
$masuk_menit = balikin($rku['masuk_menit']);
$pulang_jam = balikin($rku['pulang_jam']);
$pulang_menit = balikin($rku['pulang_menit']);


echo '<div class="row">

<div class="col-md-6">


<p>
Jam Masuk : 
<br>
<input name="masuk_jam" type="text" size="5" value="'.$masuk_jam.'" class="btn-warning">:
<input name="masuk_menit" type="text" size="5" value="'.$masuk_menit.'" class="btn-warning">
</p>




<p>
Jam Pulang : 
<br>
<input name="pulang_jam" type="text" size="5" value="'.$pulang_jam.'" class="btn-warning">:
<input name="pulang_menit" type="text" size="5" value="'.$pulang_menit.'" class="btn-warning">
</p>




<p>
<input name="btnSMP" type="submit" value="SIMPAN" class="btn btn-danger">
</p>

</div>


</div>


</form>';



//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");

//diskonek
xfree($qbw);
xclose($koneksi);
exit();
?>