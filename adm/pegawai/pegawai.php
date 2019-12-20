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
$filenya = "pegawai.php";
$judul = "Data User";
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
//jika import
if ($_POST['btnIM'])
	{
	//re-direct
	$ke = "$filenya?s=import";
	xloc($ke);
	exit();
	}













//lama
//import sekarang
if ($_POST['btnIMX'])
	{
	$filex_namex2 = strip(strtolower($_FILES['filex_xls']['name']));

	//nek null
	if (empty($filex_namex2))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		$ke = "$filenya?s=import";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//deteksi .xls
		$ext_filex = substr($filex_namex2, -4);

		if ($ext_filex == ".xls")
			{
			//nilai
			$path1 = "../../filebox";
			$path2 = "../../filebox/excel";
			chmod($path1,0777);
			chmod($path2,0777);

			//nama file import, diubah menjadi baru...
			$filex_namex2 = "pegawai.xls";

			//mengkopi file
			copy($_FILES['filex_xls']['tmp_name'],"../../filebox/excel/$filex_namex2");

			//chmod
            $path3 = "../../filebox/excel/$filex_namex2";
			chmod($path1,0755);
			chmod($path2,0777);
			chmod($path3,0777);

			//file-nya...
			$uploadfile = $path3;


			//require
			require('../../inc/class/PHPExcel.php');
			require('../../inc/class/PHPExcel/IOFactory.php');


			  // load excel
			  $load = PHPExcel_IOFactory::load($uploadfile);
			  $sheets = $load->getActiveSheet()->toArray(null,true,true,true);
			
			  $i = 1;
			  foreach ($sheets as $sheet) 
			  	{
			    // karena data yang di excel di mulai dari baris ke 2
			    // maka jika $i lebih dari 1 data akan di masukan ke database
			    if ($i > 1) 
			    	{
				      // nama ada di kolom A
				      // sedangkan alamat ada di kolom B
				      $i_xyz = md5("$x$i");
				      $i_no = cegah($sheet['A']);
				      $i_kode = cegah($sheet['B']);
				      $i_nama = cegah($sheet['C']);
				      $i_jabatan = cegah($sheet['D']);
					  $i_akses = balikin($i_kode);
					  $i_passx = md5($i_akses);
					  
						//cek
						$qcc = mysql_query("SELECT * FROM m_orang ".
												"WHERE nip = '$i_kode'");
						$rcc = mysql_fetch_assoc($qcc);
						$tcc = mysql_num_rows($qcc);
		
						//jika ada, update				
						if (!empty($tcc))
							{
							mysql_query("UPDATE m_orang SET nama = '$i_nama', ".
											"jabatan = '$i_kelas' ".
											"WHERE nip = '$i_kode'");
							}
		
		
						else
							{
							//insert
							mysql_query("INSERT INTO m_orang(kd, nip, nama, jabatan, usernamex, passwordx, postdate) VALUES ".
											"('$i_xyz', '$i_kode', '$i_nama', '$i_jabatan', '$i_akses', '$i_passx', '$today')");
							}
					  
				    }
			
			    $i++;
			  }





			//hapus file, jika telah import
			$path1 = "../../filebox/excel/$filex_namex2";
			chmod($path1,0777);
			unlink ($path1);


			//re-direct
			xloc($filenya);
			exit();
			}
		else
			{
			//salah
			$pesan = "Bukan File .xls . Harap Diperhatikan...!!";
			$ke = "$filenya?s=import";
			pekem($pesan,$ke);
			exit();
			}
		}
	}











