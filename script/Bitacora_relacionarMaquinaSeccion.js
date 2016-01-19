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
            cargar_seccion();
                      
        });  
        
        
        
        
       
        $('form#rg_bitacora').bind('submit',handler);
  
      
  
    
    

    

});







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



