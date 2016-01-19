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

        cargar_maquinas();
        cargar_opereadores();
            cargar_listaTipoMateriales(); 
        $("#maquina").change(function(){ 
            cargar_opereadores();
            cargar_listaTipoMateriales(); 
           
        }); 
        
        
          $('form#registroProduccion').bind('submit',handler);
  
      
  
    
    

    

});




function cargar_maquinas()
{



    $.get("controlador/Bitacora_Cargar_lista_desplegables.php?op=2", function(resultado) {


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

function cargar_listaTipoMateriales()
{
    
    var maquina = $("#maquina").val();
    
    $.get("controlador/Bitacora_Cargar_lista_desplegables.php?op=22",{ code: maquina}, function(resultado) {
        if (resultado == false)
        {

            
             $('#material option[value!="0"]').remove();
        }
        else

        {
             $('#material option[value!="0"]').remove();
             $('#material').append(resultado);
             

        }
    });
}


function cargar_opereadores()
{
   
    var code = $("#maquina").val();
    
    $.get("controlador/Bitacora_Cargar_lista_desplegables.php?op=9",{ code: code }, function(resultado) {
        if (resultado == false)
        {
            
             $('#operador option[value!="0"]').remove();
        }
        else
        {
            $('#operador option[value!="0"]').remove();
            $('#operador').append(resultado);
        }
    });
}





