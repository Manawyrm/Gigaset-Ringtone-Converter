<?php
$filename = "1000weisseLilien.g722";
$data = file_get_contents("1000weisseLilien.g722");

$key = md5($data, true);

$output = "";
$output .= "GRT1";
$output .= pack("V", 4 + 4 + 1 + strlen($filename) + 16 + 4 + strlen($data));
$output .= pack("C", strlen($filename));
$output .= $filename;
$output .= $key;
$output .= pack("V", strlen($data));

for ($i=0; $i < strlen($data); $i++)
{
	$output .= chr(ord($data[$i]) ^ ((ord($key[$i % 16]) + $i) & 0xFF));
}

file_put_contents("1000weisseLilien.L22", $output);

