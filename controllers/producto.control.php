<?php

require_once "models/productodata.model.php";
function run()
{
    $viewData = array();


    $Tipo = array(
      array("cod" => "1", "desc" => "Combo"),
      array("cod" => "2", "desc" => "Personal"),
      array("cod" => "3", "desc"=> "Bebida")
    );

    $mode= array(
      "INS"=>"Producto Nuevo",
      "UPD" => "Actualizando",
      "DEL" => "Eliminando ",
      "DSP" => "Detalle de ",
    );

    $viewData["mode"] = "";
    $viewData["cod_producto"] = "";
    $viewData["errors"]= array();
    $viewData["haserrors"] = false;
    $viewData["readonly"] = false;
    $viewData["isdeleting"] = false;
    $viewData["xstoken"] = '';

    if(isset($_GET["mode"])){
      $viewData["mode"] = $_GET["mode"];
    }

    if(isset($_GET["cod_producto"])){
      $viewData["cod_producto"] = $_GET["cod_producto"];
    }

    $viewData["Tipo"] = $Tipo;


    switch($viewData["mode"]){
      case "INS":
      break;
      case "UPD":

        break;
      case "DEL":
        $viewData["isdeleting"] = "readonly";
        break;
      case "DSP":
       $viewData["readonly"] = "readonly";
        break;
      default:
        redirectWithMessage("Acción No Disponible", "index.php?page=productos");

    }

    if (isset($_POST["btnConfirmar"])) { /// Si hay un POST (INS, UPD, DEL)
        $varBody = $_POST;

        mergeFullArrayTo($viewData, $varBody);


        //Validacion
        $validated = true;
        if($viewData["mode"] =='INS' || $viewData["mode"]=="UPD"){
          //Validaciones Correspondientes
          /*if($_SESSION["examen_token"] != $varBody["examen_token"]){
            $validated = false;
            $viewData["haserrors"] = true;
            error_log("Token de Verificacion comprometido");
            //addBitacora("examen", "Error Token", json_encode($varBody), "WRN");
            redirectWithMessage("Lo sentimos ocurrio un error!!!", "index.php?page=examenlist");
          }*/
          if (preg_match('/^\s*$/', $varBody["descripcion"] ) == 1){
            $validated = false;
            $viewData["descripcion_haserror"] = true;
            $viewData["descripcion_error"] = "La descripción no puede ir vacia.";
          }

        } else {
            if($viewData["mode"] == 'DEL'){
              $viewData["isdeleting"] = "readonly";
            }
            if($viewData["mode"] == 'DSP'){
              $viewData["readonly"] = "readonly";
            }

        }
        if($validated){
          switch($viewData["mode"]){
            case "INS":
              if(agregarProducto($varBody["descripcion"],$varBody["precio"], $varBody["cod_tipo"])){
                $_SESSION["examen_token"] = "";
                redirectWithMessage("Producto Agregado Satisfactoriamente!", "index.php?page=productos");
              }else{
                $viewData["errors"][] = "Error al agregar nuevo producto";
                $viewData["haserrors"] = true;
              }
              break;

            case "UPD":
              $oldProduct = obtenerProductoXCodigo($varBody["cod_producto"]);
              //$result = actualizarProducto($varBody["descripcion"],$varBody["precio"], $varBody["cod_tipo"], $varbody["cod_producto"]);
              if(actualizarProducto($varBody["descripcion"],$varBody["precio"], $varBody["cod_tipo"], $varBody["cod_producto"])>0){
                $logDetail = array("old"=> $oldProduct,"new"=>$varBody);
                //insertBitacora("producto","Actualización", json_encode($logDetail), "WRN");
                $_SESSION["examen_token"] = "";
                redirectWithMessage("Producto Actualizado Satisfactoriamente!", "index.php?page=productos");
                }else{
                  $viewData["errors"][] = "No se actualizó el producto o se generó un error. Intente nuevamente mas tarde.";
                  $viewData["haserrors"] = true;
                }
                break;

              case "DEL":
                if(eliminarProducto($varBody["cod_producto"])>=0) {
                    $_SESSION["examen_token"] = "";
                    redirectWithMessage("Producto Eliminado Satisfactoriamente!", "index.php?page=productos");
                  }else{
                    $viewData["errors"][] = "No se eliminó el producto o se generó un error. Intente nuevamente mas tarde.";
                    $viewData["haserrors"] = true;
                  }
                  break;
          }
        }else{

        }
    }

    if ($viewData["mode"] !== "INS") {
        $examen = obtenerProductoXCodigo($viewData["cod_producto"]);
        mergeFullArrayTo($examen, $viewData);
    }
    $_SESSION["examen_token"] = md5("examen" . time());
    $viewData["examen_token"] = $_SESSION["examen_token"];

    $viewData["modedsc"] = $mode[$viewData["mode"]];


    renderizar("producto", $viewData);
}

run();
?>
