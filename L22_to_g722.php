<?php
$data = file_get_contents("1000weisseLilien.L22");

// skip header "GRT1"
$data = substr($data, 4);

// extract length
$length = unpack("V", substr($data, 0, 4))[1];
$data = substr($data, 4);

// extract filename
$filename_length = unpack("C", substr($data, 0, 1))[1];
$data = substr($data, 1);

$filename = substr($data, 0, $filename_length);
$data = substr($data, $filename_length);

error_log("filename: " . $filename);

// extract key
$key = substr($data, 0, 16);
$data = substr($data, 16);

error_log("key: " . bin2hex($key));

// extract payload length
$payload_length = unpack("V", substr($data, 0, 4))[1];
$data = substr($data, 4);

// "decrypt" payload
$decode = "";
for ($i=0; $i < $payload_length; $i++)
{
	$decode .= chr(ord($data[$i]) ^ ((ord($key[$i % 16]) + $i) & 0xFF));
}

file_put_contents("1000weisseLilien.L22.decode.g722", $decode);
// ffmpeg -f g722 -i 1000weisseLilien.L22.decode.g722 -ar 22050 test.wav