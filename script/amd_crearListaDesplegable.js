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
/* se carga el listado de estados posibles registrados en la aplicacion*/
        cargar_estado_usuario();
        cargar_motivo_estado_usuario();

        $('form#amd_find').bind('submit',handler); // relacionar con la funcion handler que maneja las peticiones asincronas


    });



/**
 * carga la lista desplegable pertenecientes
 * a las distintos estaos de un usuario
 sea activo o no activo
 * 
 * @returns {undefined}
 */
function cargar_estado_usuario()
{

	 $.get("../controlador/amd_Cargar_lista_desplegables.php?op=2", function(resultado) {


        if (resultado == false)
        {
         
       
        }
        else
        {
        	


            $('#estado option[value!="0"]').remove();
            $('#estado').append(resultado);
        }
    });
    
}



/**
 * carga la lista desplegable pertenecientes
 * a las distintos estaos de un usuario
 sea activo o no activo
 * 
 * @returns {undefined}
 */
function cargar_motivo_estado_usuario()
{

        

     $.get("../controlador/amd_Cargar_lista_desplegables.php?op=4", function(resultado) {


        if (resultado == false)
        {
         
       
        }
        else
        {
            



            $('#motivo option[value!="0"]').remove();
            $('#motivo').append(resultado);
        }
    });
    
}


