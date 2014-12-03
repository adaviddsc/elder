<?php
session_start();

if( !empty($_GET['id']) && !empty($_SESSION['username']) ){
	$pattern = "/^(0|[1-9][0-9]*)$/";
	$id = $_GET['id'];
	if (preg_match($pattern,$id)){
		include("../account/connect.php");
		$dsn = "mysql:host=$host_name;dbname=$db_name;charset=utf8";
		$db = new PDO($dsn, $user_name, $password);
		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
		$stmt_S_addSelf = $db->prepare("SELECT username,photo FROM addSelf WHERE id=?");
		$stmt_S_addSelf->execute(array($id));
		if( $result = $stmt_S_addSelf->fetch() ){
			header('Pragma: public');
			header('Cache-Control: max-age=86400');
			header('Expires: '. gmdate('D, d M Y H:i:s \G\M\T', time() + 600));
			header('Content-Type: image/jpeg');
			readfile('../../../elder-upload/'.$result->username.'/'.$result->photo);
		}
		$db = null;
	}
}
?>