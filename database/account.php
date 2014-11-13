<?php
$con = mysql_connect("localhost","root","a58105810");
if (!$con){
	die('Could not connect: ' . mysql_error());
}
// Create table in my_db database
mysql_select_db("elder", $con);
$sql = "CREATE TABLE account 
(
	id int NOT NULL primary key auto_increment,
	username varchar(500),
	password varchar(500),
	email varchar(500),
	sex varchar(500),
	IV_B varchar(24)
)";
if (!mysql_query($sql,$con)){
	die('Could not create table: ' . mysql_error());
}
mysql_close($con);
?>