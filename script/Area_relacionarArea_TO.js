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



    cargar_areas();

    $("#area").change(function () {
        cargar_usuario();
        cargar_maquinas();

    });


    $('form#rg_bitacora').bind('submit', handler);



});


function cargar_areas()
{





    $.get("../controlador/Bitacora_Cargar_lista_desplegables.php?op=25", function (resultado) {


        if (resultado == false)
        {




            $('#area option[value!="0"]').remove();
        }
        else

        {
            $('#area option[value!="0"]').remove();
            $('#area').append(resultado);



        }
    });
}


function cargar_maquinas()
{





    $.get("../controlador/Bitacora_Cargar_lista_desplegables.php?op=27", function (resultado) {


        if (resultado == false)
        {

            $('#maquina option[value!="0"]').remove();
        }
        else

        {
            $('#maquina option[value!="0"]').remove();
            $('#maquina').append(resultado);



        }
    });
}

















function cargar_usuario()
{

    $.get("../controlador/Bitacora_Cargar_lista_desplegables.php?op=26", function (resultado) {
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



