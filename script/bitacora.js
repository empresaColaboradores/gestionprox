/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {

    
    $('form#loging').bind('submit', handler);
    $('form#find_bitacora').bind('submit', handler);

    
});


/*se escoge la vista cuatro por que la la vista, 2,3 estan ocupadas*/
function reportarTiempoImproductivo(){
    
    
    $.post("peticion/rg_bitacora.php", function(e) {
        $("#vista4").hide().html(e).fadeIn()
    })
    
}

function buscarTiempoImproductivo(){
    
    
    $.post("peticion/find_bitacora.php", function(e) {
        $("#vista4").hide().html(e).fadeIn()
    })
    
}

function limpiar() {
    $("#vista4").text("")
}


