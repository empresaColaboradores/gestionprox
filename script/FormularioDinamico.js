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

 
    cargarInputSegunMauina();
    cargarInputParaPesarProduccion();
    
     $("#maquina").change(function(){ 
             
           cargarInputSegunMauina();
           cargarInputParaPesarProduccion();
           
          
        }); 
   
    


});





function cargarInputSegunMauina(){
    
    
    var maquina = $('#maquina').val();
    
    
     $.get("controlador/CargarOpcionesFormularios.php?op=25", {maquina: maquina}, function (resultado) {
        if (resultado == false)
        {
            $('#dinamico').text('');
            
        }
        else
        {
            
           
            $('#dinamico').text('');
             $('#dinamico').append(resultado);
           
        }        
    });
    
}

function cargarInputParaPesarProduccion(){
    
     var maquina = $('#maquina').val();
    
     $.get("controlador/CargarOpcionesFormularios.php?op=24",{maquina: maquina},  function (resultado) {
        if (resultado == false)
        {
            $('#dinamicoKilosVelocidad').text('');

           
            
        }
        else
        {
            

           
             $('#dinamicoKilosVelocidad').text('');
             $('#dinamicoKilosVelocidad').append(resultado);
           
        }        
    });
    
}

