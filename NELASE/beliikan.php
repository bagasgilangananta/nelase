<?php
session_start();
include 'conf/koneksi.php';
if (!empty($_SESSION['username'])){
	if($_SESSION['peran'] == "nelayan"){
		header('location: dashboard-nelayan.php');
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
  <a href="dashboard.php">Lihat Pembelian</a> 
   <a href="tentang_kami.php">Tentang Kami</a>
   <a href="dashboard.php">Beranda</a> 
   <h3>Nelase</h3>
  </nav>
  <main>
     <div class="Fitur">
      <h1 >Beli Ikan</h1>
   </div>
  
      <section id="boxes" style="text-align:center;padding:10px;"><br/>
	  <label for="jenis" style="font-weight: bold;">Cari Jenis Ikan</label><br/>
 		<input type="text" id="cari" name="ikan" style="height:25px;width:300px;font-size:20px;padding:10px;border-radius:5px;border:1px solid gray;" required/><br/>			
      </section><hr>
	  <br/><br/>
	<div id="result"  style="margin-left:10%;margin-right:10%;">
	</div>
	<form>
	</form>
	<table id="tblrs" style="margin-left:10%;margin-right:10%;width:80%">
	</table>
	<br/>
	<div class="beli" id="beli" 
	style="
	text-align:center;
	display:none;
	">
		<br/>
		<form action="" method="POST">
			<input type="hidden" id="id" name="id" value="">
			<input type="hidden" id="idp" name="idp" value="">
			<b>Ikan</b><br/>
			<input type="text" name="ikan" id="ikan" readonly><br/><br/>
			<b>Harga ikan/kg</b><br/>
			<input type="text" name="harga" id="harga" readonly><br/><br/>
			<b>Jumlah Beli/kg</b><br/>
			<input type="text" name="jml" id="jml"><br/><br/>
			<b>Alamat</b><br/>
			<textarea name="alamat" required></textarea><br/><br/>
		<hr/>
		<h3>Transfer ke:</h3>
		<font id="tujuan"></font>
		<h3>Sejumlah:</h3>
		<font id="nom"></font><br/><br/>
		<input type="submit" name="submit" class="tombolbeli" value="beli"/>
		</form>
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
 <script type="text/javascript">
	document.getElementById("jml").onchange = function(){
		var v = document.getElementById("jml").value;
		c = parseInt(v);
		if (c > document.getElementById("jml").getAttribute("max")){
			document.getElementById("jml").value = document.getElementById("jml").getAttribute("max");
		}else if (c < 1){
			document.getElementById("jml").value = 1;
		}
		document.getElementById("nom").innerHTML = "Rp "+document.getElementById("jml").value*document.getElementById("harga").value;
	}
	function pilihan(id) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var myArr = JSON.parse(this.responseText);
				if (myArr.status){
					document.getElementById("beli").style.display = "";
					document.getElementById("id").value = myArr.data.id;
					document.getElementById("idp").value = myArr.data.id_penjual;
					document.getElementById("ikan").value = myArr.data.jenis_ikan;
					document.getElementById("harga").value = myArr.data.harga_ikan;
					document.getElementById("jml").value = 1;
					document.getElementById("jml").setAttribute("max", myArr.data.berat_ikan);
					document.getElementById("nom").innerHTML = "Rp "+myArr.data.harga_ikan;
					xhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							datas = JSON.parse(this.responseText);
							if (datas.status){
								console.log(datas);
								document.getElementById("tujuan").innerHTML = datas.data.rekening+"<br/>("+datas.data.norek+")";
							}
						}
					};
					  xhttp.open("GET", "api.php?t=u&id="+document.getElementById("idp").value, true);
					  xhttp.send();
					
				}
				//console.log(document.getElementById("cari").value);
			}
		};
		  xhttp.open("GET", "api.php?t=cari&id="+id, true);
		  xhttp.send();
	}
	document.getElementById("cari").onkeyup = function(){
		if (document.getElementById("cari").value !== ""){
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					var myArr = JSON.parse(this.responseText);
					if (myArr.status){
						document.getElementById("result").innerHTML = "";
						document.getElementById("tblrs").style.display = "";
						document.getElementById("tblrs").innerHTML = "<tr><th>Jenis Ikan</th><th>Berat Ikan</th><th>Harga Ikan</th><th>Aksi</th></tr>"+myArr.data;
					}else{
						document.getElementById("tblrs").style.display = "none";
						document.getElementById("result").innerHTML = "Data tidak ditemukan.";
					}
					//console.log(document.getElementById("cari").value);
				}
			};
			  xhttp.open("GET", "api.php?t=cari&n="+document.getElementById("cari").value, true);
			  xhttp.send();
		}
	}
 </script>
</body>
</html>