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



    cargarTiempoProductivos();
   

    $('form#rg_bitacora').bind('submit', handler);



});





function cargarTiempoProductivos()
{





    $.get("../controlador/Bitacora_Cargar_lista_desplegables.php?op=29", function (resultado) {


        if (resultado == false)
        {

            $('#horaProductiva option[value!="0"]').remove();
        }
        else

        {
            $('#horaProductiva option[value!="0"]').remove();
            $('#horaProductiva').append(resultado);



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



