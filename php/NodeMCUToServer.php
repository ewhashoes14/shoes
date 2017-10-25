<?php
  //php information
  $mysql_hostname = 'localhost';
  $mysql_username = 'root';
  $mysql_password = 'mysql';
  $mysql_database = 'shoes';

  //getting NFC-strUID from the arduino
  $strUID = $_REQUEST['strUID'];

  //connecting to DB
  $connect = new mysqli($mysql_hostname, $mysql_username, $mysql_password, $mysql_database);
  //checking the connection of DB
  if($connect->connect_errno){
 	echo '[연결실패] : '.$connect->connect_error.'<br>';
  } else {
 	echo '[연결성공]<br>';
  }  
  
  //A query that changes member tuple if the strUID is same as the tag-number in D
  $query = "update members set isChanged=1 where tag='$strUID';";
  //starting the query
  mysqli_query($connect, $query);  
  
?>

//Refreshing the webpage automatically for a second
<script language='javascript'>
  window.setTimeout('window.location.reload()',1000); 
</script>