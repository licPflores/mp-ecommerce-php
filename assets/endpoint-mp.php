<?php
/**
 * End point
 * -------------------------------------
 * manejo la vuelta mientras se hace el proceso.
 */
# recibir el request
# generar un archivo json. por cada movimiento 
if(isset($_REQUEST["topic"])&&$_REQUEST["topic"]=="merchant_order"){
    file_put_contents('merchant-'.date('Ymdhis').'.json', json_encode($_REQUEST));
    
}
if(isset($_REQUEST["type"])&&$_REQUEST["type"]=="payment"){
    file_put_contents('payment-'.date('Ymdhis').'.json', json_encode($_REQUEST));
}


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