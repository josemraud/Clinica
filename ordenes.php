<?php


session_start();
    $database_name = "proyecto_final";
    $con = mysqli_connect("localhost","root","",$database_name);

    if (isset($_POST["add"])){
        if (isset($_SESSION["cart"])){
            $item_array_id = array_column($_SESSION["cart"],"codCarrito");
            if (!in_array($_GET["id"],$item_array_id)){
                $count = count($_SESSION["cart"]);
                $item_array = array(
                    'codCarrito' => $_GET["id"],
                    'Descripcion' => $_POST["descripcion"],
                    'precio' => $_POST["precio"],
                    'cantidad' => $_POST["cantidad"],
                );
                $_SESSION["cart"][$count] = $item_array;
                echo '<script>window.location="ordenes.php"</script>';
            }else{
                echo '<script>alert("Ya esta en el carro")</script>';
                echo '<script>window.location="ordenes.php"</script>';
            }
        }else{
            $item_array = array(
                'codCarrito' => $_GET["id"],
                'Descripcion' => $_POST["descripcion"],
                'precio' => $_POST["precio"],
                'cantidad' => $_POST["cantidad"],
            );
            $_SESSION["cart"][0] = $item_array;
        }
    }
    if (isset($_POST["limpiar"])){
      Clean();

    }
    function Clean()
    {
      unset($_SESSION["cart"]);

    }
    function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }


      if (isset($_GET["pay"])){
          if ($_GET["pay"] == "pagar"){



                if(!empty($_SESSION["cart"])){
                    $Val=1;

                if ($Val==1)
                {
                  $fecha=date('Y-m-d');

                  $SQL = "INSERT INTO ordenes (fecha_orden)
                  VALUES ( '$fecha');";

                  if ($con->query($SQL) === TRUE) {
                      $last_id = $con->insert_id;

                  }
                  else {
                    phpAlert($con->error)    ;
                }
                  foreach ($_SESSION["cart"] as $key => $value) {
                    $total=0;
                      $total = $total + (1 * $value["precio"]);

                        $cod =$value["codCarrito"];
                        $cat = date($value["cantidad"]);
                        $SQL = "INSERT INTO ordenes_detalle (cod_orden, cod_producto, cantidad, total_pagar)
                        VALUES ( $last_id ,  $cod,   $cat, $total);";
                        mysqli_query($con, $SQL);

              }
            Clean();
      echo '<script>alert("Factura pagada correctamente")</script>';
          echo '<script>window.location="ordenes.php"</script>';
        }  else
                    echo '<script>alert("No se puede cumplir esa orden...!")</script>';
                    echo '<script>window.location="ordenes.php"</script>';
                }

              }
            }


    if (isset($_GET["action"])){
        if ($_GET["action"] == "delete"){
            foreach ($_SESSION["cart"] as $keys => $value){
                if ($value["codCarrito"] == $_GET["id"]){
                    unset($_SESSION["cart"][$keys]);
                    echo '<script>alert("Consulta eliminada de la agenda")</script>';
                    echo '<script>window.location="ordenes.php"</script>';
                }
            }
        }
    }



?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Agenda en Linea</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="public/css/agenda.css">
    <link rel="stylesheet" href="public/css/estilosMain.css">
      <link href="https://fonts.googleapis.com/css?family=Solway&display=swap" rel="stylesheet">
    <script src="public/js/jquery.min.js"></script>


</head>

<div class="menu">
               <header>
                <img src="public/img/logo.png" alt="logo" class="logo">
                <nav class="main-nav">
                    <ul>
                        <li><a href="index.php?page=home">Inicio</a></li>
                        <li><a href="index.php?page=info">Información</a></li>
                        <li><a href="index.php?page=consultas">Consultas</a></li>
                        <li><a href="ordenes.php">Agendar</a></li>
                        <li><a href="index.php?page=logout">Cerrar Sesión</a></li>
                    </ul>
                </nav>
                </header>
            </div>

</header>
<body style="background-color:#ECF0F1;">
  <br><br><br>
    <div   class="col-s-12 col-m-12 col-l-12 " >

