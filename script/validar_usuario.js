/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * con este archivo se valida que todos los usuarios
 * dentro de la aplciacion  validen sus creadenciales antes de 
 * utilizar cualquier funcion dispobible en los distintos 
 * formularios
 */


$(document).ready(function() {



    a = validar_usuario();


});



function validar_usuario()
{
    var resultado2 = 2;

    $.get("controlador/Bitacora_Cargar_lista_desplegables.php?op=3", function(resultado) {

        resultado2 = resultado;
        if (resultado == 1) {
            alert('Usted no esta logiado, ingrese pra despues ejecutar la accion deseada');
            location.href = "../index.html";
            return false;


        }



    });

    return resultado2;
}



