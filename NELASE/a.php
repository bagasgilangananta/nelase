<?php

$s = "https://www.youtube.com/watch?v=DDjLrnCAyeA&feature=youtu.be";
if (substr($s, 0,3) == "htt"){
	preg_match('/v=(.*?)&/', $s, $c);
	print_r($c[1]);
}else{
	echo "x";
}
?>