<br><br><br>
        <div id="Subtitulo"></div>
            <h1>Tipos de Consultas</h1>
        </div>
        <section class="citas" id="citas">
        
        <?php
        
            $query = "SELECT * FROM productos";
            $result = mysqli_query($con,$query);
            if(mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_array($result)) {


                    ?>  
                    <div class="cita"><div class="col-s-6 col-m-5 col-l-3 tab-item">



                        <form  method="post" action="ordenes.php?action=add&id=<?php echo $row["cod_producto"]; ?>">
                                <img src="public/img/<?php echo $row["prodimg"]; ?>" alt="">
                                <h1 style="font-size:20px;font-family: 'Solway', serif; margin-bottom:auto;" ><?php echo $row["descripcion"]; ?></h5>
                                <h1 class="text-danger" style="font-family: 'Solway', serif; font-size:20px;"> <?php echo  "Precio:"." L. ".$row["precio"]; ?></h5>
                                <label style="font-family: 'Solway', serif;"for="">Escoge la fecha:</label>
                                 <input type="date"  name="cantidad" id="cantidad"/>
                                <input type="hidden"name="descripcion" value="<?php echo $row["descripcion"]; ?>">
                                <input type="hidden" name="precio" value="<?php echo $row["precio"]; ?>">
                                <input type="submit" name="add" style="margin-top: 5px;" value="Añadir al carrito">
                        </form>
</div>
<br>
<br>
<br>
</div>
                      <?php

                }
            }
              ?>
              
              </section>

  </div>

        <div ></div>
        <div >


        <h3 style="font-size: 35px;font-family: 'Solway', serif; ">Carrito:</h3>
        <div class="col-s-10 col-m-10 col-l-10">
            <table style="font-family: 'Solway', serif; " class="blueTable" class="col-10 col-offset-1">
            <tr>
                <th style="font-size: 30px;font-family: 'Solway', serif; " >Nombre</th>
                <th style="font-size: 30px;font-family: 'Solway', serif; ">Fecha</th>
                <th style="font-size: 30px;font-family: 'Solway', serif; ">Precio</th>
                <th style="font-size: 30px;font-family: 'Solway', serif; ">Sub-Total</th>
                <th style="font-size: 30px;font-family: 'Solway', serif; " ></th>
            </tr>

            <?php
                if(!empty($_SESSION["cart"])){
                    $total = 0;
                    foreach ($_SESSION["cart"] as $key => $value) {
                        ?>
                        <tr style="text-align:center">
                            <td><?php echo $value["Descripcion"]; ?></td>
                            <td><?php echo $value["cantidad"]; ?></td>
                            <td>L. <?php echo $value["precio"]; ?></td>
                            <td>
                                L. <?php echo number_format(1 * $value["precio"], 2);?></td>
                            <td><a href="ordenes.php?action=delete&id=<?php echo $value["codCarrito"]; ?>"><span
                                        class="btn">Remover</span></a></td>

                        </tr>
                        <?php
                        $total = $total + (1 * $value["precio"]);


                    }

                        ?>
                        <tr>
                            <td colspan="3" align="right">Total:</td>
                            <th align="left">L.  <?php echo number_format($total, 2); ?></th>

                            <td></td>
                        </tr>
                        <?php

                    }
                ?>

            </table>
              </div>

                  <?php $fecha = date('H', strtotime('-8 hours'));


            ($fecha <=8 || $fecha >=21) ? $resu="disabled" : $resu="enabled";

 ?>
   <div class="col-s-8 col-m-8 col-l-8 pagar ">

                      <a style="  border-radius:3px;
                        border:1px solid #942911;
                        display:inline-block;
                        cursor:pointer;
                        color:#ffffff;
                        font-family:Arial;
                        font-size:13px;
                        font-weight:bold;
                        padding:8px 24px;
                        text-decoration:none;
                        background-color: navy;
                        text-shadow:0px 1px 0px #854629;"href="index.php?page=checkout" class="btn">Pagar</a>


            <form method="post">

         <input type="submit" name="limpiar" style="margin-top: 5px;" class="btn"
            value="Limpiar Carrito">

                   </form>
        </div>

  </div>
    </div>


</body>




</html>
