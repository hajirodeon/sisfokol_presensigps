<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/display.html");

nocache;

//nilai
$filenya = "display.php";
$judul = "Display";
$judulku = "$judul";
$judulx = $judul;




$kd = nosql($_REQUEST['kd']);
$s = nosql($_REQUEST['s']);
$kunci = cegah($_REQUEST['kunci']);
$kunci2 = balikin($_REQUEST['kunci']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}



//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();


//require
require("../../template/js/jumpmenu.js");
require("../../template/js/checkall.js");
require("../../template/js/swap.js");
?>


  
  <script>
  	$(document).ready(function() {
    $('#table-responsive').dataTable( {
        "scrollX": true
    } );
} );
  </script>
  
<?php
//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$bulanx = $arrbln[$bulan];

echo "<h3>DISPLAY REALTIME : $tanggal $bulanx $tahun</h3>
<hr>";
?>


<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td width="500">

	<iframe frameborder="0" width="100%" scrolling="0" name="lap_hari" height="600" src="ifr_display.php"></iframe>

</td>

<td width="500">

	<iframe frameborder="0" width="100%" scrolling="0" name="lap_log" height="300" src="ifr_display_log_masuk.php"></iframe>
<br>
	<iframe frameborder="0" width="100%" scrolling="0" name="lap_log" height="300" src="ifr_display_log_pulang.php"></iframe>
	
</td>
</tr>
</table>







<?php

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//null-kan
xclose($koneksi);
exit();
?>