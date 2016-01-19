<!--
Archivo que muestra las opciones del programa principal
-->
<?php
if (!isset($_SESSION)) {
    session_start();
}


 
?>


<head>
    <script type="text/javascript" src="script/bitacora_1.js" ></script> 
    
</head>
<div id="vista3">
    
 
   
    <div class="cointaner text-center"> 
        <div> 
            
           
            <?php  if(($_SESSION['k_userName'])== strtolower('tintas')){?>

              <button  onclick="rg_bitacora()" class="btn btn-lg btn-primary " title="Registrar Bitacora" type="submit"> <span class="glyphicon glyphicon-book"></span></button>
             <button onclick="find_bitacora()"  class="btn btn-lg btn-primary " title="Buscar Registro Bitacora" type="submit"><span class="glyphicon glyphicon-search"></span> </button>
            
            <?php } else{ ?>

            <button  onclick="pesaje_produccion()" class="btn btn-lg btn-primary " title="Pesaje Produccion" type="submit"> <span class="glyphicon glyphicon-th-large"></span></button>
            <button  onclick="consulta_produccion()" class="btn btn-lg btn-primary " title="Consultar Orden de Produccion" type="submit"> <span class="glyphicon glyphicon-screenshot"></span></button>

           
            
            <button onclick="regsitroTiempoImproductivo()"  class="btn btn-lg btn-primary " title="Registro Tiempo Improductivo" type="submit"><span class="glyphicon glyphicon-time"></span></button>
            
             <button onclick="consultaTiempoImproductivo()"  class="btn btn-lg btn-primary" title="Buscar Registro Tiempo Improductivo"  type="submit"><span class="glyphicon glyphicon-zoom-in"></span></button>
             <?php }?>
           
  <button type="button"  onclick="limpiar()"  class="btn btn-lg btn-primary " > <span class="glyphicon glyphicon-remove"></span></button>
            

        </div>
    </div>
    <div id="vista4"> </div>
  

   

</div>