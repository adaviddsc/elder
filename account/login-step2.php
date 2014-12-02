<?php
session_start();
ob_start();
$data = array();

include("connect.php");
$dsn = "mysql:host=$host_name;dbname=$db_name;charset=utf8";
$db = new PDO($dsn, $user_name, $password);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);


$username = $_POST['username'];
$enc_data = $_POST['enc_data'];
$enc_data = str_replace(",","+",$enc_data);


$stmt_S_acc = $db->prepare("SELECT username,password,IV_B FROM account WHERE username =?");
$stmt_S_acc->execute(array($username));
if ( $result = $stmt_S_acc->fetch() ){

	$username_fetch = $result->username;
	$key = substr(md5($result->password),0,16);
	$IV_B = substr($result->IV_B,0,16);
	$stmt_S_acc->closeCursor();
	$EncryptData = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $username_fetch, MCRYPT_MODE_CBC, $IV_B));

	if( $enc_data==$EncryptData ){
		$_SESSION['username'] = $result->username;
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
$stmt_U_acc = $db->prepare("UPDATE account SET IV_B = '' WHERE username =?");
$stmt_U_acc->execute(array($username));
$stmt_U_acc->closeCursor();



$db = null;
ob_end_clean();
echo json_encode($data);
flush();
exit(0);
?>