<?php
session_start();
include("xss_clean.php");
include("connect.php");
$input = $_POST['input'];
//$input = xss_clean($input);
$input = htmlspecialchars($input);
//$input = mysql_escape_string($input);
$input = mysql_real_escape_string($input);


$dsn = "mysql:host=$host_name;dbname=$db_name;charset=utf8";
$db = new PDO($dsn, $user_name, $password);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);

$stm_U_temp = $db->prepare("UPDATE temp SET value = ? WHERE id = 1");
$stm_U_temp->execute(array($input));
$stm_U_temp->closeCursor();
$db = NULL;
header('Location: ../view/index.php');


/*include("connect.php");
$input = $_POST['input'];
$sql = "SELECT value FROM temp WHERE id = '$input'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);
echo $row[0];*/
?>
