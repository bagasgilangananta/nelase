<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "nelase";

$koneksi = new mysqli($host, $user, $pass, $db);

if ($koneksi->connect_error){
	die("koneksi mysql gagal");
}
?>