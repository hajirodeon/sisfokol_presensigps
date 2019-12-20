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
$filenya = "profil.php";
$judul = "[SETTING]. Profil";
$judulku = "$judul";













//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//simpan
if ($_POST['btnSMP2'])
	{
	//re-direct
	xloc($filenya);
	}
	
	
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







//isi *START
ob_start();






     	
echo '<form action="'.$filenya.'" method="post" name="formx">';


//detail
$qku = mysql_query("SELECT * FROM a_profil");
$rku = mysql_fetch_assoc($qku);
$kdx = nosql($rku['kd']);
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
$ku_lat_x = balikin($rku['lat_x']);
$ku_lat_y = balikin($rku['lat_y']);



//jika belum ada, berikan yang dari google map
if ((empty($ku_lat_x)) OR (empty($ku_lat_y)))
	{
	$e_lat_x = "-7.5488485";
	$e_lat_y = "111.6486598";
	}
else
	{
	$e_lat_x = $ku_lat_x;
	$e_lat_y = $ku_lat_y;
	}




$diload = "peta_awal(18);setpeta('$e_lat_x','$e_lat_y','$kdx',18)";


echo '<div class="row">

<div class="col-3">
<img src="'.$sumber.'/img/logo.png" width="100">

<hr>



</div>


<div class="col-9">

<h3>PETA SEKOLAH</h3>';

echo '<form action="'.$filenya.'" method="post" name="formx2">';
?>



	<script type="text/javascript" src="<?php echo $sumber;?>/inc/js/jquery.js"></script>

  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&&callback=initMap&key=<?php echo $keyku;?>"></script>

	<script type="text/javascript" src="<?php echo $sumber;?>/inc/js/gmap3.js"></script>
	<script type="text/javascript">
	var peta;
	var dataku;

	function peta_awal(zoomnya){
	var indonesia = new google.maps.LatLng(<?php echo $e_lat_x;?>, <?php echo $e_lat_y;?>);
	var petaoption = {
		zoom: zoomnya,
		center: indonesia,
		mapTypeId: google.maps.MapTypeId.HYBRID
		};
	peta = new google.maps.Map(document.getElementById("petaku"),petaoption);
	google.maps.event.addListener(peta,'click',function(event){
		kasihtanda(event.latLng);
	});
	}

	function kasihtanda(lokasi, dataku){
	$("#cx").val(lokasi.lat());
	$("#cy").val(lokasi.lng());


	tanda.setMap(null);
	
        $.ajax({
            type : 'POST',
            url : 'i_xy.php',
            data: {
                nilx : $('#cx').val(),
                nily : $('#cy').val(),
                lokkd : $('#dataku').val()
            },
            success:function (data) {
                $("#testku").append(data);

            }
        });



	tanda = new google.maps.Marker({
		position: lokasi,
		map: peta
		});
		
	
	tanda.setMap(peta);
	}



	function setpeta(x,y,id,zoomnya){
	var lokasibaru = new google.maps.LatLng(x,y);
	var petaoption = {
		zoom: zoomnya,
		center: lokasibaru,
		mapTypeId: google.maps.MapTypeId.HYBRID
		};
	peta = new google.maps.Map(document.getElementById("petaku"),petaoption);
	tanda = new google.maps.Marker({
		position: lokasibaru,
		map: peta
	});
	var idnya = "#"+id;
	var isistring = "<?php echo $e_nama;?>";
	var infowindow = new google.maps.InfoWindow({
		content: isistring
	});






	google.maps.event.addListener(tanda, 'click', function() {
	infowindow.open(peta,tanda);
	});
	google.maps.event.addListener(peta,'click',function(event){
		kasihtanda(event.latLng);
	});





	var cluster1 = [

	<?php
	//data di database
	$qdt = mysql_query("SELECT * FROM a_profil ".
							"ORDER BY postdate ASC");
	$rdt = mysql_fetch_assoc($qdt);
	$tdt = mysql_num_rows($qdt);


	//jika gak null
	if ($tdt != 0)
		{
		do
			{
			$dt_x = balikin($rdt['lat_x']);
			$dt_y = balikin($rdt['lat_y']);

			echo 'new google.maps.LatLng('.$dt_x.', '.$dt_y.'), ';
			}
		while ($rdt = mysql_fetch_assoc($qdt));
		}
	?>
	];

	var p1 = new google.maps.Polygon({
	map: peta,
	path: cluster1,
	strokeColor: "#FF0000",
	strokeOpacity: 0.8,
	strokeWeight: 2,
	fillColor: "#FF0000",
	fillOpacity: 0.35
	});
	}



	</script>



	<div id="petaku" style="width:100%; height:600px"></div>

	<input type="hidden" name="lat_x" id="cx" size="25" value="<?php echo $e_lat_x;?>">
	<input type="hidden" name="lat_y" id="cy" size="25" value="<?php echo $e_lat_y;?>">
	<input name="dataku" id="dataku" type="hidden" value="<?php echo $kdx;?>">
	<div class="testku" id="testku"></div>


	<img src="<?php echo $sumber;?>/img/wait.gif" style="display:none" id="loading">


<br>
<p>
<input name="btnSMP2" type="submit" value="SIMPAN >>" class="btn btn-block btn-danger">
</p>


</form>







</div>


</div>



<?php
//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");

//diskonek
xfree($qbw);
xclose($koneksi);
exit();
?>