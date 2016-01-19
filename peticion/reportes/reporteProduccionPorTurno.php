<?php
if (!isset($_SESSION)) {
    session_start();
}



require_once '../../modelo/validar_usuario.php';
?>

<head>
    
    
             
            
        
   
    <script language="javascript" src="script/submitAjax.js"></script>
    <script language="javascript" src="script/valida_campos_bitacora.js"></script>
    <script language="javascript" src="script/Bitatoca_crearListaDesplegable.js"></script> 
    
    
  
</head>

<div class="container">
    <div class=" row">
        <div class="col-md-4 ol-md-offset-4" > </div>

        <div class="col-md-4">


          <form role="form" id="rg_bitacora" action="controlador/reportes/estadisticoProduccion_controller.php" method="post" >
                <h3 class="text-center"> REPORTE PRODUCCION POR <small> TURNO-OPERADOR</small></h3>

                
                <div class="form-group">
                    <label for="exampleInputPassword1">Maquina</label>

                    <select id="maquina" name="maquina" class="form-control">
                        <option value="0">Selecciona Uno...</option>
                    </select>
                </div>
                
                  <div class="form-group">
                    <label for="exampleInputPassword1">Operador</label>
                    <select id="operador" name="operador" class="form-control">

                        <option value="0">Selecciona Uno...</option>
                    </select>

                </div>
                
                  <div class="form-group">

                    <label for="exampleInputPassword1">Turno</label>
                    <input type="text" class="form-control form-inline onlyNumbers"   name="turno"  placeholder="Valor numerico 1=A,2=B,3=C">
                    



                </div>
                
                  <div class="form-group">
                    <label for="exampleInputPassword1">Fecha Inicial</label>
                    <input type="date" name="fecha_inicial" class="form-control "  placeholder="aaaa-mm-dd"/>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Fecha Final</label>
                    <input type="date" name="fecha_final" class="form-control "  placeholder="aaaa-mm-dd"/>
                </div>
                

                <div class="form-group">
                     
                     <button class="btn btn-lg btn-primary btn-block" type="submit">Generar</button>

                  
                </div>



               
                
               
            </form>
            
           





        </div> <!-- fin class columna -->



    </div> <!-- fin row-->

</div>