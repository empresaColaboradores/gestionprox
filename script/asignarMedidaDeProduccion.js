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


$(document).ready(function () {



    cargar_usuario();
    cargar_medidas();
    cargar_medidasSecundaria();

    $('form#rg_bitacora').bind('submit', handler);



});




function cargar_medidas()
{

    $.get("../controlador/Bitacora_Cargar_lista_desplegables.php?op=30", function (resultado) {
    if (resultado == false)
        {
            $('#mainUnit option[value!="0"]').remove();
        }
        else
        {
            $('#mainUnit option[value!="0"]').remove();
            $('#mainUnit').append(resultado);

        }
    });
}

function cargar_medidasSecundaria()
{

    $.get("../controlador/Bitacora_Cargar_lista_desplegables.php?op=32", function (resultado) {
    if (resultado == false)
        {
            $('#secondUnit option[value!="0"]').remove();
        }
        else
        {
            $('#secondUnit option[value!="0"]').remove();
            $('#secondUnit').append(resultado);

        }
    });
}





function cargar_usuario()
{

    $.get("../controlador/Bitacora_Cargar_lista_desplegables.php?op=31", function (resultado) {
        if (resultado == false)
        {

            
              $('#usuario option[value!="0"]').remove();
        }
        else
        {
            
            $('#usuario option[value!="0"]').remove();
            $('#usuario').append(resultado);
            
            

        }
    });
}






