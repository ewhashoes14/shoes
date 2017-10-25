<?php
include ("shoes_dao.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>따라오슈</title>
      <link rel="stylesheet" href="css/style.css">
      <link href="http://localhost/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body background-color:#E0E3DA>
<form align-items:center method="post" action="login.php">
  <header>
    <div class="imgcontainer">
      <a href="http://192.168.0.13"<center><img src="http://imageshack.com/a/img924/8268/9iaouH.png" alt="Banner" class="Banner_img" id="logo" width=600px></center></a>
    </div>
  </header>
  <input type="text" class="textform" placeholder="ID" name="id" style="margin-bottom: 20px"/><input type="password" class="textform"  placeholder="Password" name="pwd" style="margin-bottom: 20px"/>
  <div style="float:left; width:50%;"><input type="button" class="btn1" onclick="location.href='http://192.168.0.13/signup.php'" value="SignUp"/></div>
<div style="float:left; width:50%;"><input type="submit" class="btn2" value="SignIn"/></div>
</body>
</html>
