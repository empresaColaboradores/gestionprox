<?php
require_once ('../modelo/validar_usuario.php');
if (!isset($_SESSION)) {
    session_start();
}

validar_user_amd();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8">
        <title>SOFTWARE PARA LA GESTI&Oacute;N DE LA PRODUCCI&Oacute;N</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">



        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->


        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> 

        <script language="javascript" src="../script/ajax_amd.js"></script>
        <script language="javascript" src="../script/getXMLHTTPRequest.js"></script>










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
                    <h1>GestionProx <small>Modulo Administrador</small></h1>



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
                    <a class="navbar-brand" href="/"><i class="icon-home icon-white"> </i>GestionProx</a>                      </a>
                </div>

                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">


                        <li class="menu-item dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Sistema <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="menu-item dropdown dropdown-submenu"><a  href="#"  class="dropdown-toggle" data-toggle="dropdown">Modulo de Usuarios</a>


                                    <ul class="dropdown-menu">
                                        <li class="menu-item"> <a id="rg_usuario" href="#">Crear</a> </li>
                                        <li class="menu-item"> <a id="find_usuario" href="#">Buscar</a> </li>
                                        <li class="menu-item"> <a  id="up_usuario" href="#">Actualizar</a> </li>
                                        <li class="menu-item "> <a title="Cambiar Clave" id="change_pass"  href="#" class="dropdown-toggle" data-toggle="dropdown"> Cambiar Clave</a>


                                        </li>

                                    </ul>




                                </li>

                                <li class="menu-item dropdown dropdown-submenu">
                                    <a  href="#" class="dropdown-toggle" data-toggle="dropdown">Modulo Maquinas</a>
                                    <ul class="dropdown-menu">
                                        <li class="menu-item"> <a id ="rg_maquina" href="#">Crear</a> </li>
                                        <li class="menu-item"> <a id ="find_maquina" href="#">Buscar</a> </li>
                                        <li class="menu-item"> <a id ="add_timeToMachine" href="#">Asignar Tiempo Productivo</a> </li>
                                        <li class="menu-item"> <a id ="find_timeToMachine" href="#">Buscar Tiempo Productivo</a> </li>
                                        <li class="menu-item"> <a id ="add_mainMedida" href="#">Asignar Medida de Produccion Principal</a> </li>
                                        <li class="menu-item"> <a id ="find_mainMedida" href="#">Buscar Medida de Produccion Principal</a> </li>
                                        <li class="menu-item"> <a id ="add_secondMedida" href="#">Asignar Medida de Produccion Secundaria</a> </li>
                                        <li class="menu-item"> <a id ="find_secondMedida" href="#">Buscar Medida de Produccion Secundaria</a> </li>


                                    </ul>
                                </li>

                                <li class="menu-item dropdown dropdown-submenu">
                                    <a  href="#" class="dropdown-toggle" data-toggle="dropdown">Modulo Area</a>
                                    <ul class="dropdown-menu">
                                        <li class="menu-item"> <a  id ="rg_area" href="#">Crear</a> </li>
                                        <li class="menu-item"> <a  id ="find_area" href="#">Buscar</a></li>
                                        <li class="menu-item"> <a  id ="relacionarUsuarioArea" href="#">Relacionar Area-Usuario</a></li>
                                        <li class="menu-item"> <a  id ="BuscarRelacionUsuarioArea" href="#">Buscar Relacion Area-Usuario</a></li>
                                        <li class="menu-item"> <a  id ="RelacionarMaquinaArea" href="#">Relacionar Area-Maquina</a></li>
                                        <li class="menu-item"> <a  id ="BuscarRelacionMaquinaArea" href="#">Buscar Relacion Area-Maquina</a></li>

                                    </ul>
                                </li>
                                
                                
                                <li class="menu-item dropdown dropdown-submenu">
                                    <a  href="#" class="dropdown-toggle" data-toggle="dropdown">Arbol Jerarquico-Maquina</a>
                                    <ul class="dropdown-menu">
                                   
                                        <li class="menu-item"> <a  id ="asignarArbolJerarQuicoAMaquina" href="#">Asignar Arbol Jerarquico-Maquina </a></li>
                                        <li class="menu-item"> <a  id ="buscarrArbolJerarQuicoAMaquina" href="#">Buscar Arbol Jerarquico-Maquina</a></li>
                                        <li class="menu-item"> <a  id ="actualizarArbolJerarQuicoAMaquina" href="#">Actualizar Arbol Jerarquico-Maquina</a></li>
                                        
                                     

                                    </ul>
                                </li>

                                <li class="menu-item dropdown dropdown-submenu"><a  href="#"  class="dropdown-toggle" data-toggle="dropdown">Modulo Seccion Maquina</a>


                                    <ul class="dropdown-menu">
                                        <li class="menu-item"> <a id="amd_crear_seccion" href="#">Crear</a> </li>
                                        <li class="menu-item"> <a id="find_seccion" href="#">Buscar</a> </li>


                                    </ul>




                                </li>

                                <li class="menu-item dropdown dropdown-submenu"><a  href="#"  class="dropdown-toggle" data-toggle="dropdown">Modulo Equipo Maquina</a>


                                    <ul class="dropdown-menu">
                                        <li class="menu-item"> <a id="amd_crear_equipo" href="#">Crear</a> </li>
                                        <li class="menu-item"> <a id="amd_find_equipo" href="#">Buscar</a> </li>


                                    </ul>




                                </li>

                                <li class="menu-item dropdown dropdown-submenu"><a  title="ultimo nivel gerarquico" href="#"  class="dropdown-toggle" data-toggle="dropdown">Modulo Parte Maquina</a>


                                    <ul class="dropdown-menu">
                                        <li class="menu-item"> <a id="amd_crear_parte" href="#">Crear</a> </li>
                                        <li class="menu-item"> <a id="amd_find_parte" href="#">Buscar</a> </li>


                                    </ul>




                                </li>


                        </li>



                        <li class="menu-item dropdown dropdown-submenu"><a  href="#" class="dropdown-toggle" data-toggle="dropdown">Modulo Operadores</a>
                            <ul class="dropdown-menu">
                                <li class="menu-item"> <a id="rg_operador" href="#">Crear</a> </li>
                                <li class="menu-item"> <a  id="find_operador" href="#">Buscar</a> </li>


                            </ul>



                        </li>


                        <li class="menu-item dropdown dropdown-submenu"><a  href="#" class="dropdown-toggle" data-toggle="dropdown">Causa Tiempo Improductivo</a>
                            <ul class="dropdown-menu">
                                <li class="menu-item"> <a id="rg_origen" href="#">Crear</a> </li>
                                <li class="menu-item"> <a id="find_origen" href="#">Buscar</a> </li>


                            </ul>



                        </li>

                        <li class="menu-item dropdown dropdown-submenu"><a  href="#" class="dropdown-toggle" data-toggle="dropdown">Tipo de Fallas</a>
                            <ul class="dropdown-menu">
                                <li class="menu-item"> <a id="rg_causa" href="#">Crear</a> </li>
                                <li class="menu-item"> <a id="find_causa" href="#">Buscar</a> </li>
                                <li class="menu-item"> <a id="find_maquina_origen_causa" href="#">tiempo Improductivo por maquina</a> </li>


                            </ul>



                        </li>













                    </ul>
                    </li><!-- fin ventas-->


                    <!-- inicio nosotros-->
                    <!-- inicio nosotros-->
                    <li class="menu-item dropdown"> 
                        <a  target ="_blank" href ="../peticion/slide.htm" > Nosotros</a>




                    </li> <!-- fin nosotro-->
                    <!-- fin nosotro-->




                    <!-- nueva ventana-->


                    <li class="menu-item "><a target ="_blank" href ="/amd/">Nueva ventana</a></li>


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
            <div class="container">
                <div  id="vista"> </div>

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