<?php

//header("Content-Type: text/plain");
$servername = "localhost";
$username = "root";
$password = "Slyugrov90";
$dbname = "archive";
$isp = "";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
foreach ($_POST["Ispolnitel"] as $value) {
  $isp=$isp.$value." ";
}

$id_dog = $_POST["id_dogovora"];

if (strlen($id_dog)>0) {
$sql = "Select * from Dog where id = $id_dog";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

/////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////
}


$sql = "INSERT INTO Spisok (Naim_ob,
                            Nomer_zakl,
                            Nomer_reg_zakl,
                            Data_podp_zakl,
                            Data_reg_zakl,
                            Zakl,
                            Srok_zakl_date,

                            id_dogovora,
                            Zakazchik,
                            Nomer_dog,
                            Data_dog,
                            Koment_dog,

                            Nal_eltr_nos,
                            Ispolnitel
                            )";

$sql = $sql . " VALUES ('".$_POST["Naim_ob"].
                       "','".$_POST["Nomer_zakl"].
                       "','".$_POST["Nomer_reg_zakl"].
                       "','".$_POST["Data_podp_zakl"].
                       "','".$_POST["Data_reg_zakl"].
                       "','".$_POST["Zakl"].
                       "','".$_POST["Srok_zakl_date"].

                       "','".$row["id"].
                       "','".$row["Organ"].
                       "','".$row["Nomer_dog"].
                       "','".$row["Data_dog"].
                       "','".$row["Koment"].

                       "','".$_POST["Nal_eltr_nos"].
                       "','".$isp.
                       "')";




if (mysqli_query($conn, $sql)) {

      $id_zakl = mysqli_insert_id($conn);

      if ($_POST["Nal_eltr_nos"]=="file")
      {
        $x = 1;
        echo empty($_FILES["file".$x])."<br>";

        while (!empty($_FILES["file".$x]))
        {
            $typedoc = $_POST["type_doc".$x];

            $uploads_dir = iconv("UTF-8","windows-1251",$_SERVER["DOCUMENT_ROOT"].'\upload\\'.$id_zakl.'\\'.$typedoc.'\\');

            if (!is_dir($uploads_dir))
                {
                if (!mkdir($uploads_dir, 0777, true))
                    {
                        echo "Ошибка при создании папки ".$uploads_dir."<br>";
                    }
                }
            $i = 0;
            foreach ($_FILES["file".$x]['tmp_name'] as $key)
            {
                $fn = iconv("UTF-8","windows-1251",$_FILES["file".$x]['name'][$i]);


                if (move_uploaded_file($key, $uploads_dir.$fn))
                {
                  $utf8uploadfn = iconv("windows-1251","UTF-8",$uploads_dir.$fn);

                  $utf8uploadfn = mysqli_real_escape_string($conn,$utf8uploadfn);

                  $sql = "INSERT INTO prdoc (id_zakl,
                                             chto,
                                             put)";

                    $sql = $sql . " VALUES ('$id_zakl',
                                           '$typedoc',
                                           '$utf8uploadfn'
                                           )";


                  if (!mysqli_query($conn, $sql))
                  {
                    echo "Не придвиденная ошибка ".$sql."<br/>";
                  }


                }
                else
                {
                  echo  "Не придвиденная ошибка при перемещении файла ".$fn."<br/>";
                }
                $i++;
            }
            $x++;
            if ($_FILES["file".$x]['name'][0]=="") {break;}
        }
      }


      echo "Ok";
}
else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>
