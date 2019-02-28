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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-html5-1.5.4/sl-1.2.6/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-html5-1.5.4/sl-1.2.6/datatables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
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

      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#Dog">Договор</a>

        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#Isp">Исполнители</a>

        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#PF">Прикрепляемые файлы</a>

        </li>
      </ul>

      <div class="tab-content">
        <div class="tab-pane container active"  id="Dog">
            <br>
            <table id="TableDog" class="table table-striped table-bordered"></table>
          </div>
        <div class="tab-pane container fade" id="Isp">
            <br>
            <table id="TableIsp" class="table table-striped table-bordered"></table>
          </div>
        <div class="tab-pane container fade" id="PF">
            <br>
            <table id="TablePF" class="table table-striped table-bordered"></table>
          </div>
      </div>

    </div>

    <footer class="p-3 text-muted text-center text-small" id="foot">
      <p class="mb-1" id="h1">&copy; 2019 ГазЭкспертСервис</p>
    </footer>

    <script type="text/javascript">

    var TableDog = $('#TableDog').DataTable( {
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      "paging":         false,
        stateSave:    true,
        colReorder:   true,
        "bSmart": false,
        "bRegex": true,
        select: true,
        "ajax": "getDogTable.php",
        "columns": [
                      {
                        "data": "id",
                        "title": "№"
                      }, //0
                      {
                        "data": "Organ",
                        "title": "Организация"
                      }, //1
                      {
                        "data": "Nomer_dog",
                        "title": "Номер договора"
                      }, //2
                      {
                        "data": "Data_dog",
                        "title": "Дата договора"
                      }, //3
                      {
                        "data": "Koment",
                        "title": "Комментарии"
                      }, //4
                      {
                        "data": "vis",
                        "title": "Видимость",
                          render: function(data, type, row) {
                            var id = row.id;
                            if (data === '1') {
                              return '<input type="checkbox" onclick="checkvisdog(\''+id+'\',this);" checked>';
                            } else {
                              return '<input type="checkbox" onclick="checkvisdog(\''+id+'\',this);">';
                            }
                            return data;
                          },
                        "className": "dt-body-center text-center"
                      } //5
                  ],
            dom: 'Bfrtip',
            buttons: [
                      {
                          extend: 'selectedSingle',
                          text: 'Удалить',
                          attr:
                                {
                                  class: 'btn btn-danger ml-3'
                                },
                          action: function ( e, dt, button, config )
                            {
                              var mass = TableDog.rows( { selected: true } ).data();
                              var m = mass[0];
                              alert(m["id"]);
                            }
                      },
                      {
                          extend: 'selectedSingle',
                          text: 'Изменить',
                          attr:
                                {
                                  class: 'btn btn-info ml-3'
                                },
                          action: function ( e, dt, button, config )
                            {
                              var mass = TableDog.rows( { selected: true } ).data();
                              var m = mass[0];
                              alert(m["id"]);
                            }
                      },
                      {
                          text: 'Добавить',
                          attr:
                                {
                                  class: 'btn btn-success ml-3'
                                },
                          action: function ( e, dt, button, config )
                            {
                              var mass = TableDog.rows( { selected: true } ).data();
                              var m = mass[0];
                              alert(m["id"]);
                            }
                      }
                  ]
    } );

    var TableIsp = $('#TableIsp').DataTable( {
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      "paging":         false,
        stateSave:    true,
        colReorder:   true,
        "bSmart": false,
        "bRegex": true,
        select: true,
        "ajax": "getIspTable.php",
        "columns": [
                      {
                        "data":     "id",
                        "title":    "№"
                      }, //0
                      {
                        "data": "Ispolnitel",
                        "title": "Исполнитель"
                      }, //1
                      {
                        "data": "vis",
                        "title": "Видимость",
                          render: function(data, type, row) {
                            var id = row.id;
                            if (data === '1') {
                              return '<input type="checkbox" onclick="checkvisisp(\''+id+'\',this);" checked>';
                            } else {
                              return '<input type="checkbox" onclick="checkvisisp(\''+id+'\',this);">';
                            }
                            return data;
                          },
                        "className": "dt-body-center text-center"
                      } //2
                  ],
                  dom: 'Bfrtip',
                  buttons: [
                            {
                                extend: 'selectedSingle',
                                text: 'Удалить',
                                attr:
                                      {
                                        class: 'btn btn-danger ml-3'
                                      },
                                action: function ( e, dt, button, config )
                                  {
                                    var mass = TableDog.rows( { selected: true } ).data();
                                    var m = mass[0];
                                    alert(m["id"]);
                                  }
                            },
                            {
                                extend: 'selectedSingle',
                                text: 'Изменить',
                                attr:
                                      {
                                        class: 'btn btn-info ml-3'
                                      },
                                action: function ( e, dt, button, config )
                                  {
                                    var mass = TableDog.rows( { selected: true } ).data();
                                    var m = mass[0];
                                    alert(m["id"]);
                                  }
                            },
                            {
                                text: 'Добавить',
                                attr:
                                      {
                                        class: 'btn btn-success ml-3'
                                      },
                                action: function ( e, dt, button, config )
                                  {
                                    var mass = TableDog.rows( { selected: true } ).data();
                                    var m = mass[0];
                                    alert(m["id"]);
                                  }
                            }
                        ]
    } );

    var TablePF = $('#TablePF').DataTable( {
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      "paging":         false,
        stateSave:    true,
        colReorder:   true,
        "bSmart": false,
        "bRegex": true,
        select: true,
        "ajax": "getPFTable.php",
        "columns": [
                      {
                        "data":     "id",
                        "title":    "№"
                      }, //0
                      {
                        "data": "naim",
                        "title": "Названия файла"
                      } //1
                    ],
                    dom: 'Bfrtip',
                    buttons: [
                              {
                                  extend: 'selectedSingle',
                                  text: 'Удалить',
                                  attr:
                                        {
                                          class: 'btn btn-danger ml-3'
                                        },
                                  action: function ( e, dt, button, config )
                                    {
                                      var mass = TableDog.rows( { selected: true } ).data();
                                      var m = mass[0];
                                      alert(m["id"]);
                                    }
                              },
                              {
                                  extend: 'selectedSingle',
                                  text: 'Изменить',
                                  attr:
                                        {
                                          class: 'btn btn-info ml-3'
                                        },
                                  action: function ( e, dt, button, config )
                                    {
                                      var mass = TableDog.rows( { selected: true } ).data();
                                      var m = mass[0];
                                      alert(m["id"]);
                                    }
                              },
                              {
                                  text: 'Добавить',
                                  attr:
                                        {
                                          class: 'btn btn-success ml-3'
                                        },
                                  action: function ( e, dt, button, config )
                                    {
                                      var mass = TableDog.rows( { selected: true } ).data();
                                      var m = mass[0];
                                      alert(m["id"]);
                                    }
                              }
                          ]
    } );

    function checkvisisp(id,e){
      $.ajax( {
                url: 'ivisp.php',
                type: "POST",
                data:
                      {
                        id: id,
                        check: e.checked
                      },
                dataType: 'json',
                success: function ( json )
                      {
                        $(".alert").alert();

                        // <div class="alert alert-primary" role="alert">
                        //     <strong>Well done!</strong> You successfully read this
                        //     important alert message.
                        // </div>
                      }
            } );
    }

    function checkvisdog(id,e){
      $.ajax( {
                url: 'ivdog.php',
                type: "POST",
                data:
                      {
                        id: id,
                        check: e.checked
                      },
                dataType: 'json',
                success: function ( json )
                      {
                        $(".alert").alert();

                        // <div class="alert alert-primary" role="alert">
                        //     <strong>Well done!</strong> You successfully read this
                        //     important alert message.
                        // </div>
                      }
            } );
    }

    </script>

</body>
</html>
