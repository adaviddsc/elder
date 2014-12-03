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
<!DOCTYPE HTML>
<html>
     <head>
     <title>後青春的日子</title>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="../stylesheets/health.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script type="text/javascript" src="../javascripts/health.js"></script>

		<script>
		function Event(n,e){
			if(e == "true"){
				document.getElementById(n.id).style.overflow="visible";
			}else{
				document.getElementById(n.id).style.overflow="hidden";
			}
		}
		</script>
			
     </head>
     
	 <body>
		<div id="header">
			<h1> <font color="#FFFFFF"> 本月線上教學課程! Ready? GO~~</font> </h1>
		        
		<table align='center'>
		<tr><td><b><font face="微軟正黑體" size="3">高齡養生健康食譜</font></b></td>
		<td><font face="微軟正黑體" size="3"><a href='../health/1.pdf' target='_blank'>下載</a></font></td></tr>
		<tr><td><b><font face="微軟正黑體" size="3">唱歌看電影我最行</font></b></td>
		<td><font face="微軟正黑體" size="3"><a href='../health/entertainment.pdf' target='_blank'>下載</a></font></td></tr>
		<tr><td><b><font face="微軟正黑體" size="3">防跌健康操</font></b></td>
		<td><font face="微軟正黑體" size="3"><a href='../health/exercise.pdf' target='_blank'>下載</a></font></td>	</tr>
		<tr><td><b><font face="微軟正黑體" size="3">Facebook使用教學</font></b></td>
		<td><font face="微軟正黑體" size="3"><a href='../health/fb.pdf' target='_blank'>下載</a></font></td></tr>
	
		<tr><td><b><font face="微軟正黑體" size="3">Google搜尋</font></b></td>
		<td><font face="微軟正黑體" size="3"><a href='../health/google.pdf' target='_blank'>下載</a></font></td></tr>
		</table>

		</div>
		<div id="div2"> </div>
		
		
		

		<div id="command"> 
			<h1> <font color="#FFFFFF"> 樂活網站推薦區</font> </h1>
			<ul>
	        	<li><a href="http://www.happyold.net/" target="iframe_a" >happyold</a></li>
	        	<li><a href="http://ylohas.tcfst.org.tw/" target="iframe_a">養樂網</a></li>
	        	<li><a href="http://www.5bobe.com.tw/" target="iframe_a">5bobe熟齡網</a></li>
	           	<li><a href="http://afterthatday.blogspot.com/" target="iframe_a">病後人生</a></li>
            </ul>		
		<iframe width="100%" height=500px" src="../health/health.html" name="iframe_a"> </iframe>		 
        </div> 
        <div id="div2"> </div>
	

		<div id="news">
				    <h1> <font color="#FFFFFF"> 財經+新聞專區 </font> </h1>
			<ul>
	        	<li><a href="http://www.appledaily.com.tw/appledaily/article/finance/" target="iframe_b">蘋果財經新聞</a></li>
	        	<li><a href="http://udn.com/NEWS/FINANCE/" target="iframe_b">聯合財經新聞</a></li>
	        	<li><a href="http://www.moneydj.com/KMDJ/" target="iframe_b">MoneyDJ理財網</a></li>	        	

	        	<li><a href="http://www.ltn.com.tw/" target="iframe_b">自由電子報</a></li>
	        	<li><a href="http://www.appledaily.com.tw/realtimenews/section/new/" target="iframe_b">蘋果即時新問</a></li>
	        	<li><a href="http://udn.com/News/BreakingNews.jsp" target="iframe_b">聯合即時新問</a></li>        	
            </ul>		
		<iframe width="100%" height=500px" src="health-pag1.html" name="iframe_b"> </iframe>
		</div>  

	 </body>

	 <script>	 
		$(document).ready(function(){
		  $("#hide").click(function(){
		    $("p").hide();
		  });
		  $("#show").click(function(){
		    $("p").show();
		  });
		});
     </script>
	 

</html>