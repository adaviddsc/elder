<?php
ob_start();
session_start(); 
include("connect.php");
$data = array();

$username = $_POST['username'];
$EncryptedData = $_POST['enc_data'];
$sql = "SELECT username,password,IV_B FROM account WHERE username = '$username'";
$result = mysql_query($sql);


if (mysql_num_rows($result) > 0){
	
	$row = mysql_fetch_row($result);
	$username_fetch = $row[0];
	$key = substr(md5($row[1]),0,16);
	$IV_B = substr($row[2],0,16);
	$DecryptData = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, base64_decode($EncryptedData), MCRYPT_MODE_CBC, $IV_B),"\0");
	
	if( $username==$DecryptData ){
		array_push($data,array( "status" => $DecryptData ));
	}
	else{
		array_push($data,array( "status" => "error" ));
	}
}
else{
	array_push($data,array( "status" => "error" ));
}



/*$sql = "SELECT * FROM account where user = '$user'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

if( $user != null && $password != null && $row[7] == $user && $row[2] == $password)
{
       
        $_SESSION['username'] = $row[1];
        echo $lang->line("login success");
        echo '<meta http-equiv=REFRESH CONTENT=1;url=home.php>';

}
else
{
        echo $lang->line("login failure");
}*/

ob_end_clean();
echo json_encode($data);
flush();
exit(0);
?>