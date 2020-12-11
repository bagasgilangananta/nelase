<?php
session_start();
if (empty($_SESSION['username'])){
	header('location: login.php');
}
include 'conf/koneksi.php';
$getUserLogin = $koneksi->query("SELECT * FROM pengguna where username='".$_SESSION['username']."'")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Nelase</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style>
		table, th, td {
  border: 1px solid black;
}
	</style>
</head>
<body>
	<div class="wrapper">
  <nav>
  <a href="logout.php">Logout</a> 
   <a href="tentang_kami.php">Tentang Kami</a>
   <?php 
			if($_SESSION['peran'] == "konsumen"){
				echo '   <a href="beliikan.php">Beli Ikan</a>';
			}else{
				echo '	<a href="pesanan.php">Lihat Pesanan</a> ';
			}
				?>
   <a href="index.php">Beranda</a> 
   <h3>Nelase</h3>
  </nav>
  <main>
   </main>
   <div class="Fitur">
      <h1>Dashboard</h1>
   </div>
  
      <section id="boxes">
        	<?php 
			if($_SESSION['peran'] == "nelayan"){
				?>
				          <div class="box">
            <a href="edukasi.php"><img src="img/buku.png"></a>
            <h3>Edukasi Nelayan</h3>
            <p>
              fitur ini ditujukan untuk mengedukasi nelayan
            </p>
          </div>
          <div class="box">
            <a href="formnelayan.php"><img src="img/jual.png"></a>
            <h3>Jual Ikan</h3>
            <p>
              fitur ini ditujukan untuk nelayan untuk menjual ikan
            </p>
          </div>
		  <?php
			}else{
			?>
			<table style="margin-left:10%;margin-right:10%;width:80%">
			<tr>
			<th>Ikan</th>
			<th>Jumlah</th>
			<th>Total</th>
			<th>Alamat Pengantaran</th>
			<th>Tanggal Pembelian</th>
			</tr>
			<?php
			$q = $koneksi->query("SELECT * FROM transaksi where id_pembeli='".$getUserLogin['id']."'");
			while($r = $q->fetch_assoc()){
				echo "<tr>";
				echo "<td>".$koneksi->query("SELECT jenis_ikan from ikan where id='".$r['id_ikan']."'")->fetch_assoc()['jenis_ikan']."</td>";
				echo "<td>".$r['jumlah']."</td>";
				echo "<td>".$r['total']."</td>";
				echo "<td>".$r['alamat']."</td>";
				echo "<td>".$r['tanggal_pembelian']."</td>";
				echo "</tr>";
			}
			?>
			</table>
			<?php
			}
			?>
			
      </section><hr>
<footer style="position: fixed;">
  <p>
    Nelase, Copyright @2020.
  </p>
</footer>
 </div>

</body>
</html>