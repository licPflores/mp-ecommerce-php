$( document ).ready(function() {
    // para el boton de la compra..
    $('.mercadopago-button').on('click',function(){
        event.preventDefault();
        let itemTitulo,itemPrecio,itemCantidad,itemImagenUrl;
        itemTitulo      = $('#item-titulo').val();
        itemPrecio      = $('#item-price').val();
        itemCantidad    = $('#item-unit').val();
        itemImagenUrl   = $('#item-foto').val();

        console.log(itemTitulo,itemPrecio,itemCantidad,itemImagenUrl);
        $.ajax({
            method: "GET",            
            url: "assets/pago-ajax.php",
            async: false,        
            data: { 
                'pagar': 1,
                'itemTitulo': itemTitulo, 
                'itemPrecio': itemPrecio, 
                'itemCantidad': itemCantidad,                
                'itemImagenUrl': itemImagenUrl
            } ,
            dataType: "json"
        })
        .done(function(data) {
            console.log('regreso de la preferncia');
            console.table(data);
            var url = data.response.init_point;
            window.location.href=url;         
          
        })
        .fail(function() {
          alert( "error" );
        })
        .always(function() {
          //alert( "complete" );
        });
    });
});