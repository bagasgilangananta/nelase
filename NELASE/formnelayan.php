<?php
include 'conf/koneksi.php';
session_start();
if (empty($_SESSION['username'])){
	header('location: login.php');
}else{
	if($_SESSION['peran'] == "konsumen"){
		header('location: dashboard-konsumen.php');
	}
}

$userInfo = $koneksi->query("SELECT * FROM pengguna where username='".$_SESSION['username']."' LIMIT 1")->fetch_assoc();
?>
<html>
<head>
	<title>data ikan</title>
	<link href="stylenelayan.css" rel="stylesheet"/>
</head>
<body>
	<div class="nav">
	<h1 style="text-align: center; padding-top: 25px">Jual Ikan</h1>
	</div>
<div class="wrapper">
	<form action="" method="POST">
		<label for="jenis">Jenis Ikan</label><br/>
 		<input type="text" name="ikan" class="form" required/><br/>			
		<label for="berat">Berat Ikan (kg)</label><br/>
		<input type="text" name="berat" class="form" required/><br/>
		<label for="harga">Harga Ikan (rp/kg)</label><br/>
		<input type="text" name="harga" class="form" required/><br/>
		<label for="alamat">Alamat Lengkap</label><br/>
		<textarea class="form" name="alamat" required></textarea><br/>
		<input type="submit" name="submit" id="tombol1" value="SUBMIT">
	</form>
	<a href="dashboard.php"><button class="tombol">Kembali</button></a>
	<br/><br/>
<?php
	if(isset($_POST['submit'])){
		$q = $koneksi->query("INSERT INTO ikan (id_penjual, jenis_ikan, berat_ikan, harga_ikan, alamat, tanggal_input) values ('".$userInfo['id']."', '".$_POST['ikan']."', '".$_POST['berat']."', '".$_POST['harga']."', '".$_POST['alamat']."', CURRENT_TIMESTAMP)");
		if($q){
			echo"Sukses menginput ikan";
		}else{
			echo"Gagal menginput ikan";
		}
	}
	?>
</div>
</body>
</html>