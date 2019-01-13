<?php
$secret_key = "6LdHT4kUAAAAAAq3crrEdT05140l0lvDSuaq8340";
$verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);$response = json_decode($verify);
$response = json_decode($verify);

	
			mysql_connect("localhost", "root", "");
			mysql_select_db("guestbook");
 
			$nama	= htmlentities(mysql_real_escape_string($_POST['nama']));
			$email	= htmlentities(mysql_real_escape_string($_POST['email']));
			$pesan	= htmlentities(mysql_real_escape_string($_POST['pesan']));
			$tgl	= time();
 
		if($response->success)
			{
				if($nama && $email && $pesan){
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
					$in = mysql_query("INSERT INTO bukutamu VALUES(NULL, '$tgl', '$nama', '$email', '$pesan')");
					if($in){
						echo '<script language="javascript">alert("Terima kasih, data Anda berhasil disimpan"); document.location="index.php";</script>';
					}else{
						echo '<div id="error">Uppsss...! Query ke database gagal dilakukan!</div>';
					}
				}else{
					echo '<div id="error">Uppsss...! Email Anda tidak valid!</div>';
				}
			}else{
				echo '<div id="error">Uppsss...! Lengkapi form!</div>';
			}
			}
	
else {
				echo "<h2>pesan anda tidak terkirim</h2>";
				echo "<a href=index.php>kembali ke awal";
		}
		
		?>