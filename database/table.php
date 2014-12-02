<?php
include("../account/connect.php");
$con = mysql_connect($host_name,$user_name,$password);
if (!$con){
	die('Could not connect: ' . mysql_error());
}
mysql_select_db($db_name, $con);
// Create table in my_db database
/****************account**********************/

$sql = "CREATE TABLE account 
(
	id int NOT NULL primary key auto_increment,
	username varchar(30),
	password varchar(30),
	email varchar(500),
	sex varchar(500),
	IV_B varchar(24)
)ENGINE=InnoDB CHARACTER SET=utf8;";
if (!mysql_query($sql,$con)){
	die('Could not create table: ' . mysql_error());
}

/*********************************************/

/****************temp**********************/

$sql = "CREATE TABLE temp 
(
	id int NOT NULL primary key auto_increment,
	value varchar(500)
)ENGINE=InnoDB CHARACTER SET=utf8;";
if (!mysql_query($sql,$con)){
	die('Could not create table: ' . mysql_error());
}

/*********************************************/


mysql_close($con);
?>