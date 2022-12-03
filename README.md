# Gigaset-Ringtone-Converter
Gigaset propritary ringtone format (L22 / 722) encoder/decoder, written in PHP

``` 
Gigaset L22 / 722 ringtone file format contains the following header:
	4 bytes magic "GRT1"
	4 bytes total file length (including header), little endian
	1 byte filename string length
	n bytes filename (ASCII)
	16 bytes MD5 checksum of decoded G722 data
	4 bytes decoded payload length, little endian
	n bytes payload, XOR encrypted with (MD5 checksum at (read offset % 16)) + read offset. 
```

### Decode
```bash
(change filenames in PHP script)
php L22_to_g722.php
ffmpeg -f g722 -i 1000weisseLilien.L22.decode.g722 -ar 22050 test.wav
```

### Encode
```bash
(change filenames in PHP script)
ffmpeg -i 1000weisseLilien.mp3 -ar 22050 1000weisseLilien.g722
php g722_to_L22.php
```