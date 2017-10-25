<?php
$servername = "localhost";
$username="root";
$password="lilly903";
$dbname="prototype";
$conn=new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  die("메세지: " . $conn->connect_error);
}
?>
