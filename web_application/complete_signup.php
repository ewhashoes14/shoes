<?php
include ('shoes_dao.php');
$sql1 = "SELECT id FROM members WHERE id = '".$_POST['id']."';";
$res1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($res1);
if($row1!=null){
echo("<script name=javascript>window.history.back();self.window.alert('아이디 중복확인을 해주세요.');</script>");
}
else{
  if($_POST['pwd1']==$_POST['pwd2']) {
      $sql3="select * from members where tag= '".$_POST['tag']."';";
      $res3=mysqli_query($conn, $sql3);
      $row2=mysqli_fetch_assoc($res3);
      if($row2!=null) {
      echo("<script name=javascript>window.history.back();self.window.alert('이미 등록된 태그입니다.');</script>");
    } else {
      echo("<script name=javascript> self.window.alert('".$_POST['id']."님 환영합니다!'); location.replace('/followme.php');</script>");
      $sql2="insert into members values('".$_POST['id']."','".$_POST['pwd1']."', '".$_POST['tag']."');";
      $res2=mysqli_query($conn, $sql2);
    }
  }
}
?>
