<?php
include ('shoes_dao.php');
$sql = "SELECT id, pwd FROM members WHERE id = '".$_POST['id']."' AND pwd = '".$_POST['pwd']."';";
$id=$_POST['id'];
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
    if ($row != null) {
      session_start();
      $_SESSION['id']=$id;
      echo("<script name=javascript>self.window.alert('$id 님 환영합니다.'); location.replace('http://192.168.0.13/followme2.php');</script>");
    } else if($row == null){
      echo("<script name=javascript>self.window.alert('없는 회원정보입니다.'); location.replace('/');</script>");
    }
     ?>
