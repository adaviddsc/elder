<?php
include("../account/connect.php");
$con = mysql_connect($host_name,$user_name,$password);
if (!$con){
	die('Could not connect: ' . mysql_error());
}
mysql_select_db($db_name, $con);
// Create table in my_db database
/****************account**********************/

$sql = "CREATE TABLE addTravel
(
	id int NOT NULL primary key auto_increment,
	username varchar(30),
	title varchar(500),
	date date,
	address varchar(500),
	detail text,
	sick varchar(255),
	articleID varchar(32)
)ENGINE=InnoDB CHARACTER SET=utf8;";
if (!mysql_query($sql,$con)){
	die('Could not create table: ' . mysql_error());
}

/*********************************************/


mysql_close($con);
?>