<?php
session_start();
include("connect.php");
include("img_filter.php");
$num_files = count($_FILES['fileToUpload']['tmp_name']);
for($i=0; $i < $num_files;$i++)
{
	if( $_FILES['fileToUpload']['error'][$i] ) {
		$_SESSION['addTravel_alert'] = '上傳檔案請小於8M';
	    header('Location: ../view/travel.php');
	    exit(0);
	}
}
$dsn = "mysql:host=$host_name;dbname=$db_name;charset=utf8";
$db = new PDO($dsn, $user_name, $password);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);

if( is_uploaded_file($_FILES['fileToUpload']['tmp_name'][0]) && !empty($_SESSION['username']) && !empty($_POST['title']) && !empty($_POST['addr_county']) && !empty($_POST['addr_area']) && !empty($_POST['address']) && !empty($_POST['detail']) ){
	$_FILES['fileToUpload']['name'] = img_filter($_FILES['fileToUpload']['name'],$_FILES['fileToUpload']['tmp_name'],'../view/travel.php','addTravel_alert','資料未完整',1);


	/*$username = $_SESSION['username'];
	$title = mysql_real_escape_string(htmlspecialchars($_POST['title']));
	$date = $today = date('Y-m-d');
	$address = mysql_real_escape_string(htmlspecialchars($_POST['addr_county'].$_POST['addr_area'].$_POST['address']));
	$detail = $_POST['detail'];
	$detail = $_POST['detail'];
	$detail = str_replace(" ","&nbsp",$detail);
	$detail = str_replace("\n","",$detail);
	$detail = mysql_real_escape_string(htmlspecialchars(preg_replace("/\s/","<br>",$detail)));*/
	$username = $_SESSION['username'];
	$title = $_POST['title'];
	$date = $today = date('Y-m-d');
	$address = $_POST['addr_county'].$_POST['addr_area'].$_POST['address'];
	$detail = $_POST['detail'];
	$detail = $_POST['detail'];
	$detail = str_replace(" ","&nbsp",$detail);
	$detail = str_replace("\n","",$detail);
	$detail = preg_replace("/\s/","<br>",$detail);

	$title = @mysql_escape_string(htmlspecialchars($title));
	$address = @mysql_escape_string(htmlspecialchars($address));
	$detail = @mysql_escape_string(htmlspecialchars($detail));

	$uniqid = md5(uniqid(rand()));
	$stmt_I_addTravel = $db->prepare("INSERT INTO addTravel (username, title, date, address, detail, articleID) VALUES (?,?,?,?,?,?)");
	$stmt_I_addTravel->execute(array($username,$title,$date,$address,$detail,$uniqid));
	$stmt_I_addTravel->closeCursor();

	for($i=0; $i < $num_files;$i++)
	{
		$user_dir="../../../elder-upload/";
	    if (!is_dir($user_dir.$username)) {
	        mkdir($user_dir.$username,0777);
	    }
	    if($_FILES['fileToUpload']["tmp_name"][$i]!=null){
	        move_uploaded_file( $_FILES['fileToUpload']["tmp_name"][$i], iconv("utf-8", "big5", "../../../elder-upload/".$username."/".$_FILES['fileToUpload']["name"][$i]) );
	        $PhotoAddress= $_FILES['fileToUpload']["name"][$i];
	    }
	    $stmt_I_addTravelPhoto = $db->prepare("INSERT INTO addTravelPhoto (username,articleID,photo) VALUES (?,?,?)");
	    $stmt_I_addTravelPhoto->execute(array($username,$uniqid,$PhotoAddress));
	}
	$stmt_I_addTravelPhoto->closeCursor();
}
else{
	$_SESSION["addTravel_alert"] = "資料未完整";
    header('Location: ../view/travel.php');
    exit(0);
}

$db = null;
header('Location: ../view/travel.php');
?>