

function relacionarOM(){
    $.post("../peticion/amd_relacionarOperador_maquina.php", function(e) {
        $("#vista2").hide().html(e).fadeIn();
    });
    
}

function relacionarDM(){

    $.post("../peticion/amd_relacionarDefecto_maquina.php", function(e) {
        $("#vista2").hide().html(e).fadeIn();
    });
    
    
}


function relacionarSM(){

    $.post("../peticion/amd_relacionarSeccion_maquina.php", function(e) {
        $("#vista2").hide().html(e).fadeIn();
    });
    
    
}


function EliminarRelacionarOPeradorMaquina(){
    $.post("../peticion/amd_EliminarrelacionOperador_maquina.php", function(e) {
        $("#vista2").hide().html(e).fadeIn();
    });
    
}



function buscarSEPM(){
    
     $.post("../peticion/amd_FindSeccion_maquina_equipo.php", function(e) {
        $("#vista2").hide().html(e).fadeIn();
    })
    
}


function relacionarMSE(){

    $.post("../peticion/amd_relacionarSeccion_maquina_equipo.php", function(e) {
        $("#vista2").hide().html(e).fadeIn();
    })
    
    
}

/**
 * relacionar maquina-seccion-equipo-parte
 * @returns {undefined}
 */
function relacionarMSEP(){

    $.post("../peticion/amd_relacionarSeccion_maquina_equipo_parte.php", function(e) {
        $("#vista2").hide().html(e).fadeIn();
    })
    
    
}


function buscarSM(){

    $.post("../peticion/amd_find_seccion.php", function(e) {
        $("#vista2").hide().html(e).fadeIn();
    })
    
    
}

function buscarEM(){

    $.post("../peticion/amd_find_equipo.php", function(e) {
        $("#vista2").hide().html(e).fadeIn();
    })
    
    
}

function buscarPM(){

    $.post("../peticion/amd_find_parte.php", function(e) {
        $("#vista2").hide().html(e).fadeIn();
    })
    
    
}

function buscarOM(){

    $.post("../peticion/amd_FindOperador_maquina.php", function(e) {
        $("#vista2").hide().html(e).fadeIn();
    })
    
    
}



function relacionarCD(){
    $.post("../peticion/amd_relacionarCausa_defecto.php", function(e) {
        $("#vista2").hide().html(e).fadeIn();
    })
    
}

function buscarDM(){
    $.post("../peticion/amd_FindDefecto_maquina.php", function(e) {
        $("#vista2").hide().html(e).fadeIn();
    })
    
}

function limpiar(){
    
    
        
       $("#vista2").text("");
    
    
}
