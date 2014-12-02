<?php
session_start();

if ( !isset($_SESSION['username']) ){
	header('Location: index.php');
}
else{
	$username = $_SESSION['username'];
}

if ( isset($_SESSION['addSelf_alert']) ){
	echo "<script>";
	echo "var addSelf_alert = '$_SESSION[addSelf_alert]';";
	echo "</script>";
	unset($_SESSION['addSelf_alert']);
}

include("../account/connect.php");
$dsn = "mysql:host=$host_name;dbname=$db_name;charset=utf8";
$db = new PDO($dsn, $user_name, $password);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);

$stmt_S_addSelf = $db->prepare("SELECT * FROM addSelf WHERE username=?");
$stmt_S_addSelf->execute(array($username));

?>
<!DOCTYPE html>
<html>
	<title>後青春的日子</title>
	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width; initial-scale=1.0" />
		<link rel="stylesheet" href="../external/sweetalert-master/lib/sweet-alert.css">
		<script type="text/javascript" src="../external/sweetalert-master/lib/sweet-alert.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script> 
		<script type="text/javascript" src="../javascripts/self.js"></script>
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../stylesheets/animate.css">
		<link rel="stylesheet" href="../stylesheets/self.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
		<style>
		body
		{
			background-image: url("../images/sky.jpg");
			background-repeat: no-repeat;
			background-position: center top;
			background-attachment: fixed;
		}
		#header
		{
			background-color:#C2A366;
			color:white;
			text-align:center;
			padding:5px;
		}
		#section
		{
			width:500px;
			text-align:center;
			margin: 0 auto;
			padding:5px;
		}
		.selfPag-img
		{
			border:1px solid #FF70B8;
			padding:5px;
			background:#efefef;
		}
		</style>
	</head>

	<body>
		<div id="section">
			<br>
		    <a href=""><font color="#FFFFFF" size="5">個人資料</font></a>
			<a href=""><font color="#FFFFFF" size="5">旅遊日誌</font></a>
			<a href="album.php"><font color="#FFFFFF" size="5">個人相簿</font></a><br>	
			<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal-addSelf">修改個人資訊</button>
			<h2><font color="#FFFFFF" size="10">個人資料</font></h2>
			<?php
			if ( $result = $stmt_S_addSelf->fetch() ){

				echo '<img class="selfPag-img" src="../readfile/readfile-selfPhoto.php?id='.$result->id.'&updateTime='.$result->updateTime.'" alt="Tank" style="width:250px;height:250px">';
				echo '<table style="width:100%">';
				echo '<tr>';
				echo '<th><b><font color="#FFFFFF" size="8">貴姓大名</font></b></th>';
				echo '<th><b><font color="#FFFFFF" size="8">'.$result->name.'</font></b></th>';
				echo '</tr>';
				echo '<tr>';
				echo '<td><b><font color="#FFFFFF" size="8">性別</font></b></td>';
				echo '<td><b><font color="#FFFFFF" size="8">'.$result->sex.'</font></b></td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td><b><font color="#FFFFFF" size="8">年齡</font></b></td>';
				echo '<td><b><font color="#FFFFFF" size="8">'.$result->age.'</font></b></td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td><b><font color="#FFFFFF" size="8">興趣</font></b></td>';
				echo '<td><b><font color="#FFFFFF" size="8">'.$result->interestment.'</font></b></td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td><b><font color="#FFFFFF" size="8">夢想</font></b></td>';
				echo '<td><b><font color="#FFFFFF" size="8">'.$result->dream.'</font></b></td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td><b><font color="#FFFFFF" size="8">感情狀態</font></b></td>';
				echo '<td><b><font color="#FFFFFF" size="8">'.$result->love.'</font></b></td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td><b><font color="#FFFFFF" size="8">哪裡人</font></b></td>';
				echo '<td><b><font color="#FFFFFF" size="8">'.$result->address.'</font></b></td>';
				echo '</tr>';
				echo '</table>';
			}
			else{
				echo '<img src="../images/user_icon.png" alt="Tank" style="width:250px;height:250px">
				<table style="width:100%">
				<tr>
					<th><b><font color="#FFFFFF" size="8">貴姓大名</font></b></th>
					<th><b><font color="#FFFFFF" size="8">請編輯</font></b></th>		
				 </tr>
				 <tr>
					<td><b><font color="#FFFFFF" size="8">性別</font></b></td>
					<td><b><font color="#FFFFFF" size="8">請編輯</font></b></td>		
				 </tr>
				 <tr>
					<td><b><font color="#FFFFFF" size="8">年齡</font></b></td>
					<td><b><font color="#FFFFFF" size="8">請編輯</font></b></td>		
				 </tr>
				 <tr>
					<td><b><font color="#FFFFFF" size="8">興趣</font></b></td>
					<td><b><font color="#FFFFFF" size="8">請編輯</font></b></td>		
				 </tr>
				 <tr>
					<td><b><font color="#FFFFFF" size="8">夢想</font></b></td>
					<td><b><font color="#FFFFFF" size="8">請編輯</font></b></td>		
				 </tr>
				 <tr>
					<td><b><font color="#FFFFFF" size="8">感情狀態</font></b></td>
					<td><b><font color="#FFFFFF" size="8">請編輯</font></b></td>		
				 </tr>
				 <tr>
					<td><b><font color="#FFFFFF" size="8">哪裡人</font></b></td>
					<td><b><font color="#FFFFFF" size="8">請編輯</font></b></td>		
				 </tr>
			 </table>';
			}
			$stmt_S_addSelf->closeCursor();

			?>
		</div>
		<div class="modal fade" id="myModal-addSelf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        <h4 class="modal-title" id="myModalLabel">修改個人資訊</h4>
		      </div>
		      <div class="modal-body">
		        <form class="item-info-form" enctype="multipart/form-data" id="add-travelArti-form" action="../account/add-self.php" method="post">
		        	<div id="add-selfPhoto">
		        		<i class="fa fa-camera-retro" ></i>
		        	</div>
					<img id="add-selfPhoto-img">
					<input class="add-selfPhoto-input" type="file" name="fileToUpload" style="display:none;"/ accept="image/*">
		        	<br>
		        	姓名<input class="form-control" name="name" type="text" maxlength="50">
		        	性別<input class="form-control" name="sex" type="text" maxlength="50">
		        	年齡<input class="form-control" name="age" type="text" maxlength="50">
		        	興趣<input class="form-control" name="interestment" type="text" maxlength="50">
		        	夢想<input class="form-control" name="dream" type="text" maxlength="50">
		        	感情狀態<input class="form-control" name="love" type="text" maxlength="50">
		        	哪裡人<input class="form-control" name="address" type="text" maxlength="50">
		        	<input type="submit" class="btn btn-primary" value="修改">
		        </form>
		      </div>
		    </div>
		  </div>
		</div>
	</body>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</html>