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
        
        $("#maquina").change(function(){ 
            cargar_opereadores();
            cargar_origen();
            cargar_seccion();
            cargar_equipo_maquina();
            cargar_opereadores_relacionados_con_una_maquina();
            
        }); 
        
        $("#seccion").change(function(){ cargar_equipo_maquina(); });
        
        
        $("#origen").change(function(){ cargar_causas(); });
        $('form#rg_bitacora').bind('submit',handler);
  
      
  
    
    

    

});


function cargar_equipo_maquina()
{
    
    
    
    
    
    $.get("../controlador/Bitacora_Cargar_lista_desplegables.php?op=18", function(resultado) {
        
       
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




/**
 * carga la lista desplegable pertenecientes
 * a las distintas areas que producen tiempos improductivos.
 * 
 * @returns {undefined}
 */
function cargar_opereadores()
{
   
    var code = $("#maquina").val();
    
    $.get("../controlador/Bitacora_Cargar_lista_desplegables.php?op=10",{ code: code }, function(resultado) {
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

function cargar_opereadores_relacionados_con_una_maquina()
{
   
    var code = $("#maquina").val();
    
    
    
    $.get("../controlador/Bitacora_Cargar_lista_desplegables.php?op=9",{ code: code }, function(resultado) {
        if (resultado == false)
        {
            
             $('#eliminar_operador option[value!="0"]').remove();
        }
        else
        {
            $('#eliminar_operador option[value!="0"]').remove();
            $('#eliminar_operador').append(resultado);
        }
    });
}



/**
 * carga la lista desplegable pertenecientes
 * a las distintas areas que producen tiempos improductivos.
 * 
 * @returns {undefined}
 */
function cargar_seccion()
{
   
    var code = $("#maquina").val();
    
    
    
    $.get("../controlador/Bitacora_Cargar_lista_desplegables.php?op=16",{ code: code }, function(resultado) {
        
        if (resultado == false)
        {
            
             
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
    
    $.get("../controlador/Bitacora_Cargar_lista_desplegables.php?op=11",{ code: code }, function(resultado) {
        
        
       
        if (resultado == false)
        {
            
             
        }
        else
        {
            
            $('#origen option[value!="0"]').remove();
            $('#origen').append(resultado);
           
         
        }
    });
}


function cargar_causas()
{
   
    var code = $("#maquina").val();
    
    $.get("../controlador/Bitacora_Cargar_lista_desplegables.php?op=12",{ code: code }, function(resultado) {
        
        
       
        if (resultado == false)
        {
            
             
        }
        else
        {

          
            $('#causa option[value!="0"]').remove();
            $('#causa').append(resultado);
           
         
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



