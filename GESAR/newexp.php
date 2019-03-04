<?php
$servername = "localhost";
$username = "root";
$password = "Slyugrov90";
$dbname = "archive";
$con = new mysqli($servername, $username, $password, $dbname);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$sql = "INSERT INTO exp (exp)";
$sql = $sql." VALUES ('".$_POST["exp"]."')";

if (mysqli_query($con, $sql))
{
        echo mysqli_insert_id($con);
}
else {
  echo "Error";
}
mysqli_close($con);
?>
