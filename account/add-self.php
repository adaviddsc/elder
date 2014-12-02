<?php
session_start();
include("connect.php");
include("img_filter.php");
$dsn = "mysql:host=$host_name;dbname=$db_name;charset=utf8";
$db = new PDO($dsn, $user_name, $password);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);




if( is_uploaded_file($_FILES['fileToUpload']['tmp_name']) && !empty($_SESSION['username']) && !empty($_POST['name']) && !empty($_POST['sex']) && !empty($_POST['age']) && !empty($_POST['interestment']) && !empty($_POST['dream']) && !empty($_POST['love']) && !empty($_POST['address']) ){
	if( !isset($_POST['name'][50]) && !isset($_POST['sex'][50]) && !isset($_POST['age'][50]) && !isset($_POST['interestment'][50]) && !isset($_POST['dream'][50]) && !isset($_POST['love'][50]) && !isset($_POST['address'][50]) ){
		$_FILES['fileToUpload']['name'] = img_filter($_FILES['fileToUpload']['name'],$_FILES['fileToUpload']['tmp_name'],'../view/self.php','addSelf_alert','資料未完整',0);

		$username = $_SESSION['username'];
		$name = $_POST['name'];
		$sex = $_POST['sex'];
		$age = $_POST['age'];
		$interestment = $_POST['interestment'];
		$dream = $_POST['dream'];
		$love = $_POST['love'];
		$address = $_POST['address'];

		$user_dir="../../../elder-upload/";
	    if (!is_dir($user_dir.$username)) {
	        mkdir($user_dir.$username,0777);
	    }
	    if($_FILES['fileToUpload']["tmp_name"]!=null){
	        move_uploaded_file( $_FILES['fileToUpload']["tmp_name"], iconv("utf-8", "big5", "../../../elder-upload/".$username."/".$_FILES['fileToUpload']["name"]) );
	        $photo= $_FILES['fileToUpload']["name"];
	    }

	    $stmt_S_addSelf = $db->prepare("SELECT * FROM addSelf WHERE username = ?");
		$stmt_S_addSelf->execute(array($username));
		if( $result = $stmt_S_addSelf->fetch() ){

			$stmt_U_addSelf = $db->prepare("UPDATE addSelf SET photo=?, name=?, sex=?, age=?, interestment=?, dream=?, love=?, address=?, updateTime=? WHERE username=?");
			$stmt_U_addSelf->execute(array($photo,$name,$sex,$age,$interestment,$dream,$love,$address,time(),$username));
			$stmt_U_addSelf->closeCursor();
		}
		else{
			$stmt_I_addSelf = $db->prepare("INSERT INTO addSelf (username, photo, name, sex, age, interestment, dream, love, address, updateTime) VALUES (?,?,?,?,?,?,?,?,?,?)");
			$stmt_I_addSelf->execute(array($username,$photo,$name,$sex,$age,$interestment,$dream,$love,$address,time()));
			$stmt_I_addSelf->closeCursor();
		}
		$stmt_S_addSelf->closeCursor();

	}
	else{
		$_SESSION['addSelf_alert'] = '資料未完整';
	    header('Location: ../view/self.php');
	    exit(0);
	}
}
else{
	$_SESSION['addSelf_alert'] = '資料未完整';
    header('Location: ../view/self.php');
    exit(0);
}




$db = null;
header('Location: ../view/self.php');
?>