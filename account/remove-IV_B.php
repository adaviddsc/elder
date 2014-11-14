<?php
ob_start();
session_start(); 
include("connect.php");
$data = array();

$username = $_POST['username'];


$sql = "UPDATE account SET IV_B = '' WHERE username = '$username'";
$result = mysql_query($sql);
array_push($data,array( "remove" => "success" ));

ob_end_clean();
echo json_encode($data);
flush();
exit(0);
?>