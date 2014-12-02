<?php
ob_start();
include("connect.php");
$dsn = "mysql:host=$host_name;dbname=$db_name;charset=utf8";
$db = new PDO($dsn, $user_name, $password);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
$data = array();


if( !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password_again']) && $_POST['password']==$_POST['password_again'] && !isset($_POST['username'][30]) && !isset($_POST['password'][30]) && !isset($_POST['password_again'][30]) ){//檢查username,password,password_again是否有值，且不能超過30字元，且密碼比對正確
	$username = $_POST['username'];
	$password = $_POST['password'];

	$pattern = "/^([0-9A-Za-z@._-]+)$/";
	if (preg_match($pattern,$username) && preg_match($pattern,$password)){
		$stmt_S_acc = $db->prepare("SELECT * FROM account WHERE username=?");
		$stmt_S_acc->execute(array($username));
		if( !$stmt_S_acc->fetch() ){
			$stmt_I_acc = $db->prepare("INSERT INTO account (username, password) VALUES (?, ?)");
		    $stmt_I_acc->execute(array($username,$password));
		    $stmt_I_acc->closeCursor();
			array_push($data,array( "status" => "success" ));
		}
		else{
			array_push($data,array( "status" => "used" ));
		}
		$stmt_S_acc->closeCursor();
	}
	else{
		array_push($data,array( "status" => "illegal" ));
	}

}
else{
	array_push($data,array( "status" => "again" ));
}



$db = null;
ob_end_clean();
echo json_encode($data);
flush();
exit(0);
?>