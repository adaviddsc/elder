<!DOCTYPE html>
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


echo "<script>";
echo "var session = '$_SESSION[username]';";
echo "var xss = '$result->value';";
echo "</script>";
?>

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
    <link rel="stylesheet" href="../external/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../external/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="http://crypto-js.googlecode.com/svn/tags/3.0.2/build/rollups/aes.js"></script>
    <script src="http://crypto-js.googlecode.com/svn/tags/3.0.2/build/components/pad-zeropadding.js"></script>
    <!--external-->
    <script type="text/javascript" src="../javascripts/MD5.js"></script>
    <script type="text/javascript" src="../javascripts/index.js"></script>
    <link rel="stylesheet" href="../stylesheets/index.css">
	</head>
  <body>
    <div class="login-form">
      帳號:<input type="text" name="username" class="form-control"><br>
      密碼:<input type="password" name="password" class="form-control"><br>
      <button class="login-button btn btn-success">登入</button>
      <h1 class="login-message"></h1>
    </div>
    <div class="regist-form">
      帳號:<input type="text" name="username" class="form-control"><br>
      密碼:<input type="password" name="password" class="form-control"><br>
      密碼確認:<input type="password" name="password-again" class="form-control"><br>
      <p style="margin:0;font-size:16px;color:red;">帳號密碼只允許使用英文大小寫，數字，和&nbsp@&nbsp.&nbsp-&nbsp_&nbsp註冊!</p>
      <button class="regist-button btn btn-success">註冊</button>
      <h1 class="regist-message"></h1>
    </div>

    <br><br><br><br><br><br>
    <form action="../account/temp-input.php" method="post">
      輸入:<input type="text" name="input"><br>
      <input type="submit" value="送出">
    </form>
    <a class="temp1" name="" href="">click</a>
    <p class="temp"></p>
    <p class="session"></p>
  </body>
  <script src="../external/bootstrap.min.js"></script>
</html>
