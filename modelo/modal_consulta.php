<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of modal_consulta
 *
 * @author Rocha
 */

/**
 * funcion que es llamada cuando, una consulta
 * no arroja resultados
 */
function mensajeDeErrorModal($titulo,$subtitulo,$mensaje){
    
     echo '
                    
<script>
$("document").ready(function() {

$( "#foo" ).trigger( "click" );
});
</script>
                     <a id="foo" data-toggle="modal" href="#example">

    

   </a>
                    
<div id="example" class="modal fade">
   <div class="modal-dialog">   
      <div class="modal-content"> 
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
            </button>
            <h3>'.$titulo.'</h3>
         </div>
         <div class="modal-body">
            <h4>'.$subtitulo.'</h4>
            <p>'.$mensaje.'</p>                
         </div>
         <div class="modal-footer">
           
            <a href="#" data-dismiss="modal" class="btn">Cerrar</a>
         </div>
      </div>
   </div>
</div>';
     
     exit();

     
}



function mensajeModal(){
    
    $titulo='ACCESO DENEGADO';
            $subtitulo='';
            $mensaje='El usuario actual no cuenta con los permisos necesarios para ejecutar'
                    . ' la operacion seleccionada';
    
     echo '
                    
<script>
$("document").ready(function() {

$( "#foo" ).trigger( "click" );
});
</script>
                     <a id="foo" data-toggle="modal" href="#example">

    

   </a>
                    
<div id="example" class="modal fade">
   <div class="modal-dialog">   
      <div class="modal-content"> 
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
            </button>
            <h3>'.$titulo.'</h3>
         </div>
         <div class="modal-body">
            <h4>'.$subtitulo.'</h4>
            <p>'.$mensaje.'</p>                
         </div>
         <div class="modal-footer">
           
            <a href="#" data-dismiss="modal" class="btn">Cerrar</a>
         </div>
      </div>
   </div>
</div>';
     
     exit();

     
}

function mensajeParaOperadores($titulo,$subtitulo,$mensaje){
    
     echo '
                    
<script>
$("document").ready(function() {

$( "#foo" ).trigger( "click" );
});
</script>
                     <a id="foo" data-toggle="modal" href="#example">

    

   </a>
                    
<div id="example" class="modal fade">
   <div class="modal-dialog">   
      <div class="modal-content"> 
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            ×
            </button>
            <h3>'.$titulo.'</h3>
         </div>
         <div class="modal-body">
            <h4>'.$subtitulo.'</h4>
            <p>'.$mensaje.'</p>                
         </div>
         <div class="modal-footer">
           
            <a href="#" data-dismiss="modal" class="btn">Cerrar</a>
         </div>
      </div>
   </div>
</div>';
     
     

     
}

?>
