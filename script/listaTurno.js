/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {

    

  
cargar_turno();
   

    $('form#registroProduccion_xyz').bind('submit', handler);






});


function cargar_turno()
{



    $.get("controlador/Bitacora_Cargar_lista_desplegables.php?op=28", function (resultado) {


        if (resultado == false)
        {
             $('#turno option[value!="0"]').remove();

        }
        else
        {


           $('#turno option[value!="0"]').remove();
            $('#turno').append(resultado);



            
        }
    });
}
