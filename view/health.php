
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
		<link rel="stylesheet" href="stylesheets/index.css">
		<link rel="stylesheet" href="stylesheets/animate.css">
		<script type="text/javascript" src="javascripts/index.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
    
	 <body class="metro">


	    <div id="st1" class="st">
		 <div class="inner">
		  <h1>樂活推薦網</h1>	

		          
		   <div class="box">
				<a href='http://ylohas.tcfst.org.tw/'  target='_blank'> <img src="view/images/1.png" width="100%" height="150px"></img> </a>				
		   </div>

		    <div class="box">
		   <a href='http://www.5bobe.com.tw/'  target='_blank'> <img src="view/images/5bobe.png" width="100%" height="150px"></img> </a>
		    </div>

		   <div class="box">
				<a href='http://www.happyold.net/happyold.html' target='_blank'> <img src="view/images/老人樂園.png" width="100%" height="150px"></img> </a>				
		   </div>
		   
		   <div class="box">
		   <a href='http://silverpsynews.blogspot.tw/' target='_blank'> <img src="view/images/2.png" width="100%" height="150px"></img> </a>
		   </div>		  	  
		 </div>

		</div>

		<div id="st3" class="st">
		 <div class="inner">
		  <h1>健康新生活</h1>

		   <div class="box">
				<a href='view/1.pdf'  target='_blank'> <img src="view/images/1pdf.png" width="100%" height="150px"></img> </a>				
		   </div>

		   <div class="box">
		   <a href='view/entertainment.pdf'  target='_blank'> <img src="view/images/2pdf.png" width="100%" height="150px"></img> </a>
		   </div>

		   <div class="box">
				<a href='view/photo.pdf'  target='_blank'> <img src="view/images/3pdf.png" width="100%" height="150px"></img> </a>				
		   </div>
		   <div class="box">
		   <a href='view/hospital.pdf'  target='_blank'> <img src="view/images/4pdf.png" width="100%" height="150px"></img> </a>
		   </div>
		   
		 </div>

		</div>

		<div id="st2" class="st">
		 <div class="inner">
		  <h1>財經新聞網</h1>

		   <div class="box">
				<a href='http://www.appledaily.com.tw/appledaily/article/finance/'  target='_blank'> <img src="view/images/4.png" width="100%" height="150px"></img> </a>								
		   </div>
		   <div class="box">
		   <a href='http://udn.com/news/cate/6644'  target='_blank'> <img src="view/images/5.png" width="100%" height="150px"></img> </a>	
		   </div>
		   <div class="box">
		        <a href='http://www.ettoday.net/news/focus/%E8%B2%A1%E7%B6%93/'  target='_blank'> <img src="view/images/7.png" width="100%" height="150px"></img> </a>										
		   </div>
		   <div class="box">
		   <a href='http://www.moneydj.com/KMDJ/'  target='_blank'> <img src="view/images/6.png" width="100%" height="150px"></img> </a>	

			</div>
		    
		 </div>

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
		// FlipList triggerDelay
		$("#myFlipList").liveTile({
		    tileSelector: '>div:not(.exclude)',
		    alwaysTrigger: true,
		    triggerDelay: function(idx){
		        return idx * 250;
		    }
});
     </script>
	 
 
</html>