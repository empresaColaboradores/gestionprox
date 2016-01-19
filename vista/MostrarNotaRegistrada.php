<head>
   <link rel="stylesheet" href="css/hover.css">
   <script type="text/javascript" src="script/bitacora_1.js" ></script> 
</head>

<div id="vista3">
    
 
   
    <div class="cointaner text-center"> 
        <div> 
           
             <button  onclick="rg_bitacora()" class="btn btn-lg btn-primary " title="Registrar Bitacora" type="submit"> <span class="glyphicon glyphicon-book"></span></button>
             <button onclick="rg_timpoImp()"  class="btn btn-lg btn-primary " title="Registro Tiempo Improductivo" type="submit"><span class="glyphicon glyphicon-time"></span></button>
             <button onclick="find_bitacora()"  class="btn btn-lg btn-primary " title="Buscar Registro Bitacora" type="submit"><span class="glyphicon glyphicon-search"></span> </button>
             <button onclick=""  class="btn btn-lg btn-primary " type="submit"><span class="glyphicon glyphicon-zoom-in"></span></button>
             <button type="button"  onclick="limpiar()"  class="btn btn-lg btn-primary " > <span class="glyphicon glyphicon-remove"></span></button>
            

        </div>
    </div>
    <div id="vista4"> </div>
  

   
   <div class="page-header">
                 <h1> <small> REGISTRO OBSERVACIONES TECNICAS</small></h1>
                
               
            </div>

</div>

 

<div class="row"> <!-- row one -->


    <div class="col-md-12">

        <table class="table  table-bordered table-bordered ">

            <thead>
                <tr class="active">
                    
                    <th>T&eacute;cnico </th>
                    <th>M&aacute;quina </th>
                    <th style="width:15%"> Fecha</th> 
                    
                    <th >Detalle </th>
                    <th>Id OT</th> 

                </tr>
            </thead>

            <tbody>

               

                <?php
                $tabla->imprimirTabla();
                ?>
            </tbody>

        </table>
    </div>


</div><!-- end the row one -->