//jika export
//export
if ($_POST['btnEX'])
	{
	//require
	require('../../inc/class/excel/OLEwriter.php');
	require('../../inc/class/excel/BIFFwriter.php');
	require('../../inc/class/excel/worksheet.php');
	require('../../inc/class/excel/workbook.php');


	//nama file e...
	$i_filename = "pegawai.xls";
	$i_judul = "Pegawai";
	



	//header file
	function HeaderingExcel($i_filename)
		{
		header("Content-type:application/vnd.ms-excel");
		header("Content-Disposition:attachment;filename=$i_filename");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
		header("Pragma: public");
		}

	
	
	
	//bikin...
	HeaderingExcel($i_filename);
	$workbook = new Workbook("-");
	$worksheet1 =& $workbook->add_worksheet($i_judul);
	$worksheet1->write_string(0,0,"NO.");
	$worksheet1->write_string(0,1,"NO_INDUK");
	$worksheet1->write_string(0,2,"NAMA");
	$worksheet1->write_string(0,3,"JABATAN");



	//data
	$qdt = mysql_query("SELECT * FROM m_orang ".
							"ORDER BY nama ASC");
	$rdt = mysql_fetch_assoc($qdt);

	do
		{
		//nilai
		$dt_nox = $dt_nox + 1;
		$dt_nip = balikin($rdt['nip']);
		$dt_nama = balikin($rdt['nama']);
		$dt_jabatan = balikin($rdt['jabatan']);



		//ciptakan
		$worksheet1->write_string($dt_nox,0,$dt_nox);
		$worksheet1->write_string($dt_nox,1,$dt_nip);
		$worksheet1->write_string($dt_nox,2,$dt_nama);
		$worksheet1->write_string($dt_nox,3,$dt_jabatan);
		}
	while ($rdt = mysql_fetch_assoc($qdt));


	//close
	$workbook->close();

	
	
	//re-direct
	xloc($filenya);
	exit();
	}













