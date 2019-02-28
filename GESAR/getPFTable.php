<?php
$servername = "localhost";
$username = "root";
$password = "Slyugrov90";
$dbname = "archive";
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "Select * from doc order by id desc";

$data = array();

$ta = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($ta))
  {
    $data['data'][] = $row;
  }
echo json_encode($data);
?>
