/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */






$(document).ready(function() {


    
      $('[data-toggle="tooltip"]').tooltip();  
    

    
});




function pesaje_produccion(){
    
    
    $.post("peticion/produccion/pesajeProduccion.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    })
    
}

function autoPesajeCeroProduccion(){

    
    
    
    $.post("controlador/pesajeProduccionCeroProduccion_controller.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    })
    
}



function consulta_produccion(){
    
    
    $.post("peticion/produccion/consultaPesajeProduccion.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    })
    
}




function rg_bitacora(){
    
    
    $.post("peticion/rg_bitacora_1.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    })
    
}



function find_bitacora(){
    
    
    
   $.post("peticion/find_bitacora_registro.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    })
    
}



function consultaTiempoImproductivo(){
    
    
    
   $.post("peticion/produccion/consultaTiempoImproductivo.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    })
    
}

function regsitroTiempoImproductivo(){
    
    
    $.post("peticion/regsitroTiempoImproductivo.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    })
    
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
    
    $.post("peticion/reportes/ReporteDeFallaPorMaquina.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    })
    
}

function estadisticaProduccion(){
    
    $.post("peticion/reportes/reporteProduccionPorTurno.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    })
    
}

function estadisticaResumida(){
    
    $.post("peticion/reportes/consolidadoProduccionPorMaquina.php", function(e) {
        $("#vista4").hide().html(e).fadeIn();
    });
    
}

function exportarResumido(){
    
    $.post("peticion/exportarEstadisticoProduccion_controller.php?excel=excell", function(e) {
        alert('hola');
    }); 
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




function limpiar() {
    $("#vista4").text("");
}


