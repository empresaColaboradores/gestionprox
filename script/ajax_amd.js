$("document").ready(function() {

    
     $("#log_out").click(function() {
      
        $.post("../peticion/logout.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
    });


     $("#find_usuario").click(function() {
      
        $.post("../peticion/amd_find_usuario.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
    });


     $("#rg_usuario").click(function() {
      
        $.post("../peticion/amd_crear_usuario_1.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
    });
    

    


     $("#up_usuario").click(function() {
      
        $.post("../peticion/amd_upDate_usuario.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
    });
     
   
   $("#rg_maquina").click(function() {
      
        $.post("../peticion/amd_crear_maquina.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
    });


   $("#find_maquina").click(function() {

    $.post("../peticion/amd_find_maquina.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
      
        
    });
    
     $("#add_timeToMachine").click(function() {

    $.post("../peticion/amd_AsignarTiempoProductivoAMaquina.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
      
        
    });
    
     $("#find_timeToMachine").click(function() {

    $.post("../peticion/amd_BuscarTiempoProductivoAMaquina.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
      
        
    });
    
    $("#add_mainMedida").click(function() {

    $.post("../peticion/amd_AsignarMedidaPrincipalAUsuario.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
      
        
    });
    
     $("#find_mainMedida").click(function() {

    $.post("../peticion/amd_BuscarMedidaPrincipalAUsuario.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
      
        
    });
    
    
    
    
    
    $("#find_secondMedida").click(function() {
      
        $.post("../peticion/amd_BuscarMedidaSecundariaAmaquina.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           });
    });
    
    
    
     $("#add_secondMedida").click(function() {
      
        $.post("../peticion/amd_AsignarMedidaSecundariaUsuario.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
    });
    
     $("#find_area").click(function() {
      
        $.post("../peticion/amd_buscar_area.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
    });
    
      $("#asignarArbolJerarQuicoAMaquina").click(function() {
      
        $.post("../peticion/amd_relacionarMaquina_TipoFormulario.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
    });
    
      $("#buscarrArbolJerarQuicoAMaquina").click(function() {
      
        $.post("../peticion/amd_BuscarRelacionMaquina_TipoFormulario.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
    });
    
    $("#actualizarArbolJerarQuicoAMaquina").click(function() {
      
        $.post("../peticion/amd_ActualizarMaquina_TipoFormulario.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
    });
    
    $("#eliminarArbolJerarQuicoAMaquina").click(function() {
      
        $.post("../peticion/amd_EliminarJerarquiaMaquina.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
    });
    
     $("#relacionarUsuarioArea").click(function() {


      
        $.post("../peticion/amd_relacionarArea_Usuario.php", function(e) {
             $("#vista").hide().html(e).fadeIn();

            
       
        });
    });
    
     $("#BuscarRelacionUsuarioArea").click(function() {
      
        $.post("../peticion/amd_buscarRelacionArea_Usuario.php", function(e) {
             $("#vista").hide().html(e).fadeIn();
           
       
        });
    });
    
    
    $("#RelacionarMaquinaArea").click(function() {
      
        $.post("../peticion/amd_relacionarArea_Maquina.php", function(e) {
             $("#vista").hide().html(e).fadeIn();
           
       
        });
    });
    
     $("#BuscarRelacionMaquinaArea").click(function() {
      
        $.post("../peticion/amd_buscarRelacionArea_Maquina.php", function(e) {
             $("#vista").hide().html(e).fadeIn();
           
       
        });
    });


   $("#rg_operador").click(function() {

   $.post("../peticion/amd_crear_operador.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
      
        
    });


   $("#find_operador").click(function() {

   $.post("../peticion/amd_find_operador.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
      
        
    });


   $("#rg_origen").click(function() {

   $.post("../peticion/amd_crear_defecto.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
      
        
    });

$("#find_origen").click(function() {

   $.post("../peticion/amd_find_defecto.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
      
        
    });


$("#rg_causa").click(function() {

   $.post("../peticion/rg_causa.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
      
        
    });





$("#find_causa").click(function() {

   $.post("../peticion/amd_buscarCausa.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
      
        
    });



$("#find_maquina_origen_causa").click(function() {

   $.post("../peticion/amd_findRelacionarCausa_defecto_Origen.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
      
        
    });



    

$("#rg_unidad").click(function() {

   $.post("../peticion/amd_crear_unidad_medida.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
      
        
    });


$("#rg_tipo_articulo").click(function() {

   $.post("../peticion/amd_rg_tipo_articulos.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
      
        
    });



$("#find_tipoProducto").click(function() {

   $.post("../peticion/amd_find_tipo_articulos.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
      
        
    });
    
    
    
$("#amd_crear_seccion").click(function() {

   $.post("../peticion/amd_crear_seccion.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
      
        
    });
    
    
    $("#find_seccion").click(function() {

   $.post("../peticion/amd_find_seccion.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
      
        
    });
    
    $("#amd_crear_equipo").click(function() {

   $.post("../peticion/amd_crear_equipo.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
      
        
    });
    
    
    
     $("#amd_find_equipo").click(function() {

   $.post("../peticion/amd_find_equipo.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
      
        
    });
    
    
    $("#amd_crear_parte").click(function() {

   $.post("../peticion/amd_crear_parte.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
      
        
    });
    
     $("#amd_find_parte").click(function() {

   $.post("../peticion/amd_find_parte.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
      
        
    });

      $("#change_pass").click(function() {
      
        $.post("../peticion/change_pass.php", function(e) {
             $("#vista").hide().html(e).fadeIn()
           
       
        });
    });

        $("#rg_company").click(function() {

        $.post("../peticion/amd_crear_empresa.php", function(e) {
            $("#vista").hide().html(e).fadeIn()


        });


    });


    $("#find_company").click(function() {

        $.post("../peticion/amd_buscar_empresa.php", function(e) {
            $("#vista").hide().html(e).fadeIn();


        });


    });


    
    
    
    
    
    
    
    
    
    
    
    









   
     






});