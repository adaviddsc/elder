<?php
ob_start();

$mysqli = new mysqli("localhost", "root", "a58105810", "elder");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$data = array();

$username = $_POST['username'];
$username = mysql_escape_string($username);
$IV_A = $_POST['IV_A'];

$stmt_S_acc = $mysqli->prepare("SELECT password FROM account WHERE username=?");
$stmt_S_acc->bind_param("s", $username);
$stmt_S_acc->execute();
$stmt_S_acc->bind_result($password);
if( $stmt_S_acc->fetch() ){

	$key = substr(md5($password),0,16);
	$IV_B = substr(md5(rand()),0,24);
	$stmt_S_acc->close();

	$stmt_U_acc = $mysqli->prepare("UPDATE account SET IV_B = '$IV_B' WHERE username=?");
	$stmt_U_acc->bind_param("s", $username);
    $stmt_U_acc->execute();
    $stmt_U_acc->close();
    $EncryptData = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $IV_B, MCRYPT_MODE_CBC, $IV_A));
	array_push($data,array( "EncryptData" => $EncryptData ));
}
else{
	array_push($data,array( "EncryptData" => "none" ));
}

$mysqli->close();
ob_end_clean();
echo json_encode($data);
flush();
exit(0);
?>