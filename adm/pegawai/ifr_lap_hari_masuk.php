<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");

nocache;

//nilai
$filenya = "ifr_lap_hari_masuk.php";
$judul = "Laporan per Tanggal";
$judulku = "$judul";
$judulx = $judul;
$utgl = nosql($_REQUEST['utgl']);
$ubln = nosql($_REQUEST['ubln']);
$uthn = nosql($_REQUEST['uthn']);




//terpilih
$qku = mysql_query("SELECT * FROM a_profil");
$rku = mysql_fetch_assoc($qku);
$ku_judul = balikin($rku['judul']);
$ku_isi = balikin($rku['isi']);
$ku_web = balikin($rku['web']);
$ku_email = balikin($rku['email']);
$ku_alamat = balikin($rku['alamat']);
$ku_alamat2 = balikin($rku['alamat_googlemap']);
$ku_telp = balikin($rku['telp']);
$ku_fax = balikin($rku['fax']);
$ku_fb = balikin($rku['fb']);
$ku_twitter = balikin($rku['twitter']);
$ku_youtube = balikin($rku['youtube']);
$ku_wa = balikin($rku['wa']);
$ku_instagram = balikin($rku['instagram']);
$ku_latx = balikin($rku['lat_x']);
$ku_laty = balikin($rku['lat_y']);



$datax_lat = $ku_laty;
$datax_long = $ku_latx; 




$jml_detik = "60000";
$ke = "$filenya?utgl=$utgl&ubln=$ubln&uthn=$uthn";
?>




<style>
  html, body, #map-canvas {
    height: 500;
    width: 100%;
    margin: 0px;
    padding: 0px
  }
</style>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&key=<?php echo $keyku;?>"></script>

<script src="../../template/js/maplabel.js"></script>



		<script>
		
		function initialize() {
		  var mapOptions = {
		    zoom: 20,
		    center: new google.maps.LatLng(<?php echo $datax_long;?>, <?php echo $datax_lat;?>),
		
		    mapTypeId: google.maps.MapTypeId.HYBRID
		  };
		
		  var map = new google.maps.Map(document.getElementById('map-canvas'),
		      mapOptions);
		
		
		        var bounds = new google.maps.LatLngBounds();
		
			var infowindow = null;
		  
		  infowindow = new google.maps.InfoWindow({
			content: "holding..."
			});
		
		
		
		
		
		
		<?php

		//ketahui 
		$qdatai = mysql_query("SELECT DISTINCT(orang_kd) AS kdnya ".
								"FROM orang_lokasi ".
								"WHERE status = 'MASUK' ".
								"AND round(DATE_FORMAT(postdate, '%d')) = '$utgl' ".
								"AND round(DATE_FORMAT(postdate, '%m')) = '$ubln' ".
								"AND round(DATE_FORMAT(postdate, '%Y')) = '$uthn' ".
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
									"AND round(DATE_FORMAT(postdate, '%d')) = '$utgl' ".
									"AND round(DATE_FORMAT(postdate, '%m')) = '$ubln' ".
									"AND round(DATE_FORMAT(postdate, '%Y')) = '$uthn' ".
									"ORDER BY postdate DESC");
			$ryuk = mysql_fetch_assoc($qyuk);
			$yuk_jamnama = balikin($ryuk['orang_nama']);
			$x_long = balikin($ryuk['lat_x']);
			$x_lat = balikin($ryuk['lat_y']);
		
		
		
		
			?>
		
		
		
		 var mapLabel<?php echo $ikdi;?> = new MapLabel({
		          text: '<?php echo $yuk_jamnama;?>',
		          position: new google.maps.LatLng(<?php echo $x_long;?>,<?php echo $x_lat;?>),
		          map: map,
		          fontSize: 10,
		          align: 'center'
		        });
		        mapLabel<?php echo $ikdi;?>.set('position', new google.maps.LatLng(<?php echo $x_long;?>,<?php echo $x_lat;?>));
		
		        var marker<?php echo $ikdi;?> = new google.maps.Marker();
		        marker<?php echo $ikdi;?>.bindTo('map', mapLabel<?php echo $ikdi;?>);
		        marker<?php echo $ikdi;?>.bindTo('position', mapLabel<?php echo $ikdi;?>);
		        marker<?php echo $ikdi;?>.setDraggable(false);
		        
		        
		        
		
		

			<?php
				}
			while ($rdatai = mysql_fetch_assoc($qdatai));

			?>





        


			  
			}
			
			
			
			google.maps.event.addDomListener(window, 'load', initialize);
			
			  
			</script>
	




	
<div id="map-canvas"></div>
		
		
		
<script>setTimeout("location.href='<?php echo $ke;?>'", <?php echo $jml_detik;?>);</script>

<?php
exit();
?>
