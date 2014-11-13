<?php
ob_start();
session_start(); 
include("connect.php");
$data = array();

$username = $_POST['username'];
$enc_data = $_POST['enc_data'];
$enc_data = str_replace(",","+",$enc_data);
$sql = "SELECT username,password,IV_B FROM account WHERE username = '$username'";
$result = mysql_query($sql);


if (mysql_num_rows($result) > 0){

	$row = mysql_fetch_row($result);
	$username_fetch = $row[0];
	$key = substr(md5($row[1]),0,16);
	$IV_B = substr($row[2],0,16);

	$EncryptData = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $username_fetch, MCRYPT_MODE_CBC, $IV_B));

	if( $enc_data==$EncryptData ){
		array_push($data,array( "status" => "success" ));
		//成功登入區塊
	}
	else{
		array_push($data,array( "status" => "error" ));
		//此區為危險區塊
	}
}
else{
	array_push($data,array( "status" => "error" ));
}
$sql = "UPDATE account SET IV_B = ''";
$result = mysql_query($sql);


ob_end_clean();
echo json_encode($data);
flush();
exit(0);
?>