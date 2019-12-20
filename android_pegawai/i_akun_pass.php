<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;

//nilai
$filenya = "$sumber/android_pegawai/i_akun_pass.php";
$filenyax = "$sumber/android_pegawai/i_akun_pass.php";
$judul = "Ganti Password";
$juduli = $judul;



//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];





//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika simpan
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'simpan'))
	{
	//ambil nilai
	$passlama = md5(cegah($_GET["passlama"]));
	$passbaru = md5(cegah($_GET["passbaru"]));
	$passbaru2 = md5(cegah($_GET["passbaru2"]));

	//cek
	//nek null
	if ((empty($passlama)) OR (empty($passbaru)) OR (empty($passbaru2)))
		{
		//pesan
		echo "<font color=red><b>Input Tidak Lengkap. Harap Diulangi...!!</b></font>";
		exit();
		}

	//nek pass baru gak sama
	else if ($passbaru != $passbaru2)
		{
		//pesan
		echo "<font color=red><b>Password Baru Tidak Sama. Harap Diulangi...!!</b></font>";
		exit();
		}
	else
		{
		//query
		$q = mysql_query("SELECT * FROM m_orang ".
							"WHERE kd = '$sesiku' ".
							"AND passwordx = '$passlama'");
		$row = mysql_fetch_assoc($q);
		$total = mysql_num_rows($q);

		//cek
		if ($total != 0)
			{
			//perintah SQL
			mysql_query("UPDATE m_orang SET passwordx = '$passbaru' ".
							"WHERE kd = '$sesiku'");

			//pesan
			echo "<font color=red><b>PASSWORD BERHASIL DIGANTI.</b></font>";
			exit();
			}
		else
			{
			//pesan
			echo "<font color=red><b>PASSWORD LAMA TIDAK COCOK. HARAP DIULANGI...!!!</b></font>";
			exit();
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