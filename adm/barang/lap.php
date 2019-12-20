<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/admin.html");

nocache;

//nilai
$filenya = "lap.php";
$judul = "Laporan Barang";
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
	
//nek batal
if ($_POST['btnBTL'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}




//nek masuk
if ($_POST['btnMASUK'])
	{
	//re-direct
	$ke = "$filenya?s=petamasuk";
	xloc($ke);
	exit();
	}






//jika cari
if ($_POST['btnCARI'])
	{
	//nilai
	$kunci = cegah($_POST['kunci']);


	//re-direct
	$ke = "$filenya?kunci=$kunci";
	xloc($ke);
	exit();
	}



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
//jika null
	if (empty($kunci))
		{
		$sqlcount = "SELECT * FROM barang_lokasi ".
						"ORDER BY postdate DESC";
		}
		
	else
		{
		$sqlcount = "SELECT * FROM barang_lokasi ".
						"WHERE status LIKE '%$kunci%' ".
						"OR orang_nama LIKE '%$kunci%' ".
						"ORDER BY postdate DESC";
		}
	
	
	

//query
$p = new Pager();
$start = $p->findStart($limit);

$sqlresult = $sqlcount;

$count = mysql_num_rows(mysql_query($sqlcount));
$pages = $p->findPages($count, $limit);
$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
$pagelist = $p->pageList($_GET['page'], $pages, $target);
$data = mysql_fetch_array($result);



echo '<form action="'.$filenya.'" method="post" name="formx">';

//jika detail 
if ($s == "petamasuk")
	{
	echo "<h3>PETA BARANG</h3>
	<a href='$filenya' class='btn btn-danger'>DAFTAR LAINNYA >></a>
	<hr>";

	
	echo '<iframe frameborder="0" width="100%" scrolling="0" name="lap_hari" height="500" src="ifr_lap.php"></iframe>';

	}



//jika detail 
else if ($s == "detail")
	{
	echo "<h3>PETA BARANG</h3>
	<a href='$filenya' class='btn btn-danger'>DAFTAR LAINNYA >></a>
	<hr>";
	
	
	//detail
	$qjuk = mysql_query("SELECT * FROM barang_lokasi ".
							"WHERE kd = '$kd'");
	$rjuk = mysql_fetch_assoc($qjuk);
	$juk_nip = balikin($rjuk['orang_kode']);
	$juk_nama = balikin($rjuk['orang_nama']);
	$juk_status = balikin($rjuk['status']);
	$juk_postdate = balikin($rjuk['postdate']);
	$juk_alamat = balikin($rjuk['alamat']);
	$juk_filex = balikin($rjuk['filex']);

	$nil_foto1 = "$sumber/filebox/barang/$juk_filex";
	
	echo "<p>
	<i>$juk_status</i>
	<br>
	[$juk_postdate]. [$juk_nip]. [$juk_nama].
	<br>
	$juk_alamat 
	<hr>
	
	
	</p>";
	
	
	

	echo '<table width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr valign="top">
	<td width="500">
	
			<img src="'.$nil_foto1.'" width="100%" height="800">
	
	</td>
	
	<td width="500">
	
		<iframe frameborder="0" width="100%" scrolling="0" name="lap_hari" height="800" src="ifr_lap_detail.php?kd='.$kd.'"></iframe>
		
	</td>
	</tr>
	</table>';

	
	
	
	
	

	}

	
	
else
	{
	echo '<p>
	<input name="kunci" type="text" value="'.$kunci2.'" size="20" class="btn btn-warning" placeholder="Kata Kunci...">
	<input name="btnCARI" type="submit" value="CARI" class="btn btn-danger">
	<input name="btnBTL" type="submit" value="RESET" class="btn btn-info">
	<input name="btnMASUK" type="submit" value="PETA BARANG" class="btn btn-success">
	</p>
		
	
	<div class="table-responsive">          
	<table class="table" border="1">
	<thead>
	
	<tr valign="top" bgcolor="'.$warnaheader.'">
	<td width="50"><strong><font color="'.$warnatext.'">POSTDATE</font></strong></td>
	<td width="150"><strong><font color="'.$warnatext.'">IMAGE</font></strong></td>
	<td><strong><font color="'.$warnatext.'">KELUHAN/SARAN/STATUS</font></strong></td>
	<td width="150"><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
	</tr>
	</thead>
	<tbody>';
	
	if ($count != 0)
		{
		do 
			{
			if ($warna_set ==0)
				{
				$warna = $warna01;
				$warna_set = 1;
				}
			else
				{
				$warna = $warna02;
				$warna_set = 0;
				}
	
			$nomer = $nomer + 1;
			$i_kd = nosql($data['kd']);
			$i_postdate = balikin($data['postdate']);
			$i_status = balikin($data['status']);
			$i_nama = balikin($data['orang_nama']);
			$i_alamat = balikin($data['alamat']);
			$i_lat_x = balikin($data['lat_x']);
			$i_lat_y = balikin($data['lat_y']);
			$i_filex1 = balikin($data['filex']);

			 
			$nil_foto1 = "$sumber/filebox/barang/$i_filex1";
			
			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>'.$i_postdate.'</td>
			<td><img src="'.$nil_foto1.'" width="150"></td>
			<td>
			'.$i_status.'

			<hr>
			['.$i_lat_x.']. ['.$i_lat_y.']. '.$i_alamat.'
			<hr>
			<a href="'.$filenya.'?s=detail&kd='.$i_kd.'" class="btn btn-block btn-danger">LIHAT PETA</a>
			</td>
			<td>
			'.$i_nama.'
			</td>
	        </tr>';
			}
		while ($data = mysql_fetch_assoc($result));
		}
	
	
	echo '</tbody>
	  </table>
	  </div>
	
	
	<table width="500" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td>
	<strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'
	<br>
	
	<input name="jml" type="hidden" value="'.$count.'">
	<input name="s" type="hidden" value="'.$s.'">
	<input name="kd" type="hidden" value="'.$kdx.'">
	<input name="page" type="hidden" value="'.$page.'">
	</td>
	</tr>
	</table>';
	}

	
echo '</form>';



//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//null-kan
xclose($koneksi);
exit();
?>