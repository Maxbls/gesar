<?php
$servername = "localhost";
$username = "root";
$password = "Slyugrov90";
$dbname = "archive";
$con = new mysqli($servername, $username, $password, $dbname);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$input_date=$_POST['Data_dog'];
$date=date("Y-m-d",strtotime($input_date));

$sql = "INSERT INTO dog (Organ, Nomer_dog, Data_dog, Koment)";
$sql = $sql." VALUES ('".$_POST["Organ"].
                       "','".$_POST["Nomer_dog"].
                       "','".$date.
                       "','".$_POST["Koment"].
                       "')";

if (mysqli_query($con, $sql))
{
        echo mysqli_insert_id($con);
}
else {
  echo "Error";
}
mysqli_close($con);
?>
