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

 
        
        cargar_tipo_unidades();
        
       
       
   
    });





/**
 * carga la lista desplegable  de  tipo de productos creados a traves
 * de las distintas  (Formula) o combinaciones de resinas.

 * 
 * @returns {undefined}
 */
function   cargar_tipo_unidades()
{
    $.get("../controlador/Articulos_Cargar_lista_desplegables.php?op=7", function(resultado) {
        if (resultado == false)
        {
            
        }
        else
        {
           
            $('#tipoUnidades').append(resultado);
        }
    });
}







