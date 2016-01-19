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



   cargar_maquinas();
    cargar_medidasSecundaria();
    cargar_medidasSecundariaDeseada();
    

    $('form#rg_bitacora').bind('submit', handler);



});






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

function cargar_medidasSecundariaDeseada()
{

    $.get("../controlador/Bitacora_Cargar_lista_desplegables.php?op=32", function (resultado) {
    if (resultado == false)
        {
            $('#secondUnitDeseada option[value!="0"]').remove();
        }
        else
        {
            $('#secondUnitDeseada option[value!="0"]').remove();
            $('#secondUnitDeseada').append(resultado);

        }
    });
}



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







