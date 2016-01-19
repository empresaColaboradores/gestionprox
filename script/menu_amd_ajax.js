/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */






$(document).ready(function() {


    
      $('[data-toggle="tooltip"]').tooltip();  
    

    
});




function pesaje_produccion(){
    
    
    $.post("peticion/pesajeProduccion.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    })
    
}

function autoPesajeCeroProduccion(){

    
    
    
    $.post("controlador/pesajeProduccionCeroProduccion_controller.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    })
    
}



function consulta_produccion(){
    
    
    $.post("peticion/consultaPesajeProduccion.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    })
    
}




function rg_maquina(){
   
    
    $.post("../peticion/amd_crear_maquina.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    });
    
}



function find_maquina(){
    
    
    
   $.post("../peticion/find_bitacora_registro.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    })
    
}


function rg_area(){
   
    
    $.post("../peticion/amd_crear_area.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    });
    
}

function find_area(){
   
    
    $.post("../peticion/amd_buscar_area.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    });
    
}





function consultaTiempoImproductivo(){
    
    
    
   $.post("peticion/consultaTiempoImproductivo.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    })
    
}

function regsitroTiempoImproductivo(){
    
    
    $.post("peticion/regsitroTiempoImproductivo.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    })
    
}

function relacionarAreaUsuario(){
    
     $.post("../peticion/amd_relacionarArea_Usuario.php", function(e) {
             $("#vista4").hide().html(e).fadeIn();
           
       
        });
}

function relacionarAreaMaquina(){
    
     $.post("../peticion/amd_relacionarArea_Maquina.php", function(e) {
             $("#vista4").hide().html(e).fadeIn();
           
       
        });
}




function find_tiempProdu(){
   
   $.post("peticion/find_timpo_1.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    });
    
}


function find_tiempProduCorto(){
   
    $.post("peticion/find_timpo_corto.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    });
    
}









function rg_tiempoImpProdu(){
    
    
    $.post("peticion/rg_timpProduccion.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    })
    
}

/**
 * esta funcion es para probar,
 * la lista desplegable maquina segun area,luego sera borrada.
 * @returns {undefined}
 */

function rg_timpoImpListaMaquina(){
    
    
    $.post("peticion/rg_timpo_1.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    })
    
}



function do_stadisct(){
    
    $.post("peticion/estadistica.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    })
    
}

function estadisticaProduccion(){
    
    $.post("peticion/estadisticaProduccion.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    })
    
}

function estadisticaResumida(){
    
    $.post("peticion/estadisticaResumida.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    })
    
}

function rg_timpoImpProdu(){
    
    $.post("peticion/rg_timpProduccion.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    });
    
}

function find_timpProdu(){
    
    $.post("peticion/find_timpo_1.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    });
    
    
}


 function asignarArbolJerarquicoAMaquina(){
   
    
    $.post("../peticion/amd_relacionarMaquina_TipoFormulario.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    });
    
}


 function asignarMedidaPrincipal(){
   
    
    $.post("../peticion/amd_AsignarMedidaPrincipalAUsuario.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    });
    
}

 function actualizarMedidaPrincipal(){
   
    
    $.post("../peticion/amd_ActualiarMedidaPrincipalAUsuario.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    });
    
}

function asignarMedidaSecundaria(){
    $.post("../peticion/amd_AsignarMedidaSecundariaUsuario.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    });
  }
  
  function actualizarMedidaSecundaria(){
    $.post("../peticion/amd_ActualizarMedidaSecundariaUsuario.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    });
  }

 function buscarArbolJerarquicoAMaquina(){
   
    
    $.post("../peticion/amd_BuscarRelacionMaquina_TipoFormulario.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    });
    
}


function actualizarArbolJerarquicoAMaquina(){
   
    
    $.post("../peticion/amd_ActualizarMaquina_TipoFormulario.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    });
    
}

function actualizarTiempoProductivoRealAsignadoAMaquina(){
   
    
    $.post("../peticion/amd_ActualizarTiempoProductivoRealAsignadoAMaquina.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    });
    
}




function limpiar() {
    $("#vista4").text("");
}


