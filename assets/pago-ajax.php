<?php 
/*
 * preparacion y envio de la preferencia
 * 
 * Datos del pagador:

 */
ini_set('error_reporting', E_ALL);

ini_set('display_errors', 1);

require_once 'lib/mercadopago.php';

function armar_preferencia_lib($producto){

    $mp = new MP("APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398");//conexion 

    //echo print_r($producto);

    $preference_data = array(	
        "items" => array(
            array(
                "id" => $producto['id'],
                "title" => $producto['titulo'],
                "currency_id" => "ARS",
                "description" => $producto['descripcion'],
                "picture_url" => $producto['foto'],
                "quantity" => $producto['cantidad'],
                "unit_price" => $producto['precio']
            )
        ),
        "payer"=>array(           
            "name" =>'Lalo',
            "surname" =>'Landa',
            "email" =>'test_user_63274575@testuser.com',
            
            "address" => array(
                "street_name" => "False",
                "street_number" => 123,
                "zip_code" => "111"
            ),
            "phone" => array(
                "area_code" => "11",
                "number" => "22223333"
            ),
        ),
        "payment_methods"=>array(
            "excluded_payment_types" => array(
                array("id" => "amex")
            ),
            "excluded_payment_types" => array(
                array("id" => "atm")
            ),
            "installments" => 6
        ),
        "external_reference"=>"lic.pflores@gmail.com",
        "back_urls" => array(
        "success" => "https://administranet.com.ar/mp-ecommerce-php/assets/estado-compra.php?estado=exito",
        "failure" => "https://administranet.com.ar/mp-ecommerce-php/assets/estado-compra.php?estado=exito",
        "pending" => "https://administranet.com.ar/mp-ecommerce-php/assets/estado-compra.php?estado=exito"
        ),
    "auto_return" => "approved",
    "notification_url" =>"https://administranet.com.ar/mp-ecommerce-php/assets/endpoint-mp.php" 
    );
   //echo "<pre>";
   //print_r($preference_data);
   ///echo "</pre>";
    $preference = $mp->create_preference($preference_data);
    file_put_contents('prereference-'.date('Ymdhis').'.json', json_encode($preference));
    //header('Content-Type: application/json');
    header('Content-Type: application/json');
    echo json_encode( $preference );

}




function armar_preferencia($producto){
   // require __DIR__  . '../vendor/autoload.php';
   require_once '../vendor/autoload.php';
        
  
    
    MercadoPago\SDK::setAccessToken('APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398');
    //MercadoPago\SDK::setIntegratorId("dev_24c65fb163bf11ea96500242ac130004");

    # creando la preferencia.
    $preference = new MercadoPago\Preference();

    #item

    $item1 = new MercadoPago\Item();
    $item1->id = $producto['id'];
    $item1->title = $producto['titulo']; 
    $item1->quantity = $producto['cantidad'];
    $item1->description = $producto['descripcion'];
    $item1->unit_price = $producto['precio'];
    $item1->picture_url = $producto['foto'];
    $item1->currency_id = 'ARS';

    #pagador

    $pagador = new MercadoPago\Payer();
    $pagador->name ='Lalo';
    $pagador->surname ='Landa';
    $pagador->email ='test_user_63274575@testuser.com';
    $pagador->name ='Lalo';
    $pagador->address = array(
        "street_name" => "False",
        "street_number" => 123,
        "zip_code" => "111"
    );
    $pagador->phone = array(
        "area_code" => "11",
        "number" => "22223333"
    );

    # datos preferencia.
    $preference->items = array($item1);
    $preference->payer = $pagador;
    $preference->back_urls = array(
        "success" => "https://licpflores-mp-commerce-php.herokuapp.com/assets/estado-compra?estado=exito",
        "failure" => "https://licpflores-mp-commerce-php.herokuapp.com/assets/estado-compra?estado=fallo",
        "pending" => "https://licpflores-mp-commerce-php.herokuapp.com/assets/estado-compra?estado=pendiente"
    );
    
    $preference->auto_return = "approved";
    $preference->notification_url="https://licpflores-mp-commerce-php.herokuapp.com/assets/endpoint-mp.php";
    #como se paga.

    $preference->payment_methods = array(
        "excluded_payment_types" => array(
            array("id" => "amex")
        ),
        "excluded_payment_types" => array(
            array("id" => "atm")
        ),
        "installments" => 6
    );
    
    $preference->external_reference = "lic.pflores@gmail.com";
    
    $preference->save();
    



    
    //header('Content-Type: application/json');
    header('Content-Type: application/json');
    //echo json_encode($vuelta);
    echo json_encode( $preference );
}







if(isset($_REQUEST['pagar'])&&$_REQUEST['pagar']==1){
    $producto=array(
        'id'=>1234,
        'titulo'=>$_REQUEST['itemTitulo'],
        'precio'=>doubleval($_REQUEST['itemPrecio']),
        'descripcion'=>'Dispositivo móvil de Tienda e-commerce',
        'cantidad'=>intval($_REQUEST['itemCantidad']),
        'foto'=>str_replace('./','https://administranet.com.ar/',$_REQUEST['itemImagenUrl'])
    );
   // echo print_r($producto);
    armar_preferencia_lib($producto);
}