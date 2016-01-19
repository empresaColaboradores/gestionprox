$("document").ready(function() {

    $("#loging").click(function() {
        $.post("peticion/loging.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
    });
     $("#log_out").click(function() {
      
        $.post("peticion/logout.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
    });
    
    
     $("#rg_bitacora").click(function() {
        $.post("peticion/rg_bitacora.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
    });


     $("#rg_bitacora_1").click(function() {
        $.post("peticion/bitacoraTiempoImproductivo_vista.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });


    });
    
     $("#find_bitacora").click(function() {
        $.post("peticion/find_bitacora.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
    });


     $("#ponerse_al_dia").click(function() {
        $.post("peticion/regsitroTiempoImproductivo_diferenteDia.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
    });

      $("#ponerse_al_dia_produccion").click(function() {
        $.post("peticion/pesajeProduccion_TurnoDiferente.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
    });

       $("#modificar_registroTiempoImproductivo").click(function() {
        $.post("peticion/consultaTiempoImproductivo.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
    });



     $("#rg_customer").click(function() {

             $.post("peticion/rg_cliente.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
        
    });


     $("#find_customer").click(function() {

             $.post("peticion/find_cliente.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
        
    });


      $("#rg_articulo").click(function() {

             $.post("peticion/rg_articulos.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
        
    });


       $("#find_articulo").click(function() {

             $.post("peticion/find_articulos.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
        
    });
    
    
    
     $("#estadistico_bitacora").click(function() {
        $.post("peticion/reportes/menu_estadistica.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });


    });

     /*orden de trabajo*/
    
    $("#find_ot").click(function() {
        $.post("peticion/find_ot.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });


    });
    
     $("#historial_ot").click(function() {
        $.post("peticion/find_HistorialOt.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });


    });

     $("#rg_ot").click(function() {
        $.post("peticion/registroOrdenDeTrabajo.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });


    });

      /**
     * muestra el formulario registro de tiempo improductivo 
     * que necesita produccion
     * */
    $("#rg_timpProd").click(function() {
        $.post("peticion/moduloTiempoImproductivo.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });


    });


     






});