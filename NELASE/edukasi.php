<?php
include 'conf/koneksi.php';
$q = $koneksi->query("SELECT * FROM edukasi ORDER BY id DESC limit 3");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <title>NELASE</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
 <div class="wrapper">
  <nav>
   <a href="index.php">Beranda</a>
   <a href="tentang_kami.php">Tentang Kami</a>
   <a href="dashboard.php">kembali</a>
   <h3>Nelase</h3>
  </nav>
  <main>
   <div class="edukasi">
     <h1>edukasi</h1>
     <hr>
	 <?php
		while($r = $q->fetch_assoc()){
			echo '<iframe width="860" height="515" src="https://www.youtube.com/embed/'.$r['code'].'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br><br>';
		}
	 ?>
      
   </div><hr>
   </main>
<footer style="position: fixed;">
  <p>
    Nelase, Copyright @2020.
  </p>
</footer>
 </div>
</body>
</html>