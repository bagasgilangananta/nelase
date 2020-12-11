<?php
session_start();
include 'conf/koneksi.php';
if (!empty($_SESSION['username'])){
	
	if($_SESSION['peran'] == "konsumen"){
		header('location: dashboard.php');
	}
}else{
	header('location: login.php');
}
$getUserLogin = $koneksi->query("SELECT * FROM pengguna where username='".$_SESSION['username']."'")->fetch_assoc();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Nelase</title>
	<link rel="stylesheet" href="style.css">
	<style>
	table, th, td {
  border: 1px solid black;
}
#beli{
	position: relative;
    /*z-index: 1;*/
    background: rgba(255, 255, 255, 0.8);
    max-width: 360px;
    margin: 0 auto 100px;
    padding: 75px 45px 45px;
    text-align: center;
    border-radius: 30px;
    height: auto;
    background-color: #f2f2f2;
}
#beli input, textarea ,b{
	font-family: sans-serif;
    outline: 1;
    background-color: white;
    width: 100%;
    border: 0;
    margin: 0 0 15px;
    padding: 15px;
    box-sizing: border-box;
    font-size: 13px;
    color: rgb(84, 84, 87);
    border-radius: 5px;
}
.tombolbeli{

    font-family: sans-serif;
    text-transform: uppercase;
    outline: 0;
    background: #34a4eb;
    width: 100%;
    border: 0;
    padding: 15px;
    color: #fff;
    cursor: pointer;
    border-radius: 4px;
  }
  
  .tombolbeli input:hover,
  .tombolbeli input:active{
    background: #43a047;
  }
 
	</style>
</head>
<body>
	<div class="wrapper" >
  <nav>
 <a href="logout.php">Logout</a> 
   <a href="tentang_kami.php">Tentang Kami</a>
<a href="pesanan.php">Lihat Pesanan</a>

   <a href="#">Beranda</a> 
   <h3>Nelase</h3>
  </nav>
  <main>
     <div class="Fitur">
      <h1 >Pesanan Ikan</h1>
   </div>
  
      
	  <br/><br/>
	
	<form>
	</form>
	<table id="tblrs" style="margin-left:10%;margin-right:10%;width:80%">
	<tr>
				<th>Pembeli</th>
			<th>Kontak Pembeli</th>
	<th>Ikan</th>
	<th>Jumlah</th>
	<th>Total</th>
	<th>Alamat</th>
	<th>Tanggal Pesanan Masuk</th>
	</tr>
	<?php
		$q = $koneksi->query("SELECT * FROM transaksi where id_penjual='".$getUserLogin['id']."'");
		while($r = $q->fetch_assoc()){
			echo "<tr>";
							echo "<td>".$koneksi->query("SELECT username FROM pengguna where id='".$r['id_pembeli']."'")->fetch_assoc()['username']."</td>";
				echo "<td>".$koneksi->query("SELECT nohp FROM pengguna where id='".$r['id_pembeli']."'")->fetch_assoc()['nohp']."</td>";
			echo "<td>".$koneksi->query("SELECT jenis_ikan FROM ikan where id='".$r['id_ikan']."'")->fetch_assoc()['jenis_ikan']."</td>";
			echo "<td>".$r['jumlah']."</td>";
			echo "<td>".$r['total']."</td>";
			echo "<td>".$r['alamat']."</td>";
			echo "<td>".$r['tanggal_pembelian']."</td>";
			echo "</tr>";
		}
	?>
	</table>
	<br/>
	<br/>
		<?php
			if(isset($_POST['submit'])){
				$q = $koneksi->query("INSERT INTO transaksi (id_pembeli, id_ikan, jumlah, total, alamat, tanggal_pembelian) values ('".$getUserLogin['id']."', '".$_POST['id']."', '".$_POST['jml']."', '".$_POST['harga']*$_POST['jml']."', '".$_POST['alamat']."', CURRENT_TIMESTAMP)");
				if ($q){
					$koneksi->query("UPDATE ikan set berat_ikan=berat_ikan-'".$_POST['jml']."' where id='".$_POST['id']."'");
					header('location: dashboard.php');
				}else{
					echo $koneksi->error;
				}
			}
		?>
	</div>
<footer style="position: fixed;">
  <p>
    Nelase, Copyright @2020.
  </p>
</footer>
   </main>

 </div>
 
</body>
</html>