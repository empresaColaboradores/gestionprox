<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8">
        <title>SOFTWARE PARA LA GESTI&Oacute;N DE LA PRODUCCI&Oacute;N</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Gestionprox es un software  para la gestión de la producción  y manejo óptimo de la información. Su principal objetivo es eliminar la papelería en el área de producción y servir como herramienta para los planes de mantenimiento,  análisis  y eliminación de los  tiempos improductivos." />
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">




        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <script language="javascript" src="script/ajax.js"></script>
        <script language="javascript" src="script/getXMLHTTPRequest.js"></script>
        <script language="javascript" src="script/set_ot.js"></script>










        <!-- CSS code from Bootply.com editor -->

        <style type="text/css">
            .dropdown-submenu{position:relative;}
            .dropdown-submenu>.dropdown-menu{top:0;left:100%;margin-top:-6px;margin-left:-1px;-webkit-border-radius:0 6px 6px 6px;-moz-border-radius:0 6px 6px 6px;border-radius:0 6px 6px 6px;}
            /*.dropdown-submenu:hover>.dropdown-menu{display:block;}*/
            .dropdown-submenu>a:after{display:block;content:" ";float:right;width:0;height:0;border-color:transparent;border-style:solid;border-width:5px 0 5px 5px;border-left-color:#cccccc;margin-top:5px;margin-right:-10px;}
            .dropdown-submenu:hover>a:after{border-left-color:#ffffff;}
            .dropdown-submenu.pull-left{float:none;}.dropdown-submenu.pull-left>.dropdown-menu{left:-100%;margin-left:10px;-webkit-border-radius:6px 0 6px 6px;-moz-border-radius:6px 0 6px 6px;border-radius:6px 0 6px 6px;}
        </style>
    </head>

    <!-- HTML code from Bootply.com editor -->

    <body>

        <div class="container" >

            <div class="page-header">
                <div class="container">
                    <h1>GestionProx <small>Software para la Gestion de la Producci&oacute;n</small></h1>



                </div>
            </div>
        </div>

        <div class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/amd/"><i class="icon-home icon-white"> </i>GestionProx</a>                        </a>
                </div>

                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">


                        <!-- inicio clave y lougout-->

                      

                        <!-- fin claves y logout-->




                        <!-- inicio nosotros-->
                        <li class="menu-item dropdown"> 
                            <a  target ="_blank" href ="peticion/slide.php" > <span class="glyphicon glyphicon-user"></span> &nbsp;&nbsp;Nosotros</a>




                        </li> <!-- fin nosotro-->
                        <!-- inicio planecion -->

                        <!--fi planeacion -->


                        <!-- inicio produccion-->
               
                        <!-- fin producicon-->

                        <!-- inicio logistica-->




                        <!-- fin logistica -->

                        <!-- nueva ventana-->

                        <li class="menu-item "><a  title="Nueva Ventana"target ="_blank" href ="/"><span class="glyphicon glyphicon-new-window"></span> &nbsp;&nbsp; Nueva Ventana</a></li>


                        <!-- fin nueva ventana-->
                        <li class="menu-item "> <a>  Usted es: <?php
                                if (($_SESSION['k_userName'])) {
                                    echo ($_SESSION['k_userName']);
                                } else {
                                    echo "visitante";
                                }
                                ?> </a></li>

                    </ul>

                </div>
            </div>
        </div>



        <div class="page-header">
            <div class="container text-center">
                <div  id="vista">


                    <button  id='loging' class="btn btn-lg btn-primary " title="Registrar Bitacora" type="submit"> <h1><span  class="glyphicon glyphicon-user"></span></h1></button>

                </div>

            </div>
        </div>


        <div class="panel-footer">
            <div class="container text-center">
                <p class="text-muted">Software para la Gestion de la Produccion</p>
            </div>
        </div>







        <script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>







        <!-- JavaScript jQuery code from Bootply.com editor  -->

        <script type='text/javascript'>

            $(document).ready(function () {

                $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function (event) {
                    // Avoid following the href location when clicking
                    event.preventDefault();
                    // Avoid having the menu to close when clicking
                    event.stopPropagation();
                    // If a menu is already open we close it
                    $('ul.dropdown-menu [data-toggle=dropdown]').parent().removeClass('open');
                    // opening the one you clicked on
                    $(this).parent().addClass('open');

                    var menu = $(this).parent().find("ul");
                    var menupos = menu.offset();

                    if ((menupos.left + menu.width()) + 30 > $(window).width()) {
                        var newpos = -menu.width();
                    } else {
                        var newpos = $(this).parent().width();
                    }
                    menu.css({left: newpos});

                });

            });

        </script>

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
            ga('create', 'UA-40413119-1', 'bootply.com');
            ga('send', 'pageview');
        </script>
        <!-- Quantcast Tag -->
        <script type="text/javascript">
            var _qevents = _qevents || [];

            (function () {
                var elem = document.createElement('script');
                elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
                elem.async = true;
                elem.type = "text/javascript";
                var scpt = document.getElementsByTagName('script')[0];
                scpt.parentNode.insertBefore(elem, scpt);
            })();

            _qevents.push({
                qacct: "p-0cXb7ATGU9nz5"
            });
        </script>
    </body>
</html>