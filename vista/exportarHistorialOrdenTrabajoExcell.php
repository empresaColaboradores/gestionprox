<?php
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=historial_ordenProduccion.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<?php
/**
 * este archivo se utiliza para
 * exportar los registros de tiempos improductivos
 * a un archivo en excell
 */
require_once ('../modelo/validar_usuario.php');
;

if (!isset($_SESSION)) {
    session_start();
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>


    </head>
    <body>

        <div id="head">


        </div>




        <?php
        $columnas1 = $field - 1;

        $color = "#66CCFF";
        $colorLineas = "blue";
        ?>

        <?php
        if (validar_user()) {
            ?>

            <div id="vista">
                <div id="vista3">










                    <div id="vistaSinBotones" >





                        <table class="estandarTabla">
                            <tr>
                                <td width="2%">
                                    <!-- espacio izquierdo -->    
                                </td>

                                <td width="96%">

                                    <table class="impresion"  id="datos_cliente" border="1">

                                        <tr>
                                            <th colspan="10" >  HISTORIAL TIEMPO IMPRODUCTIVO</th>
                                        </tr>






                                        <tr bgcolor= "<?php echo $color ?> ">
                                              
                                            <th>Id</th>
                                            <th>Estado</th>
                                            <th >Maq.</th>
                                            <th >Operador</th>
                                            <th >Mecanico</th>
                                            <th style="width:14%"> Fecha</th> 
                                            <th>NotaOperador </th>
                                            <th>NotaTecnico </th>
                                        </tr>








                                        <?php
                                        $tabla->imprimirTabla();
                                        ?>



                                    </table>


                                </td>

                                <td width="2%">
                                    <!-- espacio derecho -->

                                </td>



                            </tr>

                        </table>

                        <br>







                    </div>


                </div>

            </div>

            <!-- tabla interna-->
        </body>
    </html>
    <?php
} else {



    echo("<script>alert('Usted no esta logiado, ingrese para ver este contenido')</script>");




    echo('<script>location.href="../index.php"</script>');
    ?>




<?php } ?>








