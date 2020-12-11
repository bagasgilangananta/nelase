<?php
include 'conf/koneksi.php';
?>

<head>
	<title>Nelase</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	    <link rel="stylesheet" href="daftar.css">
	<style>
	#boxes{
		background:#bdc3c7;
	}

	</style>
</head>
	<div class="wrapper" >
 <nav>
  <a href="logout.php">Logout</a> 
  <a href="index.php">Beranda</a> 
   <h3>Nelase</h3>
  </nav>
  <main>
     <div class="Fitur">
      <h1 >ADMIN</h1>
   </div>
   <section id="boxes">
          <div class="box">
			        <div class="form" style="height: auto; ">
            <form class="register-form" action="" method="post">
                <h2>Tambah Video Edukasi</h2>
				<b>Link Video/Code</b>
                <input style="background: white;" type="text" name="vid" placeholder="DDjLrnCAyeA" required minlength="3"><br>
                
                <button type="submit" id="create" name="create">Tambah</button>
				<br/>
				<br/>
				<?php
				if(isset($_POST['create'])){
					$s = $_POST['vid']."&";
					if (substr($s, 0,3) == "htt"){
						preg_match('/v=(.*?)&/', $s, $c);
						$s = $c[1];

					}
					$q = $koneksi->query("INSERT INTO edukasi (code) values ('".$s."')");
					echo "<font color='green'>Berhasil menambahkan video </font>";
				}

				?>

            </form>
        </div>
          </div>
   </section>
</main>
</div>