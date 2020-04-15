<?php
require_once 'libs/paypal.php';
/**
 * Renderizado de Documento
 *
 * @return void
 */
function run()
{
    $viewData = array();
    //Esto lo saca de la carretilla de compras
    $myItems = $_SESSION["cart"];
    $viewData["items"] = $myItems;
    if (isset($_POST["btnSubmit"])) {
        $viewData  = $_POST;
        $payPalReturn = createPaypalTransacction(0, $myItems);
        if ($payPalReturn) {
            redirectToUrl($payPalReturn);
        }
        $viewData["returndata"] = $payPalReturn;
    }
    if (mw_estaLogueado()){
        renderizar("checkout", $viewData,"verified_layout.view.tpl");
      }else{
        renderizar("checkout",$viewData);
      }
}

/**
 * Undocumented function
 *
 * @param [type] $_amount Cantidad a Realizar en la transacción
 * @param array  $_items  Productos a Solicitar Pago
 *
 * @return array datos de la transaccion por paypal
 */
function createPaypalTransacction( $_amount , $_items )
{
    $apiContext = getApiContext();
    $payer = new \PayPal\Api\Payer();
    $payer->setPaymentMethod('paypal');

    $items = new \PayPal\Api\ItemList();
    $_amount = 0 ;
    $Dolar = 24.80;
    foreach ($_items as $_item) {
        $item = new \PayPal\Api\Item();
        $item->setSku($_item["codCarrito"]);
        $item->setName($_item["Descripcion"]);
        $item->setQuantity(1);
        $_item["precio"]=$_item["precio"]/$Dolar;
        $item->setPrice(floatval($_item["precio"]));
        $_amount += floatval($_item["precio"]* 1);
        $item->setCurrency('USD');
        $items->addItem($item);
    }

    $amount = new \PayPal\Api\Amount();
    $amount->setTotal(strval($_amount));
    $amount->setCurrency('USD');

    $transaction = new \PayPal\Api\Transaction();
    $transaction->setAmount($amount);
    $transaction->setNoteToPayee("Clinica Gineco-Obstétrica");
    $transaction->setItemList($items);

    $redirectUrls = new \PayPal\Api\RedirectUrls();

    $redirectUrls
        ->setReturnUrl("http://localhost/Proyecto/index.php?page=checkoutapp")
        ->setCancelUrl("http://localhost/Proyecto/index.php?page=checkoutcnl");

    $payment = new \PayPal\Api\Payment();
    $payment->setIntent('sale')
        ->setPayer($payer)
        ->setTransactions(array($transaction))
        ->setRedirectUrls($redirectUrls);

    try {
        $payment->create($apiContext);
        $_SESSION["paypalTrans"] = $payment;
        return $payment->getApprovalLink();
    } catch (\PayPal\Exception\PayPalConnectionException $ex) {
        // This will print the detailed information on the exception.
        //REALLY HELPFUL FOR DEBUGGING
        error_log($ex->getData());
        return false;
    }
}

run();
?>
