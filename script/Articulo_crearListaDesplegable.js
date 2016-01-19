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

 
        cargar_origen();
        

       
       
   
    });


/**
 * carga la lista desplegable 
 * 
 * @returns {undefined}
 */
function cargar_origen()
{
    $.get("../controlador/Articulos_Cargar_lista_desplegables.php?op=1", function(resultado) {
        if (resultado == false)
        {
            
        }
        else
        {
            
            $('#tipoArticulo').append(resultado);
        }
    });
}





/**
 * carga la lista desplegable  de  tipo de productos creados a traves
 * de las distintas  (Formula) o combinaciones de resinas.

 * 
 * @returns {undefined}
 */
function cargar_tipo_producto()
{
    $.get("../controlador/Articulos_Cargar_lista_desplegables.php?op=7", function(resultado) {
        if (resultado == false)
        {
          
        }
        else
        {


            $('#tipoUnidades option[value!="0"]').remove();
            $('#tipoUnidades').append(resultado);
        }
    });
}


function cargar_color_tipo_producto()
{
    $.get("../controlador/Articulos_Cargar_lista_desplegables.php?op=6", function(resultado) {
        if (resultado == false)
        {
            
        }
        else
        {

           
            $('#color_formula option[value!="0"]').remove();
            $('#color_formula').append(resultado);
        }
    });
}



function validar_usuario()
{
    var resultado2 = 2;

    $.get("../controlador/Bitacora_Cargar_lista_desplegables.php?op=3", function(resultado) {

        resultado2 = resultado;
        if (resultado == 1) {
            alert('Usted no esta logiado, ingrese pra despues ejecutar la opcion de registro');
            location.href = "../index.php";
            return false;


        }



    });

    return resultado2;
}



