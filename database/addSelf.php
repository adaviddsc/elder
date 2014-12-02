<?php
include("../account/connect.php");
$con = @mysql_connect($host_name,$user_name,$password);
if (!$con){
	die('Could not connect: ' . mysql_error());
}
mysql_select_db($db_name, $con);
// Create table in my_db database
/****************account**********************/

$sql = "CREATE TABLE addSelf 
(
	id int NOT NULL primary key auto_increment,
	username varchar(30),
	photo varchar(45),
	name varchar(50),
	sex varchar(50),
	age varchar(50),
	interestment varchar(50),
	dream varchar(50),
	love varchar(50),
	address varchar(50),
	updateTime varchar(50)
)ENGINE=InnoDB CHARACTER SET=utf8;";
if (!mysql_query($sql,$con)){
	die('Could not create table: ' . mysql_error());
}

/*********************************************/


mysql_close($con);
?>