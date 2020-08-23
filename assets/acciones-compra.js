$( document ).ready(function() {
    // para el boton de la compra..
    $('.mercadopago-button').on('click',function(){
        let itemTitulo,itemPrecio,itemCantidad,itemImagenUrl;
        itemTitulo      = $('#item-titulo').val();
        itemPrecio      = $('#item-precio').val();
        itemCantidad    = $('#item-cantidad').val();
        itemImagenUrl   = $('#item-foto').val();

        
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
        .done(function() {
            var url = data.response.init_point;
            window.location.href=url;         
          
        })
        .fail(function() {
          alert( "error" );
        })
        .always(function() {
          alert( "complete" );
        });
    });
});