//nek batal
if ($_POST['btnBTL'])
	{
	//re-direct
	xloc($filenya);
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




//nek entri baru
if ($_POST['btnBARU'])
	{
	//re-direct
	$ke = "$filenya?s=baru&kd=$x";
	xloc($ke);
	exit();
	}










//nek pegawai : reset
if ($s == "reset")
	{ 
	//nilai
	$nilku = rand(1,5);
	
	//pass baru
	$passbarux = md5($nilku);
	
	
	//update
	mysql_query("UPDATE m_orang SET passwordx = '$passbarux' ".
					"WHERE kd = '$kd'"); 
	
	//re-direct
	$pesan = "Password Baru : $nilku";
	pekem($pesan,$filenya);
	exit();
	}










//nek pegawai : hardware kode
if ($s == "haid")
	{ 
	//update
	mysql_query("UPDATE m_orang SET hardware_kode = '' ".
					"WHERE kd = '$kd'"); 
	
	//re-direct
	$pesan = "HardWare Kode untuk HP Berhasil Dilakukan Reset";
	pekem($pesan,$filenya);
	exit();
	}




















//jika simpan
if ($_POST['btnSMP'])
	{
	$s = nosql($_POST['s']);
	$kd = nosql($_POST['kd']);
	$page = nosql($_POST['page']);
	$e_nip = cegah($_POST['e_nip']);
	$e_nama = cegah($_POST['e_nama']);
	$e_jabatan = cegah($_POST['e_jabatan']);

	$namabaru = "$kd-1.jpg";



	//nek null
	if ((empty($e_nip)) OR (empty($e_nama)) OR (empty($e_jabatan)))
		{
		//re-direct
		$pesan = "Belum Ditulis. Harap Diulangi...!!";
		$ke = "$filenya?s=$s&kd=$kd";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//set akses 
		$aksesnya = $e_nip;
		$passx = md5($aksesnya);
		
		
		
		//jika update
		if ($s == "edit")
			{
			mysql_query("UPDATE m_orang SET nip = '$e_nip', ".
							"nama = '$e_nama', ".
							"jabatan = '$e_jabatan', ".
							"usernamex = '$aksesnya', ".
							"passwordx = '$passx' ".
							"WHERE kd = '$kd'");

			//update
			mysql_query("UPDATE m_orang SET filex1 = '$namabaru', ".
							"postdate = '$today' ".
							"WHERE kd = '$kd'");

			//re-direct
			xloc($filenya);
			exit();
			}



		//jika baru
		if ($s == "baru")
			{
			//cek
			$qcc = mysql_query("SELECT * FROM m_orang ".
									"WHERE nip = '$e_nip'");
			$rcc = mysql_fetch_assoc($qcc);
			$tcc = mysql_num_rows($qcc);

			//nek ada
			if ($tcc != 0)
				{
				//re-direct
				$pesan = "Sudah Ada. Silahkan Ganti Yang Lain...!!";
				$ke = "$filenya?s=baru&kd=$kd";
				pekem($pesan,$ke);
				exit();
				}
			else
				{
				mysql_query("INSERT INTO m_orang(kd, nip, nama, jabatan, usernamex, passwordx, postdate) VALUES ".
								"('$kd', '$e_nip', '$e_nama', '$e_jabatan', '$aksesnya', '$passx', '$today')");

								
				//update
				mysql_query("UPDATE m_orang SET filex1 = '$namabaru', ".
								"postdate = '$today' ".
								"WHERE kd = '$kd'");
											

				//re-direct
				xloc($filenya);
				exit();
				}
			}
		}
	}




//jika hapus
if ($_POST['btnHPS'])
	{
	//ambil nilai
	$jml = nosql($_POST['jml']);
	$page = nosql($_POST['page']);
	$ke = "$filenya?page=$page";

	//ambil semua
	for ($i=1; $i<=$jml;$i++)
		{
		//ambil nilai
		$yuk = "item";
		$yuhu = "$yuk$i";
		$kd = nosql($_POST["$yuhu"]);

		//del
		mysql_query("DELETE FROM m_orang ".
						"WHERE kd = '$kd'");
		}

	//auto-kembali
	xloc($filenya);
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
//jika edit / baru
if (($s == "baru") OR ($s == "edit"))
	{
	$kdx = nosql($_REQUEST['kd']);

	$qx = mysql_query("SELECT * FROM m_orang ".
						"WHERE kd = '$kdx'");
	$rowx = mysql_fetch_assoc($qx);
	$e_nip = balikin($rowx['nip']);
	$e_nama = balikin($rowx['nama']);
	$e_jabatan = balikin($rowx['jabatan']);
	$e_filex1 = balikin($rowx['filex1']);


	$namabaru = "$kdx-1.jpg";



	//update
	mysql_query("UPDATE m_orang SET filex1 = '$namabaru', ".
					"postdate = '$today' ".
					"WHERE kd = '$kdx'");




	//jika edit / baru
	//nek null foto
	if (empty($e_filex1))
		{
		$nil_foto = "$sumber/template/img/bg-black.png";
		}
	else
		{
		$nil_foto = "$sumber/filebox/pegawai/$kd/$e_filex1";
		}
		
			?>
	
	
	
	<div class="row">

	<div class="col-md-6">
		
	<?php
	echo '<form action="'.$filenya.'" method="post" name="formx2">
	
	
	<p>
	Nomor Induk : 
	<br>
	<input name="e_nip" type="text" value="'.$e_nip.'" size="10" class="btn-warning">
	</p>
	
	
	
	<p>
	Nama : 
	<br>
	<input name="e_nama" type="text" value="'.$e_nama.'" size="30" class="btn-warning">
	</p>
	
	
	<p>
	Jabatan : 
	<br>
	<input name="e_jabatan" type="text" value="'.$e_jabatan.'" size="10" class="btn-warning">
	</p>
	
	
	<p>
	<input name="jml" type="hidden" value="'.$count.'">
	<input name="s" type="hidden" value="'.$s.'">
	<input name="kd" type="hidden" value="'.$kdx.'">
	<input name="page" type="hidden" value="'.$page.'">
	
	<input name="btnSMP" type="submit" value="SIMPAN" class="btn btn-danger">
	<input name="btnBTL" type="submit" value="BATAL" class="btn btn-info">
	</p>
	
	
	</form>';
	
	?>
		
	
	
	</div>
	
	<div class="col-md-6">
	

	
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  


	<style type="text/css">
	.thumb-image{
	 float:left;
	 width:150px;
	 height:150px;
	 position:relative;
	 padding:5px;
	}
	</style>
	
	
	
	
		<table border="0" cellspacing="0" cellpadding="3">
		<tr valign="top">
		<td width="100">
			<div id="image-holder"></div>
		</td>
		

		</tr>
		</table>
	
	<script>
	$(document).ready(function() {
		
		
	        $("#image_upload").on('change', function() {
	          //Get count of selected files
	          var countFiles = $(this)[0].files.length;
	          var imgPath = $(this)[0].value;
	          var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
	          var image_holder = $("#image-holder");
	          image_holder.empty();
	          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
	            if (typeof(FileReader) != "undefined") {
	              //loop for each file selected for uploaded.
	              for (var i = 0; i < countFiles; i++) 
	              {
	                var reader = new FileReader();
	                reader.onload = function(e) {
	                  $("<img />", {
	                    "src": e.target.result,
	                    "class": "thumb-image"
	                  }).appendTo(image_holder);
	                }
	                image_holder.show();
	                reader.readAsDataURL($(this)[0].files[i]);
	              }
	              
	
		    
	            } else {
	              alert("This browser does not support FileReader.");
	            }
	          } else {
	            alert("Pls select only images");
	          }
	        });
	        
	        


	        
	        
	        
	      });
	</script>

	<?php
	echo '<div id="loading" style="display:none">
	<img src="'.$sumber.'/template/img/progress-bar.gif" width="100" height="16">
	</div>
	
	
   <form method="post" id="upload_image" enctype="multipart/form-data">
	<input type="file" name="image_upload" id="image_upload" class="btn btn-warning" />

   </form>
   
   <hr>';
	
	?>
	
	
	<script>  
	$(document).ready(function(){
		
		
		
	       $('#image-holder').load("<?php echo $sumber;?>/adm/s/i_pegawai.php?aksi=lihat1&kd=<?php echo $kd;?>");

	
	
	        
	    $('#upload_image').on('change', function(event){
	     event.preventDefault();
	     
			$('#loading').show();
	
	
		
		     $.ajax({
		      url:"i_pegawai_upload.php?kd=<?php echo $kd;?>",
		      method:"POST",
		      data:new FormData(this),
		      contentType:false,
		      cache:false,
		      processData:false,
		      success:function(data){
				$('#loading').hide();
		       $('#preview').load("<?php echo $sumber;?>/adm/s/i_pegawai.php?aksi=lihat&kd=<?php echo $kd;?>");
		       	
		      }
		     })
		    });
		    
		    
	});  
	</script>




	</div>
	
	</div>


	<?php
	}
	









//jika import
else if ($s == "import")
	{
	?>
	<div class="row">

	<div class="col-md-12">
		
	<?php
	echo '<form action="'.$filenya.'" method="post" enctype="multipart/form-data" name="formxx2">
	<p>
		<input name="filex_xls" type="file" size="30" class="btn btn-warning">
	</p>

	<p>
		<input name="btnBTL" type="submit" value="BATAL" class="btn btn-info">
		<input name="btnIMX" type="submit" value="IMPORT >>" class="btn btn-danger">
	</p>
	
	
	</form>';	
	?>
		


	</div>
	
	</div>


	<?php
	}















//jika ketahui map terakhir
else if ($s == "mapnya")
	{
	?>
	<div class="row">

	<div class="col-md-12">
		

	<?php
	//ketahui
	$kdx = nosql($_REQUEST['kd']);

	//orang
	$qx = mysql_query("SELECT * FROM m_orang ".
						"WHERE kd = '$kdx'");
	$rowx = mysql_fetch_assoc($qx);
	$e_nip = balikin($rowx['nip']);
	$e_nama = balikin($rowx['nama']);
	$e_jabatan = balikin($rowx['jabatan']);


	//detail peta
	$qx = mysql_query("SELECT * FROM orang_lokasi ".
						"WHERE orang_kd = '$kdx'");
	$rowx = mysql_fetch_assoc($qx);
	$e_status = balikin($rowx['status']);
	$e_latx = balikin($rowx['lat_x']);
	$e_laty = balikin($rowx['lat_y']);
	$e_alamat = balikin($rowx['alamat']);


    $latitude = $e_latx;
    $longitude = $e_laty;

	$lat = $e_latx;
	$long = $e_laty; 

		
	
	echo "<a href='$filenya' class='btn btn-danger'>LIHAT DAFTAR LAINNYA</a>
	<hr>
	<p>
	[$e_nip. $e_nama]. [$e_jabatan].
	</p>
	
	<p>
	<hr>
	KOORDINAT : <b>[$latitude]. [$longitude].</b>
	<br>
	
	<i>$e_alamat</i> 
	<hr>
	</p>
	
	<p>
	STATUS : <b>PRESENSI $e_status</b>
	</p>"; 
	?>


		
		<style>
		  #map {
		    height: 100%;
		  }
		</style>
		
		  <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&&callback=initMap&key=<?php echo $keyku;?>"></script>
		
		
		
		
		
		<style>
		 #map-canvas {
		        width: 100%;
		        height: 400px;
		        margin: 0px;
		        padding: 0px
		      }
		    </style>
		    <script>
		var map;
		function initialize() {
		        var myLatLng = {lat: <?php echo $latitude;?>, lng: <?php echo $longitude;?>};
		
		        var map = new google.maps.Map(document.getElementById('map-canvas'), {
		          zoom: 16,
		          center: myLatLng
		        });
		
		        var marker = new google.maps.Marker({
		          position: myLatLng,
		          map: map,
		          title: '<?php echo $ku_nama;?>'
		        });
		
		}
		
		google.maps.event.addDomListener(window, 'load', initialize);
		
		    </script>
		    <div id="map-canvas"></div>
		


	</div>
	
	</div>


	<?php
	}














