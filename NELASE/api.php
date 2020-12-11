<?php
include 'conf/koneksi.php';

if ($_GET['t'] == 'cari'){
	if(!empty($_GET['n'])){
		$q = $koneksi->query("SELECT * FROM ikan where jenis_ikan LIKE '%".$_GET['n']."%'");
		if ($q->num_rows > 0){
			$td= "";
			while($r = $q->fetch_assoc()){
				$td .= "<tr><td>".$r['jenis_ikan']."</td><td>".$r['berat_ikan']."</td><td>".$r['harga_ikan']."</td><td><button onclick='pilihan(".$r['id'].")' id='pilihan' style='width:100%;'>Pilih</button></td></tr>";
			}
			$res = ["status" => true, "data" => $td];
		}else{
			$res = ["status" => false];
		}
		print_r(json_encode($res));
	}else if (!empty($_GET['id'])){
		$q = $koneksi->query("SELECT * FROM ikan where id='".$_GET['id']."' LIMIT 1");
		if ($q->num_rows > 0){
			$res = ["status" => true, "data" => $q->fetch_assoc()];
		}else{
			$res = ["status" => false];
		}
		print_r(json_encode($res));
	}else{	
		$res = ["status" => false];
		print_r(json_encode($res));
	}
}else if($_GET['t'] == 'u'){
	if (!empty($_GET['id'])){
		$q = $koneksi->query("SELECT id, nohp, rekening, norek FROM pengguna where id='".$_GET['id']."' LIMIT 1");
		if ($q->num_rows > 0){
			$res = ["status" => true, "data" => $q->fetch_assoc()];
		}else{
			$res = ["status" => false];
		}
		print_r(json_encode($res));
	}else{
		$res = ["status" => false];
		print_r(json_encode($res));
	}
}else{
	header('location: index.php');
}
?>