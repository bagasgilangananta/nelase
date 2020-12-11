<?php
include 'conf/koneksi.php';
session_start();
if (!empty($_SESSION['username'])){
	
		header('location: dashboard.php');
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="daftar.css">
    <title>Daftar</title>
</head>
<body>

    <a href="html.html"><h1>NELASE</h1></a> 
        <div class="form" style="height: auto; ">
            <form class="register-form" action="" method="post">
                <h2>Daftar Diri</h2>
                Username
                <input type="text" name="username" placeholder="Username" required minlength="3"><br>
                Password
                <input type="password" name="password" id="pw" onkeyup="pwCheck()" placeholder="Password" required><br>
                Verifikasi Password
                <input type="password"  id="repw" onkeyup="pwCheck()" placeholder="Password" required><br>
                Email
                <input type="text" name="email" placeholder="Email" required><br>
				Nomor HP
                <input type="number" name="nohp" placeholder="0821" required><br>
                Sebagai
                <select id='sebagai' name='sebagai' required>
                   <option value='konsumen'>Konsumen</option>
				   <option value='nelayan'>Nelayan</option>
                </select>
				<div id="nel" style="display:none;">
					Rekening
					<input type="text" name="rek" placeholder="BCA, BNI, OVO, GOPAY, ...."><br>
					Nomor
					<input type="number" name="norek" placeholder=""><br>
				</div>
                <button type="submit" id="create" name="create" disabled>Create</button>
				<br/>
				<br/>
				<?php
				if(isset($_POST['create'])){
					$check = $koneksi->query("SELECT * FROM pengguna where username='".$_POST['username']."' or email='".$_POST['email']."' limit 1");
					if ($check->num_rows == 0){
						if ($_POST['sebagai'] == "nelayan"){
							$q = $koneksi->query("INSERT INTO pengguna (username, password, email, nohp, peran, rekening, norek) values ('".$_POST['username']."', '".$_POST['password']."', '".$_POST['email']."',  '".$_POST['nohp']."', '".$_POST['sebagai']."','".$_POST['rek']."','".$_POST['norek']."')");
						}else{
							$q = $koneksi->query("INSERT INTO pengguna (username, password, email, nohp, peran) values ('".$_POST['username']."', '".$_POST['password']."', '".$_POST['email']."',  '".$_POST['nohp']."', '".$_POST['sebagai']."')");
						}
						if ($q){
							header('location: login.php');
						}else{
							echo '<font id="alert" color="red">Gagal mendaftarkan akun.</font>';
						}
					}else{
						echo '<font id="alert" color="red">Gagal mendaftarkan akun. Username atau email telah digunakan.</font>';
					}
				}else{
						echo '<font id="alert" color="red"></font>';
					}
	 
				?>
                <p class="message">
                    Sudah mendaftar? <a href="login.php">Login</a>
                </p>
            </form>
        </div>
    </div>

    <footer>
        <h4>Nelase, Copyright @2020.</h4>
    </footer>

    <script>
        function pwCheck() {
            if (document.getElementById("pw").value != document.getElementById("repw").value){
				document.getElementById("alert").innerHTML = "*Password tidak sesuai";
				document.getElementById("create").disabled = true;
			}else{
				document.getElementById("alert").innerHTML = "&nbsp;";
				document.getElementById("create").disabled = false;
			}
        }
		document.getElementById("sebagai").onchange = function(){
			
			if (document.getElementById("sebagai").value === "nelayan"){
				document.getElementById("nel").style.display = "";
			}else{
				document.getElementById("nel").style.display = "none";
			}
		}
    </script>

</body>
</html>