else
	{
	//jika null
	if (empty($kunci))
		{
		$sqlcount = "SELECT * FROM m_orang ".
						"ORDER BY nama ASC";
		}
		
	else
		{
		$sqlcount = "SELECT * FROM m_orang ".
						"WHERE nip LIKE '%$kunci%' ".
						"OR nama LIKE '%$kunci%' ".
						"OR jabatan LIKE '%$kunci%' ".
						"ORDER BY nama ASC";
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
	
	
	
	echo '<form action="'.$filenya.'" method="post" name="formxx">
	<p>
	<input name="btnBARU" type="submit" value="ENTRI BARU" class="btn btn-danger">
	<input name="btnIM" type="submit" value="IMPORT" class="btn btn-primary">
	<input name="btnEX" type="submit" value="EXPORT" class="btn btn-success">
	</p>
	<br>
	
	</form>



	<form action="'.$filenya.'" method="post" name="formx">
	<p>
	<input name="kunci" type="text" value="'.$kunci2.'" size="20" class="btn btn-warning" placeholder="Kata Kunci...">
	<input name="btnCARI" type="submit" value="CARI" class="btn btn-danger">
	<input name="btnBTL" type="submit" value="RESET" class="btn btn-info">
	</p>
		
	
	<div class="table-responsive">          
	<table class="table" border="1">
	<thead>
	
	<tr valign="top" bgcolor="'.$warnaheader.'">
	<td width="20">&nbsp;</td>
	<td width="20">&nbsp;</td>
	<td width="50"><strong><font color="'.$warnatext.'">NOMOR INDUK</font></strong></td>
	<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
	<td width="150"><strong><font color="'.$warnatext.'">IMAGE</font></strong></td>
	<td width="150"><strong><font color="'.$warnatext.'">JABATAN</font></strong></td>
	
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
			$i_kode = balikin($data['nip']);
			$i_nama = balikin($data['nama']);
			$i_jabatan = balikin($data['jabatan']);
			$i_haid = balikin($data['hardware_kode']);
			$i_filex1 = balikin($data['filex1']);
			$i_akses = $i_kode;
	
	
			$nil_foto1 = "$sumber/filebox/pegawai/$i_kd/$i_filex1";

			
			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			<input type="checkbox" name="item'.$nomer.'" value="'.$i_kd.'">
	        </td>
			<td>
			<a href="'.$filenya.'?s=edit&page='.$page.'&kd='.$i_kd.'"><img src="'.$sumber.'/template/img/edit.gif" width="16" height="16" border="0"></a>
			</td>
			<td>'.$i_kode.'</td>
			<td>
			'.$i_nama.'
			
			<hr>
			<a href="'.$filenya.'?s=reset&kd='.$i_kd.'" class="btn btn-primary">RESET PASSWORD >></a>

			<a href="'.$filenya.'?s=haid&kd='.$i_kd.'" class="btn btn-danger">Hardware Kode : '.$i_haid.'. RESET >></a>

			<a href="'.$filenya.'?s=mapnya&kd='.$i_kd.'" class="btn btn-success">LOKASI TERAKHIR >></a>
			
			</td>
			<td>
			
			<img src="'.$nil_foto1.'" width="150">
			
			</td>

			<td>'.$i_jabatan.'</td>
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
	
	<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$count.')" class="btn btn-primary">
	<input name="btnBTL" type="reset" value="BATAL" class="btn btn-warning">
	<input name="btnHPS" type="submit" value="HAPUS" class="btn btn-danger">
	</td>
	</tr>
	</table>
	</form>';
	}








//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//null-kan
xclose($koneksi);
exit();
?>