<?php

  //php info
  $mysql_hostname = 'localhost';
  $mysql_username = 'root';
  $mysql_password = 'mysql';
  $mysql_database = 'shoes';

  //connecting to DB
  $connect = new mysqli($mysql_hostname, $mysql_username, $mysql_password, $mysql_database);
  //checking the connection of DB
  if($connect->connect_errno){
 	echo '[연결실패] : '.$connect->connect_error.'<br>';
  } else {
 	echo '[연결성공]<br>';
  }  
  
   
  //A query that searches the member ID of modified tuples
  $query = "select id from members where isChanged=1;";
  //starting the query
  $result = mysqli_query($connect, $query);  

   //Print ID on the Restwebserver 
   while($row = mysqli_fetch_array($result)){
	echo $row['id'];
   }
?>

//Refreshing the webpage automatically for a second
<script language='javascript'>
  window.setTimeout('window.location.reload()',1000); 
</script>