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

$sql = "Select * from exp";
$result = mysqli_query($conn, $sql);
$Exp = $result;

mysqli_close($conn);
?>
<!doctype html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-html5-1.5.4/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-html5-1.5.4/datatables.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/i18n/defaults-ru_RU.js"> </script>


    <title>Hello, world!</title>
    <style type="text/css">
          .navbar {
            background: -webkit-linear-gradient(45deg, #0a67a3 36%,#0a67a3 50%,#0a67a3 57%,#ffffff 100%);
          }

          #foot {
          background: -webkit-linear-gradient(-45deg, #0a67a3 36%,#0a67a3 50%,#0a67a3 57%,#ffffff 100%);
          }

          #h1{
            color: #fff;
            font-family: "Segoe UI",sans-serif;
          }
    </style>
</head>

<body>
      <nav class="navbar navbar-expand-mb navbar-light bg-light">
        <div class="container-fluid">
          <div class="row">

              <div><img class="m-2" src="sprite/emb.png" alt="" width="80" height="100"></div>
              <div class="m-2"><h1 class="m-3" id="h1">Электронный архив "ООО ГазЭкспертСервис"</h1></div>

            </div>
          </div>
        </nav>
    <br>
    <div class="container" id="cont">
        <h3 class="mb-2 mt-4">Создания объекта архива</h3>
        <form action="NewObj.php" method="POST" enctype="multipart/form-data" id="forma">

            <label>Наименование объекта</label>
            <div class="input-group mb-3">
                <textarea class="form-control" aria-label="With textarea" name="Naim_ob" required></textarea>
            </div>

            <div class="row">
              <div class="col">
                <label>Номер заключения ЭПБ</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="Nomer_zakl" required>
                </div>
              </div>
              <div class="col">
                <label>Дата подписания заключения ЭПБ</label>
                <div class="input-group mb-3">
                    <input type="date" class="form-control" name="Data_podp_zakl" required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <label>Номер регистрации заключении ЭПБ в РТН</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="Nomer_reg_zakl">
                </div>
              </div>
              <div class="col">
                <label>Дата регистрации заключения ЭПБ в РТН</label>
                <div class="input-group mb-3">
                    <input type="date" class="form-control" name="Data_reg_zakl">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <label>Вывод заключения</label>
                <div class="input-group mb-3">
                    <textarea class="form-control" name="Zakl" required></textarea>
                </div>
              </div>
              <div class="col">
                <label>Срок действие заключения ЭПБ до</label>
                <div class="input-group mb-3">
                    <input type="date" class="form-control" name="Srok_zakl_date">
                </div>
              </div>
            </div>

            <label>Договор</label>
            <div class="row">
              <div class="col">
                <div class="input-group">
                    <select class="selectpicker form-control" id="sdog" name="id_dogovora" data-live-search="true" multiple data-max-options="1">
                      <option value="Данные отсутствуют">Данные отсутствуют</option>
                        <?php
                          while($row = mysqli_fetch_array($Dog))
                          {
                              echo '<option value="'.$row["id"].'">'.$row["Organ"].' '.$row["Nomer_dog"].' '.$row["Data_dog"].' '.$row["Koment"].'</option>';
                          }
                        ?>
                      </select>
                </div>
                <small id="HelpBlock" class="mb-3 form-text text-muted">Выбрать договор или создать новый</small>
              </div>
              <div class="col">
                    <a class="btn btn-outline-info" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Создать новый договор</a>
              </div>
            </div>

            <div><!-- Создания договора -->


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

            <label>Эксперт</label>
            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <select class="selectpicker form-control" name="exp[]" id="spexp" size=10 multiple data-live-search="true" required>
                      <?php
                        while($row = mysqli_fetch_array($Exp))
                        {
                            echo '<option value="'.$row["exp"].'">'.$row["exp"].'</option>';
                        }
                      ?>
                    </select>
                  </div>
              </div>
              <div class="col">
                    <a class="btn btn-outline-info" data-toggle="collapse" href="#multiCollapseExp" role="button" aria-expanded="false" aria-controls="multiCollapseExp">Добавить эксперта</a>
              </div>
            </div>

            <div><!-- Создания нового эксперта -->
                <div class="col collapse multi-collapse" id="multiCollapseExp">
                    <div class="card card-body">

                      <label>Новый эксперт</label>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" id="exp">
                      </div>

                      <div class="input-group mb-3"> <!-- Кнопка загрузить -->
                        <input type="button" id="Newexp" value="Сохранить и выбрать" class="btn btn-primary">
                      </div>

                    </div>
                </div>
            </div>


            <label>Исполнители</label>
            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <select class="selectpicker form-control" name="Ispolnitel[]" id="spisp" size=10 multiple data-live-search="true" required>
                      <?php
                        while($row = mysqli_fetch_array($Isp))
                        {
                            echo '<option value="'.$row["Ispolnitel"].'">'.$row["Ispolnitel"].'</option>';
                        }
                      ?>
                    </select>
                  </div>
              </div>
              <div class="col">
                    <a class="btn btn-outline-info" data-toggle="collapse" href="#multiCollapseIsp" role="button" aria-expanded="false" aria-controls="multiCollapseIsp">Добавить эксперта</a>
              </div>
            </div>

            <div><!-- Создания нового эксперта -->
                <div class="col collapse multi-collapse" id="multiCollapseIsp">
                    <div class="card card-body">

                      <label>Новый исполнитель</label>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" id="isp">
                      </div>

                      <div class="input-group mb-3"> <!-- Кнопка загрузить -->
                        <input type="button" id="Newisp" value="Сохранить и выбрать" class="btn btn-primary">
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

            <button type="submit" class="mb-3 btn btn-primary">Добавить в архив</button>

            <script>
                          $('#Newisp').click(function(){

                            $.ajax({
                              url:"Newisp.php",
                              type:"POST",
                              data: ({
                                        isp: $("#isp").val()
                                    }),
                              dataType: "html",
                              complete: function() {
                                $("#spisp").append('<option value="'+$("#isp").val()+'" selected="">'+$("#isp").val()+'</option>');
                                $("#spisp").selectpicker("refresh");
                                $("#isp").val('');
                                $('#multiCollapseIsp').collapse('hide');
                              }
                            });
                          });

                          $('#Newexp').click(function(){
                            $.ajax({
                              url:"newexp.php",
                              type:"POST",
                              data: ({
                                        exp: $("#exp").val()
                                    }),
                              dataType: "html",
                              complete: function(){
                                $("#spexp").append('<option value="'+$("#exp").val()+'" selected="">'+$("#exp").val()+'</option>');
                                $("#spexp").selectpicker("refresh");
                                $("#exp").val('');
                                $('#multiCollapseExp').collapse('hide');
                              }
                            });
                          });

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
                              complete: funcResp
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

                          $('.selectpicker').selectpicker();
            </script>

        </form>


    </div>

    <footer class="p-3 text-muted text-center text-small" id="foot">
      <p class="mb-1" id="h1">&copy; 2019 ГазЭкспертСервис</p>
    </footer>



</body>

</html>
