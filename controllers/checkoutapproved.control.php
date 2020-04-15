<?php
require_once 'libs/paypal.php';

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transactions;

session_destroy();
/**
 * Controlador cuando paypal manda una aprobación del usuario
 * se debe ahora procesar el pago ejecutandolo y creando la factura
 *
 * @return void
 */
function run()
{
    $payment = executePaypal();
    $viewData = array();
    if ($payment) {
        $viewData["payment"] = $payment->toJSON();
        $viewData["checkoutTitle"]
            = $payment->getPayer()
            ->getPayerInfo()
            ->getFirstName().
            " ".
            $payment->getPayer()
            ->getPayerInfo()
            ->getLastName();
        $viewData["checkoutDescription"] = "";
        $viewData["error"] =  "";
        $viewData["amount"]
            = $payment->getTransactions()[0]
            ->getAmount()
            ->getTotal();
    } else {
        $viewData["error"] = "Error al procesar pagos";
    }
    if (mw_estaLogueado()){
        renderizar("checkoutapproved", $viewData,"verified_layout.view.tpl");
      }else{
        renderizar("checkoutapproved",$viewData);
      }
}

run();

function IngresarHistorial()
{
  $database_name = "proyecto_final";
  $con = mysqli_connect("localhost","root","",$database_name);

  $fecha=date('Y-m-d');

  $SQL = "INSERT INTO ordenes(fecha_orden)
  VALUES ('$fecha');";

  if ($con->query($SQL) === TRUE) {
      $last_id = $con->insert_id;

  }
  else {
    phpAlert($con->error);
  }
  foreach ($_SESSION["cart"] as $key => $value) {
    $total=0;
    $total = $total + (1 * $value["precio"]);
      $cod =$value["codCarrito"];
      $cat =$value["cantidad"];

      $SQL = "INSERT INTO ordenes_detalle  (cod_orden, cod_producto, fecha, total_pagar)
      VALUES ( $last_id , $cod, '$cat', $total);";
      mysqli_query($con, $SQL);

}
}

IngresarHistorial();

/**
 * Ejecuta el pago en paypal
 *
 * @return void
 */
function executePaypal()
{
    if (isset($_GET['PayerID'])) {
        $apiContext = getApiContext();

        $paymentId = $_GET['paymentId'];
        $payment = Payment::get($paymentId, $apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($_GET['PayerID']);

        try {
            
            //error_log($payment->toJSON());
            $result = $payment->execute($execution, $apiContext);

            error_log($result);
            try {
                $payment = Payment::get($paymentId, $apiContext);
            } catch (Exception $ex) {
                error_log($ex);
                return false;
            }
        } catch (Exception $ex) {
            error_log($ex);
        }
        return $payment;
    } else {
        error_log("Usuario cancelo transacción o no es un a peticio adecuada");
        return false;
    }
}
?>
