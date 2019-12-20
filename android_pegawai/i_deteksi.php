<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;

//nilai
$filenya = "$sumber/android_pegawai/i_deteksi.php";
$filenyax = "$sumber/android_pegawai/i_deteksi.php";
$judul = "Deteksi Hardware";
$juduli = $judul;



//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];
$passx = $_SESSION['passx'];





//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika deteksi
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'deteksi'))
	{
	//ambil nilai
	$hkode = cegah($_GET["hkode"]);
	
	
	//update ke data lokasi
	mysql_query("UPDATE orang_lokasi SET hardware_kode = '$hkode' ".
					"WHERE orang_kd = '$sesiku'");
	
	
	
	
	//deteksi, udah ada yang punya ato belum...
	$q = mysql_query("SELECT * FROM m_orang ".
						"WHERE hardware_kode = '$hkode'");
	$row = mysql_fetch_assoc($q);
	$total = mysql_num_rows($q);

	//cek
	if (empty($total))
		{
		//kasi kode
		mysql_query("UPDATE m_orang SET hardware_kode = '$hkode' ".
						"WHERE kd = '$sesiku'");
		}
		



	//jika login, harus sama...
	if (!empty($passx))
		{
		//query
		$q = mysql_query("SELECT * FROM m_orang ".
							"WHERE kd = '$sesiku' ".
							"AND hardware_kode = '$hkode'");
		$row = mysql_fetch_assoc($q);
		$total = mysql_num_rows($q);
	
		//jika salah
		if (empty($total))
			{
			//re-direct
			?>
			
			<script language='javascript'>
			//membuat document jquery
			$(document).ready(function(){
					window.location.href = "deteksi.html"; 
			
			});
			
			</script>
			
			<?php
			}
		
		
			
		}
	 
	 
	
	exit();
	}








//jika form
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'form'))
	{
	?>


	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
	
		$("#btnKRM").on('click', function(){
			$("#formx2").submit(function(){
				$.ajax({
					url: "<?php echo $filenyax;?>?aksi=simpan",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#ihasil").html(data);
						}
					});
				return false;
			});
		
		
		});	
	
	
	});
	
	</script>


	
	<br>
			
	<table width="100%" border="0" cellpadding="5" cellspacing="5">
	<tr align="top">
		
	<td width="10">&nbsp;</td>
	<td valign="top">
	
	<div id="ihasil"></div>
	<form name="formx2" id="formx2">
	<p>Password Lama : <br>
	<input name="passlama" id="passlama" type="password" class="btn btn-block btn-success">
	</p>
	<p>Password Baru : <br>
	<input name="passbaru" id="passbaru" type="password" class="btn btn-block btn-success">
	</p>
	<p>RE-Password Baru : <br>
	<input name="passbaru2" id="passbaru2" type="password" class="btn btn-block btn-success">
	</p>
	<p>
	<input name="btnKRM" id="btnKRM" type="submit" value="SIMPAN" class="btn btn-block btn-danger">
	</p>
	</form>


	</td>
	
	<td width="10">&nbsp;</td>
	</tr>
	</table>

	<?php
	
	exit();
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>