<?php
include ('shoes_dao.php');
        session_start();
        $id=$_SESSION['id'];
        $sql ="SELECT e_num FROM ewha_station WHERE spot like '".'%'.$_GET['spot'].'%'."';";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result);
        $query2 ="update members set spot='".$_GET['spot']."' where  id='$id';";
        $result2=mysqli_query($conn, $query2);
        if($_REQUEST['spot']==null) {
            echo("<script name=javascript>window.history.back(); self.window.alert('검색어를 입력해주세요.');</script>");
        }
        if($row !=null) {
  print "　　　　　　　　　　　　　　　　　　　　　　　　도착지:".$_REQUEST['spot']."/  ";
            echo implode(',', $row);
              echo "번 출구로 나가세요.";
        } else {
            echo("<script name=javascript>window.history.back(); self.window.alert('검색 결과가 없습니다. 다시 검색해 주세요.');</script>");
        }
?>
