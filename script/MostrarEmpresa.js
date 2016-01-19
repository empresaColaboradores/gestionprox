

function crearEMP(){
    
    
    $.post("../peticion/amd_crear_empresa.php", function(e) {
        $("#vista2").hide().html(e).fadeIn();
        
        
    });
    
 
    
}


function buscarEPM(){
    $.post("../peticion/amd_buscar_empresa.php", function(e) {
        $("#vista2").hide().html(e).fadeIn();
    });
    
}

function crearUsuario(){
    
    $.post("../peticion/amd_crear_usuario_1.php", function(e) {
        $("#vista2").hide().html(e).fadeIn();
    });
    
}

function buscarUsuario(){
    
    $.post("../peticion/amd_find_usuario.php", function(e) {
        $("#vista2").hide().html(e).fadeIn();
    });
    
}



function limpiar(){
    
    
        
       $("#vista2").text("");
    
    
}
