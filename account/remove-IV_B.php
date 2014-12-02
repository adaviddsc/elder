<?php
ob_start();
include("connect.php");
$dsn = "mysql:host=$host_name;dbname=$db_name;charset=utf8";
$db = new PDO($dsn, $user_name, $password);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);

$username = $_POST['username'];
$data = array();

$stmt_U_acc = $db->prepare("UPDATE account SET IV_B = '' WHERE username=?");
$stmt_U_acc->execute(array($username));
$stmt_U_acc->closeCursor();
array_push($data,array( "remove" => "success" ));
$db = null;
ob_end_clean();
echo json_encode($data);
flush();
exit(0);
?>