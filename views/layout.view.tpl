<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <title>{{page_title}}</title>
            <meta name="viewport" content="width=device-width, initial-scale=1"/>
            <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
            <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Anton|Oswald" rel="stylesheet">
            <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
            <link rel="stylesheet" href="public/css/estilosMain.css"/>
            {{foreach css_ref}}
                <link rel="stylesheet" href="{{uri}}" />
            {{endfor css_ref}}
        </head>
        <body>
            <div class="menu">
               <header>
                <img src="public/img/logo.png" alt="logo" class="logo">
                <nav class="main-nav">
                    <ul>
                        <li><a href="index.php?page=home">Inicio</a></li>
                        <li><a href="index.php?page=info">Información</a></li>
                        <li><a href="index.php?page=consultas">Consultas</a></li>
                        <li><a href="index.php?page=login">Iniciar Sesión</a></li>
                    </ul>
                </nav>
                </header>
            </div>
            <div class="contenido">
                {{{page_content}}}
            </div>
            <footer>
            <div class="contenedor-footer">
                <div class="flex-hijo">
                    <img src="public/img/logo.png" alt="">
                </div>
                <div class="flex-hijo">
                    <div class="informacion">
                         <p>Dr. Mohamed Alcides Zelaya &copy; 2019
                        </br>Calle 13, La Ceiba, Atlantida
                        </br>Frente a Plaza El Iman
                        </br>Telefono: 2440-1438
                        </br>Horario de atencion: Lunes a Viernes de 9am-6pm</p>
                    </div>
                </div>
            </div>
        </footer>
        {{foreach js_ref}}
                <script src="{{uri}}"></script>
            {{endfor js_ref}}
            <script>
              $().ready(function(e){
                $(".hbtn").click(function(e){
                  e.preventDefault();
                  e.stopPropagation();
                  $(".menu").toggleClass('open');
                  });
              });
            </script>
        </body>
    </html>

            {{foreach js_ref}}
                <script src="{{uri}}"></script>
            {{endfor js_ref}}
            <script>
              $().ready(function(e){
                $(".hbtn").click(function(e){
                  e.preventDefault();
                  e.stopPropagation();
                  $(".menu").toggleClass('open');
                  });
              });
            </script>
        </body>
    </html>


