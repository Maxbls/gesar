<?php
$servername = "localhost";
$username = "root";
$password = "Slyugrov90";
$dbname = "archive";
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "Select * from doc";
$result = mysqli_query($conn, $sql);
$doc = $result;

$sql = "Select * from isp";
$result = mysqli_query($conn, $sql);
$Isp = $result;

$sql = "Select * from dog";
$result = mysqli_query($conn, $sql);
$Dog = $result;

mysqli_close($conn);
?>
<!doctype html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Hello, world!</title>
    <style type="text/css">
        body{
          height: 100%;
          background: radial-gradient(at top, #FEFFFF, #A7C3CC);
        }
    </style>
</head>

<body>

    <div class="text-center">
        <img class="d-block mx-auto mb-4 mt-2" src="sprite/emb.png" alt="" width="144" height="180">
        <h1>Электронный архив "ГазЭкспертСервис"</h1>
    </div>

    <!-- <p class="lead">Below is an example form built entirely with Bootstrap's form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>-->
    </div>

    <div class="container">
        <h3 class="mb-2 mt-4">Создания объекта архива</h3>
        <form action="NewObj.php" method="POST" enctype="multipart/form-data" id="forma">

            <label>Наименование объекта</label>
            <div class="input-group mb-3">
                <textarea class="form-control" aria-label="With textarea" name="Naim_ob" required></textarea>
            </div>

            <label>Номер заключения ЭПБ</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="Nomer_zakl" required>
            </div>

            <label>Дата подписания заключения ЭПБ</label>
            <div class="input-group mb-3">
                <input type="date" class="form-control" name="Data_podp_zakl">
            </div>

            <label>Номер регистрации заключении ЭПБ в РТН</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="Nomer_reg_zakl">
            </div>

            <label>Дата регистрации заключения ЭПБ в РТН</label>
            <div class="input-group mb-3">
                <input type="date" class="form-control" name="Data_reg_zakl">
            </div>

            <label>Вывод заключения</label>
            <div class="input-group mb-3">
                <textarea class="form-control" name="Zakl" required></textarea>
            </div>

            <label>Срок действие заключения ЭПБ до</label>
            <div class="input-group mb-3">
                <input type="date" class="form-control" name="Srok_zakl_date">
            </div>

            <label>Договор</label>
            <div class="input-group">
                <select class="custom-select" id="sdog" name="id_dogovora">
                  <option value="" disabled selected>Выбрать договор</option>
                  <?php
                    while($row = mysqli_fetch_array($Dog))
                    {
                      if ($row["vis"]==true)
                      {
                        echo '<option value="'.$row["id"].'">'.$row["Organ"].' '.$row["Nomer_dog"].' '.$row["Data_dog"].' '.$row["Koment"].'</option>';
                      }
                    }
                  ?>
                    </select>
            </div>
            <small id="HelpBlock" class="mb-3 form-text text-muted">Выбрать договор или создать новый</small>

            <div><!-- Создания договора -->

                <p>
                    <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Создать новый договор</a>
                </p>

                <div class="col collapse multi-collapse" id="multiCollapseExample1">
                    <div class="card card-body">

                        <label>Организация</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="dogOrg">
                        </div>

                        <label>Номер договора</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="dogNom">
                        </div>

                        <label>Дата договора</label>
                        <div class="input-group mb-3">
                            <input type="date" class="form-control" id="dogDate">
                        </div>

                        <label>Комментарий</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="dogKomment">
                        </div>

                        <div class="input-group mb-3"> <!-- Кнопка загрузить -->
                         <input type="button" id="Newdog" value="Сохранить и выбрать" class="btn btn-primary">
                        </div>
                    </div>



                </div>
            </div>

            <label>Носитель</label>

              <div class="input-group btn-group btn-group-toggle mb-3" data-toggle="buttons" onchange="izmtut()">

                <label class="btn btn-primary active">
                     <input type="radio" id="option1" name="radiobutton" value="electro" checked> Электронный
                </label>

                <label class="btn btn-primary">
                     <input type="radio" id="option2" name="radiobutton"  value="paper"> Бумажный
                </label>
            </div>
              <div class="col bg-white rounded">
                <div class="input-group mb-3" id="electro">

                    <div  class="input-group mt-3" id="divfile">
                        <div class="input-group mb-3">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file1[]" id="fi1" multiple="multiple" onchange="addnfl(this)">
                            <label class="custom-file-label" id="l1">Выберите файл(ы)</label>
                          </div>
                          <div class="input-group-append">
                            <select class="custom-select" name="type_doc1" id="sl1">
                                  <?php
                                    while($row = mysqli_fetch_array($doc))
                                    {
                                      echo '<option selected value="'.$row["naim"].'">'.$row["naim"].'</option>';
                                    }
                                  ?>
                            </select>
                          </div>
                          <div class="input-group-append">
                            <button class="btn btn-danger" type="button" id="bf1" onclick="rf()">Удалить</button>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3" id="paper">
                  <label class="mt-3">Комментарий</label>
                    <div class="input-group">
                      <input type="text" class="form-control mb-3" id="ipt" placeholder="Комментарий" name="Nal_eltr_nos" required>
                    </div>
                </div>
              </div>

            <label>Исполнители</label>
                  <select class="custom-select mb-3" id="ipnt" size=10 name="Ispolnitel[]" multiple required>
                    <?php
                      while($row = mysqli_fetch_array($Isp))
                      {
                        if ($row["vis"]==true)
                        {
                          echo '<option value="'.$row["Ispolnitel"].'">'.$row["Ispolnitel"].'</option>';
                        }
                      }
                    ?>
                  </select>

            <button type="submit" class="mb-3 btn btn-primary">Добавить в архив</button>

            <script>
                          $('#Newdog').click(function(){

                            $.ajax({
                              url:"newDog.php",
                              type:"POST",
                              data: ({
                                        Organ: $("#dogOrg").val(),
                                        Nomer_dog: $("#dogNom").val(),
                                        Data_dog: $("#dogDate").val(),
                                        Koment: $("#dogKomment").val()
                                    }),
                              dataType: "html",
                              success: funcResp
                            });
                          });

                          function funcResp(data){
                            option = $('<option value="'+data+'">'+
                                                         $("#dogOrg").val()+' '+
                                                         $("#dogNom").val()+' '+
                                                         $("#dogDate").val()+' '+
                                                         $("#dogKomment").val()+
                                                         '</option>');
                            $('#sdog').append(option);
                            $("#sdog option[value='" + data + "']").prop('selected', 'true');
                          }

                          var idx = 1;
                          $('#forma').submit(function(){
                            $('input').prop('disabled', false);
                          });

                          izmtut();

                          $('#divfile').change(function(){
                            var str = $('#l1').html();
                            var pos = str.indexOf('Выбрано');
                            if (pos>=0)
                            {
                              $('#ipt').val('file');
                              $('#ipt').prop('disabled', true);
                            }
                          });

                          var x = 1;
                          function izmtut(){
                            if ($('#option1').prop("checked"))
                            {
                               $('#paper').hide(); $('#electro').show();
                            }
                            else
                            {
                              $('#electro').hide(); $('#paper').show();
                            }
                          }


                          function rf(obj)
                                {
                                  if (x>1)
                                  {
                                  if (x==2)
                                  {
                                    $('#l1').addClass("selected").html('Выберите файл(ы)');
                                    $('#file'+x).remove();
                                    x--;
                                    $('#ipt').val('');
                                    $('#ipt').prop('disabled',false);
                                    $("#fi1").prop("disabled",false);
                                  }
                                  else {
                                  x--;
                                  $('#file'+x).remove();

                                  $('#file'+(x+1)).prop('id','file'+x);
                                  $('#fi'+(x+1)).prop('id','fi'+x);
                                  $('#fi'+(x+1)).prop('name','file'+x);
                                  $("#fi"+(x+1)).prop("disabled","false");
                                  $('#bf'+(x+1)).prop('id','bf'+x);
                                  $("#bf"+(x-1)).show();
                                  }
                                  }
                                }

                          function addnfl(obj)
                          {
                                if ($(obj).val() != '')
                                {
                                  $(obj).next('.custom-file-label').addClass("selected").html('Выбрано файлов: ' + $(obj)[0].files.length);
                                  $("#bf"+(x-1)).hide();
                                  $("#fi"+x).prop("disabled","true");
                                  $("#bf"+x).show();
                                  addFields();
                                }
                                else
                                {
                                  $(obj).next('.custom-file-label').addClass("selected").html('Выберите файл(ы)');
                                }
                          }

                          function addFields()
                          {
                            x++;
                            divif = $('<div class="input-group mb-3" id="file'+x+'">'+
                                        '<div class="custom-file">'+
                                          '<input type="file" class="custom-file-input" id="fi'+x+'" onchange="addnfl(this)" multiple="multiple" name="file'+x+'[]">'+
                                          '<label class="custom-file-label">Выберите файл(ы)</label>'+
                                        '</div>'+
                                        '<div class="input-group-append" >'+
                                          '<select class="custom-select" name="type_doc'+x+'" id="sl'+x+'">'+
                                          '</select>'+
                                        '</div>'+
                                        '<div class="input-group-append">'+
                                          '<button class="btn btn-danger" type="button" id="bf'+x+'" onclick="rf()">Удалить</button>'+
                                        '</div>'+
                                      '</div>');
                            $('#divfile').append(divif);
                            $("#bf"+x).hide();
                            zap_sl();
                          }

                          function zap_sl()
                          {
                            $("#sl"+x).append($("#sl1").html());
                          }

            </script>

        </form>


    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>
