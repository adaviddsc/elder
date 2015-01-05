<?php
session_start();
header("Content-Type:text/html; charset=utf-8");
if ( !isset($_SESSION['username']) ){
	header('Location: index.php');
}
else{
	$username = $_SESSION['username'];
}

if ( isset($_SESSION['addTravel_alert']) ){
	echo "<script>";
	echo "var addTravel_alert = '$_SESSION[addTravel_alert]';";
	echo "</script>";
	unset($_SESSION['addTravel_alert']);
}


include("../account/connect.php");
$dsn = "mysql:host=$host_name;dbname=$db_name;charset=utf8";
$db = new PDO($dsn, $user_name, $password);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);

echo "<script>"; 
echo "self_photo = new Array();";
echo "self_photo_update = new Array();";
echo "self_name = new Array();";
echo "</script>"; 
$stmt_S_addSelf = $db->prepare("SELECT * FROM addSelf");
$stmt_S_addSelf->execute();
while( $result = $stmt_S_addSelf->fetch() ){
	echo "<script>";
	echo "self_photo['".$result->username."'] = '".$result->id."';";
	echo "self_photo_update['".$result->username."'] = '".$result->updateTime."';";
	echo "self_name['".$result->username."'] = '".$result->name."';";
	echo "</script>";
}
$stmt_S_addSelf->closeCursor();

echo "<script>"; 
echo "travel_photo = new Array();";
echo "</script>"; 
$stmt_S_addTravelPhoto = $db->prepare("SELECT * FROM addTravelPhoto");
$stmt_S_addTravelPhoto->execute();
while( $result = $stmt_S_addTravelPhoto->fetch() ){
	echo "<script>";
	echo "travel_photo['".$result->articleID."'] = new Array();";
	echo "</script>";
}
$stmt_S_addTravelPhoto->execute();
while( $result = $stmt_S_addTravelPhoto->fetch() ){
	echo "<script>";
	echo "var i=0;";
	echo "while(1){";
	echo "	if(travel_photo['".$result->articleID."'][i]==null){";
	echo "		travel_photo['".$result->articleID."'][i] = '".$result->id."';";
	echo "		break;";
	echo "	}";
	echo "  i++;";
	echo "}";
	echo "</script>";
}
$stmt_S_addTravelPhoto->closeCursor();

echo "<script>"; 
echo "travel_username = new Array();";
echo "travel_title = new Array();";
echo "travel_date = new Array();";
echo "travel_address = new Array();";
echo "travel_detail = new Array();";
echo "travel_sick = new Array();";
echo "travel_articleID = new Array();";
echo "</script>";
$travel_length = 0;

if ( isset($_GET["search"]) ){
	$search = $_GET["search"];
	$stmt_S_addTravel = $db->prepare("SELECT * FROM addTravel WHERE title LIKE '%$search%' ORDER BY id DESC");
}
else{
	$stmt_S_addTravel = $db->prepare("SELECT * FROM addTravel ORDER BY id DESC");
}
$stmt_S_addTravel->execute();
while( $result = $stmt_S_addTravel->fetch() ){
	echo "<script>";
	echo "travel_username[".$travel_length."] = '".$result->username."';";
	echo "travel_title[".$travel_length."] = '".$result->title."';";
	echo "travel_date[".$travel_length."] = '".$result->date."';";
	echo "travel_address[".$travel_length."] = '".$result->address."';";
	echo "travel_detail[".$travel_length."] = '".$result->detail."';";
	echo "travel_sick[".$travel_length."] = '".str_replace(","," ",$result->sick)."';";
	echo "travel_articleID[".$travel_length."] = '".$result->articleID."';";
	echo "</script>";
	$travel_length++;
}
$stmt_S_addTravel->closeCursor();

