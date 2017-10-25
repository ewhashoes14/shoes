<?php
include('shoes_dao.php');
$sql = "SELECT id FROM members WHERE id = '".$_POST['id']."';";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
if($_POST['id']==null) {
    echo("<script name=javascript>window.history.back(); self.window.alert('아이디를 입력하세요!');</script>");
}
if($row!=null){
echo("<script name=javascript>window.history.back(); self.window.alert('이미 사용중인 아이디입니다.');</script>");
}
else{
  echo("<script name=javascript>window.history.back(); self.window.alert('사용 가능한 아이디입니다.');</script>");
}
?>
