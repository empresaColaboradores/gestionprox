/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * con este archivo se crearan las listas desplegable
 * para todo lo referente a la bitacora y tambien se realizara
 * las listas dependientes.
 */


$(document).ready(function() {

        cargar_maquinas();
        cargar_origen();
        $("#maquina").change(function(){ 
             
            cargar_seccion_maquina();
            cargar_equipo_maquina();
            cargar_parte_equipo();
            cargar_opereadores();
            dependencia_origen();
        }); 
        
        $("#seccion").change(function(){ cargar_equipo_maquina(); });
        $("#equipo").change(function(){ cargar_parte_equipo(); });
        
        
        /* se realiza prueba para  limpiar las causas una ves seleccionada una maquina*/
        
        $("#origen").change(function(){dependencia_origen();});



          $('form#rg_bitacora').bind('submit',handler);
          $('form#rg_bitacora_1').bind('submit',handler);
          $('form#find_timp').bind('submit',handler);
  
      
  
    
    

    

});


function cargar_equipo_maquina()
{
    var code = $("#seccion").val();
    var code2 = $("#maquina").val();
    
    $.get("controlador/Bitacora_Cargar_lista_desplegables.php?op=15",{ code: code, code2:code2 }, function(resultado) {
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
    var code = $("#seccion").val();
    var code2 = $("#maquina").val();
    var code3 = $("#equipo").val();
    
    
    
    $.get("controlador/Bitacora_Cargar_lista_desplegables.php?op=17",{ code: code, code2:code2, code3:code3 }, function(resultado) {
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
    
    $.get("controlador/Bitacora_Cargar_lista_desplegables.php?op=14",{ code: code }, function(resultado) {
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
 * a las distintas areas que producen tiempos improductivos.
 * 
 * @returns {undefined}
 */
function cargar_origen()
{
    var code = $("#maquina").val();
    $.get("controlador/Bitacora_Cargar_lista_desplegables.php?op=6",{ code: code }, function(resultado) {
        if (resultado == false)
        {

            
             $('#origen option[value!="0"]').remove();
        }
        else

        {
             $('#origen option[value!="0"]').remove();
             $('#origen').append(resultado);
             

        }
    });
}


/**
 * carga la lista desplegable pertenecientes
 * a las distintas areas que producen tiempos improductivos.
 * 
 * @returns {undefined}
 */
function cargar_opereadores()
{
   
    var code = $("#maquina").val();
    
    $.get("controlador/Bitacora_Cargar_lista_desplegables.php?op=9",{ code: code }, function(resultado) {
        if (resultado == false)
        {
            
             $('#operador option[value!="0"]').remove();
        }
        else
        {
            $('#operador option[value!="0"]').remove();
            $('#operador').append(resultado);
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



    $.get("controlador/Bitacora_Cargar_lista_desplegables.php?op=2", function(resultado) {


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


/**
 * 
 * carga la lista dependiente de la lista origen
 * 
 * @returns {undefined}
 */

function dependencia_origen()
{
    var code = $("#origen").val();
  

        
              
        
       
    $.get("controlador/Bitacora_Cargar_lista_desplegables.php?op=20", { code: code},
        function(resultado)
        {
            if(resultado == false)
            {
                $('#causa option[value!="0"]').remove();
            }
            else
            {

            $('#causa option[value!="0"]').remove();
            $('#causa').append(resultado);
           

                            
            }
        }

    );
}




/**
 *  carga los distintos codigos de productos en proceso
 *  que se fabrican en la empresa.
 * @returns {undefined}
 */
function  cargar_tipo_rollo()
{
    
  
    $.get("../controlador/Bitacora_Cargar_lista_desplegables.php?op=8", function(resultado) {
        if (resultado == false)
        {
            
        }
        else
        {
             $('#tipoArticulo option[value!="0"]').remove();           
            $('#tipoArticulo').append(resultado);
        }
    });
}




