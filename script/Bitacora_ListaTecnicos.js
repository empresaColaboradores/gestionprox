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

        cargar_tecnicos();
        
          $('form#find_timp').bind('submit',handler);
  
      
  
    
    

    

});



/**
 * carga la lista desplegable pertenecientes
 * a las distintas maquinas registradas en la aplicacion
 * 
 * @returns {undefined}
 */
function cargar_tecnicos()
{



    $.get("controlador/Bitacora_Cargar_lista_desplegables.php?op=21", function(resultado) {


        if (resultado == false)
        {
            
        }
        else
        {


            $('#operador option[value!="0"]').remove();
            $('#operador').append(resultado);
           
        }
    });
}







