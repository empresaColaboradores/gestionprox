<?php
require_once('../modelo/captcha.php');
require_once '../modelo/modal_consulta.php';
$cp = new Captchap();
$token = $cp->captchat('loging');
?>

<!DOCTYPE html>
<html lang="en">
    <head>


        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-56941141-1', 'auto');
            ga('send', 'pageview');

        </script>

        <meta name="description" content="Gestionprox es un software  para la gestión de la producción  y manejo óptimo de la información. Su principal objetivo es eliminar la papelería en el área de producción y servir como herramienta para los planes de mantenimiento,  análisis  y eliminación de los  tiempos improductivos." />


    </head>
    <style>


    </style>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="\"">GestionProx <small>Software para la Gestion de la Producci&oacute;n</small></a>
            </div>

        </div>
    </div>




    <div class="container" >

        <div class="page-header">
            <div class="container">
                <h1>GestionProx <small>Software para la Gestion de la Producci&oacute;n</small></h1>



            </div>
        </div>
    </div>

    <div class="container">

        <div class="jumbotron">
            <p>GESTIONPROX</p>
            <div class="continer">
                <form>
                    <div class="form-group form-inline">
                        <label>nombre</label>

                        <input type="text" class="form-control form-inline">
                        <label>apellido</label>
                        <input type="text" class="form-control form-inline">
                    </div>

                    <div class="form-group form-inline">
                        <label>Madre</label>

                        <input type="text" class="form-control form-inline">
                        <label>Padre</label>
                        <input type="text" class="form-control form-inline">
                    </div>
                    
                    <div class="form-group form-inline">
                        <label>Telefeno</label>

                        <input type="tel" class="form-control form-inline">
                        <label>direccion</label>
                        <input type="text" class="form-control form-inline">
                    </div>
                    
                    <div class="form-group form-inline">
                        <label>CELULAR</label>
                        <input type="tel" class="form-control form-inline">
                        
                    </div>


                    <button class="btn"> Enviar</button>
                </form>

            </div>

        </div>
    </div>




    <div class="container">
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-md-4">
                <h2>Misi&oacute;n</h2>
                <p class="text-justify">Generar  soluciones precisas y efectivas para el sector industrial
                    a trav&eacute;s de  herramientas inform&aacute;ticas desarrolladas a la medida que generen una ventaja competitiva y una
                    recuperaci&oacute;n de la inversi&oacute;n en poco tiempo. </p>
                 <p><a class="btn btn-default" href="#" role="button">Ver m&aacute;s &raquo;</a></p>
            </div>
            <div class="col-md-4">
                <h2>Visi&oacute;n</h2>
                <p class="text-justify">Para el 2018 ser la empresa l&iacute;der  a nivel  regional en el desarrollo de soluciones que ayuden a las pymes
                    en su crecimiento y fortalecimiento empresarial. </p>
                  <p><a class="btn btn-default" href="#" role="button">Ver m&aacute;s &raquo;</a></p>
            </div>
            <div class="col-md-4">
                <h2>Objetivos</h2>
                <p class="text-justify">Proporcionar las bases para la implementaci&oacute;n de herramientas inform&aacute;ticas que a partir de estas,
                    el sector industrial pueda desarrollar mejoras que ayuden a su crecimiento  a trav&eacute;s del uso
                    de las tecnolog&iacute;as, buscando la optimizaci&oacute;n de recursos, productividad e incremento en la competitividad
                </p>
               <!-- <p><a class="btn btn-default" href="#" role="button">Ver m&aacute;s &raquo;</a></p>-->
            </div>
        </div>

        <hr>

        <div class="container">
            <!-- Example row of columns -->
            <div class="row">

                <div class="col-md-4">
                    <h2>Que es GestionProx</h2>
                    <p class="text-justify"> <b>Gestionprox</b> es un software  para la gesti&oacute;n de la producci&oacute;n  y manejo &oacute;ptimo de la informaci&oacute;n. 
                        Su principal objetivo es eliminar la papeler&iacute;a en el &aacute;rea de producci&oacute;n y servir como herramienta para los planes de mantenimiento,  
                        an&aacute;lisis  y eliminaci&oacute;n de los  tiempos improductivos.</p>

                </div>

                <div class="col-md-4">
                    <h2>Caracter&iacute;sticas</h2>
                    <p class="text-justify">  
                    <ul>
                        <li>  <p class="text-justify"> <b>Sencillo.</b> <strong>GestionProx</strong> Esta desarrollado pensando en la comodidad de sus usuarios, eliminando las complejidades que dificultan el uso de las herramientas inform&aacute;ticas. </p></li>
                        <li> <b>Potente</b> <p class="text-justify"> <strong>GestionProx</strong> Procesa toda su informaci&oacute;n generando estad&iacute;sticos sencillo, facilitando la toma de decisiones en su dependencia</p></li>

                    </ul>
                    </p>

                </div>


                <div class="col-md-4">
                    <h2>Beneficios</h2>
                    <p class="text-justify">  
                    <ul>
                        <li>  <p class="text-justify"> <b>No gaste m&aacute;s papeler&iacute;a.</b> <strong>GestionProx</strong> Esta desarrollado para que reemplace el papel y comience  a disfrutar de los beneficios de la tecnolog&iacute;a en producci&oacute;n </p></li>
                        <li> <b>Lib&eacute;rese</b> <p class="text-justify"> <strong>GestionProx</strong> Ofrece su versi&oacute;n m&oacute;vil totalmente gratis, para que gestione su empresa  donde quiera que se encuentre, liber&aacute;ndolo del espacio de la oficina o el uso exclusivo del computador</p></li>

                    </ul>
                    </p>

                </div>




            </div>

            <hr>






        </div> <!-- /container -->



        <div class="container">
            <!-- Example row of columns -->
            <div class="row">

                <div class="col-md-4">
                    <h2>Compatibildad</h2>
                    <p class="text-justify"><b>Gestionprox</b> est&aacute; desarrollado en lenguaje web lo que garantiza su  compatibilidad  con otros sistemas operativos distintos de Windows. </p>
                    <a class="btn btn-danger"> </a>

                </div>

                <div class="col-md-4">

                    <h2>Adaptabilidad</h2>
                    <p class="text-justify">Gracias a su  entorno web <b> Gestionprox</b> puede ser utilizado en distintos dispositivos m&oacute;viles <br>
                        <a class="btn btn-success"> ver </a>


                    </p>


                </div>
                <div class="col-md-4">

                    <h2>Versatilidad</h2>
                    <p class="text-justify"> Muchas  empresas   utilizan formatos en papel para registrar la informaci&oacute;n y luego esta ser cargada a un programa.
                        <b>Gestionprox</b> brinda oportunidad para cargar los datos directamente en la aplicaci&oacute;n utilizando dispositivos m&oacute;viles de bajo costo </p>
                    <a class="btn btn-info"> info </a>


                </div>





            </div>








        </div> <!-- /container -->

        <div class="container">

            <div class="col-md-4">

                <h2>Pago en linea</h2>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target ="_blank">
                    <input type="hidden" name="cmd" value="_xclick">
                    <input type="hidden" name="business" value="rocha7778@hotmail.com">
                    <input type="hidden" name="lc" value="ES">
                    <input type="hidden" name="item_name" value="SERVICIO GESTIONPROX">
                    <input type="hidden" name="button_subtype" value="services">
                    <input type="hidden" name="no_note" value="0">
                    <input type="hidden" name="currency_code" value="USD">
                    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
                    <input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal. La forma rápida y segura de pagar en Internet.">
                    <img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
                </form>


            </div>

            <div class="col-md-4">

                <h2>Contactenos</h2>
                <p class="text-justify">
                    Ventas<br>
                    GestionProx<br>
                    CEL. 304-4705467<br>
                    E-mail: <a href="">servicioalcliente@gestionprox.com</a>
                </p>


            </div>

        </div> <!-- contactenos -->





        <footer>
            <p>&copy; Company 2014</p>
        </footer>
    </div> <!-- /container -->






    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript" ></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


</body>
</html>