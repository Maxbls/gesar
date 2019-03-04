<?php
$servername = "localhost";
$username = "root";
$password = "Slyugrov90";
$dbname = "archive";
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "Select * from Spisok order by id desc";
$result = mysqli_query($conn, $sql);
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Электронный архив</title>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-html5-1.5.4/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-html5-1.5.4/datatables.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/i18n/defaults-ru_RU.js"> </script>
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

    <button type="button" class="btn btn-success mb-3" onclick="location.href = 'snewObj.php'" >Добавить объект</button>
    <button type="button" class="btn btn-primary mb-3 ml-3" onclick="location.href = 'dd.php'" >Сопутствующие данные</button>

      <div class="table-responsive">
        <style media="screen">
          td.details-control {
            background: url('../resources/details_open.png') no-repeat center center;
            cursor: pointer;
          }
          tr.shown td.details-control {
            background: url('../resources/details_close.png') no-repeat center center;
          }
          </style>
        <table id="spisok" class="table table-striped table-bordered">
          </table>
        </div>

    </div>

    <footer class="p-3 text-muted text-center text-small" id="foot">
      <p class="mb-1" id="h1">&copy; 2019 ГазЭкспертСервис</p>
    </footer>

    <script type="text/javascript">

          function Detfiltr(){
            if ($(table.table().header()).find("div").css('display')=='inline-block')
                  {
                    $('.selectpicker').selectpicker('hide');
                    $(table.table().header()).find("input").css('display','none');
                    $('#btnfil').text('Вкл расш. фильтр');
                   }
            else
                  {
                    $('.selectpicker').selectpicker('show');
                    $(table.table().header()).find("input").css('display','table');
                    $('#btnfil').text('Выкл расш. фильтр');
                   }
            table.columns.adjust().draw();
          }

          function funccon (){
            if ($('#cont').attr('class') == 'container-fluid')
            {
              $('#cont').prop('class','container');
              $('#btnvid').text('Расширить вид');
            }
            else
            {
              $('#cont').prop('class','container-fluid');
              $('#btnvid').text('Стандартный вид');
            }

          }
          //////////////////////////////////////////////////////////////////////////////////////////////////////
          function format ( d ) {
            // `d` is the original data object for the row
            var res;
            if (d.Nal_eltr_nos == 'file') {
                                            res = '<div class="spinner-border" role="status"> <span class="sr-only">Loading...</span></div>';

                                            Nositel(d.id);
                                          }

                                    else  {
                                            res = d.Nal_eltr_nos;
                                          }

            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                '<tr>'+
                    '<td>№:</td>'+
                    '<td>'+d.id+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Наименование объекта:</td>'+
                    '<td>'+d.Naim_ob+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>FНомер заключения ЭПБ:</td>'+
                    '<td>'+d.Nomer_zakl+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Дата подписания заключения ЭПБ:</td>'+
                    '<td>'+d.Data_podp_zakl+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Номер регистрации заключения ЭПБ в РТН:</td>'+
                    '<td>'+d.Nomer_reg_zakl+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Дата регистрации заключения ЭПБ в РТН:</td>'+
                    '<td>'+d.Data_reg_zakl+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Срок действие заключения ЭПБ до:</td>'+
                    '<td>'+d.Srok_zakl_date+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Вывод заключения:</td>'+
                    '<td>'+d.Zakl+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Договор:</td>'+
                    '<td>'+
                      '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                        '<tr>'+
                          '<td>Номер договора:</td>'+
                          '<td>'+d.Nomer_dog+'</td>'+
                        '</tr>'+
                        '<tr>'+
                          '<td>Заказчик:</td>'+
                          '<td>'+d.Zakazchik+'</td>'+
                        '</tr>'+
                        '<tr>'+
                          '<td>Дата договора:</td>'+
                          '<td>'+d.Data_dog+'</td>'+
                        '</tr>'+
                        '<tr>'+
                          '<td>Комментарий:</td>'+
                          '<td>'+d.Koment_dog+'</td>'+
                        '</tr>'+
                      '</table>'+
                    '</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Носитель:</td>'+
                    '<td id="tid">'+res+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Исполнитель:</td>'+
                    '<td>'+d.Ispolnitel+'</td>'+
                '</tr>'+
            '</table>';
        }

        function Nositel (id)
            {
              var table = $("<table/>")
                $.ajax( {
                          url: 'getfile.php',
                          type: "POST",
                          data:
                                {
                                  id: id
                                },
                          dataType: 'json',
                          success: function ( json )
                                {
                                  $('#tid').html('');
                                  $.each(json, function(i, item)
                                                      {
                                                        var str = json[i].put;
                                                        var filename = json[i].put;
                                                        str = str.replace('C:\\inetpub\\wwwroot\\', '');
                                                        filename = filename.split('\\').pop().split('/').pop();
                                                        filename = filename.substring(0, filename.lastIndexOf('.'));
                                                        $('<tr>').html('<td>' + json[i].chto + '</td><td><p><a href="' + str + '">'+filename+'</a></td>').appendTo($('#tid'));

                                                      }
                                        );
                                }
                      } );
            }


            var table = $('#spisok').DataTable( {
              "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
              // "scrollY":        "900px",
              // "scrollCollapse": true,
              "paging":         false,
                stateSave:    true,
                colReorder:   true,
                "bSmart": false,
                "bRegex": true,
                "ajax": "generaltable0.php",
                "columns": [
                              {
                                  "className":      'details-control',
                                  "orderable":      false,
                                  "data":           null,
                                  "defaultContent": ''
                              }, //00
                              {
                                "data":     "id",
                                "visible":  false,
                                "title":    "№"
                              }, //0
                              {
                                "data": "Naim_ob",
                                "title":    "Наименование объекта"
                              }, //1
                              {
                                "data": "Nomer_zakl",
                                "title":    "Номер заключения ЭПБ"
                              }, //2
                              {
                                "data": "Data_podp_zakl",
                                "title":    "Дата подписания заключения ЭПБ"
                              }, //3
                              {
                                "data": "Nomer_reg_zakl",
                                "visible": false,
                                "title":    "Номер регистрации заключения ЭПБ в РТН"
                              }, //4
                              {
                                "data": "Data_reg_zakl",
                                "visible": false,
                                "title":    "Дата регистрации заключения ЭПБ в РТН"
                              }, //5
                              {
                                "data": "Srok_zakl_date",
                                "title":    "Срок действие заключения ЭПБ до" }, //6
                              {
                                "data": "Zakl",
                                "visible": false,
                                "title":    "Вывод заключения"
                              }, //7
                              {
                                "data": "id_dogovora",
                                "visible": false,
                                "title":    "id Договора"
                              }, //8
                              {
                                "data": "Zakazchik",
                                "visible": false,
                                "title":    "Заказчик"
                              }, //9
                              {
                                "data": "Nomer_dog",
                                "visible": false,
                                "title":    "Номер договора"
                              }, //10
                              {
                                "data": "Data_dog",
                                "visible": false,
                                "title":    "Дата договора"
                              }, //11
                              {
                                "data": "Nal_eltr_nos",
                                "visible": false,
                                "title":    "Носитель"
                              }, //12
                              {
                                "data": "Expert",
                                "title":    "Эксперт"
                              }, //13
                              {
                                "data": "Ispolnitel",
                                "title":    "Исполнитель"
                              } //14
                            ],
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Russian.json",
                    buttons: {
                      colvis: 'Видимость столбцов',
                      excel:  'Вывод на Excel',
                      copy:   'Копировать таблицу',
                    }
                  },
                dom: 'Bfrtip',
                buttons: [
                    'colvis',
                    { extend:'copy',
                      attr:
                            {
                              id: 'allan',
                              class: 'btn btn-info ml-3'
                            }
                    },
                    {
                      extend:'excel',
                      attr:
                            {
                              class: 'btn btn-info ml-3'
                            }
                    }
                ],

              initComplete: function () {
                    this.api().columns([2,3,4,5,6,7,8,9,10,11,12,13,14]).every( function () {
                        var column = this;
                        $(column).css('overflow','hidden');
                        column.search('').draw();
                        var header = $(column.header());

                        var select = $('<select class="selectpicker" multiple data-live-search="true"></select>');
                        var br = $('<br>');
                        header.append(br);
                        header.append(select);

                        var input = $('<input type="text" onclick="event.cancelBubble = true" style="cursor: text" class="btn btn-light btn-sm">');
                        header.append(input);

                        input.on( 'keyup change',
                                        function () {
                                                      if ( column.search() !== this.value ) {
                                                                                            $('.selectpicker').selectpicker('deselectAll');
                                                                                            column
                                                                                                  .search( this.value )
                                                                                                  .draw();
                                                                                            table.columns.adjust().draw();
                                                                                          }
                                                    }
                                      );


                            select.on( 'change', function () {
                                                              var vals = $('option:selected', this).map(
                                                                                                        function (index, element) {
                                                                                                                                   input.value = '';
                                          	                                                                                       return $.fn.dataTable.util.escapeRegex($(element).val());
                                                                                                                                  }
                                                                                                        )
                                                                                                   .toArray()
                                                                                                   .join('|');

                                        column
                                            .search( vals.length > 0 ? vals : '', true, false )  //'^('+vals+')$'
                                            //.search( vals )
                                            .draw();
                                        table.columns.adjust().draw();
                                    } );

                         column.data().unique().sort().each( function ( d, j ) {
                                                        select.append( '<option>'+d+'</option>' );
                        } );
                    } );

                    $('.selectpicker').selectpicker({});

                    Detfiltr();
                    table.buttons().container().append('<button type="button" class="btn btn-info ml-3" onclick="Detfiltr()" id="btnfil">Вкл расш. фильтр</button>');
                    table.buttons().container().append('<button type="button" class="btn btn-info ml-3" onclick="funccon()" id="btnvid">Расширить вид</button>');
                    //table.buttons().container().show();

                }


            } );


            $('#spisok').on( 'column-visibility.dt', function ( e, settings, column, state ) {
                  if ($(table.table().header()).find("div").css('display')=='inline-block')
                        {
                          $(table.table().header()).find("input").css('display','table');
                         }
                  else
                        {
                          $(table.table().header()).find("input").css('display','none');
                         }
                  table.columns.adjust().draw();
              } );


            $('#spisok tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );
                //var rows = table.rows( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {


                          table.rows().every(function(){
                              if(this.child.isShown()){
                                  this.child.hide();
                                  $(this.node()).removeClass('shown');
                              }
                          });

                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            } );

        //} );




    </script>

</body>
</html>
