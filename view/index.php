<?php
session_start();
include("../account/connect.php");
$dsn = "mysql:host=$host_name;dbname=$db_name";
$db = new PDO($dsn, $user_name, $password);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);

$stm_S_temp = $db->prepare("SELECT value FROM temp WHERE id = 1");
$stm_S_temp->execute();
$result = $stm_S_temp->fetch();
$stm_S_temp->closeCursor();
$db = NULL;
if(isset($_SESSION['username'])){
  echo "<script>";
  echo "var session = '$_SESSION[username]';";
  echo "</script>";
}
else{
  echo "<script>";
  echo "var session = 'no';";
  echo "</script>";
}
echo "<script>";
echo "var xss = '$result->value';";
echo "</script>";
?>
<!DOCTYPE html>
<html>
  <title>後青春的日子</title>
	<head>
		<meta charset="utf-8" />
    <meta name="google-site-verification" content="XFLWzNxG-0JQU8yG3B2TlUhqelQSp49V9UaKUZqy-eE" />
    <meta name="robots" content="index,follow" />
    <meta name="keywords" content="後青春的日子" />
    <meta name="description" content="老人養護,養老,老人,退休生活,後青春,不老騎士,祖父母,喪葬,生死,老人醫護,老年保健制度,安養院,不老的夢想" />

    <!--external-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="http://crypto-js.googlecode.com/svn/tags/3.0.2/build/rollups/aes.js"></script>
    <script src="http://crypto-js.googlecode.com/svn/tags/3.0.2/build/components/pad-zeropadding.js"></script>
    <!--external-->
    <script type="text/javascript" src="../javascripts/MD5.js"></script>
    <script type="text/javascript" src="../javascripts/index.js"></script>
    <link rel="stylesheet" href="../stylesheets/index.css">
    <link rel="stylesheet" href="../stylesheets/selectbar.css">
    <style>
      h1{
        font-size:1000%;
        color:white;
        text-align:center;
      }
      body{

        background-image:url(../images/back3.jpg);
        background-size: 100% 1000px;
        background-repeat:no-repeat;
      }



      </style>
	</head>
  <body>
  <?php
  if(!isset($_SESSION['username'])){
    echo '<div id="selectbar">';
    echo '<ul>';
    echo '<li><a page="self.php" href="#" class="enter-door" data-toggle="modal" data-target="#myModal-login">個人頁</a></li>';
    echo '<li><a page="travel.php" href="#" class="enter-door" data-toggle="modal" data-target="#myModal-login">夢想遊記</a></li>';
    echo '<li><a page="health.php" href="#" class="enter-door" data-toggle="modal" data-target="#myModal-login">樂活資訊</a></li>';
    echo '<li><a href="#" data-toggle="modal" data-target="#myModal-regist">註冊</a></li>';
    echo '</ul>';
    echo '</div>';
  }
  else{
    echo '<div id="selectbar">';
    echo '<ul>';
    echo '<li><a href="self.php">個人頁</a></li>';
    echo '<li><a href="travel.php">夢想遊記</a></li>';
    echo '<li><a href="health.php">樂活資訊</a></li>';
    echo '<li><a href="#" data-toggle="modal" data-target="#myModal-regist">註冊</a></li>';
    echo '</ul>';
    echo '</div>';
  }
  ?>
    <div class="modal fade modal-login" id="myModal-login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">登入</h4>
          </div>
          <div class="modal-body">
            <div class="login-form">
              帳號:<input type="text" name="username" class="form-control" maxlength="30"><br>
              密碼:<input type="password" name="password" class="form-control" maxlength="30"><br>
              <button class="login-button btn btn-success">登入</button>
              <h1 class="login-message"></h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="modal fade modal-regist" id="myModal-regist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">註冊</h4>
          </div>
          <div class="modal-body">
            <div class="regist-form">
              帳號:<input type="text" name="username" class="form-control" maxlength="30"><br>
              密碼:<input type="password" name="password" class="form-control" maxlength="30"><br>
              密碼確認:<input type="password" name="password-again" class="form-control" maxlength="30"><br>
              <p style="margin:0;font-size:16px;color:red;">帳號密碼長度限制30字元，並且只允許使用英文大小寫，數字，和&nbsp@&nbsp.&nbsp-&nbsp_&nbsp註冊!</p>
              <button class="regist-button btn btn-success">註冊</button>
              <h1 class="regist-message"></h1>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--<br><br><br><br><br><br>
    <form action="../account/temp-input.php" method="post">
      輸入:<input type="text" name="input"><br>
      <input type="submit" value="送出">
    </form>
    <a class="temp1" name="" href="">click</a>
    <p class="temp"></p>
    <p class="session"></p>-->
  </body>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</html>
