<head>
   <link rel="stylesheet" href="css/hover.css">
   <script type="text/javascript" src="script/paginacion_bitacora_1.js" ></script> 
   <script type="text/javascript" src="script/bitacora_1.js" ></script> 
    <script language="javascript" src="script/set_ot.js"></script>
</head>
<?php
  
    require_once('../modelo/FormularioDinamico.php');
    $formulario = new FormularioDinamico();
    ?>

<div id="vista3">
    
 
   
       <div class="cointaner text-center"> 
        <div> 
           
             <button  onclick="do_stadisct()" class="btn btn-lg btn-primary " title="Generar Estadistico tiempo Improductivo" type="submit"> <span class="glyphicon glyphicon glyphicon-signal"></span> Tiempo Impro</button>
             <button  onclick="estadisticaProduccion()" class="btn btn-lg btn-primary " title="Consulta Productividad" type="submit"> <span class="glyphicon glyphicon-align-left"></span> Consulta Productividad</button>
             <button  onclick="estadisticaResumida()" class="btn btn-lg btn-primary " title="Reporte Resumido" type="submit"> <span class="glyphicon glyphicon-align-left"></span>REPORTE RESUMIDO</button>
            
             <button type="button"  onclick="limpiar()"  class="btn btn-lg btn-primary " > <span class="glyphicon glyphicon-remove"></span></button>
            

        </div>
    </div>
    <div id="vista4"> </div>
  

   




<div class="row"> <!-- row one -->


    <div class="col-md-12">
        
        <h3 class="text-center"> ESTADISTICO <small>PRODUCCION ESPERADA </small></h3>
<h1> RANGO DE FECHA PARA LA CONSULTA ACTUAL<small> <?php  echo $_SESSION['fecha_inicial'] ?> </small></h1>
        
        <table class="table  table-bordered table-bordered ">

            <thead>
                <tr class="active">
                                  
                   
                   
                    <th>Operador </th>
                    <th >Maq.</th>                   
                    
                     <th>Producido </th>
                        <th>Turno </th>
                        <th>Capacidad Maq </th>
                        <th>Tiempo Productivo </th>
                        <th>Tiempo Improductivo </th>
                        <th>Unds Teorica </th>
                         
                          <th>Eficiencia Maq (%) </th>
                         

                         <th>Eficiencia Operador(%) </th>
                          
                    

                   

                </tr>
            </thead>

            <tbody>
                
                
                <?php
                
                
                
                $bitacora->imprimir( $estadisticaResumidaArray);
                ?>
            </tbody>

        </table>
    </div>
    
    
    <div class="row"> <!-- row one -->


    <div class="col-md-12">
        
        <h3 class="text-center"> CONSOLIDADO <small>TIEMPO IMPRODUCTIVO</small></h3>
        
        <table class="table  table-bordered table-bordered ">

            <thead>
                <tr class="active">
                    
                    <?php  for($i=0;$i<=count($vector)-1;$i++){?>
                                  
                    <th ><?php echo $vector[$i];?></th> 
                    
                   <?php 
                    }
                   ?>
                    

                   

                </tr>
            </thead>

            <tbody>

               

                <?php
               
                $bitacora->imprimir($url_array_contenido);
                ?>
            </tbody>

        </table>
    </div>


</div><!-- end the row one -->


     <div class="container">

        <div class="navbar-btn text-center">

            



            <form  class="form-signin"  method="post" action="#"  role="form">

                <button class="btn btn-lg btn-success" type="submit" title="Descarcar Excell"><span class="glyphicon glyphicon-cloud-download"></span></button>
            </form>




        </div>



    </div>


</div><!-- end the row one -->



</div>