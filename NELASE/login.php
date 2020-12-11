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
    <link rel="stylesheet" href="login.css">
    <title>Login - Nelase</title>
</head>
<body>

    <center><a href="index.php"><h1>NELASE</h1></a></center>
    <div class="login-page">
        <div class="form">
            <h2>Login Konsumen</h2>
            <form action="" method="POST" class="login-form">
                Username
                <input type="text" name="username" placeholder="Username" required>
                Password
                <input type="text" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
				<br/><br/>
				<?php
					if(isset($_POST['login'])){
						$q = $koneksi->query("SELECT * FROM pengguna where username='".$_POST['username']."' LIMIT 1");
						if ($q->num_rows > 0){
							$data = $q->fetch_assoc();
							if ($data['password'] == $_POST['password']){
								$_SESSION['username'] = $_POST['username'];
								$_SESSION['peran'] = $data['peran'];
								
									header('location: dashboard.php');
								
								
							}else{
								echo '<font color="red">Username atau password salah</font>';
							}
						}else{
							echo '<font color="red">Username atau password salah</font>';
						}
					}else{
						echo '<font color="red">&nbsp;</font>';
					}
				?>
				<br/>
                <p class="message">
                    Belum mendaftar ? <a href="daftar.php"> Daftar</a>
                </p>
            </form>
        </div>
    </div>

    <footer>
        <h4>Nelase, Copyright @2020.</h4>
    </footer>
        
    <script>
        
    </script>

    
</body>
</html>