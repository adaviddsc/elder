<?php
ob_start();
include("connect.php");
$dsn = "mysql:host=$host_name;dbname=$db_name;charset=utf8";
$db = new PDO($dsn, $user_name, $password);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);

$pattern = "/^([0-9A-Za-z@._-]+)$/";
$username = $_POST['username'];
$IV_A = $_POST['IV_A'];
$data = array();

if(preg_match($pattern,$username) && !isset($username[30]) ){
	$stmt_S_acc = $db->prepare("SELECT password FROM account WHERE username=?");
	$stmt_S_acc->execute(array($username));
	if( $result = $stmt_S_acc->fetch() ){

		$key = substr(md5($result->password),0,16);
		$IV_B = substr(md5(rand()),0,24);
		$stmt_S_acc->closeCursor();

		$stmt_U_acc = $db->prepare("UPDATE account SET IV_B = '$IV_B' WHERE username=?");
	    $stmt_U_acc->execute(array($username));
	    $stmt_U_acc->closeCursor();
	    $EncryptData = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $IV_B, MCRYPT_MODE_CBC, $IV_A));
		array_push($data,array( "EncryptData" => $EncryptData ));
	}
	else{
		array_push($data,array( "EncryptData" => "none" ));
	}
}
else{
	array_push($data,array( "EncryptData" => "none" ));
}


$db = null;
ob_end_clean();
echo json_encode($data);
flush();
exit(0);
?>