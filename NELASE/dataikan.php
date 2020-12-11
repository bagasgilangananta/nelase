<html>
	<head>
	<title>Data ikan</title>
	<link href="stylenelayan.css" rel="stylesheet"/>
	</head>

		<body style="color: black">

		<div class="tb">
		<table width="500">
		<tr>
        <th style="font-weight: bold">Tanggal</th>
		<th style="font-weight: bold">Nama Nelayan</th>
		<th style="font-weight: bold">Jenis Kelamin</th>
		<th style="font-weight: bold">Alamat Lengkap</th>
		<th style="font-weight: bold">Jenis Ikan</th>
		<th style="font-weight: bold">Berat Ikan</th>
		<th style="font-weight: bold">Harga Ikan</th>
    	</tr>
			<?php
			$myfile = fopen("datanelayan.txt", "r");
			while (!feof($myfile) ) {
		    $line_of_text = fgets($myfile);
		    $distance = explode(':', $line_of_text);
			echo "<tr>";
			foreach($distance as $d){echo "<td>".$d."</td>";}
			echo "</tr>";
			}
			fclose($myfile);
			?>
		</table>
</div>
</body>