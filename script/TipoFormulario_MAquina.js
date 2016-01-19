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
    cargar_formularios();

    $("#maquina").change(function () {
      
        

    });


    $('form#rg_bitacora').bind('submit', handler);



});


function cargar_formularios()
{





    $.get("../controlador/CargarOpcionesFormularios.php?op=26", function (resultado) {


        if (resultado == false)
        {




            $('#formulario option[value!="0"]').remove();
        }
        else

        {
            $('#formulario option[value!="0"]').remove();
            $('#formulario').append(resultado);



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



