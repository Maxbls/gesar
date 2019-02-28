<?php
$servername = "localhost";
$username = "root";
$password = "Slyugrov90";
$dbname = "archive";
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "Select * from prdoc where id_zakl = ".$_POST["id"];

$data = array();

$ta = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($ta))
  {
    $data[] = $row;
  }
echo json_encode($data);
?>
