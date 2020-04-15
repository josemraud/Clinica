<?php
require_once 'vendor/autoload.php';

//die("<h1>Revisar el archivo libs/paypal.php</h1><h1>Comentar o eliminar linea 4 despues de agregar los datos de autenticación solicitados</h1><h2><a href=\"index.php?page=dashboard\">Regresar</a></h2>");
/**
 * Retorna el Api Context de Paypal
 *
 * @return void
 */
function getApiContext()
{
    $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'AVp2GXS8DZ7owLMyxOYdUL85x1bxG7ncmcxeUmscEqaXT_KUSkvAJKRi2y2cLhIa3xfr8Jjo9nlvTQoF',     // ClientID
            'EKdAqj2RtLhUcBfm37ijYYc_CrYZdR0BG_nJuXr_aq9JtPJLM_FDvKS5MCddnB5_YPyzaa7ZG5qhFg_I'      // ClientSecret
        )
    );
    return $apiContext;
}
?>
