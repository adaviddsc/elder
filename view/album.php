<?php
session_start();
header("Content-Type:text/html; charset=utf-8");
if ( !isset($_SESSION['username']) ){
	header('Location: index.php');
}
else{
	$username = $_SESSION['username'];
}
?>
<!DOCTYPE html>
<html>
	<title>後青春的日子</title>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width; initial-scale=1.0" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script> 
		<script type="text/javascript" src="../javascripts/self.js"></script>
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
			text-align:center;
			margin: 0 auto;
			padding:5px;
		}
		img
		{
			border:1px solid #FF70B8;
			padding:5px;
			background:#efefef;
		}
		
		</style>
	</head>
	<body>
		<div id="section">
		    <a href="self.php"><font color="#FFFFFF" size="5">個人資料</font></a>
			<a href=""><font color="#FFFFFF" size="5">旅遊日誌</font></a>
			<a href=""><font color="#FFFFFF" size="5">個人相簿</font></a>
			<h2><font color="#FFFFFF" size="10">個人相簿</font></h2>
			
			<div align="center">
				<script language="JavaScript1.1">
				var photos=new Array()
				var photoslink=new Array()
				var which=0
				photos[0]="../images/Tank.jpg"
				photos[1]="../images/Tank2.jpg"
				photos[2]="../images/Tank3.jpg"
				photos[3]="../images/Tank4.jpg"
				photos[4]="../images/Tank5.jpg"
				photos[5]=""
				photos[6]=""
				var linkornot=0
				photoslink[0]=""
				photoslink[1]=""
				photoslink[2]=""
				photoslink[3]=""
				photoslink[4]=""
				photoslink[5]=""
				photoslink[6]=""
				var preloadedimages=new Array()
				for (i=0;i<photos.length;i++){
				preloadedimages[i]=new Image()
				preloadedimages[i].src=photos[i]
				}


				function applyeffect(){
				if (document.all){
				photoslider.filters.revealTrans.Transition=Math.floor(Math.random()*23)
				photoslider.filters.revealTrans.stop()
				photoslider.filters.revealTrans.apply()
				}
				}



				function playeffect(){
				if (document.all)
				photoslider.filters.revealTrans.play()
				}

				function keeptrack(){
				window.status="Image "+(which+1)+" of "+photos.length
				}


				function backward(){
				if (which>0){
				which--
				applyeffect()
				document.images.photoslider.src=photos[which]
				playeffect()
				keeptrack()
				}
				}

				function forward(){
				if (which<photos.length-1){
				which++
				applyeffect()
				document.images.photoslider.src=photos[which]
				playeffect()
				keeptrack()
				}
				}

				function transport(){
				window.location=photoslink[which]
				}

				</script>
				<div align="center">
				<table border="0" cellspacing="0" cellpadding="0">
				<tr>
				<td colspan="2">
				<script>
				if (linkornot==1)
				document.write('<a href="javascript:transport()">')
				document.write('<img src="'+photos[0]+'" name="photoslider" style="filter:revealTrans(duration=2,transition=23)" border=0>')
				if (linkornot==1)
				document.write('</a>')
				</script>
				</tr>
				<tr>
				<td width="50%" height="21">
				<p align="left"><a href="#" onClick="backward();return false">  <img src="../images/pre.jpg" border=0></a></td> 
				<td width="50%" height="21"> 
				<p align="right"><a href="#" onClick="forward();return false"><img src="../images/next.jpg" border=0>  </a></td> 
				</tr> 
				</table>
				</div> 
			</div>
		</div>
	</body>


</html>