<?php
ob_start();
include("connect.php");
$data = array();

$username = $_POST['username'];
$IV_A = $_POST['IV_A'];
$sql = "SELECT password FROM account WHERE username = '$username'";
$result = mysql_query($sql);

if (mysql_num_rows($result) > 0){
	$row = mysql_fetch_row($result);
	$key = substr(md5($row[0]),0,16);
	$IV_B = substr(md5(rand()),0,24);
	$sql = "UPDATE account SET IV_B = '$IV_B'";
	mysql_query($sql);

	$EncryptData = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $IV_B, MCRYPT_MODE_CBC, $IV_A));
	array_push($data,array( "EncryptData" => $EncryptData ));
}
else{
	array_push($data,array( "EncryptData" => "none" ));
}



/*$iv = "1234567812345678";
$DecryptData = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, base64_decode($R_a), MCRYPT_MODE_CBC, $iv),"\0");*/
/*$EncryptData = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_CBC, $R_a);
$EncryptData = base64_encode($EncryptData);*/

/*$sql = "UPDATE account SET random_B = '$R_b'";
mysql_query($sql);*/
//$result = md5($server.md5($password)."$R_b");




ob_end_clean();
echo json_encode($data);
flush();
exit(0);
?>