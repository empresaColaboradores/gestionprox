<!--
Archivo que muestra las opciones del programa principal
-->
<head>
    <script type="text/javascript" src="script/bitacora_1.js" ></script> 
    
</head>
<div id="vista3">
    
 
   
    <div class="cointaner text-center"> 
        <div> 
           
             <button  onclick="do_stadisct()" class="btn btn-lg btn-primary " title="Reporte De Fallas Por Maquina" type="submit"> <span class="glyphicon glyphicon-signal"></span></button>
             <button  onclick="estadisticaProduccion()" class="btn btn-lg btn-primary " title="Consulta Productividad" type="submit"> <span class="glyphicon glyphicon-th"></span> </button>
             <button  onclick="estadisticaResumida()" class="btn btn-lg btn-primary " title="Reporte Resumido" type="submit"> <span class="glyphicon glyphicon-th-list"></span></button>
             
            
             <button type="button"  onclick="limpiar()"  class="btn btn-lg btn-primary " > <span class="glyphicon glyphicon-remove"></span></button>
            

        </div>
    </div>
    <div id="vista4"> </div>
  

   

</div>