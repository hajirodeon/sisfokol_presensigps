<form action="" method="post">
<p>
email tujuan : 
<br>
<input name="tujuan" id="tujuan" type="text" value="hajirodeon@yahoo.com">
</p>


<p>
judul : 
<br>
<input name="judul" id="judul" type="text" value="coba email">
</p>


<p>
isi email :  
<br>
<input name="isi" id="isi" type="text" value="isi email ya...">
</p>


<p>

<button type="submit" name="submit">KIRIM EMAIL</button>
</p>

</form>

<?php
require_once('function.php');


if(isset($_POST['submit']))
	{
	//ambil nilai
	$tujuan = $_POST['tujuan'];
	$judul = $_POST['judul'];
	$isi = $_POST['isi'];
	
	
    $to       = $tujuan;
    $subject  = $judul;
    $message  = $isi;
    smtp_mail($to, $subject, $message, '', '', 0, 0, true);
    
    /*
      jika menggunakan fungsi mail biasa : mail($to, $subject, $message);
      dapat juga menggunakan fungsi smtp secara dasar : smtp_mail($to, $subject, $message);
      jangan lupa melakukan konfigurasi pada file function.php
    */
	}
?>
