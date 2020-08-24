<?php
/**
 * End point
 * -------------------------------------
 * manejo la vuelta mientras se hace el proceso.
 */
# recibir el request
# generar un archivo json. por cada movimiento 
/*
if(isset($_REQUEST["topic"])&&$_REQUEST["topic"]=="merchant_order"){
    file_put_contents('merchant-'.date('Ymdhis').'.json', json_encode($_REQUEST));
    
}
if(isset($_REQUEST["type"])&&$_REQUEST["type"]=="payment"){
    file_put_contents('payment-'.date('Ymdhis').'.json', json_encode($_REQUEST));
}

file_put_contents('endpoing-'.date('Ymdhis').'.json', json_encode($_REQUEST));

file_put_contents('endpoing-post'.date('Ymdhis').'.json', json_encode($_POST));
file_put_contents('endpoing-get'.date('Ymdhis').'.json', json_encode($_GET));
*/


$json_event = file_get_contents('php://input', true);
$event = $json_event;
file_put_contents('webhook.json', $event,FILE_APPEND);
http_response_code(200);
/*
switch($_GET["topic"]) {
        case "payment":
            $payment = MercadoPago\Payment::find_by_id($_GET["id"]);
            // Get the payment and the corresponding merchant_order reported by the IPN.
            $merchant_order = MercadoPago\MerchantOrder::find_by_id($payment->order->id);
            break;
        case "merchant_order":
            $merchant_order = MercadoPago\MerchantOrder::find_by_id($_GET["id"]);
            break;
    }
*/