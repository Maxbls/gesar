<?php
$servername = "localhost";
$username = "root";
$password = "Slyugrov90";
$dbname = "archive";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($_POST["check"]=='true') {
  $check = 1;
}
else {
  $check = 0;
}

$sql = "UPDATE dog SET vis = '$check' WHERE dog.id = '".$_POST["id"]."'";
//UPDATE `isp` SET `vis` = '0' WHERE `isp`.`Ispolnitel` = 1;
if (mysqli_query($conn, $sql)){
  echo "Ok";
  // echo "<br>";
  // echo $sql;
}
else {
  echo "Ошибка при изменении видимости";
  // echo "<br>";
  // echo $sql;
}
?>