?>
<!DOCTYPE HTML>
<html>
<title>後青春的日子</title>
	<head>
		<meta charset="utf-8">	
		<meta name="viewport" content="width=device-width; initial-scale=1.0" />
		<!--sweetalert要先...無解-->
		<link rel="stylesheet" href="../external/sweetalert-master/lib/sweet-alert.css">
		<script type="text/javascript" src="../external/sweetalert-master/lib/sweet-alert.js"></script>
		<!--sweetalert要先...無解-->
		<!--external-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script> 
		<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAO84sQWjSC19_vifH_aynYtbgYzbws4M8&sensor=FALSE&language=zh-tw"></script>
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
		<script type="text/javascript" src="../external/jquery.twzipcode.js"></script>
		<!--<link rel="stylesheet" href="http://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.min.css" />
		<script src="http://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>-->
		<!--external-->

		
		<script type="text/javascript" src="../javascripts/travel.js"></script>
		<link rel="stylesheet" href="../stylesheets/travel.css">
	</head>

	<body style="overflow: hidden;">
		<div class="travel-container">
			<div class="travel-leftMap" id="google-map"></div>
			<div class="travel-rightContain">
				<div class="travel-header">
					<div class="travel-planeIcon fa fa-plane"></div>
					<h1 class="travel-name">旅遊記事</h1>
					<div class="travel-addArticle" data-toggle="modal" data-target="#myModal-addTravel"><i class="fa fa-plus"></i>新增遊記</div>
				</div>
				<div>
					<i id="search-btn" class="fa fa-search"></i>
					<input type="text" class="form-control" id="search-input">
				</div>
				<div class="sick-avoid-div">
					<ul class="sick-avoid">
						<li value="all" class="active">全部</li>
						<li value="a">高血壓</li>
						<li value="b">低血壓</li>
						<li value="c">心臟病</li>
						<li value="d">肥胖症</li>
						<li value="e">癌症</li>
					</ul>
				</div>
				<style>
				#search-input{
					position: relative;
				}
				#search-btn{
					position: absolute;
					right: 10px;
					margin-top: 6px;
					font-size: 20px;
					z-index: 1;
					cursor: pointer;
				}
				.sick-avoid{
					text-align: center;
				}
				.sick-avoid li{
					display: inline-block;
					cursor: pointer;
					background: #eee;
					width: 70px;
					height: 25px;
					text-align: center;
					line-height: 25px;
				}
				.sick-avoid .active{
					background: #000;
					color: #fff;
				}
				</style>
				<div class="travel-body">
					<div class="travel-bodyLeft travel-bodyContain">
					</div>
					<div class="travel-bodyRight travel-bodyContain">
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="myModal-addTravel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        <div class="dialog-travel-addArticle"><i class="fa fa-plus"></i>新增遊記</div>
		      </div>
		      <div class="modal-body">
				<div class="item-info">
					<form class="item-info-form" enctype="multipart/form-data" id="add-travelArti-form" action="../account/add-travel.php" method="post">
						<div class="item-info-images">
							<div class="fa fa-camera-retro" id="add-travelPhoto"></div>
							<img id="add-travelPhoto-pre">
							<input class="item-info-images-input" type="file" name="fileToUpload[]" multiple="" style="display:none;"/ accept="image/*">
						</div>

						<div class="item-info-tags">
							<span class="fa fa-tag"></span>
							<span class="fa fa-map-marker"></span>
							<span class="fa fa-pencil-square-o"></span> 
						</div>
						<div class="item-info-items">
							<div class="item-info-items-div1">
								<input type="text" name="title" class="form-control" placeholder="標題">
							</div>
							<input type="date" class="form-control" id="add-travel-date" value="<?php echo date('Y-m-d');?>" readonly>
							<div id="item-info-twzipcode">
								<div id="item-info-county" data-role="county" data-style="county" data-value="縣市"></div>
								<div id="item-info-district" data-role="district" data-style="district" data-value="鄉鎮市區"></div> 
								<div id="item-info-zipcode" data-role="zipcode"></div>
							</div>
							<div class="item-info-twzipcode-address">
								<input type="text" name="address" class="form-control" placeholder="地址">
							</div>
							<textarea class="form-control" name="detail" placeholder="細節"></textarea>
							<div class="sub-text-content">
								<label class="checkbox-inline">
								  <input type="checkbox" class="checkbox" name="sick[]" value="a">高血壓  
								</label>
								<label class="checkbox-inline">
								  <input type="checkbox" class="checkbox" name="sick[]" value="b">低血壓
								</label>
								<label class="checkbox-inline">
								  <input type="checkbox" class="checkbox" name="sick[]" value="c">心臟病
								</label>
								<label class="checkbox-inline">
								  <input type="checkbox" class="checkbox" name="sick[]" value="d">肥胖症
								</label>
								<label class="checkbox-inline">
								  <input type="checkbox" class="checkbox" name="sick[]" value="e">癌症
								</label>
							</div>
							<input type="submit" class="myButtonDonate" value="提交">
						</div>
					</form>
				</div>
		      </div>
		    </div>
		  </div>
		</div>

		<div class="modal fade" id="myModal-travelInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-body">
				
				<div id="addTravel-photoGallery" class="carousel slide" data-ride="carousel">
				  <ol class="carousel-indicators" id="addTravel-li">

				  </ol>
				  <div class="carousel-inner" role="listbox" id="addTravel-img">

				  </div>
				  <a class="left carousel-control" href="#addTravel-photoGallery" role="button" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true" id="photoGallery-leftButton"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="right carousel-control" href="#addTravel-photoGallery" role="button" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" id="photoGallery-rightButton"></span>
				    <span class="sr-only">Next</span>
				  </a>
				</div>
		      </div>
		      <div class="modal-footer">
		        <div class="dialog-travelInfo-title"></div>
		        <div class="fa fa-map-marker dialog-travelInfo-address">
		        	<h1></h1>
		        </div>
		        <div class="travelInfo-iconInfo">
		        	<i class="fa fa-heart" id="travelInfo-like">
						<h2 class="like-count">3895</h2>
					</i>
					<i class="fa fa-calendar">
						<h2 class="travelInfo-date"></h2>
					</i>
		        </div>
		        
		        <div class="dialog-travelInfo-text"></div>
		      </div>
		    </div>
		  </div>
		</div>

	</body>
	<!--external-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<!--external-->
</html>
