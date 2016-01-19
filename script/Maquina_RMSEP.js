/**
 * archivo que es utilizado 
 * con la funcion relacionar maquina-seccion-equipo-parte
 * 
 * para relacionar una maquina con el ultimo nivel de relacion.
 */


$(document).ready(function() {

        cargar_maquinas();
        $("#maquina").change(function(){ 
           
            cargar_seccion_maquina();
            cargar_equipo_maquina();
            cargar_parte_equipo();
           
        
        }); 
        
        $("#seccion").change(function(){ cargar_equipo_maquina(); });
        $("#equipo").change(function(){ cargar_parte_equipo(); });
        
        
      
        
       



          $('form#rg_bitacora').bind('submit',handler);
          $('form#rg_bitacora_1').bind('submit',handler);
          $('form#find_timp').bind('submit',handler);
  
      
  
    
    

    

});


function cargar_equipo_maquina()
{
    var code = $("#seccion").val();
    var code2 = $("#maquina").val();
    
    
    
    $.get("../controlador/Bitacora_Cargar_lista_desplegables.php?op=15",{ code: code, code2:code2 }, function(resultado) {
        if (resultado == false)
        {

            
             $('#equipo option[value!="0"]').remove();
        }
        else

        {
             $('#equipo option[value!="0"]').remove();
             $('#equipo').append(resultado);
             

        }
    });
}


function cargar_parte_equipo()
{
   
    
    
    $.get("../controlador/Bitacora_Cargar_lista_desplegables.php?op=19", function(resultado) {
        if (resultado == false)
        {

            
             $('#parte option[value!="0"]').remove();
        }
        else

        {
             $('#parte option[value!="0"]').remove();
             $('#parte').append(resultado);
            
             

        }
    });
}






function cargar_seccion_maquina()
{
    var code = $("#maquina").val();
    
    $.get("../controlador/Bitacora_Cargar_lista_desplegables.php?op=14",{ code: code }, function(resultado) {
        if (resultado == false)
        {

            
             $('#seccion option[value!="0"]').remove();
        }
        else

        {
             $('#seccion option[value!="0"]').remove();
             $('#seccion').append(resultado);
             

        }
    });
}






/**
 * carga la lista desplegable pertenecientes
 * a las distintas maquinas registradas en la aplicacion
 * 
 * @returns {undefined}
 */
function cargar_maquinas()
{



    $.get("../controlador/Bitacora_Cargar_lista_desplegables.php?op=2", function(resultado) {


        if (resultado == false)
        {
            
        }
        else
        {


            $('#maquina option[value!="0"]').remove();
            $('#maquina').append(resultado);
           
        }
    });
}






